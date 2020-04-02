<?php

if (!defined('ROOT')) exit('Can\'t Access !');
abstract class admin extends act {
    function __construct() {
        if (ADMIN_DIR!=config::get('admin_dir')) {
            config::modify(array('admin_dir'=>ADMIN_DIR));
            front::flash('后台目录更改成功！');
        }
        front::$rewrite=false;
        parent::__construct();
        if (!config::get('debug')) $this->check_admin();
    }
    function check_admin() {
        if (cookie::get('login_username')&&cookie::get('login_password')) {
            $user=new user();
            $user=$user->getrow(array('username'=>cookie::get('login_username'),'groupid'=>888));
            if (is_array($user)&&cookie::get('login_password')==front::cookie_encode($user['password'])) {
                $this->view->user=$user;
                front::$user=$user;
            }
            else $user=null;
        }
        if (!isset($user)||!is_array($user)) {
            front::redirect(url::create('admin/login'));
        }
    }
}