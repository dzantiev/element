<?php
/**
 * Abstract class for field type
 */
abstract class FieldBase extends Phalcon\Mvc\User\Plugin
{
	protected $fieldValue = '';
	protected $row        = [];
	protected $settings   = [];
	public function __construct($fieldValue = '', array $settings = [], array $row = [])
	{
		$this->fieldValue = $fieldValue;
		$this->settings   = $settings;
		$this->row        = $row;
	}
	abstract function getValue();
	abstract function saveValue();

	/**
	 * Gets field path
	 * @return string
	 */
	public function getFieldFolderPath()
	{
		$className = get_class($this);
		$classInfo = new ReflectionClass($className);
		return dirname($classInfo->getFileName());
	}

	/**
	 * Gets field settings
	 * @return array
	 */
	public function getSettings()
	{
		$dir      = $this->getFieldFolderPath();
		$fileInfo = "{$dir}/info.json";
		$settings = [];

		if(file_exists($fileInfo))
			$settings = json_decode(file_get_contents($fileInfo), true);

		$settings['fieldComponent'] = get_class($this);
		$settings['code']           = basename($dir);
		if(is_array($this->settings))
			$settings = array_merge($settings, $this->settings);

		return $settings;
	}

	/**
	 * Gets field VueJs code
	 * @return string
	 */
	public function getFieldJs()
	{
		$dir = $this->getFieldFolderPath();
		$fieldFile = "{$dir}/Field.js";
		if(file_exists($fieldFile))
			return file_get_contents($fieldFile);
		return false;
	}

	/**
	 * Gets field VueJs code
	 * @return string
	 */
	public function getSettingsJs()
	{
		$dir = $this->getFieldFolderPath();
		$fieldFile = "{$dir}/Settings.js";
		if(file_exists($fieldFile))
			return file_get_contents($fieldFile);
		return false;
	}

	/**
	 * Gets field style css file
	 * @return string
	 */
	public function getStylesCss()
	{
		$dir = $this->getFieldFolderPath();
		$fieldFile = "{$dir}/style.css";
		if(file_exists($fieldFile))
			return file_get_contents($fieldFile);
		return false;
	}
}