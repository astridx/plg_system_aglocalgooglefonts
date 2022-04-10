<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
?>


<div class="container-fluid">
	<div class="row">

		<div class="col-xs-4">

			<div class="card">

				<?php echo JHtml::_('image', $this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), ['class' => 'img-fluid', 'id' => 'img-landfrau']); ?>

			</div>

		</div>


		<div class="col-xs-8">

			<h3 class="card-title"><?php echo $this->contact->name; ?></h3>
			<h4 class="card-subtitle text-muted"><?php echo $this->escape($this->contact->category_title); ?></h4>
			<?php echo $this->contact->misc; ?>
			<?php echo $this->loadTemplate('address'); ?>
		</div>
	</div>
</div>