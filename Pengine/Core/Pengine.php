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
    }

    protected static function init()
    {
    }

    protected static function autoload()
    {
        spl_autoload_register(function($name)
        {
            $LoadableModules = array('/App/Controller','/App/Model');

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
        new IndexController();
        print_r(get_included_files());
    }
}