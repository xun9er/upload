<?php

if (!defined('ROOT')) exit('Can\'t Access !');
class table_archive  extends table_mode {
    function view_before(&$data) {
        $pics = unserialize($data['pics']);
        if(is_array($pics) &&!empty($pics)) {
            foreach ($pics as $k =>$v) {
                $data['pics'.$k] = $v;
            }
        }
        $archive['pics'] = $v;
        unset($data['pics']);
        $rank=new rank();
        $rank=$rank->getrow('aid='.front::get('id'));
        if(is_array($rank))
            $data['_ranks']=unserialize($rank['ranks']);
        else $data['_ranks']=array();
        unset($data['ranks']);
    }
    function vaild() {
        if(!front::post('title')) {
            front::flash('请填写标题！');
            return false;
        }
        if(!front::post('catid')) {
            front::flash('请选择分类！');
            return false;
        }
        return true;
    }
    function add_before(act $act) {
        front::$post['userid']=$act->view->user['userid'];
        front::$post['username']=$act->view->user['username'];
        if(empty(front::$post['author'])) {
            front::$post['author']=$act->view->user['username'];
        }
        front::$post['checked']=1;
        if(empty(front::$post['adddate'])) {
            front::$post['adddate']=date('Y-m-d H:i:s');
        }
    }
    function save_before() {
        parent::save_before();
        $pics = array();
        foreach(front::$post as $k =>$v) {
            if(preg_match('/pics(\d+)/i',$k,$out)) {
                $pics[$out[1]] = $v;
                unset(front::$post[$k]);
            }
        }
        front::$post['pics'] = serialize($pics);
        if(!front::post('attr1')) {
            front::$post['attr1']='';
        }
        if(!front::$post['introduce'])
            front::$post['introduce']=cut(strip_tags(front::$post['content']),front::$post['introduce_len']*2);
        $content=front::post('content');
        preg_match_all('%<img[^>]*?src="[^"]*?(/upload/(archive|attachment|images)/[^"]*?[^w]\.jpg)"%i',$content,$result,PREG_SET_ORDER);
        include_once ROOT.'/lib/plugins/watermark.php';
        $ftp = new nobftp();
        $ftpconfig = config::get('website');
        foreach($result as $img) {
            if(config::get('watermark_open')) {
                imageWaterMark(ROOT.$img[1],config::get('watermark_pos'),ROOT.config::get('watermark_path'),null,5,"#FF0000",
                        config::get('watermark_ts'),config::get('watermark_qs'));
            }
            $img=$img[1];
            $img_new=str_replace('.jpg','w.jpg',$img);
            rename(ROOT.$img,ROOT.$img_new);
            if($_GET['site']!='default') {
                $ftp->connect($ftpconfig['ftpip'],$ftpconfig['ftpuser'],$ftpconfig['ftppwd'],$ftpconfig['ftpport']);
                $ftperror = $ftp->returnerror();
                if($ftperror) {
                    exit($ftperror);
                }else {
                    $ftp->nobchdir($ftpconfig['ftppath']);
                    $ftp->nobput($ftpconfig['ftppath'].$img_new,ROOT.$img_new);
                    $ftperror = $ftp->returnerror();
                    if($ftperror) exit($ftperror);
                }
            }
            front::$post['content']=str_replace($img,$img_new,front::$post['content']);
        }
    }
    function save_after($aid) {
        $tag=preg_replace('/\s+/',' ',trim(front::$post['tag']));
        $tags=explode(' ',$tag);
        $tag_table=new tag();
        $arctag_table=new arctag();
        foreach($tags as $tag) {
            if($tag)
                if(!$tag_table->getrow('tagname="'.$tag.'"'))
                    $tag_table->rec_insert(array('tagname'=>$tag));
            $tag=$tag_table->getrow('tagname="'.$tag.'"');
            $arctag_table->rec_replace(array('aid'=>$aid,'tagid'=>$tag['tagid']));
        }
        $doit = false;
        if(session::get('attachment_id') ||front::post('attachment_id')) {
            $attachment_id=session::get('attachment_id')?session::get('attachment_id'):front::post('attachment_id');
            $attachment=new attachment();
            $attachment->rec_update(array('aid'=>$aid,'intro'=>front::post('attachment_intro')),$attachment_id);
            $doit = true;
            if(session::get('attachment_id')) session::del('attachment_id');
        }
        if(front::post('attachment_path') != '' && $doit == false) {
            $attachment=new attachment();
            $attachment->rec_insert(array('aid'=>$aid,'path'=>front::post('attachment_path'),'intro'=>front::post('attachment_intro'),'adddate'=>date('Y-m-d H:i:s')));
            $doit = false;
        }
        if(front::post('_ranks')) {
            $_ranks=serialize(front::post('_ranks'));
            $rank=new rank();
            if(is_array($rank->getrow(array('aid'=>$aid))))
                $rank->rec_update(array('ranks'=>$_ranks),'aid='.$aid);
            else
                $rank->rec_insert(array('aid'=>$aid,'ranks'=>$_ranks));
        }
        else {
            $rank=new rank();
            $rank->rec_delete('aid='.$aid);
        }
        if(front::post('vote')) {
            $votes=front::$post['vote'];
            $images=front::$post['vote_image'];
            $vote=new vote();
            $_vote=$vote->getrow('aid='.$aid);
            if(!$_vote) $_vote=array('aid'=>$aid);
            $_vote['titles']=serialize($votes);
            $_vote['images']=serialize($images);
            $vote->rec_replace($_vote,$aid);
        }
        else {
        }
        $arc_url='http://'.front::$host.url('archive/show/aid/'.$aid,false);
        file_get_contents($arc_url);
    }
    function delete_before($id) {
        $arc=new archive();
        $info=$arc->getrow($id);
        if(category::getarcishtml($info)) {
            $path=ROOT.preg_replace("%".THIS_URL."[\\/]%",'',archive::url($info));
            if(file_exists($path)) unlink($path);
        }
    }
}