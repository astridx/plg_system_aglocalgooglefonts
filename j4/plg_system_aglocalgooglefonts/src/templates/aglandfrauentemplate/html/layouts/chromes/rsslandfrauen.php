<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.aghpptemplate
 *
 * @copyright   Copyright (C) 2005 - 2014 Astrid Günther.
 * @license     GNU General Public License version 2 or later;
 */
defined('_JEXEC') or die;

$module  = $displayData['module'];

	echo '<hr>';
if ($module->showtitle) {
	echo '<h2>'.$module->title.'</h2>';
}


	echo $module->content;
