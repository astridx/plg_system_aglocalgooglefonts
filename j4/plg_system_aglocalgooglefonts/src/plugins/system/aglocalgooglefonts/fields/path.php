<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldPath extends JFormField
{
	protected $type = 'textpath';

	public function getInput()
	{
		return 	'<div class="input-append">' .
				'<span class="add-on" style="border-radius:0;">JOOMLA/</span><input class="input-medium" style="width:300px;" type="text" name="' . $this->name . '" id="' . $this->id . '"' . ' value="'
				. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"/>' .
				'' .
				'</div>';
	}
}
