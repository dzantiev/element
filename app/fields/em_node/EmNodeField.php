<?php

class EmNodeField extends FieldBase
{
	static $nodeTable = [];

	/**
	 * Достать значение поля
	 */
	public function getValue()
	{
		if (empty(self::$nodeTable) || empty(self::$nodeTable[$this->settings['nodeTableCode']]))
			self::$nodeTable[$this->settings['nodeTableCode']] = $this->element->select(['from' => $this->settings['nodeTableCode']]);

		if (empty(self::$nodeTable[$this->settings['nodeTableCode']]) || empty(self::$nodeTable[$this->settings['nodeTableCode']]['items']))
			return [];

		$node = null;
		foreach (self::$nodeTable[$this->settings['nodeTableCode']]['items'] as $nodeItem) {
			if ($nodeItem[$this->settings['nodeFieldCode']] == $this->fieldValue)
			{
				$node = $nodeItem;
				break;
			}
		}

		if(empty($node))
			return [];

		return [
			'id'   => $node[$this->settings['nodeFieldCode']],
			'name' => $node[$this->settings['nodeSearchCode']],
			'url'  => "/table/{$this->settings['nodeTableCode']}/el/{$node[$this->settings['nodeFieldCode']]}"
		];
	}

	/**
	 * Сохранить значение
	 */
	public function saveValue()
	{
		if(empty($this->fieldValue))
			return NULL;

		if(is_numeric($this->fieldValue))
			return intval($this->fieldValue);

		if(is_string($this->fieldValue))
			return NULL;

		if(!is_array($this->fieldValue))
			return intval($this->fieldValue);

		return $this->fieldValue['id'];
	}

	/**
	 * Gets collations
	 * @return array
	 */
	public function getCollations()
	{
		$locales = json_decode($this->getLocales());
		return [
			['name'=>$locales->is,'code'=>'IS'],
			['name'=>$locales->is_not,'code'=>'IS NOT'],
			['name'=>$locales->is_empty,'code'=>'IS EMPTY'],
			['name'=>$locales->is_not_empty,'code'=>'IS NOT EMPTY']
		];
	}

	/**
	 * Return collation SQL Where
	 * @var $whereArray = ['code' => id, 'operation' => IS_NOT_EMPTY 'value' =>]
	 * @return string
	 */
	public function getCollationSql($whereArray)
	{
		switch ($whereArray['operation']) {
			case 'IS':
				return $whereArray['code'] . ' = ' . "'" . $whereArray['value'] . "'";
				break;

			case 'IS NOT':
				return $whereArray['code'] . ' <> ' . "'" . $whereArray['value'] . "'";
				break;

			case 'IS EMPTY':
				return "{$whereArray['code']} IS NULL OR {$whereArray['code']} = \"\" ";
			break;

			case 'IS NOT EMPTY':
				return "{$whereArray['code']} IS NOT NULL AND {$whereArray['code']} <> \"\" ";
			break;
		}
		return '';
	}
}
