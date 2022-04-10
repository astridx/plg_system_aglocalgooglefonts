<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
JHtml::_('behavior.core');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>
<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_CONTACT_NO_CONTACTS'); ?>	 </p>
<?php else : ?>
		<ul class="category list-striped">
			<?php foreach ($this->items as $i => $item) : ?>
				<?php if (in_array($item->access, $this->user->getAuthorisedViewLevels())) : ?>
					<?php if ($this->items[$i]->published == 0) : ?>
						<li class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
					<?php else : ?>
						<li class="row cat-list-row<?php echo $i % 2; ?>" >
					<?php endif; ?>

					<div class="col-md-2">
						<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>">
							<?php echo JHtml::_('image', $this->items[$i]->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), ['class' => 'jover-contact-cat-thumb img-thumbnail']); ?></a><br />
					</div>
					<div class="list-title col-md-7">
						<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>">
							<?php echo $item->name; ?></a>
						<?php if ($this->items[$i]->published == 0) : ?>
							<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
						<?php endif; ?>
						<p>
							<?php if ($this->params->get('show_position_headings')) : ?>
									<?php echo $item->con_position; ?><br />
							<?php endif; ?>
							<?php if ($this->params->get('show_email_headings')) : ?>
									<?php echo $item->email_to; ?><br />
							<?php endif; ?>
							<?php if ($this->params->get('show_suburb_headings') and !empty($item->suburb)) : ?>
								<?php echo $item->suburb . ', '; ?>
							<?php endif; ?>

							<?php if ($this->params->get('show_state_headings') and !empty($item->state)) : ?>
								<?php echo $item->state . ', '; ?>
							<?php endif; ?>

							<?php if ($this->params->get('show_country_headings') and !empty($item->country)) : ?>
								<?php echo $item->country; ?><br />
							<?php endif; ?>
						</p>
					</div>
					<div class="col-md-3">
						<?php if ($this->params->get('show_telephone_headings') and !empty($item->telephone)) : ?>
							<?php echo JText::sprintf('COM_CONTACT_TELEPHONE_NUMBER', $item->telephone); ?><br />
						<?php endif; ?>

						<?php if ($this->params->get('show_mobile_headings') and !empty($item->mobile)) : ?>
								<?php echo JText::sprintf('COM_CONTACT_MOBILE_NUMBER', $item->mobile); ?><br />
						<?php endif; ?>

						<?php if ($this->params->get('show_fax_headings') and !empty($item->fax)) : ?>
							<?php echo JText::sprintf('COM_CONTACT_FAX_NUMBER', $item->fax); ?><br />
						<?php endif; ?>
					</div>

					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>

		<?php if ($this->params->get('show_pagination', 2)) : ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
		<?php endif; ?>
		<div>
			<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
			<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		</div>
<?php endif; ?>