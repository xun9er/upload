<?php

if (!defined('ROOT')) exit('Can\'t Access !');
class comment_act extends act {
    function init() {
        $this->manage=new table_comment;
    }
    function add_action() {
        if(front::post('submit') &&front::post('aid')) {
            if(front::post('verify')<>session::get('verify')) {
                front::flash(lang('验证码有误！'));
                front::redirect(front::$from);
            }
            if(!front::post('username')) {
                front::flash(lang('请留下你的名字！'));
                front::redirect(front::$from);
            }
            if(!front::post('content')) {
                front::flash(lang('请填写评论内容！'));
                front::redirect(front::$from);
            }
            $this->manage->filter();
            $comment=new comment();
            $archive=new archive();
            front::$post['adddate']=date('Y-m-d H:i:s');
            $comment->rec_insert(front::$post);
            $archive->rec_update('comment=comment+1',front::post('aid'));
            front::flash(lang('提交成功！'));
            front::redirect(front::$from);
        }else {
            front::flash(lang('提交失败！'));
            front::redirect(front::$from);
        }
    }
    function list_action() {
        front::check_type(front::get('aid'));
        $this->view->article=archive::getInstance()->getrow(front::get('aid'));
        $this->view->page=front::get('page')?front::get('page'):1;
        $this->pagesize=config::get('list_pagesize');
        $limit=(($this->view->page-1)*$this->pagesize).','.$this->pagesize;
        $comment=new comment();
        $this->view->comments=$comment->getrows('aid='.front::get('aid'),$limit);
        $this->view->record_count=$comment->rec_count('aid='.front::get('aid'));
        front::$record_count=$this->view->record_count;
        $this->view->aid=front::get('aid');
    }
    function comment_js_action() {
        front::check_type(front::get('aid'));
        $comment=new comment();
        $this->view->comments=$comment->getrows('aid='.front::get('aid'),20,'1');
        $this->view->aid=front::get('aid');
        echo  tool::text_javascript($this->fetch());
        exit;
    }
    function end() {
        if(front::$debug)
            $this->render('style/index.html');
        else
            $this->render();
    }
}