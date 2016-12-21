<?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$public=dirname(__FILE__).'/protected/config/public.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
error_reporting(E_ALL^E_NOTICE^E_WARNING);  //关闭php警告 (修改配置也可以)


require_once($yii);
require_once($public);
Yii::createWebApplication($config)->run();
