<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<dl class="contact-address dl-horizontal" itemscope itemtype="https://schema.org/PostalAddress">
	<?php if (($this->params->get('address_check') > 0) &&
		($this->item->address || $this->item->suburb  || $this->item->state || $this->item->country || $this->item->postcode)) : ?>
		<dt>
			<span class="<?php echo $this->params->get('marker_class'); ?>">
				<?php echo $this->params->get('marker_address'); ?>
			</span>
		</dt>

		<?php if ($this->item->address && $this->params->get('show_street_address')) : ?>
			<dd>
				<span class="contact-street" >
					<?php echo nl2br($this->item->address); ?>
					<br />
				</span>
			</dd>
		<?php endif; ?>

		<?php if ($this->item->suburb && $this->params->get('show_suburb')) : ?>
			<dd>
				<span class="contact-suburb" >
					<?php echo $this->item->postcode . ' ' .$this->item->suburb; ?>
					<br />
				</span>
			</dd>
		<?php endif; ?>
	<?php endif; ?>

<?php if ($this->item->email_to && $this->params->get('show_email')) : ?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo nl2br($this->params->get('marker_email')); ?>
		</span>
	</dt>
	<dd>
		<span class="contact-emailto">
			<?php echo $this->item->email_to; ?>
		</span>
	</dd>
<?php endif; ?>

<?php if ($this->item->telephone && $this->params->get('show_telephone')) : ?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>">
			<?php echo $this->params->get('marker_telephone'); ?>
		</span>
	</dt>
	<dd>
		<span class="contact-telephone" >
			<?php echo nl2br($this->item->telephone); ?>
		</span>
	</dd>
<?php endif; ?>
<?php if ($this->item->fax && $this->params->get('show_fax')) : ?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>">
			<?php echo $this->params->get('marker_fax'); ?>
		</span>
	</dt>
	<dd>
		<span class="contact-fax" >
		<?php echo nl2br($this->item->fax); ?>
		</span>
	</dd>
<?php endif; ?>
<?php if ($this->item->mobile && $this->params->get('show_mobile')) :?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>">
			<?php echo $this->params->get('marker_mobile'); ?>
		</span>
	</dt>
	<dd>
		<span class="contact-mobile" >
			<?php echo nl2br($this->item->mobile); ?>
		</span>
	</dd>
<?php endif; ?>
<?php if ($this->item->webpage && $this->params->get('show_webpage')) : ?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>">
		</span>
	</dt>
	<dd>
		<span class="contact-webpage">
			<a href="<?php echo $this->item->webpage; ?>" target="_blank" >
			<?php echo JStringPunycode::urlToUTF8($this->item->webpage); ?></a>
		</span>
	</dd>
<?php endif; ?>
</dl>
