<?php
/**
 * Created by PhpStorm.
 * User: guoyexuan
 * Date: 2019/1/10
 * Time: 9:25 PM
 */

class Pengine
{
    public function __construct()
    {

    }

    public static function run()
    {
        static::init();
        static::autoload();
        static::dispathch();
        static::checkEnv();
    }

    protected static function init()
    {

    }

    protected static function autoload()
    {
        spl_autoload_register(function($name)
        {
            $LoadableModules = array('/App/Controller','/App/Model','App/Config','App/Model','App/View');

            foreach ($LoadableModules as $module)
            {
                $filename =  BASE_PATH.$module.'/'.$name . '.php';
                if (file_exists($filename))
                    require_once $filename;
            }
        });
    }

    protected static function dispathch()
    {
        $Uri      = $_SERVER['REQUEST_URI'];
        $Position = strpos($Uri, '?');

        $Url = $Position === false ? $Uri : substr($Uri, 0, $Position);
        $Url = trim($Url, '/');

        parse_str($_SERVER['QUERY_STRING'],$parse_arr);

        if($parse_arr)
        {
            $params = $parse_arr;
        }

        if($Url)
        {
            $UrlArray   = explode('/',$Url);
            $Controller = ucfirst($UrlArray[0]);
            $Action     = $UrlArray[1];
        }

        $Controller = $Controller.'Controller';

        if(!class_exists($Controller))
        {
            exit('Controller not found!');
        }
        if(!method_exists($Controller,$Action))
        {
            exit(sprintf('%s not found %s Action',$Controller,$Action));
        }

        call_user_func_array(array($Controller,$Action),array($params));
    }

    protected static function checkEnv()
    {
        if(APP_DEBUG)
        {
            error_reporting(E_ALL);
            ini_set('display_errors','on');
        }
        else
        {
            error_reporting(E_ALL);
            ini_set('display_errors','off');
            ini_set('log_errors','on');
        }
    }
}