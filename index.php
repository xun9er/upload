<?php
/**
 * cmseasy: index.php
 * ============================================================================
 * 版权所有 2008-2010 cmseasy，并保留所有权利。
 * -------------------------------------------------------
 * 这不是一个自由软件！也不是一个开源软件！您不能在任何目的的前提下对程序代码进行破解、修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 *
 * @version:    v3.5 r20101031
 * ---------------------------------------------
 * $Id: index.php 2010/10/31
 */

header("Pragma:no-cache\r\n");
header("Cache-Control:no-cache\r\n");
header("Expires:0\r\n");

header("Content-Type: text/html; charset=utf-8");
header('Cache-control: private, must-revalidate'); //支持页面回跳
date_default_timezone_set('Etc/GMT-8');
$_GET['site']='default';

/*
 *验证开始
 *
define(AUTH_KEY,'6b1e062b0dcf447728a7eec6528dafb5'); //6b1e062b0dcf447728a7eec6528dafb5 = md5('www.cmseasy.cn')
//echo md5(AUTH_KEY.$_SERVER['HTTP_HOST']); //域名多重加密结果

if(md5(AUTH_KEY.$_SERVER['HTTP_HOST'])!='f5e29f075bb71d77305257fd0c0dc8ac'){
	if($_GET['admin_dir']){
		exit('请联系管理员！cmseasy@163.com');
	}
}
/*
 *验证结束
 */

class time {
    static $start;

    static function start() {
        self::$start=self::getMicrotime();
    }

    static function getMicrotime() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    static function getTime($length=6) {
        return round(self::getMicrotime()-self::$start, $length);
    }
}

time::start();

define('ROOT',dirname(__FILE__));
define('TEMPLATE',dirname(__FILE__).'/template');

if(!defined('THIS_URL')) define('THIS_URL','');

function __autoload($class) {
    include_once $class.'.php';

    if(!class_exists($class,false)) exit('系统加载类失败，类'.$class.'不存在！');
}


set_include_path(ROOT.'/lib/default'.PATH_SEPARATOR.ROOT.'/lib/plugins'.PATH_SEPARATOR.ROOT.'/lib/tool'.PATH_SEPARATOR.ROOT.'/lib/table'.PATH_SEPARATOR.ROOT.'/lib/inc');
include_once 'front_class.php';
include_once 'userfunction.php';

$debug=config::get('isdebug');//1提示错误，0禁止

if($debug || isset($_GET['isdebug'])){
    error_reporting(E_ALL & ~E_NOTICE);
}else{
    error_reporting(0);
}

$front=new front();
$front->dispatch();

stats::getbot();