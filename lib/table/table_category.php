<?php

if (!defined('ROOT')) exit('Can\'t Access !');
class table_category extends table_mode {
    function vaild() {
        if(!front::post('catname')) {
            front::flash('请填写类别标题等！');
            return false;
        }
        if(!front::post('htmldir'))
            front::$post['htmldir']=pinyin::get(front::post('catname'));
        return true;
    }
    function view_before(&$data) {
        $rank=new rank();
        $rank=$rank->getrow('catid='.front::get('id'));
        if(is_array($rank))
            $data['_ranks']=unserialize($rank['ranks']);
        else $data['_ranks']=array();
        unset($data['ranks']);
    }
    function save_after($categoryid) {
        if(front::$post['_ranks']) {
            $_ranks=serialize(front::post('_ranks'));
            $rank=new rank();
            if(is_array($rank->getrow(array('catid'=>front::get('id')))))
                $rank->rec_update(array('ranks'=>$_ranks),'catid='.$categoryid);
            else
                $rank->rec_insert(array('catid'=>front::get('id'),'ranks'=>$_ranks));
        }
        else {
            $rank=new rank();
            $rank->rec_delete('catid='.$categoryid);
        }
    }
    function save_before() {
    }
    function delete_before() {
        $tbname = config::get('database','prefix').'archive';
        $categoryid = front::$get['id'];
        $where = "catid = '$categoryid'";
        $arc=new archive();
        $arc->rec_delete($tbname,$where);
    }
}