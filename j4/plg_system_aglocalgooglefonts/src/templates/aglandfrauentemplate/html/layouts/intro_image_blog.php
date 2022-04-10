<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$params  = $displayData->params;
?>

<?php $images = json_decode($displayData->images); ?>
<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
	<div class="entry-image intro-image"> 
	<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
	<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language)); ?>"><figure><img
	src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" class="img-fluid intro_image_blog" itemprop="thumbnailUrl"/>
	  <figcaption><?php if ($images->image_intro_caption) :
			echo htmlspecialchars($images->image_intro_caption);
				  endif; ?></figcaption></figure></a>
	<?php else :
		?><figure><img
	src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" class="img-fluid intro_image_blog" itemprop="thumbnailUrl"/>
	   <figcaption><?php if ($images->image_intro_caption) :
			echo htmlspecialchars($images->image_intro_caption);
				   endif; ?></figcaption></figure>
	<?php endif; ?> 
</div>
<?php endif; ?>

