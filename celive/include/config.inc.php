<?php
/**
* CmsEasy Live http://www.cmseasy.cn 				  			 
* by CmsEasy Live Team 							  						
**
* Software Version: CmsEasy Live v 1.2.0 					  				  
* Software by: Aiens, UTA (http://www.aiens.cn) 		      
* Copyright 2009 by: CmsEasy, (http://www.cmseasy.cn) 	  
* Support, News, Updates at: http://www.cmseasy.cn 			  			  
**
* This program is not free software; you can't may redistribute it and modify it under	  
**
* This file contains configuration settings that need to altered                  
* in order for CE Live to work, and other settings that            
**/

// 数据库配置
$config['host'] = 'localhost';
$config['database'] = 'cmseasy';
$config['username'] = 'root';
$config['password'] = 'root';
$config['prefix'] = 'cmseasy_';
$config['expire'] = 86400; //24 hours
// 如果在php.ini开启了safe_mode为'on'的话,请修改此处为true
$config['safe_mode'] = false;
// CElive的安装目录
$config['url'] = 'http://localhost/celive';
// 语言控制
$config['lang'] = 'chinese';
// 公司站点名称
$config['company'] = 'CmsEasy';
// 模板名称
$config['template'] = 'default';
// 文件上传目录
$config['upload_dir'] = 'uploadfiles/';
// 上传允许文件类型
$config['upload_file_type'] = 'jpg,gif,bmp,jpeg,png';
// 允许访客信息收集
$config['customer_info'] = true;
// 时间设置
// 无特殊要求,请按默认设置
$config['tracker_refresh'] = '5000'; //5秒
// 企业简介
$config['companyinfos'] = '<P style=\"\"\"\"MARGIN-TOP: \" class=p0 \? 0pt; MARGIN-BOTTOM: 0pt\?><SPAN style=\"\"\"\"FONT-FAMILY: \" \? ?宋体?; FONT-SIZE: 10.5pt; mso-spacerun: ?yes?\?><STRONG>CElive</STRONG><FONT face=宋体>是一套<STRONG>免安装</STRONG>客户端</FONT><FONT face=\'\\"Times\' New Roman\?>,</FONT><FONT face=宋体>支持</FONT><FONT face=\'\\"Times\' New Roman\?>JS</FONT><FONT face=宋体>调用</FONT><FONT face=\'\\"Times\' New Roman\?>,</FONT><FONT face=宋体>支持多用户</FONT><FONT face=\'\\"Times\' New Roman\?>,</FONT><FONT face=宋体>多部门</FONT><FONT face=\'\\"Times\' New Roman\?>,</FONT><FONT face=宋体>任务分配</FONT><FONT face=\'\\"Times\' New Roman\?>,</FONT></SPAN><SPAN style=\"\"\"\"FONT-FAMILY: \" \? ?宋体?; FONT-SIZE: 10.5pt; mso-spacerun: ?yes?\?>支持自定义模板<FONT face=\'\\"Times\' New Roman\?>,</FONT><FONT face=宋体>含带缓存机制</FONT><FONT face=\'\\"Times\' New Roman\?>,</FONT><FONT face=宋体>能够<STRONG>自动生成多元化调用代码</STRONG>的多语言在线客服系统</FONT><FONT face=\'\\"Times\' New Roman\?>.</FONT></SPAN><SPAN style=\"\"\"\"FONT-FAMILY: \" \? ?宋体?; FONT-SIZE: 10.5pt; mso-spacerun: ?yes?\?>是企业提供各类线上支持的便捷易管理操作的服务系统<FONT face=\'\\"Times\' New Roman\?>.</FONT></SPAN></P>';

//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);
define('CE_ROOT',str_replace("\\", '/', substr(dirname(__FILE__), 0, -7)));
define('IN_CELIVE',true);
?>