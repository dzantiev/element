##Компонент принимает 3 свойства

###fieldValue
значение из БД

###fieldSettings
{
	primaryKey:{fieldCode:<код филда>,value:<значение>}
	fieldCode
	tableCode
	...  (остальые поля для каждого филда свои)
}

###mode
- edit
- read
- editWithoutSave

### по изменению значения в филде отрабатывает следующий emit
this.$emit('onChange', {
	value    : <значени в бд>,
	settings : <основной формат настроек>
});