<?php

class cache_act extends act {
    function init() {
        $this->check_admin();
    }
    function check_admin() {
        if(cookie::get('login_username') &&cookie::get('login_password')) {
            $user=new user();
            $user=$user->getrow(array('username'=>cookie::get('login_username'),'groupid'=>888));
            if(is_array($user)  &&cookie::get('login_password')==front::cookie_encode($user['password'])) {
                $this->view->user=$user;
            }
        }
        if(!isset($user) ||!is_array($user)) {
            front::redirect(url::create('admin/login'));
        }
    }
    function index_action() {
        $case='archive';
        $act='list';
        $_GET=array('case'=>$case,'act'=>$act);
    }
}