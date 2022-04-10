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


	// Getting params from template
	echo '<nav id="top-nav" class="hidden-md-down navbar navbar-full">';
	echo '<ul class="nav pull-xs-right navbar-nav" id="top-menu">';
	echo $module->content;
	echo '</ul>';
	echo '</nav>';
