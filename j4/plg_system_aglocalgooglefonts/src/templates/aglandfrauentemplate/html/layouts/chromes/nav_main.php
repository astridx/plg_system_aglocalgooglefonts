<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.aghpptemplate
 *
 * @copyright   Copyright (C) 2005 - 2014 Astrid Günther.
 * @license     GNU General Public License version 2 or later;
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

$module  = $displayData['module'];
$params  = $displayData['params'];
$attribs = $displayData['attribs'];

$app = Factory::getApplication();
	$sitename = $app->get('sitename');
	$logo = '<img src="' . Uri::base() . 'templates/aglandfrauentemplate/images/logo_landfrauen.png" alt="Das Logo der Landfrauen stellt eine Biene dar." />' ;

	echo '<nav id="main-nav-fixed" class="">';
	echo '<ul class="nav bg-primary sm sm-simple " id="main-menu">';
	echo $module->content;
	echo '<li><a id="landfrauenlogo" class="hidden-md-down navbar-brand pull-sm-right" href="' . Uri::base() . '">' . $logo . '</a></li>';
	echo '</ul>';
	echo '</nav>';
