<?php

if (!defined('ROOT')) exit('Can\'t Access !');
class cache_admin extends admin {
    public $archive;
    function init() {
        header('Cache-control: private, must-revalidate');
        front::$admin=false;
        front::$html=true;
    }
    function make_index_action() {
        $case='index';
        $act='index';
        $_GET=array('case'=>$case,'act'=>$act);
        $front=new front();
        front::$admin=false;
        front::$html=true;
        $case=$case.'_act';
        $case=new $case();
        $case->init();
        $method=$act.'_action';
        $view=$case->view;
        file_put_contents(ROOT.'/index.html',$case->fetch());
        front::flash('成功生成首页！');
        front::redirect(front::$from);
    }
    function make_list_action() {
        header('Cache-control: private, must-revalidate');
        @set_time_limit(0);
        if (!front::post('submit')) return;
        $case='archive';
        $act='list';
        $_GET=array('case'=>$case,'act'=>$act);
        $front=new front();
        front::$admin=false;
        front::$html=true;
        front::$rewrite=false;
        $case=$case.'_act';
        $case=new $case();
        $case->init();
        $method=$act.'_action';
        $totalpage=100;
        $time_start=time::getTime();
        $category=category::getInstance();
        $categories=$category->sons(front::post('catid'));
        $categories[]=front::post('catid');
        $cpage=0;
        $archive_all=new archive();
        foreach ($categories as $key=>$catid) {
            $new_categories=$category->sons($catid);
            $new_categories[]=$catid;
            $archive_num[]=$archive_all->rec_count('catid in('.implode(',',$new_categories).') and checked=1 and `state`=1');
            //$archives[]=$archive_all->getrows('catid in('.implode(',',$new_categories).') and checked=1 and `state`=1','0,'.config::get('list_pagesize'),'`order` asc,aid desc');
            //优化生成 去掉多次数据库查询和去掉一个大数组  待多次测试看是否会影响其他功能
        }
        $i=0;
        foreach ($categories as $catid) {
            if ($catid == 0) continue;
            if (!category::getishtml($catid)) continue;
            front::$get['catid']=$catid;
            $case->view->categories=category::getpositionlink2($catid);
            $_categories=$category->sons($catid);
            $_categories[]=$catid;
            $case->view->ifson=category::hasson($catid);
            for (front::$get['page']=1;;front::$get['page']++) {
                $view=$case->view;
                $_catpage = category::categorypages($catid);
                if($_catpage) {
                    $pagesize = $_catpage;
                }else {
                    $pagesize = config::get('list_pagesize');
                }
                $limit=((front::$get['page'] -1) * $pagesize).','.$pagesize;
                $archive=new archive();
                if (@$category->category[$catid]['includecatarchives']){
                    $case->view->archives=$archive->getrows('catid in('.implode(',',$_categories).') and checked=1 and `state`=1',$limit,'`listorder` asc,aid desc');
                }else{
                    $case->view->archives=$archive->getrows("catid=$catid and checked=1 and `state`=1",$limit,'`listorder` desc,aid desc');
                }
                $case->view->page=front::$get['page'];
                /*if (front::$get['page'] == 1 &empty($case->view->archives)) {
                    $case->view->archives=$archives[$i];
                }*/
                foreach ($case->view->archives as $order=>$arc) {
                    $articles=$arc;
                    if (!$arc['introduce']) $arc['introduce']=cut($arc['content'],200);
                    $articles['url']=archive::url($arc);
                    $articles['catname']=category::name($arc['catid']);
                    $articles['caturl']=category::url($arc['catid']);
                    $articles['image']=@strstr($arc['image'],"http://") ?$arc['image'] : config::get('base_url').'/'.$arc['image'];
                    $articles['strgrade']=archive::getgrade($arc['grade']);
                    $articles['adddate']=sdate($arc['adddate']);
                    $case->view->archives[$order]=$articles;
                }
                if (!isset($page_count)) {
                    front::$record_count = $case->view->record_count=$archive_num[$i];
                    $case->view->page_count=ceil($case->view->record_count / $pagesize);
                    $page_count=$case->view->page_count;
                }

                $case->view->catid=$catid;
                $case->view->topid=category::gettopparent($catid);
                $case->view->parentid=$category->getparent($catid);
                $case->view->pages=@$category->category[$catid]['ispages'];
                if (front::get('page') >1 &&front::get('page') >$case->view->page_count) {
                    $page_count=null;
                    break;
                }
                if (front::get('page') >1 &&!@$category->category[$catid]['ispages']) {
                    $page_count=null;
                    break;
                }
                $template=@$category->category[$catid]['template'];
                if ($template &&file_exists(TEMPLATE.'/'.$case->view->_style.'/'.$template)) $tpl=$template;
                else $tpl=category::gettemplate($case->view->catid);
                $content=$case->fetch($tpl);
                $path=ROOT.category::url($catid,front::$get['page'] >1 ?front::$get['page'] : null,true);
                if (!preg_match('/\.[a-zA-Z]+$/',$path)) $path=rtrim(rtrim($path,'/'),'\\').'/index.html';
                $path=rtrim($path,'/');
                $path=rtrim($path,'\\');
                $path=str_replace('//','/',$path);
                tool::mkdir(dirname($path));
                file_put_contents($path,$content);
                $indexpath=dirname($path).'/index.html';
                if (front::$get['page'] == 1 &&$indexpath!=ROOT.'/index.html') {
                    file_put_contents($indexpath,$content);
                    $cpage++;
                }
                $cpage++;
                $case->view=$view;
            }
            $i++;
        }
        if ($cpage >0) front::flash("成功生成html <b>$cpage</b> 页！");
        else front::flash("没有生成html！");
        front::$admin=true;
    }
    function make_sitemap_action() {
    }
    function make_sitemap_baidu_action() {
    }
    function make_baidu_action() {
        $limit=front::$post['XmlOutNum'];
        $p=front::$post['XmlMaxPerPage'];
        $frequency=front::$post['frequency'];
        $this->archive=new archive();
        $articles=$this->archive->getrows('',$limit);
        $site_url=config::get('site_url');
        $email=config::get('email');
        $head='<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
        $head .= '<document>'."\r\n";
        $head .= "<webSite>{$site_url}</webSite>\r\n";
        $head .= "<webMaster>{$email}</webMaster>\r\n";
        $head .= "<updatePeri>{$frequency}</updatePeri>\r\n";
        $foot="</document>";
        $code='';
        $i=1;
        $j=1;
        if (is_array($articles) &&!empty($articles)) {
            foreach ($articles as $arr) {
                $text=strip_tags(mb_substr($arr['content'],0,588));
                $code .= "<item>\r\n<title><![CDATA[{$arr['title']}]]></title>\r\n<link><![CDATA[{$site_url}".url('archive/show/aid/'.$arr['aid'])."]]></link>\r\n<text><![CDATA[{$text}]]></text>\r\n";
                $code .= "<image/>\r\n";
                if ($arr['keyword'] != '') {
                    $code .= "<keywords>{$arr['keyword']}</keywords>\r\n";
                }
                else {
                    $code .= "<keywords/>\r\n";
                }
                $code .= "<author>{$arr['author']}</author>\r\n";
                $code .= "<source>互联网</source>\r\n";
                $code .= "<pubDate>{$arr['adddate']}</pubDate>\r\n</item>\r\n";
                if ($i %$p == 0) {
                    file_put_contents("baidumap_article_$j.xml",$head.$code.$foot);
                    $j++;
                }
                $i++;
            }
            file_put_contents("baidumap_article_$j.xml",$head.$code.$foot);
        }
        echo '<script>alert("生成完成!");window.location="index.php?case=cache&act=make_sitemap_baidu&admin_dir=admin"</script>';
        exit;
    }
    function make_show_action() {
        header('Cache-control: private, must-revalidate');
        @set_time_limit(0);
        $submit=front::post('submit') ?front::post('submit') : front::get('submit');
        if (!$submit) return;
        $post=front::$post +front::$get;
        unset($post['submit']);
        $c_url=preg_replace('#&make_page=(\d+)#','',$_SERVER['QUERY_STRING']);
        $c_url=preg_replace('#&aid_start=(\d+)#','',$c_url);
        $c_url=preg_replace('#&aid_end=(\d+)#','',$c_url);
        $c_url=preg_replace('#&catid=(\d+)#','',$c_url);
        $c_url=preg_replace('#&submit=(\d+)#','',$c_url);
        $c_url='index.php?'.$c_url;
        $c_url.='&submit=1';
        if ($post['aid_start']) {
            $aid_start=$post['aid_start'];
            $aid_end=$post['aid_end'];
            $where="aid>=$aid_start and aid<=$aid_end";
            $c_url.='&aid_start='.$aid_start.'&aid_end='.$aid_end;
        }
        elseif (isset($post['catid'])) {
            $catid=$post['catid'];
            $category=category::getInstance();
            $categories=$category->sons($catid);
            $categories[]=$catid;
            $categories=implode(',',$categories);
            $where="catid in(".$categories.') and checked=1';
            $c_url.='&catid='.$catid;
        }else return;
        $case='archive';
        $act='show';
        $_GET=array('case'=>$case,'act'=>$act);
        $front=new front();
        front::$admin=false;
        front::$html=true;
        front::$rewrite=false;
        $case=$case.'_act';
        $case=new $case();
        $case->init();
        $method=$act.'_action';
        $category=category::getInstance();
        $time_start=time::getTime();
        $archive=new archive();
        if (config::get('group_on')) {
            $make_page=$post['make_page'] == ''?1 : $post['make_page'];
            $archive->getrows($where);
            $archive_num=$archive->record_count;
            $group_count=config::get('group_count');
            $make_page_num=ceil($archive_num / $group_count);
            $totalpage=(($make_page -1) * $group_count).','.$group_count;
            $c_url.='&make_page='.($make_page +1);
        }
        else {
            $totalpage="";
        }
        $archives=$archive->getrows($where,$totalpage,'1');
        $cpage=0;
        foreach ($archives as $arc) {
            if (!category::getarcishtml($arc)) continue;
            front::$get['aid']=$arc['aid'];
            $case->view->archive=$arc;
            $case->view->aid=$arc['aid'];
            $case->view->catid=$arc['catid'];
            $case->view->catid=$case->view->catid;
            $case->view->topid=category::gettopparent($case->view->catid);
            $case->view->parentid=$category->getparent($case->view->catid);
            $template=@$arc['template'];
            $content=$arc['content'];
            $case->view->categories=category::getpositionlink2($case->view->catid);
            $linkword=new linkword();
			$linkwords=$linkword->getrows(null,1000,'linkorder desc');
			foreach ($linkwords as $linkword) {
				if (trim($linkword['linkurl']) &&!preg_match('%^http://$%',trim($linkword['linkurl']))) {
					$linkword['linktimes']=(int) $linkword['linktimes'];
					$link="<a href='$linkword[linkurl]' target='_blank'>$linkword[linkword]</a>";
				}else {
					$link="<a href='".url('archive/search/keyword/'.urlencode($linkword['linkword']))."' target='_blank'>$linkword[linkword]</a>";
				}
				if (isset($link)){
					$content=preg_replace("%(?!\"]*>)$linkword[linkword](?!\s*\")%i","\\1$link\\2",$content,$linkword['linktimes']);
					/*$content=preg_replace("%(?!\"]*>alt=\")(<a.*?>)(\"?!\s*\")%i","\\1\\2",$content,$linkword['linktimes']);*/
				}
				unset($link);
			}
            $contents=preg_split('%<div style="page-break-after(.*?)</div>%si',$content);
            if (!empty($contents)) {
                $case->view->pages=count($contents);
                front::$record_count=$case->view->pages * config::get('list_pagesize');
                $case->view->pages=count($contents);
            }
            else {
                $case->view->pages=1;
            }
            $taghtml='';
            $tag_table=new tag();
            foreach ($tag_table->urls($case->view->archive['tag']) as $tag=>$url) {
                $taghtml.="<a href='$url' target='_blank'>$tag</a>&nbsp;&nbsp;";
            }
            $case->view->archive['tag']=$taghtml;
            $case->view->archive['special']=null;
            if ($case->view->archive['spid']) {
                $spurl=special::url($case->view->archive['spid']);
                $sptitle=special::gettitle($case->view->archive['spid']);
                $case->view->archive['special']="<a href='$spurl' target='_blank'>$sptitle</a>&nbsp;&nbsp;";
            }
            $case->view->archive['type']=null;
            if ($case->view->archive['typeid']) {
                $typeurl=type::url($case->view->archive['typeid']);
                $typetitle=type::name($case->view->archive['typeid']);
                $case->view->archive['type']="<a href='$typeurl' target='_blank'>$typetitle</a>&nbsp;&nbsp;";
            }
            $case->view->archive['area']=null;
            $case->view->archive['area']=area::getpositonhtml($case->view->archive['province_id'],$case->view->archive['city_id'],$case->view->archive['section_id']);
            $arc=$case->view->archive;
            for ($c=1;$c <= $case->view->pages;$c++) {
                front::$get['page']=$c;
                $case->view->page=$c;
                if (!empty($contents)) {
                    $content=$contents[$c -1];
                }
                $arc['content']=$content;
                $aid=$arc['aid'];
                $catid=$arc['catid'];
                $sql1="SELECT * FROM `{$archive->name}` WHERE catid = '$catid' AND aid > '$aid' ORDER BY aid ASC LIMIT 0,1";
                $sql2="SELECT * FROM `{$archive->name}` WHERE catid = '$catid' AND aid < '$aid' ORDER BY aid DESC LIMIT 0,1";
                $n=$archive->rec_query_one($sql1);
                $p=$archive->rec_query_one($sql2);
                $arc['p']=$p;
                $arc['n']=$n;
                $arc['p']['url']=archive::url($p);
                $arc['n']['url']=archive::url($n);
                $arc['strgrade']=archive::getgrade($arc['grade']);
                $case->view->archive=$arc;
                if ($template &&file_exists(TEMPLATE.'/'.$case->view->_style.'/'.$template)) $tpl=$template;
                else $tpl=category::gettemplate($case->view->catid,'showtemplate');
                $content=$case->fetch($tpl);
                $path=ROOT.archive::url($arc,front::$get['page'] >1 ?front::$get['page'] : null,true);
                if (!preg_match('/\.[a-zA-Z]+$/',$path)) $path=rtrim(rtrim($path,'/'),'\\').'/index.html';
                $path=rtrim($path,'/');
                $path=rtrim($path,'\\');
                $path=str_replace('//','/',$path);
                tool::mkdir(dirname($path));
                file_put_contents($path,$content);
                $cpage++;
                if ($case->view->pages >1 &&$c == 1) {
                    $path=ROOT.archive::url($arc,1,true);
                    if (!preg_match('/\.[a-zA-Z]+$/',$path)) $path=rtrim(rtrim($path,'/'),'\\').'/index.html';
                    $path=rtrim($path,'/');
                    $path=rtrim($path,'\\');
                    $path=str_replace('//','/',$path);
                    tool::mkdir(dirname($path));
                    file_put_contents($path,$content);
                    $cpage++;
                }
            }
        }
        $totalpage=count($archives);
        if (!isset($archives[0])) $totalpage=0;
        if ($make_page >= $make_page_num) {
            $show_msg="本组生成html <b>{$cpage}</b> 页！  生成html完毕，本次共生成 <b>{$archive_num}</b> 页！ 2秒后自动返回内容生成首页面！\n";
            $c_url=preg_replace('#&make_page=(\d+)#','',$_SERVER['QUERY_STRING']);
            $c_url=preg_replace('#&aid_start=(\d+)#','',$c_url);
            $c_url=preg_replace('#&aid_end=(\d+)#','',$c_url);
            $c_url=preg_replace('#&catid=(\d+)#','',$c_url);
            $c_url=preg_replace('#&submit=(\d+)#','',$c_url);
            $c_url='index.php?'.$c_url;
        }
        else {
            $show_msg="第 <b>{$make_page}</b> 组成功生成html <b>{$cpage}</b> 页！ 本次共需生成 <b>{$archive_num}</b> 页！ 已经生成 <b>".($make_page * $group_count)."</b> 页！ 2秒后自动跳入下组生成！\n";
        }
        $getnexturl="<script>";
        $getnexturl.="var t=4;\n";
        $getnexturl.="setInterval('testTime()',1000);\n";
        $getnexturl.="function testTime() \n";
        $getnexturl.=" { \n";
        $getnexturl.="if(t == 0) location = '".$c_url."'; \n";
        $getnexturl.=" t--;\n";
        $getnexturl.="}\n</script> \n";
        if ($cpage >0) {
            if (!config::get('group_on')) {
                front::flash("成功生成html <b>{$cpage}</b> 页！ 2秒后自动返回内容生成首页面！\n".$getnexturl);
            }
            else {
                front::flash($show_msg."\n".$getnexturl);
            }
        }
        else {
            front::flash("没有需要生成的html，可能您选择的栏目暂无内容或者网站并未开启内容生成静态功能！");
        }
        front::$admin=true;
        front::$post=$post;
    }
    function end() {
        front::$html=false;
        front::$admin=true;
        $this->render('index.php');
    }
}