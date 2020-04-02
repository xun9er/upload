<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
class index_admin extends admin {
    function init() {
    }
    function index_action() {
        session::del('mod');
    }
    function hotsearch_action() {
        $this->render('dialog/hotsearch.php');
        exit;
    }
    function logout_action() {
        cookie::del('login_username');
        cookie::del('login_password');
        session::del('username');
        require_once ROOT.'/celive/include/config.inc.php';
        require_once ROOT.'/celive/include/celive.class.php';
        $login=new celive();
        $login->auth();
        $GLOBALS['auth']->logout();
        $GLOBALS['auth']->check_logout1();
        front::redirect(url::create('index'));
    }
    function end() {
        $this->render('index.php');
    }
}