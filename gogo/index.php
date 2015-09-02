<?php
header("content-type:text/html;charset=utf-8");
//设置静态资源(img/css/js)文件目录常量

//前台Home
define('CSS_URL','/Public/css/');
define('IMG_URL','/Public/img/');
define('JS_URL','/Public/js/');
define('OTHER_URL','/Public/other/');
define('UPLOAD_URL','/Public/upload/');

define('SITE_URL','/');
//后台Admin
define('ADMIN_CSS_URL','/Admin/Public/css/');
define('ADMIN_IMG_URL','/Admin/Public/img/');
define('ADMIN_JS_URL','/Admin/Public/js/');
//设置tp框架为“开发调试模式”
define('APP_DEBUG',true);//开发模式
//define('APP_DEBUG',false);//生产模式
//引用tp框架中的接口文件 ThinkPHP/ThinkPHP.php
include_once("./ThinkPHP/ThinkPHP.php");
ini_set("session.save_handler", "user");//设置PHP的SESSION由用户定义