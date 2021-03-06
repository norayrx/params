<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 23.08.2017
 * Time: 16:31
 *
 * @author Pavel Shulaev (https://rover-it.me)
 */

namespace Rover\Params;

use Rover\Params\Engine\Cache;
use Rover\Params\Engine\Core;

/**
 * Class Blog
 *
 * @package Rover\Params
 * @author  Pavel Shulaev (https://rover-it.me)
 */
class Blog extends Core
{
    /**
     * @var string
     */
    protected static $moduleName = 'blog';

    /**
     * @param array $params
     * @return null
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\SystemException
     * @author Pavel Shulaev (https://rover-it.me)
     */
    public static function getBlogs(array $params = array())
    {
        self::checkModule();

        if (empty($params['order']))
            $params['order'] = array('URL' => 'ASC');

        $params     = self::prepareParams($params);
        $cacheKey   = Cache::getKey(__METHOD__, serialize($params));

        if((false === (Cache::check($cacheKey))) || $params['reload']) {

            $blogs  = \CBlog::GetList($params['order'],
                $params['filter'],
                false,
                false,
                $params['select']
            );

            $result = self::prepareDBResult($blogs, $params['template'], $params['empty']);

            Cache::set($cacheKey, $result);
        }

        return Cache::get($cacheKey);
    }
}