<?php

class tag_act extends act {
    function show_action() {
        $tagname=front::get('tag');
        $tag=new tag();
        $tag=$tag->getrow('tagname="'.$tagname.'"');
        $tagid=$tag['tagid'];
        $archives=array();
        if($tagid) {
            $arctag=new arctag();
            if(front::get('page')) $page=front::get('page');
            else $page=1;
            $this->view->page=$page;
            $this->view->pagesize=config::get('list_pagesize');
            $limit=(($this->view->page-1)*$this->view->pagesize).','.$this->view->pagesize;
            $this->view->record_count=$arctag->rec_count('tagid='.$tagid);
            if($this->view->record_count>$this->view->pagesize)
                $this->view->pages=true;
            front::$record_count=$this->view->record_count;
            $arctags=$arctag->getrows('tagid='.$tagid,$limit);
            $arcids=array();
            foreach($arctags as $arctag) {
                $arcids[]=$arctag['aid'];
            }
            $archive=new archive();
            $archives=$archive->getrows('aid in ('.implode(',',$arcids).')',null,'aid desc');
            foreach($archives as $order=>$arc) {
                $archives[$order]['url']=archive::url($arc);
                $archives[$order]['catname']=category::name($arc['catid']);
                $archives[$order]['caturl']=category::url($arc['catid']);
                $archives[$order]['adddate']= sdate($arc['adddate']);
                $archives[$order]['stitle']= strip_tags($arc['title']);
            }
        }
        else echo lang('标签信息不存在');
        $this->view->tag=$tagname;
        $this->view->archive['title'] = $tagname;
        $this->view->archives=$archives;
        $this->render();
    }
}