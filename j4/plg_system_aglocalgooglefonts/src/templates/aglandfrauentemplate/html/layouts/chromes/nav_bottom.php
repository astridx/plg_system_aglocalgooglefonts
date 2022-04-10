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
	$app = JFactory::getApplication();
	$params = $app->getTemplate(true)->params;

if ($params->get('navbarfixedbottom')) {
	$navbarfixedbottom = 'navbar-fixed-bottom';
} else {
	$navbarfixedbottom = '';
}

	echo '<nav class="navbar bg-inverse ' . $navbarfixedbottom . ' navbar-full">';
	echo '<ul class="nav navbar-nav" id="bottom-menu">';
	echo $module->content;
	echo '</ul>';
	echo '</nav>';
