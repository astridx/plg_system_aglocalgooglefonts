<?php
/**
 * @package     Joomla.Site
 * @subpackage  pkg_aghyphenopoly
 *
 * @copyright   Copyright (C) 2005 - 2019 Astrid Günther, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 * @link        astrid-guenther.de
 */

defined('_JEXEC') or die;

/**
 * System Plugin Aghypenopoly Plugin
 *
 * @since  0.0.1
 */
class GoogleFont
{
	/**
	 * Name
	 *
	 * @var    string
	 * @since  0.0.1
	 */
	public $name;

	/**
	 * Font data collected from API - via JSON for this font
	 * @var    string
	 * @since  0.0.1
	 */
	public $font_data;

	/**
	 * Constructor
	 *
	 * @param   string  $name    The name
	 * @param   array   $config  An array
	 *
	 * @since   0.0.1
	 */
	public function __construct($name, $data = array())
	{
		$this->name = $name;
		$this->font_data = $data;
	}

	/**
	 * Generate CSS based on variants and subsets
	 */
	public function generate_css($variants, $subsets)
	{
		$css = array();

		foreach ($subsets as $subset)
		{
			foreach ($variants as $variant)
			{
				$italic = false;

				// Normalize variant identifier
				$variant = $this->_normalize_variant_id($variant);

				if (strpos($variant, 'i') !== false)
				{
					$italic = true;
				}

				// Variant doesn't exist?
				if (empty($this->font_data[$subset][$variant]))
				{
					continue;
				}

				// Font data (from JSON)
				$data = $this->font_data[$subset][$variant];

				$data['fontFile'] = $this->download_font($data['fontFile']);
				$data['fontFileWoff'] = $this->download_font($data['fontFileWoff']);

				if (!$data['fontFile'] || !$data['fontFileWoff'])
				{
					// Continue;
				}

				// Common CSS rules to create
				$rules = array(
					'font-family: "' . $this->name . '"',
					'font-weight: ' . intval($variant),
					'font-style: ' . ($italic ? 'italic' : 'normal')
				);

				/**
				 * Build src array with localNames first and woff/woff2 next
				 */
				$src = array();

				$src[] = 'url(' . $data['fontFile'] . ") format('woff2')";
				$src[] = 'url(' . $data['fontFileWoff'] . ") format('woff')";

				// Add to rules array
				$rules[] = 'src: ' . implode(', ', $src);

				if (($range = $this->get_unicode_range($subset)))
				{
					$rules[] = 'unicode-range: ' . $range;
				}

				// Add some formatting
				$rules = array_map(
					function ($rule) {
						return "\t" . $rule . ";";
					},
					$rules
				);

				// Add to final CSS
				$css[] = "@font-face {\n" . implode("\n", $rules) . "\n}";
			}
		}

		return $css;
	}

	/**
	 * Normalize variant identifier
	 */
	public function _normalize_variant_id($variant)
	{
		$variant = trim($variant);

		// Google API supports bold and b as variants too
		if (stripos($variant, 'b') !== false)
		{
			$variant = str_replace(array('bold', 'b'), '700', $variant);
		}

		// Normalize regular
		$variant = str_replace('regular', '400', $variant);

		// Remove italics in variant
		if (strpos($variant, 'i') !== false)
		{
			// Normalize italic variant
			$variant = preg_replace('/(italics|i)$/i', 'italic', $variant);

			// Italic alone isn't recognized
			if ($variant == 'italic')
			{
				$variant = '400italic';
			}
		}

		// Fallback to 400
		if (!$variant || (!strstr($variant, 'italic') && !is_numeric($variant)))
		{
			$variant = '400';
		}

		return $variant;
	}

	public function download_font($url)
	{
		$path_parts = pathinfo($url);
		$name = $path_parts['filename'] . '.' . $path_parts['extension'];
		$file = JPATH_PLUGINS . '/system/aglocalgooglefonts/fonts/' . $name;

		if (!file_exists($file))
		{
			file_put_contents($file, file_get_contents($url));
		}

		$local_url = JURI::root() . 'plugins/system/aglocalgooglefonts/fonts/' . $name;

		return $local_url;
	}

	public function get_unicode_range($subset)
	{
		// Todo

		return false;
	}
}
