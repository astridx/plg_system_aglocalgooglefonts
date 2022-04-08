<?php
/**
 * @package     Joomla.Site
 * @subpackage  pkg_aghyphenopoly
 *
 * @copyright   Copyright (C) 2005 - 2020 Astrid Günther, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 * @link        astrid-guenther.de
 */

defined('_JEXEC') or die;

/**
 * Installation class to perform additional changes during install/uninstall/update
 *
 * @since  1.0.0
 */
class Pkg_AglocalgooglefontsInstallerScript extends JInstallerScript
{
	/**
	 * Extension script constructor.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function __construct()
	{
		$this->minimumJoomla = '3.9.0';
		$this->minimumPhp    = JOOMLA_MINIMUM_PHP;
	}
}
