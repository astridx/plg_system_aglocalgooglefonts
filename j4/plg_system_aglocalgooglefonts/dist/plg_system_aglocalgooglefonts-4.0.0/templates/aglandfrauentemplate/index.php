<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.aglandfrauentemplate
 *
 * @copyright   Copyright (C) 2005 - 2016 Astrid Günther, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();

$wa = $this->getWebAssetManager();

$wa->registerAndUseStyle("landcustom", 'templates/aglandfrauentemplate/css/custom.css');

$wa->registerAndUseScript('landcustombootstrap', 'templates/aglandfrauentemplate/bootstrap.min.js');
$wa->registerAndUseScript('landcustom', 'templates/aglandfrauentemplate/js/custom.js');
$wa->registerAndUseScript('smartmenus', 'templates/aglandfrauentemplate/js/jquery.smartmenus.min.js');


$tpath = Uri::base() . '/templates/aglandfrauentemplate/';
$menu = $app->getMenu();
$sitename = $app->get('sitename');
$frontpage = 0;
if ($menu->getActive() == $menu->getDefault()) {
	$frontpage = 1;
}
// Getting params from template
$params = $app->getTemplate(true)->params;
$showContentOnFrontpage = $params->get('showContentOnFrontpage', '1');
$aside = $params->get('aside', 'r');

// Use of Favicon
$faviconpath = $tpath . '/favicon';
if ($this->params->get('favicon')) {
	$faviconpath = 'images/' . $this->params->get('faviconfolder');
}

?>

<!doctype html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<!-- Head -->

<head>
	<jdoc:include type="metas" />

	<jdoc:include type="styles" />


	<script src="<?php echo Uri::base(); ?>/media/jui/js/jquery.min.js?29c73fd7cbc685ea9af0c3d8b28aeb16"
		type="text/javascript"></script>
	<script src="<?php echo Uri::base(); ?>/media/jui/js/jquery-noconflict.js?29c73fd7cbc685ea9af0c3d8b28aeb16"
		type="text/javascript"></script>
	<script src="<?php echo Uri::base(); ?>/media/jui/js/bootstrap.min.js?29c73fd7cbc685ea9af0c3d8b28aeb16"
		type="text/javascript"></script>
	<jdoc:include type="scripts" />

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $faviconpath ?>/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $faviconpath ?>/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $faviconpath ?>/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $faviconpath ?>/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $faviconpath ?>/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $faviconpath ?>/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $faviconpath ?>/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $faviconpath ?>/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $faviconpath ?>/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo $faviconpath ?>/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $faviconpath ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $faviconpath ?>/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $faviconpath ?>/favicon-16x16.png">
	<link rel="manifest" href="<?php echo $faviconpath ?>/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo $faviconpath ?>/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<link rel="shortcut icon" href="<?php echo $faviconpath ?>/favicon.ico" />

</head>

<!-- Body -->

<body>
	<div class="body container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">









		<!-- Use Landerleben in top position -->
		<!-- Nur wenn aktiviert -->
		<?php if ($params->get('landerleben') && $params->get('landerlebenposition') == 1) : ?>
		<div class="row">
			<!-- Landerleben -->
			<div class="col-xs-12">
				<a href="http://landfrauen-rheinland-nassau.de/"><img class="img-fluid hidden-md-down" style="width:33%"
						src="<?php echo $tpath . '/images/LanderlebenLogo2.jpg' ?>" alt="Landerleben"></a>
			</div>
		</div> <!-- class row -->
		<!-- End Landerleben in top position -->
		<?php endif; ?>










		<div class="row">
			<!-- Header -->

			<header class="col-xs-12">
				<?php if ($this->countModules('nav-top')) : ?>
				<jdoc:include type="modules" style="nav_top" name="nav-top" />
				<?php endif; ?>
			</header>
		</div> <!-- class row -->















		<div class="row">
			<!-- navigation -->
			<div class="col-xs-12">
				<?php if ($this->countModules('nav-main')) : ?>
				<jdoc:include type="modules" style="nav_main" name="nav-main" />
				<?php endif; ?>
			</div>
		</div> <!-- class row -->







		<div class="row">
			<!-- Breadcrumbs -->
			<div class="col-xs-12">

				<?php if (false) : //($this->countModules('navigationspfad')) : ?>
				<jdoc:include type="modules" style="navigationspfad" name="navigationspfad" />
				<?php endif; ?>

				<nav class="mod-breadcrumbs__wrapper" aria-label="Navigationspfad">
					<ol itemscope itemtype="https://schema.org/BreadcrumbList"
						class="mod-breadcrumbs breadcrumb px-3 py-2">
						<li class="mod-breadcrumbs__here float-start">

						</li>

						<li class="mod-breadcrumbs__item breadcrumb-item"><a href="/kunden/landfrauen/"
								class="pathway"><span></span></a></li>
					</ol>
				</nav>

			</div>
		</div> <!-- class row -->


		<!-- Inhaltsbereiche -->
		<!-- Auf Startseite ausblendbar -->
		<?php if (($showContentOnFrontpage && $frontpage) || (!$showContentOnFrontpage && !$frontpage) || ($showContentOnFrontpage && !$frontpage)) : ?>
		<div class="row">
			<!-- Main -->
			<main class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
				<div class="row">

					<!-- Seiteleistenausrichtung1 -->
					<!-- Article hier anzeigen falls Seitenleiste rechts  -->
					<?php if ($aside == 'r') : ?>
					<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
						<jdoc:include type="message" />
						<jdoc:include type="component" />
					</article>
					<!-- End  Seiteleistenausrichtung1 -->
					<?php endif; ?>

					<!-- Seiteleistenausrichtung -->
					<!-- hidden-md-down damit Seitenleiste auch mobil unten erscheint  -->
					<aside class="hidden-md-down col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">




						<!-- Use Landerleben in top position -->
						<!-- Nur wenn aktiviert -->
						<?php if ($params->get('landerleben') && $params->get('landerlebenposition') == 0) : ?>
						<div class="row">
							<!-- Landerleben -->
							<div class="col-xs-12">
								<a href="http://landfrauen-rheinland-nassau.de/"><img class="img-fluid hidden-md-down"
										src="<?php echo $tpath . '/images/LanderlebenLogo2.jpg' ?>"
										alt="Landerleben"></a>
							</div>
						</div> <!-- class row -->
						<!-- End  Seiteleistenausrichtung1 -->
						<?php endif; ?>


						<?php if ($this->countModules('search')) : ?>
						<jdoc:include type="modules" style="search" name="search" />
						<?php endif; ?>

						<?php if ($this->countModules('rsslandfrauen')) : ?>
						<jdoc:include type="modules" style="rsslandfrauen" name="rsslandfrauen" />
						<?php endif; ?>

						<?php if ($this->countModules('angebote')) : ?>
						<jdoc:include type="modules" style="angebote" name="angebote" />
						<?php endif; ?>

						<?php if ($this->countModules('aktuelles')) : ?>
						<jdoc:include type="modules" style="aktuelles" name="aktuelles" />
						<?php endif; ?>

						<?php if ($params->get('osm') == "0") : ?>
						<!-- Karte in Seitenleiste -->
						<div class="row">
							<!-- Landkarte osm nur wenn im Template hier aktiviert -->
							<section class="col-xs-12">
								<?php if ($this->countModules('osm')) : ?>
								<jdoc:include type="modules" style="osm" name="osm" />
								<?php endif; ?>
							</section>
						</div>
						<?php endif; ?>


						<?php if ($params->get('carousel') == "0") : ?>
						<!-- Slider in Seitenleiste -->
						<div class="row">
							<!-- Slider nur wenn im Template hier aktiviert -->
							<section class="hidden-md-down col-md-12">
								<?php if ($this->countModules('carousel')) : ?>
								<jdoc:include type="modules" style="carousel" name="carousel" />
								<?php endif; ?>
							</section>
						</div>
						<?php endif; ?>

					</aside>







					<!-- Seiteleistenausrichtung2 -->
					<!-- Article hier anzeigen falls Seitenleiste links  -->
					<?php if ($aside == 'l') : ?>
					<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
						<jdoc:include type="message" />
						<jdoc:include type="component" />
					</article>
					<!-- End  Seiteleistenausrichtung2 -->
					<?php endif; ?>

				</div>
			</main>
		</div> <!-- class row -->
		<!-- End Sidebar -->
		<?php endif; ?>








		<!-- Slider in Seitenleiste -->
		<div class="row">
			<!-- Slider nur wenn im Template hier aktiviert -->
			<section class="hidden-md-down col-md-12">
				<?php if ($this->countModules('carousel')) : ?>
				<jdoc:include type="modules" style="carousel" name="carousel" />
				<?php endif; ?>
			</section>
		</div>




		<?php if ($params->get('osm') == "1") : ?>
		<div class="row">
			<!-- Landkarte osm nur wenn im Template hier aktiviert -->
			<section class="footer col-xs-12">
				<?php if ($this->countModules('osm')) : ?>
				<jdoc:include type="modules" style="osm" name="osm" />
				<?php endif; ?>
			</section>
		</div>
		<?php endif; ?>



		<div class="row">
			<!-- Fußbereich -->
			<footer class="footer col-xs-12">
				<?php if ($this->countModules('nav-bottom')) : ?>
				<jdoc:include type="modules" style="nav_bottom" name="nav-bottom" />
				<?php endif; ?>


				<div class="bg-primary">
					<span class="bg-primary text-muted pull-xs-right">&copy; <?php echo date('Y'); ?>
						<?php echo $sitename; ?></span>
					&nbsp;
				</div>

			</footer>



			<!-- Debug -->
			<jdoc:include type="modules" name="debug" />
		</div> <!-- class row -->
	</div> <!-- class body -->







</body>

</html>