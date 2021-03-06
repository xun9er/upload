<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
class archive_act extends act {
    public $auto_end=true;
    function init() {
        $this->archive=new archive();
        $this->category=category::getInstance();
        $this->view->category=$this->category->category;
        if (front::get('page'))
            $page=front::get('page');
        else
            $page=1;
        $this->view->page=$page;
        front::check_type($page);
        $_catpage=category::categorypages(front::get('catid'));
        if ($_catpage) {
            $this->pagesize=$_catpage;
        }
        else {
            $this->pagesize=config::get('list_pagesize');
        }
        front::check_type($this->pagesize);
        $announcement=new announcement();
        $this->view->announcements=$announcement->getrows(null,10);
        $this->view->usergroupid=0;
        front::check_type(cookie::get('login_username'),'safe');
        front::check_type(cookie::get('login_password'),'safe');
        $this->view->showarchive=archive::getInstance()->getrow(front::get('aid'));
        $addcontentuser=new user();
        $addcontentuser=$addcontentuser->getrow(array('userid'=>$this->view->showarchive['userid']));
        if (is_array($addcontentuser)) {
            $this->view->adduser=$addcontentuser;
        }
        if (cookie::get('login_username') &&cookie::get('login_password')) {
            $user=new user();
            $user=$user->getrow(array('username'=>cookie::get('login_username')));
            if (is_array($user) &&cookie::get('login_password') == front::cookie_encode($user['password'])) {
                $this->view->user=$user;
                $this->view->usergroupid=$user['groupid'];
            }
        }
    }
    function set_verify() {
        return array(
                'is_int'=>'id,aid',
                'is_word'=>'',
                'is_email'=>'',
                'is_text'=>''
        );
    }
    function index_action() {
    }
    function rss_action() {
        $sitename=config::get('sitename');
        $site_url=config::get('site_url');
        $catid=intval(front::get('catid'));
        if (!$catid) {
            $title=$sitename;
            $url=$site_url;
            $articles=$this->archive->getrows('',30);
        }
        else {
            $type=$this->category->category[$catid];
            $title=$type['catname'].'-'.$sitename;
            $url=$site_url.url('archive/list/catid/'.$catid);
            $articles=$this->archive->getrows('catid='.$catid,30);
        }
        $code="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
        $code .= "<rss version=\"2.0\">\r\n";
        $code .= "<channel>\r\n";
        $code .= "<title>{$title}</title>\r\n";
        $code .= "<link><![CDATA[{$url}]]></link>\r\n";
        $code .= "<description>{$title}</description>\r\n";
        $i=1;
        if (is_array($articles) &&!empty($articles)) {
            foreach ($articles as $arr) {
                $text=strip_tags(mb_substr($arr['content'],0,588));
                $code .= "<item id=\"{$i}\">\r\n";
                $code .= "<title><![CDATA[{$arr['title']}]]></title>\r\n";
                $code .= "<link><![CDATA[".url('archive/show/aid/')."{$arr['aid']}]]></link>\r\n";
                $code .= "<description><![CDATA[{$text}]]></description>\r\n";
                $code .= "<pubDate>{$arr['adddate']}</pubDate>\r\n";
                $code .= "</item>\r\n";
                $i++;
            }
        }
        $code .= "</channel>\r\n";
        $code .= "</rss>";
        header('Content-type: application/xml');
        echo $code;
        exit;
    }
    function list_action() {
        front::check_type(front::get('catid'));
        $this->view->categorys=category::getpositionlink2(front::get('catid'));
        $topid=category::gettopparent(front::get('catid'));
        if (!isset($this->category->category[front::get('catid')]) ||
                !isset($this->category->category[$topid])) {
            $this->out('message/error.html');
        }
        $limit=(($this->view->page -1) * $this->pagesize).','.$this->pagesize;
        $categories=array();
        if (@$this->category->category[front::get('catid')]['ispages'])
            $categories=$this->category->sons(front::get('catid'));
        $categories[]=front::get('catid');
        $this->view->pages=@$this->category->category[front::get('catid')]['ispages'];
        if (!rank::catget(front::get('catid'),$this->view->usergroupid))
            $this->out('message/error.html');
        $order="`listorder` asc,`adddate` DESC";
        if (@$this->category->category[front::get('catid')]['includecatarchives'])
            $articles=$this->archive->getrows('catid in ('.implode(',',$categories).') and checked=1',$limit,$order);
        else
            $articles=$this->archive->getrows('catid='.front::get('catid').' and checked=1',$limit,$order);
        if (!is_array($articles)) {
            $this->out('message/error.html');
        }
        foreach ($articles as $order=>$arc) {
            $articles[$order]['url']=archive::url($arc);
            $articles[$order]['catname']=category::name($arc['catid']);
            $articles[$order]['caturl']=category::url($arc['catid']);
            $articles[$order]['adddate']=sdate($arc['adddate']);
            $articles[$order]['stitle']=strip_tags($arc['title']);
            $articles[$order]['strgrade']=archive::getgrade($arc['grade']);
        }
        $this->view->archives=$articles;
        $this->view->articles=$articles;
        if (@$this->category->category[front::get('catid')]['includecatarchives'])
            $this->view->record_count=$this->archive->rec_count('catid in('.implode(',',$categories).')');
        else
            $this->view->record_count=$this->archive->rec_count('catid='.front::get('catid'));
        front::$record_count=$this->view->record_count;
        $this->view->catid=front::get('catid');
        $this->view->ifson=category::hasson($articles[0]['catid'] ?$articles[0]['catid'] : $this->view->catid);
        $this->view->topid=category::gettopparent(front::get('catid'));
        $this->view->parentid=@$this->category->getparent($this->view->catid);
        if(front::get('t') == 'wap'){
            $this->out('wap/list.html');
            return;
        }
        $template=@$this->category->category[front::get('catid')]['template'];
        if ($template &&file_exists(TEMPLATE.'/'.$this->view->_style.'/'.$template))
            $this->out($template);
        else {
            $tpl=category::gettemplate($this->view->catid);
            if (category::getishtml($this->view->catid)) {
                $path=ROOT.category::url($this->view->catid,@front::$get['page'] >1 ?front::$get['page'] : null);
                if (!preg_match('/\.[a-zA-Z]+$/',$path))
                    $path=rtrim(rtrim($path,'/'),'\\').'/index.html';
                $this->cache_path=$path;
            }
            $this->out($tpl);
        }
    }
    function search_action() {
        if (front::get('ule')) {
            front::$get['keyword']=str_replace('-','%',front::$get['keyword']);
            front::$get['keyword']=urldecode(front::$get['keyword']);
        }
        if (front::get('keyword') &&!front::post('keyword'))
            front::$post['keyword']=front::get('keyword');
        front::check_type(front::post('keyword'),'safe');
        if (front::post('keyword')) {
            $this->view->keyword=trim(front::post('keyword'));
            /*if(isset(front::$get['keyword']))
                front::redirect(preg_replace('/keyword=[^&]+/','keyword='.urlencode($this->view->keyword),front::$uri));
            else  front::redirect(front::$uri.'&keyword='.urlencode($this->view->keyword));*/
        }
        else {
            $this->view->keyword=session::get('keyword');
        }
        $path=ROOT.'/data/hotsearch/'.urlencode($this->view->keyword).'.txt';
        $keywordcount=@file_get_contents($path);
        $keywordcount=$keywordcount +1;
        file_put_contents($path,$keywordcount);
        $type=$this->view->category;
        $condition="";
        if (front::post('catid')) {
            $condition .= "catid = '".front::post('catid')."' AND ";
        }
        $condition .= "(title like '%".$this->view->keyword."%'";
        $sets=settings::getInstance()->getrow(array('tag'=>'table-fieldset'));
        $arr=unserialize($sets['value']);
        if (is_array($arr['archive']) &&!empty($arr['archive'])) {
            foreach ($arr['archive'] as $v) {
                if ($v['issearch'] == '1') {
                    $condition .= " OR {$v['name']} like '%{$this->view->keyword}%'";
                }
            }
        }
        $condition .= ")";
        $order="`listorder`,1 DESC";
        $limit=(($this->view->page -1) * $this->pagesize).','.$this->pagesize;
        $articles=$this->archive->getrows($condition,$limit,$order);
        foreach ($articles as $order=>$arc) {
            $articles[$order]['url']=archive::url($arc);
            $articles[$order]['catname']=category::name($arc['catid']);
            $articles[$order]['caturl']=category::url($arc['catid']);
            $articles[$order]['adddate']=sdate($arc['adddate']);
            $articles[$order]['stitle']=strip_tags($arc['title']);
        }
        $this->view->articles=$articles;
        $this->view->archives=$articles;
        $this->view->record_count=$this->archive->record_count;
    }
    function asearch_action() {
        if (front::get('keyword') &&!front::post('keyword'))
            front::$post['keyword']=front::get('keyword');
        front::check_type(front::post('keyword'),'safe');
        if (front::post('keyword')) {
            $this->view->keyword=trim(front::post('keyword'));
            session::set('keyword',$this->view->keyword);
        }
        elseif (session::get('keyword')) {
            $this->view->keyword=trim(session::get('keyword'));
            session::set('keyword',$this->view->keyword);
        }
        else {
            session::set('keyword',null);
            $this->view->keyword=session::get('keyword');
        }
        $limit=(($this->view->page -1) * $this->pagesize).','.$this->pagesize;
        $articles=$this->archive->getrows("title like '%".$this->view->keyword."%'",$limit);
        foreach ($articles as $order=>$arc) {
            $articles[$order]['url']=archive::url($arc);
            $articles[$order]['catname']=category::name($arc['catid']);
            $articles[$order]['caturl']=category::url($arc['catid']);
            $articles[$order]['adddate']=sdate($arc['adddate']);
            $articles[$order]['stitle']=strip_tags($arc['title']);
        }
        $this->view->articles=$articles;
        $this->view->archives=$articles;
        $this->view->record_count=$this->archive->record_count;
    }
    function show_action() {
        if (!front::get('aid'))
            front::$get['aid']=front::get('id');
        front::check_type(front::$get['aid']);
        $this->view->aid=trim(front::get('aid'));
        $this->view->archive=archive::getInstance()->getrow(front::get('aid'));
        $this->view->categorys=category::getpositionlink2($this->view->archive['catid']);
        if (!is_array($this->view->archive))
            $this->out('message/error.html');
        if ($this->view->archive['checked'] <1)
            exit(lang('未审核！'));
        if (!rank::arcget(front::get('aid'),$this->view->usergroupid)) {
            $this->out('message/error.html');
        }
        $this->view->catid=$this->view->archive['catid'];
        $this->view->topid=category::gettopparent($this->view->catid);
        $this->view->parentid=$this->category->getparent($this->view->catid);
        if (!rank::catget($this->view->catid,$this->view->usergroupid))
            $this->out('message/error.html');
        if (!isset($this->category->category[$this->view->catid]) ||
                !isset($this->category->category[$this->view->topid])) {
        }
        $template=@$this->view->archive['template'];
        $linkword=new linkword();
        $linkwords=$linkword->getrows(null,1000,'linkorder desc');
        $content=$this->view->archive['content'];
        $contents=preg_split('%<div style="page-break-after(.*?)</div>%si',$content);
        if ($contents) {
            $this->view->pages=count($contents);
            front::$record_count=$this->view->pages * config::get('list_pagesize');
            $content=$contents[$this->view->page -1];
        }
        foreach ($linkwords as $linkword) {
            if (trim($linkword['linkurl']) &&!preg_match('%^http://$%',trim($linkword['linkurl']))) {
                $linkword['linktimes']=(int) $linkword['linktimes'];
                $link="<a href='$linkword[linkurl]' target='_blank'>$linkword[linkword]</a>";
            }
            else {
                $link="<a href='".url('archive/search/keyword/'.urlencode($linkword['linkword']))."' target='_blank'>$linkword[linkword]</a>";
            }
            if (isset($link)){
                $content=preg_replace("%(?!\"]*>)$linkword[linkword](?!\s*\")%i","\\1$link\\2",$content,$linkword['linktimes']);
                /*$content=preg_replace("%(?!\"]*>alt=\")(<a.*?>)(\"?!\s*\")%i","\\1\\2",$content,$linkword['linktimes']);*/
            }
            unset($link);
        }
        $taghtml='';
        $tag_table=new tag();
        foreach ($tag_table->urls($this->view->archive['tag']) as $tag=>$url) {
            $taghtml.="<a href='$url' target='_blank'>$tag</a>&nbsp;&nbsp;";
        }
        $this->view->archive['tag']=$taghtml;
        $this->view->archive['special']=null;
        if ($this->view->archive['spid']) {
            $spurl=special::url($this->view->archive['spid']);
            $sptitle=special::gettitle($this->view->archive['spid']);
            $this->view->archive['special']="<a href='$spurl' target='_blank'>$sptitle</a>&nbsp;&nbsp;";
        }
        $this->view->archive['type']=null;
        if ($this->view->archive['typeid']) {
            $typeurl=type::url($this->view->archive['typeid']);
            $typetitle=type::name($this->view->archive['typeid']);
            $this->view->archive['type']="<a href='$typeurl' target='_blank'>$typetitle</a>&nbsp;&nbsp;";
        }
        $this->view->archive['area']=null;
        $this->view->archive['area']=area::getpositonhtml($this->view->archive['province_id'],$this->view->archive['city_id'],$this->view->archive['section_id']);
        $this->view->archive['content']=$content;
        $aid=front::$get['aid'];
        $catid=$this->view->catid;
        $sql1="SELECT aid,title,catid FROM `{$this->archive->name}` WHERE catid = '$catid' AND aid > '$aid' ORDER BY aid ASC LIMIT 0,1";
        $sql2="SELECT aid,title,catid FROM `{$this->archive->name}` WHERE catid = '$catid' AND aid < '$aid' ORDER BY aid DESC LIMIT 0,1";
        $n=$this->archive->rec_query_one($sql1);
        $p=$this->archive->rec_query_one($sql2);
        $this->view->archive['p']=$p;
        $this->view->archive['n']=$n;
        $this->view->archive['p']['url']=archive::url($p);
        $this->view->archive['n']['url']=archive::url($n);
        $this->view->archive['strgrade']=archive::getgrade($this->view->archive['grade']);
        if(front::get('t') == 'wap'){
            $this->out('wap/show.html');
            return;
        }
        if ($template &&file_exists(TEMPLATE.'/'.$this->view->_style.'/'.$template))
            $this->out($template);
        else {
            $tpl=category::gettemplate($this->view->catid,'showtemplate');
            if (category::getarcishtml($this->view->archive)) {
                $path=ROOT.archive::url($this->view->archive);
                if (!preg_match('/\.[a-zA-Z]+$/',$path))
                    $path=rtrim(rtrim($path,'/'),'\\').'/index.html';
                $this->cache_path=$path;
            }
            $this->out($tpl);
        }
    }
    function view_js_action() {
        front::check_type(front::get('aid'));
        $aid=front::get('aid');
        $this->archive->rec_update('view=view+1',$aid);
        $archive=$this->archive->getrow($aid);
        echo tool::text_javascript($archive['view']);
        exit;
    }
    function email_action() {
        if (front::post('submit')) {
            $path=ROOT.'/data/subscriptionmail.txt';
            $maillist=file_get_contents($path);
            $content=$maillist.',guest'.time().' ['.front::$post['email'].']';
            file_put_contents($path,$content);
            echo '<script type="text/javascript">alert("'.lang('操作完成！').'")</script>';
            front::refresh(url('archive/email',true));
        }
    }
    function respond_action() {
        include_once ROOT.'/lib/plugins/pay/'.front::$get['code'].'.php';
        $payclassname=front::$get['code'];
        $payobj=new $payclassname();
        $uri=$_SERVER["REQUEST_URI"];
        $__uriget=strstr($uri,'?');
        $__uriget=str_replace('?','',$__uriget);
        $__uriget=explode('&',$__uriget);
        $_GET=array();
        foreach ($__uriget as $key=>$val) {
            $tmp=explode('=',$val);
            $_GET[$tmp[0]]=$tmp[1];
        }
        $status=$payobj->respond();
        if ($status) {
            echo '<script type="text/javascript">alert("'.lang('已经付款，跳转到订单查询').'")</script>';
            front::refresh(url('archive/orders/oid/'.front::get('subject'),true));
        }
        else {
            echo '<script type="text/javascript">alert("'.lang('跳转到订单查询').'")</script>';
            front::refresh(url('archive/orders/oid/'.front::get('subject'),true));
        }
    }
    function payorders_action() {
        if (front::get('oid')) {
            preg_match_all("/-(.*)-(.*)-(.*)/isu",front::get('oid'),$oidout);
            $this->view->paytype=$oidout[3][0];
            $this->view->user_id=$oidout[2][0];
            $where=array();
            $where['oid']=front::get('oid');
            $this->view->orders=orders::getInstance()->getrow($where);
            $string=$this->view->orders['aid'];
            $find=',';
            $pos=strpos($string,$find);
            $this->view->statusnum=$data['status']=$this->view->orders['status'];
            switch ($data['status']) {
                case 1:
                    $this->view->orders['status']=lang('完成');
                    break;
                case 2:
                    $this->view->orders['status']=lang('处理中');
                    break;
                case 3:
                    $this->view->orders['status']=lang('已发货');
                    break;
                case 4:
                    $this->view->orders['status']=lang('客户已付款，待审核');
                    break;
                case 5:
                    $this->view->orders['status']=lang('已核实客户支付');
                    break;
                default:
                    $this->view->orders['status']=lang('新订单');
                    break;
            }
            if ($this->view->user['userid'] != $this->view->user_id) {
                echo '<script type="text/javascript">alert("'.lang('您未登录，请保存订单编号').'")</script>';
            }
            $logisticsid=$oidout[1][0];
            if ($pos !== false) {
                $_aid=$string;
                $_aid=substr($_aid,0,-1);
                $this->view->archivearr1=$this->view->_archivearr=archive::getInstance()->getrows('aid in ('.$_aid.')',100);
                $pnums=explode(',',$this->view->orders['pnums']);
                foreach ($this->view->archivearr1 as $key=>$val) {
                    $this->view->orders[$key]['pnums']=$pnums[$key];
                    $this->view->archive['title'].=$val['title'];
                    $where=array();
                    $payfilename=$where['pay_code']=$this->view->paytype;
                    $this->view->pay=pay::getInstance()->getrows($where);
                    $where=array();
                    $where['id']=$logisticsid;
                    $this->view->logistics=logistics::getInstance()->getrows($where);
                    if ($this->view->logistics[0]['cashondelivery']) {
                        $this->view->logistics[0]['price']=0.00;
                    }
                    else {
                        if ($this->view->logistics[0]['insure']) {
                            $this->view->logistics[0]['price']=$this->view->logistics[0]['price'] +($val['attr2'] * $this->view->orders[$key]['pnums']) * ($this->view->logistics[0]['insureproportion'] / 100);
                        }
                    }
                    if (!isset($this->view->logistics[0]['price']))
                        $this->view->logistics[0]['price']=0;
                    $this->view->pay[0]['pay_fee']=$this->view->pay[0]['pay_fee'] / 100;
                    $this->view->archivearr1[$key]['total']=$val['attr2'] * $this->view->orders['pnums'] +$this->view->logistics[0]['price'] +($val['attr2'] * $this->view->orders[$key]['pnums'] * $this->view->pay[0]['pay_fee']);
                    $this->view->total += $val['attr2'] * $this->view->orders[$key]['pnums'] +$this->view->logistics[0]['price'] +($val['attr2'] * $this->view->orders[$key]['pnums'] * $this->view->pay[0]['pay_fee']);
                }
                $order['ordersn']=front::get('oid');
                $order['title']=$this->view->archive['title'];
                $order['id']=$this->view->orders['id'];
                $order['orderamount']=$this->view->total;
                include_once ROOT.'/lib/plugins/pay/'.$payfilename.'.php';
                $payclassname=$payfilename;
                $payobj=new $payclassname();
                $this->view->pay[0]['pay_config'];
                $this->view->gotopaygateway=$payobj->get_code($order,unserialize_config($this->view->pay[0]['pay_config']));
            }else {
                $this->view->archive=archive::getInstance()->getrow($this->view->orders['aid']);
                $where=array();
                $payfilename=$where['pay_code']=$this->view->paytype;
                $this->view->pay=pay::getInstance()->getrows($where);
                $where=array();
                $where['id']=$logisticsid;
                $this->view->logistics=logistics::getInstance()->getrows($where);
                if ($this->view->logistics[0]['cashondelivery']) {
                    $this->view->logistics[0]['price']=0.00;
                }
                else {
                    if ($this->view->logistics[0]['insure']) {
                        $this->view->logistics[0]['price']=$this->view->logistics[0]['price'] +($this->view->archive['attr2'] * $this->view->orders['pnums']) * ($this->view->logistics[0]['insureproportion'] / 100);
                    }
                }
                if (!isset($this->view->logistics[0]['price']))
                    $this->view->logistics[0]['price']=0;
                $this->view->pay[0]['pay_fee']=$this->view->pay[0]['pay_fee'] / 100;
                $this->view->total=$this->view->archive['attr2'] * $this->view->orders['pnums'] +$this->view->logistics[0]['price'] +($this->view->archive['attr2'] * $this->view->orders['pnums'] * $this->view->pay[0]['pay_fee']);
                $order['ordersn']=front::get('oid');
                $order['title']=$this->view->archive['title'];
                $order['id']=$this->view->orders['id'];
                $order['orderamount']=$this->view->total;
                include_once ROOT.'/lib/plugins/pay/'.$payfilename.'.php';
                $payclassname=$payfilename;
                $payobj=new $payclassname();
                $this->view->gotopaygateway=$payobj->get_code($order,unserialize_config($this->view->pay[0]['pay_config']));
            }
        }
    }
    function doorders_action() {
        if (archive::getInstance()->getrow(front::get('aid'))) {
            $orders_c=cookie::get('ce_orders_cookie');
            $orders_c=stripslashes(htmlspecialchars_decode($orders_c));
            $c_aid='c'.front::get('aid');
            if (empty($orders_c)) {
                $orders_c=array($c_aid=>array('aid'=>front::get('aid'),'amount'=>1));
                $orders_c=serialize($orders_c);
            }
            else {
                $orderid=unserialize($orders_c);
                if (is_array($orderid) &&array_key_exists($c_aid,$orderid)) {
                    $amount=$orderid[$c_aid]['amount'] +1;
                    unset($orderid[$c_aid]);
                    $nowcart=array($c_aid=>array('aid'=>front::get('aid'),'amount'=>$amount));
                    $newcart=array_merge($orderid,$nowcart);
                    $orders_c=serialize($newcart);
                }
                elseif (is_array($orderid)) {
                    $nowcart=array($c_aid=>array('aid'=>front::get('aid'),'amount'=>1));
                    $newcart=array_merge_recursive($nowcart,$orderid);
                    $orders_c=serialize($newcart);
                }
                else {
                    $nowcart=array($c_aid=>array('aid'=>front::get('aid'),'amount'=>1));
                    $orders_c=serialize($newcart);
                }
            }
            cookie::set('ce_orders_cookie',$orders_c);
            echo '<script type="text/javascript">alert("'.lang('完成操作，你可以继续购物，或者在购物车中结算！').'")</script>';
            front::refresh(url('archive/show/aid/'.front::get('aid'),true));
        }
    }
    function orders_action() {
        $this->view->aid=trim(front::get('aid'));
        if (front::post('submit')) {
			if(front::$post['telphone'] == ''){
				front::flash('联系电话为必填！');
				return;
			}
            front::$post['mid']=$this->view->user['userid'] ?$this->view->user['userid'] : 0;
            front::$post['adddate']=time();
            front::$post['ip']=front::ip();
            if (isset(front::$post['aid'])) {
                $aidarr=front::$post['aid'];
                unset(front::$post['aid']);
                foreach ($aidarr as $val) {
                    front::$post['aid'].=$val.',';
                    front::$post['pnums'].=front::$post['thisnum'][$val].',';
                }
            }
            else {
                front::$post['aid']=$this->view->aid;
            }
            if (!isset(front::$post['logisticsid']))
                front::$post['logisticsid']=0;
            front::$post['oid']=date('YmdHis').'-'.front::$post['logisticsid'].'-'.front::$post['mid'].'-'.front::$post['payname'];
            $this->orders=new orders();
            $insert=$this->orders->rec_insert(front::$post);
            if ($insert <1) {
                front::flash($this->tname.lang('添加失败！'));
            }
            else {
                if (front::$post['payname'] &&front::$post['payname'] != 'nopay') {
					if(config::get('sms_on') && config::get('sms_order_on')){
                    	sendMsg(front::$post['telphone'],config::get('sms_order'));
                	}
                	if(config::get('sms_on') && config::get('sms_order_admin_on') && $mobile = config::get('site_mobile')){
                    	sendMsg($mobile,'网站在'.date('Y-m-d H:i:s').'有新订单了');
                	}
                    echo '<script type="text/javascript">alert("'.lang('orderssuccess').' '.lang('现在转入支付页面').'");window.location.href="'.url('archive/payorders/oid/'.front::$post['oid'],true).'";</script>';
                }
                echo '<script type="text/javascript">alert("'.lang('orderssuccess').'");window.location.href="'.url('archive/orders/oid/'.front::$post['oid'],true).'";</script>';
            }
        }
        elseif (front::get('oid')) {
            preg_match_all("/-(.*)-(.*)-(.*)/isu",front::get('oid'),$oidout);
            $this->view->paytype=$oidout[3][0];
            $where=array();
            $where['oid']=front::get('oid');
            $this->view->orders=orders::getInstance()->getrow($where);
            $this->view->statusnum=$data['status']=$this->view->orders['status'];
            switch ($data['status']) {
                case 1:
                    $data['status']=lang('完成');
                    break;
                case 2:
                    $data['status']=lang('处理中');
                    break;
                case 3:
                    $data['status']=lang('已发货');
                    break;
                case 4:
                    $data['status']=lang('客户已付款，待审核');
                    break;
                case 5:
                    $data['status']=lang('已核实客户支付');
                    break;
                default:
                    $data['status']=lang('新订单');
                    break;
            }
            $this->view->orders['status']=$data['status'];
            if ($this->view->paytype) {
                $this->view->gotopaygateway='<a href="'.url('archive/payorders/oid/'.front::get('oid'),true).'">进入支付页面</a>';
            }
            $this->out('message/orderssuccess.html');
        }
        elseif (front::get('aid')) {
            $this->view->archive=archive::getInstance()->getrow(front::get('aid'));
            $this->view->categorys=category::getpositionlink2($this->view->archive['catid']);
            $this->view->paylist=pay::getInstance()->getrows('',50);
            $this->view->logisticslist=logistics::getInstance()->getrows('',50);
            if (!is_array($this->view->archive))
                $this->out('message/error.html');
            if ($this->view->archive['checked'] <1)
                exit(lang('未审核！'));
            if (!rank::arcget(front::get('aid'),$this->view->usergroupid)) {
                $this->out('message/error.html');
            }
        }
        else {
            $oreders_c=cookie::get('ce_orders_cookie');
            $oreders_c=stripslashes(htmlspecialchars_decode($oreders_c));
            $aid=!empty($oreders_c) ?unserialize($oreders_c) : 0;
            if ($aid) {
                foreach ($aid as $key=>$val) {
                    $archive=archive::getInstance()->getrow($val['aid']);
                    $val['title']=$archive['title'];
                    $val['attr2']=$archive['attr2'];
                    $aid[$key]=$val;
                }
                $this->view->orderaidlist=$aid;
                $this->view->paylist=pay::getInstance()->getrows('',50);
            }
            else {
                if (isset(front::$get['oid'])) {
                    echo '<script type="text/javascript">alert("'.lang('请输入订单编号！').'");';
                    if ($_SERVER['HTTP_REFERER']) {
                        //front::refresh($_SERVER['HTTP_REFERER']);
                        echo 'window.location.href="'.$_SERVER['HTTP_REFERER'].'";';
                    }
                    else {
                        //front::refresh(url('index'));
                        echo 'window.location.href="'.url('index').'";';
                    }
                    echo '</script>';
                    exit;
                }
                echo '<script type="text/javascript">alert("'.lang('购物车暂无商品！').'");';
                if ($_SERVER['HTTP_REFERER']) {
                    //front::refresh($_SERVER['HTTP_REFERER']);
                    echo 'window.location.href="'.$_SERVER['HTTP_REFERER'].'";';
                }
                else {
                    //front::refresh(url('index'));
                    echo 'window.location.href="'.url('index').'";';
                }
                echo '</script>';
            }
        }
    }
    function out($tpl) {
        if (front::$debug)
            return;
        $this->render($tpl);
        $this->out=true;
        exit;
    }
    function end() {
        if (isset($this->out))
            return;
        if ($this->auto_end) {
            if (front::$debug)
                $this->render('style/index.html');
            else
                $this->render();
        }
    }
}