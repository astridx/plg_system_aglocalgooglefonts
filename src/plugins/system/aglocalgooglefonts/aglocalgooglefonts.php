<?php

/**
 * @package     Joomla.Plugins
 * @subpackage  System.actionlogs
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Class Aglocalgooglefonts
 *
 * @since  1.0.0
 */
class PlgSystemAglocalgooglefonts extends JPlugin
{
	public $_json;

	public $_ranges;

	protected $fonts = array();

	protected $cdns = array();

	/**
	 * Fonts.
	 *
	 * @var    jsonstring
	 * @since  1.0.0
	 */
	protected $fonts_file;

	/**
	 * Load plugin language file automatically so that it can be used inside component
	 *
	 * @var    boolean
	 * @since  1.0.0
	 */
	protected $autoloadLanguage = true;

	/**
	 * Application object.
	 *
	 * @var    JApplicationCms
	 * @since  1.0.0
	 */
	protected $app;

	/**
	 * Database object.
	 *
	 * @var    JDatabaseDriver
	 * @since  1.0.0
	 */
	protected $db;

	/**
	 * Constructor.
	 *
	 * @param   object  &$subject  The object to observe.
	 * @param   array   $config    An optional associative array of configuration settings.
	 *
	 * @since   1.0.0
	 */
	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);

		$this->fonts_file = dirname(__FILE__) . '/data/google-fonts-src.json';
	}

	public function onAfterRender()
	{
		if ($this->app->isSite() == false)
		{
			return;
		}

		$template = strtolower($this->app->getTemplate());
		$body = $this->app->getBody();

		// If auto / Else custom
		if ($this->params->get('modus_ac', 0) == 0)
		{
			if (strpos($template, 'yoo') !== false)
			{
				// Todo test Yoo $body = $this->disable_yootheme_css($body, $template);
			}
		}
		else
		{
			$custompath = $this->params->get('addcssfiles');
			$body = $this->disable_custommode_css($body, $custompath);
			$customcdnpath = $this->params->get('addcdnfiles');
			$body = $this->disable_custommode_cdn($body, $customcdnpath);
		}

		$body = $this->disable($body);

		// Should we replace or is disable enought?
		$replace = $this->params->get('modus_dr', 0);

		if ($replace == 1)
		{
			foreach ($this->fonts as $font)
			{
				$localcssfile = $this->process_fonts_url($font);
				$localcsspath = JURI::root() . 'plugins/system/aglocalgooglefonts/css/';
				$string_to_insert = '<link href="' . $localcsspath . $localcssfile . '" rel="stylesheet" />';
				$body = str_replace('<head>', '<head>' . $string_to_insert, $body);
			}

			foreach ($this->cdns as $cdn)
			{
				// <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js"" defer async></script>
				// todo bisher nur js und async oder defer einfügen
				$localcdnfile = $this->process_cdns_url($cdn);
				$localcdnpath = JURI::root() . 'plugins/system/aglocalgooglefonts/cdns/';
				$string_to_insert = '<script src="' . $localcdnpath . $localcdnfile . '"></script>';
				$body = str_replace('<head>', '<head>' . $string_to_insert, $body);
			}
		}

		$this->app->setBody($body);
	}

	/**
	 * Process and generate Google Fonts' CSS by URL
	 *
	 * @return string Local css file name
	 */
	public function process_fonts_url($url)
	{
		$fonts = $this->parse_fonts_url($url);
		$css = $this->generate_css($fonts['families'], $fonts['subsets']);

		// Empty? Can't be
		if (empty($css))
		{
			return $url;
		}

		// Create CSS file
		$file = $this->create_css_file(
			implode("\n", $css), 'font-' . md5($url)
		);

		return $file;
	}

	/**
	 * Process and generate Google Fonts' CSS by URL
	 *
	 * @return string Local css file name
	 */
	public function process_cdns_url($url)
	{
		$path_parts = pathinfo($url);
		$name = $path_parts['filename'] . '.' . $path_parts['extension'];
		$file = JPATH_PLUGINS . '/system/aglocalgooglefonts/cdns/' . $name;

		if (!file_exists($file))
		{
			file_put_contents($file, file_get_contents($url));
		}

		$local_url = JURI::root() . 'plugins/system/aglocalgooglefonts/cdns/' . $name;

		return $name;
	}

	/**
	 * Load and return the Google Fonts data
	 */
	public function get_fonts_json()
	{
		if (!$this->_json)
		{
			$json = json_decode(
				file_get_contents($this->fonts_file), true
			);

			$this->_json = $json['fonts'];
			$this->_ranges = $json['ranges'];
		}

		return $this->_json;
	}

	/**
	 * Generate CSS provided a list of fonts and subsets
	 *
	 * Example:
	 * <code>
	 * 	generate_css(
	 *      [
	 *        ['name' => 'Source Sans Pro', 'variants' => '400,400i,600'],
	 *        ['name' => 'Lato', 'variants' => '400italic,600']
	 *      ],
	 *      ['latin', 'latin-ext']
	 *  );
	 * </code>
	 *
	 * @param array $families
	 * @param array $subsets
	 *
	 * @return array Array of CSS strings to join and use
	 */
	public function generate_css($families, $subsets)
	{
		$css = array();
		require_once dirname(__FILE__) . "/helper/google-font.php";

		// Jimport('\GoogleFont');

		/**
		 * Each family can have multiple variants/weights
		 */
		$json = $this->get_fonts_json();

		foreach ($families as $font)
		{
			$font_obj = new GoogleFont($font['name'], $json[$font['name']]);

			// Generate the CSS for this family
			$css = array_merge(
				$css, $font_obj->generate_css($font['variants'], $subsets)
			);
		}

		return $css;
	}

	/**
	 * Parse a standard Google Fonts /css URL
	 *
	 * @see self::parse_fonts_query()
	 * @return array
	 */
	public function parse_fonts_url($url)
	{
		// Decode htmlentities like &amp; and encoded URL
		$url = urldecode(
			htmlspecialchars_decode(trim($url))
		);

		// Protocol relative fails with parse_url
		if (substr($url, 0, 2) == '//')
		{
			$url = 'https:' . $url;
		}

		/**
		 * Parse URL to determine families and subsets
		 */
		$query = parse_url(
			$url, PHP_URL_QUERY
		);

		return $this->parse_fonts_query($query);
	}

	/**
	 * Parses a Google Fonts query string and returns an array
	 * of families and subsets used.
	 *
	 * NOTE: Data must NOT be urlencoded.
	 *
	 * @param string|array $query  Query string or parsed query string
	 *
	 * @return array
	 */
	public function parse_fonts_query($query)
	{
		if (!is_array($query))
		{
			parse_str($query, $parsed);
		}
		else
		{
			$parsed = $query;
		}

		$parsed = array_map('trim', $parsed);
		$families = explode('|', $parsed['family']);

		$subsets = array();

		if (!empty($parsed['subset']))
		{
			$subsets = explode(',', $parsed['subset']);
		}

		/**
		 * Parse variants/weights and font names
		 */
		foreach ($families as $k => $font)
		{
			$font_query = explode(':', $font);
			$font_name = trim($font_query[0]);

			if (empty($font_query[1]))
			{
				$variants = array(400);
			}
			else
			{
				$variants = explode(',', $font_query[1]);
			}

			$families[$k] = array(
				'name' => $font_name,
				'variants' => array_map('strtolower', $variants)
			);

			// Third chunk - probably a subset here from WF loader
			if (!empty($font_query[2]))
			{
				// Split and trim
				$font_subs = array_map('trim', explode(',', $font_query[2]));

				// Add it to the subsets array
				$subsets = array_merge($subsets, $font_subs);
			}
		}

		// Add fored subsets
		/*
		  if (Plugin::options()->force_subsets) {
		  $subsets = array_merge($subsets, (array) Plugin::options()->force_subsets);
		  } */

		// Remove duplicates
		$subsets = array_unique($subsets);

		// At least one subset is required
		if (empty($subsets))
		{
			$subsets = array('latin');
		}

		return array(
			'families' => $families,
			'subsets' => $subsets
		);
	}

	/**
	 * Create CSS file and return the local URL
	 *
	 * @param string|array  $css
	 * @param string|null   $name
	 */
	public function create_css_file($css, $name = '')
	{
		if (is_array($css))
		{
			$css = implode("\n", $css);
		}

		if (!$name)
		{
			$name = md5(time() . rand(1, 100000));
		}

		$name .= '.css';

		// $file = $this->get_upload_path() . sanitize_file_name($name);
		$file = JPATH_PLUGINS . '/system/aglocalgooglefonts/css/' . $name;

		// Plugin::file_system()->put_contents($file, $css, FS_CHMOD_FILE);
		file_put_contents($file, $css);

		return $name;
	}

	public function disable($text)
	{
		preg_match_all('/<link[^>]*href=["{1}|\'{1}](.*?)fonts\.google(.*?)["{1}|\'{1}][^>]*>/', $text, $matches);

		// Todo zweite zeile nur if replace
		foreach ($matches[0] as $matchIndex => $match)
		{
			$text = str_replace($match, '<!--removed google font-->', $text);
			$this->fonts[] = $matches[1][$matchIndex] . 'fonts.google' . $matches[2][$matchIndex];
		}

		preg_match_all('/<script.*src=["{1}|\'{1}](.*)googleapis\.com(.*)webfont\.js(.*)["{1}|\'{1}].*><\/script>/', $text, $matches);

		// Todo zweite zeile nur if replace
		foreach ($matches[0] as $matchIndex => $match)
		{
			$text = str_replace($match, '<!--removed google font-->', $text);
			$this->fonts[] = $matches[1][$matchIndex] . 'googleapis.com' . $matches[2][$matchIndex];
		}

		preg_match_all('/@import url\(["{1}|\'{1}](.*)fonts\.googleapis\.com(.*)\)(;?)/', $text, $matches);

		// Todo zweite zeile nur if replace
		foreach ($matches[0] as $matchIndex => $match)
		{
			$text = str_replace($match, '/*removed google font*/', $text);
			$this->fonts[] = $matches[1][$matchIndex] . 'fonts.googleapis.com' . $matches[2][$matchIndex];
		}

		return $text;
	}

	public function disable_yootheme_css($text, $tmplt)
	{
		preg_match_all('/<link[^>]*href=["{1}|\'{1}](.*?)templates\/' . $tmplt . '(.*)theme(.*)\.css(.*?)["{1}|\'{1}][^>]*>/', $text, $matches);

		foreach ($matches[0] as $matchIndex => $match)
		{
			preg_match('/\/theme(.*?)\.css/', $match, $css);
			$css = str_replace('/', '', $css[0]);
			$replace = str_replace($css, 'disable_google_font_' . $css, $match);
			$text = str_replace($match, $replace, $text);

			$filename = JPATH_THEMES . '/' . $tmplt . '/' . 'css' . '/' . $css;

			// If css file exists
			if (file_exists($filename))
			{
				$dest = JPATH_THEMES . '/' . $tmplt . '/' . 'css' . '/' . 'disable_google_font_' . $css;
				$destchild = JPATH_THEMES . '/' . $tmplt . '_child/' . 'css' . '/' . 'disable_google_font_' . $css;
				$content = explode(';', JFILE::read($filename));
				$newcontent = '';

				foreach ($content as $val)
				{
					if (preg_match('/@import(.*)fonts\.googleapis\.com(.*)/', $val))
					{
						$val = '/*' . $val . ';*/';
					}
					else
					{
						$val = $val . ';';
					}

					$newcontent .= $val;
				}

				JFile::write($dest, $newcontent);
				JFile::write($destchild, $newcontent);
			}
		}

		preg_match_all('/<link[^>]*href=["{1}|\'{1}](.*?)templates\/' . $tmplt . '(.*)bootstrap(.*)\.css(.*?)["{1}|\'{1}][^>]*>/', $text, $matches);

		foreach ($matches[0] as $matchIndex => $match)
		{
			preg_match('/\/bootstrap(.*?)\.css/', $match, $css);
			$css = str_replace('/', '', $css[0]);
			$replace = str_replace($css, 'disable_google_font_bootstrap.css', $match);
			$text = str_replace($match, $replace, $text);

			$filename = JPATH_THEMES . '/' . $tmplt . '/' . 'css' . '/' . $css;

			if (file_exists($filename))
			{
				$dest = JPATH_THEMES . '/' . $tmplt . '/' . 'css' . '/' . 'disable_google_font_bootstrap.css';
				$content = explode(';', JFILE::read($filename));
				$newcontent = '';

				foreach ($content as $val)
				{
					if (preg_match('/@import(.*)fonts\.googleapis\.com(.*)/', $val))
					{
						$val = '/*' . $val . ';*/
						';
					}
					else
					{
						$val = $val . ';';
					}

					$newcontent .= $val;
				}

				JFile::write($dest, $newcontent);
			}
		}

		return $text;
	}

	public function disable_custommode_css($text, $custompath)
	{
		foreach ($custompath as $obj)
		{
			if ($obj->path != '' && $obj->file != '')
			{
				$path = ltrim(rtrim($obj->path, '/'), '/');
				$file = ltrim($obj->file, '/');
				$replacehref = 'templates/' . $path . '/' . $file . '.css';
				$replace = 'templates/' . $path . '/disable_google_font_' . $file . '.css';
				$text = str_replace($replacehref, $replace, $text);

				$filename = JPATH_BASE . '/' . $path . '/' . $file . '.css';

				if (file_exists($filename))
				{
					$dest = JPATH_BASE . '/' . $path . '/disable_google_font_' . $file . '.css';
					$content = explode(';', JFILE::read($filename));
					$newcontent = '';

					foreach ($content as $val)
					{
						// Todo zweite zeile nur if replace
						preg_match_all('/@import url\(["{1}|\'{1}](.*)fonts\.googleapis\.com(.*)\)(;?)/', $val, $matches);

						foreach ($matches[0] as $matchIndex => $match)
						{
							$this->fonts[] = $matches[1][$matchIndex] . 'fonts.googleapis.com' . $matches[2][$matchIndex];
						}

						$match = preg_match('/@import(.*)fonts\.googleapis\.com(.*)/', $val);

						if ($match)
						{
							$val = '/*' . $val . ';*/';
						}
						else
						{
							$val = $val . ';';
						}

						$newcontent .= $val;
					}

					JFile::write($dest, $newcontent);
				}
			}
		}

		return $text;
	}

	public function disable_custommode_cdn($text, $custompath)
	{
		// Todo im Moment nur Skript dies noch für css und png? erweitern
		foreach ($custompath as $obj)
		{
			if ($obj->path != '')
			{
				$suchwort = str_replace('.', '\.', str_replace('/', '\/', $obj->path));
				preg_match_all('/<script(.*?)' . $suchwort . '(.*?)script>/', $text, $matches);

				// Todo zweite zeile nur if replace
				foreach ($matches[0] as $matchIndex => $match)
				{
					$text = str_replace($match, '<!--removed cdn -->', $text);
					$this->cdns[] = $obj->path;
				}
			}
		}

		return $text;
	}

}
