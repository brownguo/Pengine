<?php
/**
 * Created by PhpStorm.
 * User: guoyexuan
 * Date: 2019/1/10
 * Time: 9:20 PM
 */

define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");

define('APP_DEBUG', true);

echo BASE_PATH.'config/config.php'.PHP_EOL;
$config = require(BASE_PATH . 'core/Pengine.php');

Pengine::run();