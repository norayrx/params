<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 17.11.2016
 * Time: 17:46
 *
 * @author Pavel Shulaev (http://rover-it.me)
 */

namespace Rover\Params;

use Rover\Params\Engine\Core;

class Form extends Core
{
	/**
	 * @var string
	 */
	protected static $moduleName = 'form';

	/**
	 * @param array $params
	 * @return mixed
	 * @throws \Bitrix\Main\SystemException
	 * @author Pavel Shulaev (http://rover-it.me)
	 */
	public static function getWebForms($params = [])
	{
		self::checkModule();

		$rsForms = \CForm::GetList(
			$by = "s_id",
			$order = "ASC",
			[],
			$is_filtered
		);

		$params = self::checkParams($params);
		$empty  = $params['empty'];
		$result = is_null($empty)
			? []
			: [0 => $empty];

		while ($form = $rsForms->Fetch())
			$result[$form['ID']] = '['.$form['ID'].'] ' . $form['NAME'];

		return $result;
	}

}