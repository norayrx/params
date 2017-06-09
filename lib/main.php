<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 25.10.2016
 * Time: 20:35
 *
 * @author Pavel Shulaev (http://rover-it.me)
 */

namespace Rover\Params;

use Bitrix\Main\ArgumentNullException;
use Rover\Params\Engine\Core;

/**
 * Class Main
 *
 * @package Rover\Params
 * @author  Pavel Shulaev (http://rover-it.me)
 */
class Main extends Core
{
	/**
	 * @var
	 */
	protected static $currentSiteId;

	/**
	 * @param bool|false $hideAdmin
	 * @param array      $params
	 * @return array|null
	 * @author Pavel Shulaev (http://rover-it.me)
	 */
	public static function getSysGroups($hideAdmin = false, array $params = [])
	{
		$params['class']    = '\Bitrix\Main\GroupTable';
		$params['method']   = 'getList';

		if (!isset($params['filter']) && $hideAdmin)
			$params['filter'] = ['!ID' => 1];

		if (!isset($params['order']))
			$params['order'] = ['ID' => 'ASC'];

		return self::prepare($params);
	}

	/**
	 * @param            $userId
	 * @param bool|false $hideAdmin
	 * @param array      $params
	 * @return array|null
	 * @throws ArgumentNullException
	 * @author Pavel Shulaev (http://rover-it.me)
	 */
	public static function getUserSysGroups($userId, $hideAdmin = false, array $params = [])
	{
		$userId = intval($userId);
		if (!$userId)
			throw new ArgumentNullException('userId');

		if (!isset($params['add_filter']))
			$params['add_filter'] = [];

		$params['add_filter']['=ID'] = \CUser::GetUserGroup($userId);

		return self::getSysGroups($hideAdmin, $params);
	}

	/**
	 * @param string $lid
	 * @param array  $params
	 * @return array|null
	 * @author Pavel Shulaev (http://rover-it.me)
	 */
	public static function getEventTypes($lid = 'ru', array $params = [])
	{
		$params['class']    = '\Bitrix\Main\Mail\Internal\EventTypeTable';
		$params['method']   = 'getList';

		if (!isset($params['filter']))
			$params['filter'] = ['=LID' => $lid];

		if (!isset($params['template']))
			$params['template'] = ['{ID}' => '{NAME} [{EVENT_NAME}]'];

		return self::prepare($params);
	}

    /**
     * @param null   $eventName
     * @param string $siteId
     * @param array  $params
     * @return array|null
     * @author Pavel Shulaev (http://rover-it.me)
     */
	public static function getEventMessages($siteId = '', $eventName = null, array $params = [])
	{
        $params['class']    = '\Bitrix\Main\Mail\Internal\EventMessageTable';
        $params['method']   = 'getList';

        if (!isset($params['filter']))
            $params['filter'] = [];

        if (!empty($eventName))
            $params['filter']['=EVENT_NAME'] = $eventName;

        $siteId = trim($siteId);
        if ($siteId)
            $params['filter']['=LID'] = $siteId;

        if (!isset($params['template']))
            $params['template'] = ['{ID}' => '[{EVENT_NAME}] {SUBJECT}'];

        if (!isset($params['sort']))
            $params['order'] = ['EVENT_NAME' => 'asc'];

        return self::prepare($params);
	}

	/**
	 * @param $params
	 * @return array|null
	 * @author Pavel Shulaev (http://rover-it.me)
	 */
	public static function getSites(array $params = [])
	{
		$params['class']    = '\Bitrix\Main\SiteTable';
		$params['method']   = 'getList';

		if (!isset($params['template']))
			$params['template'] = ['{LID}' => '[{LID}] {NAME}'];

		return self::prepare($params);
	}

	/**
	 * @param array $params
	 * @return array|null
	 * @author Pavel Shulaev (http://rover-it.me)
	 */
	public static function getUsers(array $params = [])
	{
		$params['class']    = '\Bitrix\Main\UserTable';
		$params['method']   = 'getList';

		if (!isset($params['template']))
			$params['template'] = ['{ID}' => '{NAME} {LAST_NAME} ({LOGIN})'];

		if (!isset($params['order']))
			$params['order'] = ['ID' => 'ASC'];

		return self::prepare($params);
	}

    /**
     * @param       $object
     * @param array $params
     * @return array
     * @throws ArgumentNullException
     * @author Pavel Shulaev (https://rover-it.me)
     */
	public static function getUserType($object, array $params = [])
    {
        $params['class']    = '\Bitrix\Main\UserFieldTable';
        $params['method']   = 'getList';

        if (!isset($params['template']))
            $params['template'] = ['{ID}' => '{FIELD_NAME} [{ID}]'];

        if (!isset($params['order']))
            $params['order'] = ['ID' => 'ASC'];

        if (!isset($params['filter']))
            $params['filter'] = ['=ENTITY_ID' => $object];

        return self::prepare($params);
    }
}