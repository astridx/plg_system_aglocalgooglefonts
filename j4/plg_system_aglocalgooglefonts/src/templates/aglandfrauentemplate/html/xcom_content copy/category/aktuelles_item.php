<?php
/**
* @package Joomla.Site
* @subpackage Layout
*
* @copyright Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
* @license GNU General Public License version 2 or later; see LICENSE.txt
*/
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info = $params->get('info_block_position', 0);
?>
<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate()) || ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>
<div class="system-unpublished">
<?php endif; ?>
<div class="container">
<article class="ellipsis row">
<div class="col-md-5">
<?php echo JLayoutHelper::render('intro_image_aktuell', $this->item); ?>
</div>
<div class="col-md-7">
	
	
	<div class="container">
		<div class="row">
<div class="col-md-2">
<div class="blog-date">
<p class="date-day"><?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_JOVER_DAY')); ?></p>
<p class="date-month"><?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_JOVER_MONTH')); ?></p>
</div>
</div>
<div class="col-md-10">
<?php echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>
<div class="modern-blog-details">
<?php if ($this->params->get('show_author')) : ?>
	<?php echo JText::_('JOVER_WRITTEN_BY'); ?>: <?php echo $this->item->author; ?><br/>
<?php endif; ?> 
<?php if ($params->get('show_tags') && !empty($this->item->tags->itemTags)) : ?>
	<?php echo JText::_('JOVER_TAGS'); ?>:<?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
<?php endif; ?>
</div>
</div>
</div>

		
		</div>

	
	
		<div class="container">
		<div class="row">
<div class="modern-blog-introtext">
<?php echo $this->item->event->beforeDisplayContent; ?> <?php echo $this->item->introtext; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
		$link = new JUri($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif; ?>

	<?php echo JLayoutHelper::render('joomla.content.readmore', ['item' => $this->item, 'params' => $params, 'link' => $link]); ?>

					</div>
</div>
	</div>
			</div>
			</article>
</div>
<?php endif; ?>

<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate()) || ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>
</div>
<?php endif; ?>
<?php echo $this->item->event->afterDisplayContent; ?>
