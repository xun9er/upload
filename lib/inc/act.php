<?php

abstract class act {
    public $cache_path;
    function __construct() {
        $this->filter();
        if (front::$case != 'install') {
            if (!self::installed()) header('Location: index.php?case=install&admin_dir=admin&site=default');
            $user=new user();
            if (!is_array($user->getrow('userid>0'))) {
                exit('数据库连接失败！请检查配置文件！<!--a href="index.php?case=install&admin_dir=admin&site=default">重新安装</a-->');
            }
        }
        $this->view=new view($this);
        front::$view=$this->view;
        load_lang('system.php');
        $this->view->user=null;
        $this->view->usergroupid=0;
        if (cookie::get('login_username') &&cookie::get('login_password'&&systemfind::find('cookie.inc'))) {
            $user=new user();
            $user=$user->getrow(array('username'=>cookie::get('login_username')));
            if (is_array($user) &&cookie::get('login_password') == front::cookie_encode($user['password'])) {
                $this->view->user=$user;
                $this->view->usergroupid=$user['groupid'];
                front::$user=$user;
            }
        }
    }
    static function installed() {
        if (file_exists(ROOT.'/install/locked')) return true;
        else return false;
    }
    function init() {
    }
    function end() {
    }
    function fetch($tpl=null) {
        return $this->view->fetch($tpl);
    }
    function render($tpl=null) {
        $content=$this->view->fetch($tpl);
        $content=view::show($content,true);
        echo $content;
        if ($this->cache_path) {
            $path=$this->cache_path;
            tool::mkdir(dirname($path));
            file_put_contents($path,$content);
        }
    }
    function filter() {
        if (front::get('page')) front::check_type(front::get('page'));
    }
}