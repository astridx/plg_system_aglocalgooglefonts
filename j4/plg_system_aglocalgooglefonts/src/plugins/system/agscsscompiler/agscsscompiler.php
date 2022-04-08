<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.agscsscompiler
 *
 * @copyright   Copyright (C) 2005 - 2017 Astrid Günther. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use ScssPhp\ScssPhp\Compiler;

/**
 * Joomla! Page Agscsscompiler Plugin.
 *
 * @since  3.7
 */
class PlgSystemAgscsscompiler extends JPlugin
{
	/**
	 * Before render
	 *
	 * @return   boolean  True if the page is excluded else false
	 *
	 * @since   3.7
	 */
	public function onBeforeRender()
	{
		// Check that we are in the site application.
		if (Factory::getApplication()->isClient('administrator'))
		{
			return true;
		}

		// Load language in plugin folder.
		$this->loadlanguage();

		$folders = array();
		$folders = $this->params->get('folders', $folders);
		$filesToCompile = array();

		// Check if and what files should be compiled.
		foreach ($folders as $folder)
		{
			$scss_folder = JPATH_BASE . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $folder->scss_folder) . DIRECTORY_SEPARATOR;
			$css_folder = JPATH_BASE . DIRECTORY_SEPARATOR . $folder->css_folder . DIRECTORY_SEPARATOR;

			if ($this->params->get('force_compile', 0))
			{
				foreach (glob($scss_folder . "[!_]*.scss") as $file)
				{
					$filesToCompile[$file] = $css_folder . basename($file, '.scss') . '.css';
				}
			}
		}

		$excludedfiles = array();
		$excludedfiles = $this->params->get('excludedfiles', $excludedfiles);

		// Check if and what files should be excluded.
		foreach ($excludedfiles as $excludedfile)
		{
			foreach ($filesToCompile as $fileScss => $fileCss)
			{
				$efile = str_replace(DIRECTORY_SEPARATOR, '', JPATH_BASE . str_replace('/', DIRECTORY_SEPARATOR, $excludedfile->excludedfile));
				$ifile = str_replace(DIRECTORY_SEPARATOR, '', $fileScss);

				if ($efile === $ifile)
				{
					unset($filesToCompile[$fileScss]);
				}
			}
		}

		// Include Leafo\ScssPhp\Compiler.
		if (!class_exists('ScssPhp\ScssPhp\Compiler'))
		{
			require_once 'scssphp/scss.inc.php';
		}

		$formatter = $this->params->get('scss_compress', 'Compressed');

		if (!in_array($formatter, array('Compact', 'Compressed', 'Crunched', 'Expanded', 'Nested')))
		{
			$formatter = 'Compressed';
		}

		$formatter = 'ScssPhp\ScssPhp\Formatter\\' . $formatter;

		foreach ($filesToCompile as $fileScss => $fileCss)
		{
			$scss_compiler = new Compiler;
			$scss_compiler->setImportPaths(pathinfo($fileScss, PATHINFO_DIRNAME));

			$scss_compiler->setFormatter($formatter);

			try
			{
				$string_sass = file_get_contents($fileScss);
				$string_css = $scss_compiler->compile($string_sass);

				if ($string_css > '')
				{
					file_put_contents($fileCss, $string_css);
				}

				if ($this->params->get('msg_ok', 0))
				{
					JFactory::getApplication()->enqueueMessage(JText::sprintf('PLG_SYSTEM_AGSCSSCOMPILER_OK', $fileScss), 'success');
				}
			}
			catch (Exception $e)
			{
				JFactory::getApplication()->enqueueMessage(JText::sprintf('PLG_SYSTEM_AGSCSSCOMPILER_ERROR', $fileScss, $e->getmessage()), 'error');
			}
		}

		return true;
	}
}
