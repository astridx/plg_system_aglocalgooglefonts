<?php

/**
*   Favourite
*
*   Responsive and customizable Joomla!3 template by FAVTHEMES
*
*   @version        4.2
*   @link           http://demo.favthemes.com/favourite
*   @author         FavThemes - https://www.favthemes.com
*   @copyright      Copyright (C) 2012-2018 FavThemes.com. All Rights Reserved.
*   @license        Licensed under GNU/GPLv3, see http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
// Add current user information
$user = JFactory::getUser();

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

<head>

	<jdoc:include type="head" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- STYLESHEETS -->
  <!-- icons -->
	<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.1.0/css/all.css" type="text/css" />
  <!-- bootstrap -->
  <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/bootstrap/favth-bootstrap.css" type="text/css" />
  <!-- cms -->
  <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/cms.css" type="text/css" />
  <!-- store -->
  <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/store.css" type="text/css" />
  <!-- theme -->
  <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/theme.css" type="text/css" />
  <!-- style -->
  <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/style.css" type="text/css" />

</head>

	<body id="fav-componentpage" class="contentpane">

    <div class="fav-container">

      	<!-- MAIN -->
        <div id="fav-mainwrap">
          <div class="favth-container">
            <div class="favth-row">
      				<div id="fav-main" class="favth-clearfix">
    				    <div id="fav-maincontent" class="favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12">
    							<jdoc:include type="message" />
    							<jdoc:include type="component" />
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    </div>

	</body>

</html>