<?php
namespace Element\Hooks;

class PagesHooks extends HooksBase
{
	public function beforeSelectHook($request)
	{
		if (isset($request['call_error']) && !empty($request['call_error']))
			throw new \EmException("hook_error", 1);

		return true;
	}
	public function afterSelectHook($request, $data)
	{
		if (isset($request['not_empty_description']) && !empty($request['not_empty_description']))
		{
			$data['items'] = array_filter($data['items'], function($item) {
				return !empty($item['description']);
			});
		}
		return $data;
	}
}
