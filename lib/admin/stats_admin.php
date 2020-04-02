<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
class stats_admin extends admin {
    protected $_table;
    function init() {
        $this->table=front::get('table');
        if (preg_match('/^my_/',$this->table)) {
            form_admin::init();
            $this->_table=new defind($this->table);
        }
        else $this->_table=new $this->table;
        $this->_table->getFields();
        $this->view->form=$this->_table->get_form();
        $this->tname=lang($this->table);
        $this->tname='访问统计';
        $this->_pagesize=config::get('manage_pagesize');
        $this->view->table=$this->table;
        $this->view->primary_key=$this->_table->primary_key;
        if (!front::get('page')) front::$get['page']=1;
        $this->Exc=$this->table == 'templatetag'?true : false;
        $manage='table_'.$this->table;
        if (preg_match('/^my_/',$this->table)) $manage='table_form';
        $this->manage=new $manage;
    }
    function list_action() {
        $where=null;
        $ordre='`id` DESC';
        $limit=((front::get('page') -1) * $this->_pagesize).','.$this->_pagesize;
        $this->_view_table=$this->_table->getrows($where,$limit,$ordre,$this->_table->getcols('manage'));
        $this->view->record_count=$this->_table->record_count;
        $this->view->data = $this->_view_table;
    }
    function batch_action() {
        if (front::post('batch') &&front::post('select')) {
            $select=implode(',',front::post('select'));
            $select=$this->_table->primary_key.' in ('.$select.')';
            if (front::post('batch') == 'delete') {
                foreach (front::post('select') as $id) {
                    $this->manage->delete_before($id);
                }
                $delete=$this->_table->rec_delete($select);
                if ($delete >0) front::flash("成功删除{$this->tname}！");
                else front::flash("没有{$this->tname}被删除！");
            }
        }
        front::redirect(front::$from);
    }
    function delete_action() {
        $this->manage->delete_before(front::get('id'));
        $delete=$this->_table->rec_delete(front::get('id'));
        if ($delete) front::flash("删除{$this->tname}成功！");
        front::redirect(url::modify('act/list/table/'.$this->table.'/bid/'.session::get('bid')));
    }
    function addwebsite_action() {
        if (front::post('submit')) {
            $var = front::$post;
            $path = ROOT.'/config/website/'.front::$post['path'].'.php';
            $contenttmp = file_get_contents(ROOT.'/config/config.example.php');
            if (is_array($var))
                foreach ($var as $key=>$value) {
                    $value=str_replace("'","\'",$value);
                    $contenttmp=preg_replace("%(\'$key\'=>)\'.*?\'(,\s*//)%i","$1'$value'$2",$contenttmp);
                }
            @file_put_contents($path,$contenttmp);
            @file_put_contents(ROOT.'/config/help_'.front::$post['path'].'.php',ROOT.'/config/help.php');
            echo '<script type="text/javascript">alert("操作完成！")</script>';
            front::refresh(url('website/listwebsite',true));
        }
    }
    function editwebsite_action() {
        if (front::post('submit')) {
            $var = front::$post;
            $path = ROOT.'/config/website/'.front::$post['path'].'.php';
            $contenttmp = file_get_contents(ROOT.'/config/config.example.php');
            if (is_array($var))
                foreach ($var as $key=>$value) {
                    $value=str_replace("'","\'",$value);
                    $contenttmp=preg_replace("%(\'$key\'=>)\'.*?\'(,\s*//)%i","$1'$value'$2",$contenttmp);
                }
            @file_put_contents($path,$contenttmp);
            echo '<script type="text/javascript">alert("操作完成！")</script>';
            front::refresh(url('website/listwebsite',true));
        }
        $path = ROOT.'/config/website/'.front::$get['id'].'.php';
        $datatmp = include $path;
        $this->view->data = $datatmp;
    }
    function deletewebsite_action() {
        $path = ROOT.'/config/website/'.front::$get['id'].'.php';
        @unlink($path);
        $path = ROOT.'/config/help_'.front::$get['id'].'.php';
        @unlink($path);
        echo '<script type="text/javascript">alert("操作完成！")</script>';
        front::refresh(url('website/listwebsite',true));
    }
    function listwebsite_action() {
        $path = ROOT.'/config/website';
        $dir = opendir($path);
        $website_num = 0;
        $website = array();
        while($file = readdir($dir)) {
            if(!($file == '..')) {
                if(!($file == '.')) {
                    if(!is_dir($path.'/'.$file)) {
                        $tmparr = include $path.'/'.$file;
                        $website_num++;
                        $tmparr['website']['id'] = $website_num;
                        $tmparr['website']['url'] = $tmparr['site_url'];
                        $tmparr['website']['path'] = $file;
                        $tmparr['website']['hostname'] = $tmparr['database']['hostname'];
                        $tmparr['website']['user'] = $tmparr['database']['user'];
                        $tmparr['website']['password'] = $tmparr['database']['password'];
                        $website[] = $tmparr['website'];
                    }
                }
            }
        }
        $this->view->data = $website;
    }
    function checkmysql_action() {
        set_time_limit(0);
        $mysqlconn=@mysql_connect($_GET['host'],$_GET['user'],$_GET['pwd']);
        if($mysqlconn) {
            echo '<font color="green">连接数据库服务器成功！</font>';
        }else {
            echo '<font color="red">连接数据库服务器失败！</font>';
        }
        exit;
    }
    function checkftp_action() {
        set_time_limit(0);
        $ftp = new nobftp();
        $ftp->connect($_GET['ftpip'],$_GET['ftpuser'],$_GET['ftppwd']);
        $ftperror = $ftp->returnerror();
        if(!$ftperror) {
            echo '<font color="green">连接FTP服务器成功！</font>';
        }else {
            echo '<font color="red">'.$ftperror.'</font>';
        }
        exit;
    }
    function end() {
        $this->render('index.php');
    }
}