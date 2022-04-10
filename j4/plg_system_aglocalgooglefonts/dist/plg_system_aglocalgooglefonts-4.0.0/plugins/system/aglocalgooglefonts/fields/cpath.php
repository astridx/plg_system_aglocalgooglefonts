<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldCpath extends JFormField
{
	protected $type = 'textpath';

	public function getInput()
	{
		return '<div class="input-append">'
			. '<span class="add-on" style="border-radius:0;"></span>'
			. '<input class="input-medium" style="width:500px;" type="text" name="'
			. $this->name . '" id="' . $this->id . '"' . ' value="'
			. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"/>'
			. '</div>';
	}
}
