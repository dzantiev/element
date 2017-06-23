<?php

class TableController extends ControllerBase
{
	/**
	 * Работа с таблицами, содержимое таблицы
	 */
	public function indexAction($tableName = false, $page = 1)
	{
		$activeTable = $this->_setActiveTable($tableName);
		$page = intval($page);
		if($page < 1 || !$activeTable)
		{
			$this->pageNotFound();
			return false;
		}

		// достаем информацию о таблице
		$curTable = $activeTable;
		$curTable['fields'] = $this->tableEditor->getTableFilelds($activeTable['real_name']);
		$this->view->setVar('tableName',$tableName);

		// ширина таблицы, менятся относительно того сколько полей в ней
		$tableWidth = count($curTable['fields'])*150;
		$this->view->setVar('tableWidth',$tableWidth);

		//достаем все что есть в этой таблице
		$db       = $this->di->get('db');
		$limit    = 20;
		$from     = $limit*(intval($page)-1);
		$sqlWhere = $activeTable['real_name'];
		
		// Sorting
		$sortString = ' ';
		$sort       = $this->request->get('sort');
		if($sort)
		{
			$sortDir = $this->request->get('sortdir');
			$sortString = ' ORDER BY  '.$sort;
			if(!empty($sortDir))
				$sortString .= ' '.$sortDir; 
			else
				$sortString .= ' DESC'; 
		}

		$tableResult = $db->fetchAll(
			"SELECT * FROM ".$sqlWhere." ".$sortString." LIMIT $from,$limit",
			Phalcon\Db::FETCH_ASSOC
		);

		// подгон результатов по типам, для вывода 
		$fieldTypes = [];
		$primaryKey = $this->tableEditor->getPrimaryKey($tableName);
		$settingsArr = [];
		foreach ($curTable['fields'] as &$field)
		{
			$fieldTypes[$field['field']] = $field['type'];
			
			$field['sort'] = 'desc';
			if(!empty($sort) && $sort == $field['field'] && !empty($sortDir))
				$field['sort'] = $sortDir;

			$fieldName = $field['field'];
			$settingsArr[$field['field']] = (!empty($field['settings']))?$field['settings']:[];
			
			// прописываем каждому типу поля свое отображение
			if(!is_null($this->fields->{$fieldTypes[$fieldName]}))
			{
				$this->fields->{$fieldTypes[$fieldName]}->prolog($field['settings'],true);
				$field['valueFieldPath'] =  $this->fields->{$fieldTypes[$fieldName]}->getValueFieldPath();
			}
		}
		$this->view->setVar('tableInfo',$curTable);
		$this->view->setVar('tableFieldsCount',count($curTable['fields'])+1);


		foreach($tableResult as &$tRes)
			foreach($tRes as $fieldName => &$fieldVal)
				if(!is_null($this->fields->{$fieldTypes[$fieldName]}))
					$fieldVal = $this->fields->{$fieldTypes[$fieldName]}->getValue($fieldVal,$settingsArr[$fieldName],true);

		$this->view->setVar('primaryKey',$primaryKey);
		$this->view->setVar('tableResult',$tableResult);

		// постраничная навигация
		$tableResultCount = $db->fetchOne(
			"SELECT count(*) as elementcount FROM ".$sqlWhere,
			Phalcon\Db::FETCH_ASSOC
		);
		$pagination                          = [];
		$pagination['curPage']               = $page;
		$pagination['countOfPages']          = ceil($tableResultCount['elementcount']/$limit);
		$pagination['countOfElements']       = $tableResultCount['elementcount'];
		$pagination['countOfElementsOnPage'] = $limit;
		$pagination['fromPage']              = ( ($page - 3)<1 )?1:($page - 3);
		$pagination['toPage']                = ( ($page + 7)>$pagination['countOfPages'] )?$pagination['countOfPages']:($page + 7);
		$this->view->setVar('pagination',$pagination);
	}

	/**
	 * Страница с формой добавления элемента
	 */
	public function addAction($tableName = false)
	{
		$activeTable = $this->_setActiveTable($tableName);

		// достаем информацию о таблице
		$curTable = $activeTable;
		$curTable['fields'] = $this->tableEditor->getTableFilelds($activeTable['real_name']);
		
		// определяем адреса форм редактирования полей
		foreach ($curTable['fields'] as &$field)
		{
			if(!is_null($this->fields->{$field['type']}))
			{
				$this->fields->{$field['type']}->prolog($field['settings']);
				$field['formPath'] = $this->fields->{$field['type']}->getEditFieldPath();
			}
			$field['formPath'] = (!empty($field['formPath']))?'fields/'.$field['formPath']:'table/notSystemEditField';
		}

		$this->view->setVar('tableInfo',$curTable);
		$this->view->setVar('sysTypes',$this->tableEditor->systemEmTypes);
	}

	/**
	 * Страница с формой редактирования элемента
	 * @return всегда  json так как работает только при аякс запросах
	 */
	public function editAction($tableName = false, $elementId = false)
	{
		$activeTable = $this->_setActiveTable($tableName);
		$elementId = intval($elementId);
		if($elementId < 1)
		{
			$this->pageNotFound();
			return false;
		}

		// достаем информацию о таблице
		$curTable           = $activeTable;
		$curTable['fields'] = $this->tableEditor->getTableFilelds($activeTable['real_name']);
		$curTableFields     = $curTable['fields'];
		$primaryKey         = $this->tableEditor->getPrimaryKey($activeTable['real_name']);
		
		// определяем адреса форм редактирования полей
		foreach ($curTable['fields'] as  &$field)
		{
			if(!is_null($this->fields->{$field['type']}))
			{
				$this->fields->{$field['type']}->prolog($field['settings']);
				$field['formPath'] = $this->fields->{$field['type']}->getEditFieldPath();
			}
			$field['formPath'] = (!empty($field['formPath']))?'fields/'.$field['formPath']:'table/notSystemEditField';
		}
		$this->view->setVar('tableInfo',$curTable);
		$this->view->setVar('sysTypes',$this->tableEditor->getFeieldTypes());
		$this->view->setVar('primaryKey',$primaryKey);
		
		$element = $this->tableEditor->getElement($tableName, ['field'=>$primaryKey, 'value'=>$elementId]);

		// подгон под типы полей
		foreach ($curTableFields as &$field)
		{
			if(!is_null($this->fields->{$field['type']}))
				$element[$field['field']] = $this->fields->{$field['type']}->getValue($element[$field['field']],$field['settings']);
			else
				$element[$field['field']] = htmlspecialchars($element[$field['field']]);
		}
		$this->view->setVar('element',$element);
	}

	/**
	 * Сохранение/добавление элемента
	 * @return всегда  json так как работает только при аякс запросах
	 */
	public function saveAction()
	{
		if(!$this->request->isAjax())
			return $this->jsonResult(['result'=>'error','msg'=>'only ajax']);


		// тип сохранения - обновление/добавление
		// и все нужные поля
		$editMode  = $this->request->getPost('editMode');
		$tableName = $this->request->getPost('tableName');
		$field     = $this->request->getPost('field');

		// валидация
		// для этого достаем полное описание таблицы
		$curTable    = [];
		$curTable['fields'] = $this->tableEditor->getTableFilelds($tableName);

		// проход по всем полям, проверка важное это поле или нет
		$validationErrors = [];
		$formData         = [];
		$primaryKeyName   = $this->tableEditor->getPrimaryKey($tableName);
		$primaryKeyValue = (!empty($field[$primaryKeyName]))?intval($field[$primaryKeyName]):false;
		$primaryKey = [
			'field' => $primaryKeyName,
			'value' => $primaryKeyValue 
		];

		foreach ($curTable['fields'] as $key => $fieldArr)
		{
			$required = ( !empty($fieldArr['required']) && $fieldArr['required'] == 1  || $fieldArr['null'] == "NO" )?true:false;
			$required = ($fieldArr['extra'] == "auto_increment")?false:$required;
			if($required && empty($field[$fieldArr['field']])) 
				$validationErrors[] = $fieldArr['field'].' required';
			else
				if(!empty($field[$fieldArr['field']]))
					if(!is_null($this->fields->{$fieldArr['type']}))
						$formData[$fieldArr['field']] = $this->fields->{$fieldArr['type']}->saveValue($field[$fieldArr['field']],$fieldArr,$tableName,$primaryKey);
					else
						$formData[$fieldArr['field']] = $field[$fieldArr['field']];
				else
					$formData[$fieldArr['field']] = null;
		}

		// добавление или обновление после проверок валидиции 
		if(count($validationErrors))
			return $this->jsonResult([
				'result' => 'error', 
				'msg'    => implode(';<br/>', $validationErrors)
			]);
		
		$res       = false;
		$sqlErrors = [];
		if($editMode == 'add')
			$res = $this->tableEditor->insert($tableName, $formData, $sqlErrors);
		else
			$res = $this->tableEditor->update($tableName, $primaryKey, $formData, $sqlErrors);
		
		if(!$res)
			return $this->jsonResult(['result'=>'error', 'msg'=>$sqlErrors ]);

		if($editMode == 'add')
			return $this->jsonResult(['result'=>'success','elId'=>$res]);
		else
			return $this->jsonResult([
				'result' => 'success',
				'msg'    => 'элемент сохранен',
				'type'   => 'update'
			]);
	}

	/**
	 * Удаление записи из таблицы
	 */
	public function deleteAction($tableName = false, $primaryKey = false, $elementId = false)
	{
		if(!$this->request->isAjax())
			return $this->jsonResult(['result'=>'error', 'msg'=>'только ajax']);
	
		if(empty($tableName) || empty($primaryKey) ||  empty($elementId) )
			return $this->jsonResult(['result'=>'error', 'msg'=>'не все нужные поля']);
		
		$sqlErrors = [];
		if($this->tableEditor->delete($tableName, ['field'=>$primaryKey, 'value'=>intval($elementId)], $sqlErrors))
			return $this->jsonResult(['result'=>'success']);
		else
			return $this->jsonResult(['result'=>'error', 'msg'=>$sqlErrors]);
	}

	/*HELPERS*/
	/**
	 * Активирует нужную таблицу и переопределяет переменную
	 * @return array Возврощает активную таблицу
	 */
	private function _setActiveTable($tableName = false)
	{
		// активируем нужную таблицу и переопределяем все таблицы в шаблоне
		if(!empty($tableName) && array_key_exists($tableName, $this->sidebarTables))
		{
			$this->sidebarTables[$tableName]['classes'] = 'act';
			$this->view->setVar('sidebarTables',$this->sidebarTables);
			$activeTable = array_merge($this->sidebarTables[$tableName],array('real_name'=>$tableName));
			$this->view->setVar('curTable',$activeTable);
			return $activeTable;
		}
		else
		{
			$this->pageNotFound();
			return false;
		}
	}
}
