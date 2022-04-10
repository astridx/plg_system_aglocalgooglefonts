<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldText extends JFormField
{
	protected $type = 'textcss';

	public function getInput()
	{
		return 	'<div class="input-append">' .
				'<input class="input-medium" type="text" name="' . $this->name . '" id="' . $this->id . '"' . ' value="'
				. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"/>' .
				'<span class="add-on">.css</span>' .
				'</div>';
	}
}
