{% extends "table/stringEditField.volt" %}
{% block input %}
	<div class="filedEdit">
		<input name="field[{{fieldArr['field']}}]" readonly="true" class="datepicker" type="text" value="{% if element[fieldArr['field']] is defined %}{{element[fieldArr['field']]}}{% endif %}" /><span class="datepickerIcon icon calendarIcon"></span>
	</div>
{% endblock %}