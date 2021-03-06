<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
class admin_act extends act {
    function login_action() {
        cookie::del('passinfo');
        $this->view->loginfalse=cookie::get('loginfalse'.md5($_SERVER['REQUEST_URI']));
        if (front::post('submit')) {
            if ($this->view->loginfalse) {
                if (!session::get('verify') ||front::post('verify') <>session::get('verify')) {
                    front::flash('验证码错误！');
                    $this->render();
                    exit;
                }
            }
            $user=new user();
            $user=$user->getrow(array('username'=>front::post('username'),'password'=>md5(front::post('password'))));
            if (is_array($user)) {
                if ($user['groupid'] == '888')
                    front::$isadmin=true;
                cookie::set('login_username',$user['username']);
                cookie::set('login_password',front::cookie_encode($user['password']));
                session::set('username',$user['username']);
                require_once ROOT.'/celive/include/config.inc.php';
                require_once ROOT.'/celive/include/celive.class.php';
                $login=new celive();
                $login->auth();
                $GLOBALS['auth']->login(front::post('username'),front::post('password'));
                $GLOBALS['auth']->check_login1();
                front::$user=$user;
            }elseif (!is_array(front::$user) ||!isset(front::$isadmin)) {
                cookie::set('loginfalse'.md5($_SERVER['REQUEST_URI']),(int) cookie::get('loginfalse'.md5($_SERVER['REQUEST_URI'])) +1,time() +3600);
                $event=new event;
                $event->rec_insert(array('event'=>'loginfalse','addtime'=>time(),'ip'=>front::ip()));
                front::flash('密码错误或不存在该管理员！');
                front::refresh(url('admin/login',true));
            }
        }
        $this->render();
    }

    function remotelogin_action() {
        cookie::del('passinfo');
        $this->view->loginfalse=cookie::get('loginfalse'.md5($_SERVER['REQUEST_URI']));
        if (front::$args) {
            $user=new user();
            $args = xxtea_decrypt(base64_decode(front::$args), config::get('cookie_password'));
            $user=$user->getrow(unserialize($args));
            if (is_array($user)) {
                if ($user['groupid'] == '888')
                    front::$isadmin=true;
                cookie::set('login_username',$user['username']);
                cookie::set('login_password',front::cookie_encode($user['password']));
                session::set('username',$user['username']);
                require_once ROOT.'/celive/include/config.inc.php';
                require_once ROOT.'/celive/include/celive.class.php';
                $login=new celive();
                $login->auth();
                $GLOBALS['auth']->remotelogin($user['username'],$user['password']);
                $GLOBALS['auth']->check_login1();
                front::$user=$user;
            }elseif (!is_array(front::$user) ||!isset(front::$isadmin)) {
                cookie::set('loginfalse'.md5($_SERVER['REQUEST_URI']),(int) cookie::get('loginfalse'.md5($_SERVER['REQUEST_URI'])) +1,time() +3600);
                $event=new event;
                $event->rec_insert(array('event'=>'loginfalse','addtime'=>time(),'ip'=>front::ip()));
                front::flash('密码错误或不存在该管理员！');
                front::refresh(url('admin/login',true));
            }
        }
        $this->render();
    }

    function loginfalsemaxtimes() {
        if (cookie::get('loginfalse'.md5($_SERVER['REQUEST_URI'])) >10 ||event::loginfalsemaxtimes()) {
            front::flash('帐号输入错误次数太多！请1小时后再登录！');
            return true;
        }
    }
}