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
        $LoadableModules = array('Config','plugins');

        spl_autoload_register(function($name)
        {
            global $LoadableModules;

            foreach ($LoadableModules as $module)
            {
                $filename =  SERVER_BASE.$module.'/'.$name . '.php';
                if (file_exists($filename))
                    require_once $filename;
            }
        });
    }

    protected static function dispathch()
    {

    }
}