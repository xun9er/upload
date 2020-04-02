<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
class language_admin extends admin {
    function init() {
    }
    function add_action() {
        if (front::post('submit')) {
            $path=ROOT.'/lang/'.config::get('lang_type').'/system.php';
            $tipspath=ROOT.'/lang/cn/system.php';
            $content=file_get_contents($path);
            $tipscontent=file_get_contents($tipspath);
            $replace="'".front::$post['key']."'=>'".front::$post['val']."',";
            $tipsreplace="'".front::$post['key']."'=>'".front::$post['cnnote']."',";
            $content=str_replace(');',$replace.');',$content);
            file_put_contents($path,$content);
            $pos=strpos($tipscontent,$tipsreplace);
            if (config::get('lang_type') != 'cn'&&$pos === false) {
                $tipscontent=str_replace(');',$tipsreplace.');',$tipscontent);
                file_put_contents($tipspath,$tipscontent);
            }
            if ($_GET['site'] != 'default') {
                $ftp=new nobftp();
                $ftpconfig=config::get('website');
                $ftp->connect($ftpconfig['ftpip'],$ftpconfig['ftpuser'],$ftpconfig['ftppwd'],$ftpconfig['ftpport']);
                $ftperror=$ftp->returnerror();
                if ($ftperror) {
                    exit($ftperror);
                }
                else {
                    $ftp->nobchdir($ftpconfig['ftppath']);
                    $ftp->nobput($ftpconfig['ftppath'].'/lang/'.config::get('lang_type').'/system.php',$path);
                }
            }
            echo '<script type="text/javascript">alert("操作完成！")</script>';
            front::refresh(url('language/edit',true));
        }
    }
    function edit_action() {
        $path=ROOT.'/lang/'.config::get('lang_type').'/system.php';
        $tipspath=ROOT.'/lang/cn/system.php';
        if (front::post('submit')) {
            $content=file_get_contents($path);
            $to_delete_items=front::$post['to_delete_items'];
            unset(front::$post['to_delete_items']);
            foreach (front::$post as $key=>$val) {
                preg_match_all("/'".$key."'=>'(.*?)',/",$content,$out);
                if (in_array($key,$to_delete_items))
                    $content=str_replace($out[0][0],'',$content);
                else
                    $content=str_replace($out[1][0],$val,$content);
            }
            file_put_contents($path,$content);
            if ($_GET['site'] != 'default') {
                $ftp=new nobftp();
                $ftpconfig=config::get('website');
                $ftp->connect($ftpconfig['ftpip'],$ftpconfig['ftpuser'],$ftpconfig['ftppwd'],$ftpconfig['ftpport']);
                $ftperror=$ftp->returnerror();
                if ($ftperror) {
                    exit($ftperror);
                }
                else {
                    $ftp->nobchdir($ftpconfig['ftppath']);
                    $ftp->nobput($ftpconfig['ftppath'].'/lang/'.config::get('lang_type').'/system.php',$path);
                }
            }
            unset($content);
            echo '<script type="text/javascript">alert("操作完成！")</script>';
        }
        $content=include($path);
        $tips=include($tipspath);
        $this->view->tips=$tips;
        $this->view->sys_lang=$content;
    }
    function delete_action() {
        $path=ROOT.'/lang/'.config::get('lang_type').'/system.php';
        $lang=include $path;
        exit;
        front::refresh(url('language/edit',true));
    }
    function end() {
        $this->render('index.php');
    }
}