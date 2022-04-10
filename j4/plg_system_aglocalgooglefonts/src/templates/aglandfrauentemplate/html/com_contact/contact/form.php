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
<?php if ($this->params->get('presentation_style') == 'plain') : ?>
	<?php echo '<h1>' . JText::_('COM_CONTACT_EMAIL_FORM') . '</h1>'; ?>
<?php endif; ?>

<?php echo $this->loadTemplate('form'); ?>

<br><hr>

