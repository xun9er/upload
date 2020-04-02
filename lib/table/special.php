<?php

class special extends table {
    public $name='b_special';
    function getcols($act) {
        switch ($act) {
            case 'manage':
                return 'spid,title,banner';
            default: return '*';
        }
    }
    function get_form() {
        return array(
                'banner'=>array(
                        'filetype'=>'image',
                ),
        );
    }
    function url($spid,$page=1) {
        return url::create('special/show/spid/'.$spid.($page >1 ?'/page/'.$page : ''),false);
    }
    function pagination() {
        return template('system/special_pagination.html');
    }
    function option() {
        $sp=new special();
        $sps=$sp->getrows('',500);
        $options=array(0=>'请选择...');
        foreach ($sps as $sp) {
            $options[$sp['spid']]=$sp['title'];
        }
        return $options;
    }
    function gettitle($spid) {
        if (empty($spid)) return;
        $sp=new special();
        $sp=$sp->getrow('spid='.$spid);
        return $sp['title'];
    }
    function listdata($limit=10) {
        $special=new special();
        $specials=$special->getrows('',$limit);
        foreach ($specials as $order=>$sp) {
            $specials[$order]['url']=special::url($sp['spid']);
        }
        return $specials;
    }
}