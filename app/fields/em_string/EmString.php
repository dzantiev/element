<?php

class EmString extends FieldBase
{
	protected $value = '';

	public function __construct($value = '')
	{
		$this->value = $value;
	}

	public function setSettings()
	{

	}
	public function getValue()
	{
		return strval($this->value);
	}
	public function saveValue()
	{

	}
}