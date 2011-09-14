<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/admin.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// 为了使uploadify不被权限检测拦截
if (isset($_POST['session_id']))
{
    $_COOKIE['PHPSESSID'] = $_POST['session_id'];
}

require_once($yii);
Yii::createWebApplication($config)->run();