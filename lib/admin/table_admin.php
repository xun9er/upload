<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
class table_admin extends admin {
    protected $_table;
    function init() {
        $this->table=front::get('table');
        if (preg_match('/^my_/',$this->table)) {
            form_admin::init();
            $this->_table=new defind($this->table);
        }
        else
            $this->_table=new $this->table;
        $this->_table->getFields();
        $this->view->form=$this->_table->get_form();
        $this->tname=lang($this->table);
        if ($this->table == 'orders')
            $this->tname='订单';
        if ($this->table == 'archive')
            $this->tname='内容';
        if ($this->table == 'user')
            $this->tname='用户';
        if ($this->table == 'usergroup')
            $this->tname='用户组';
        if ($this->table == 'announcement')
            $this->tname='公告';
        if ($this->table == 'guestbook')
            $this->tname='留言';
        if ($this->table == 'ballot')
            $this->tname='投票';
        if ($this->table == 'option')
            $this->tname='投票选项';
        if ($this->table == 'linkword')
            $this->tname='内链';
        $this->_pagesize=config::get('manage_pagesize');
        $this->view->table=$this->table;
        $this->view->primary_key=$this->_table->primary_key;
        if (!front::get('page'))
            front::$get['page']=1;
        $this->Exc=$this->table == 'templatetag'?true : false;
        $manage='table_'.$this->table;
        if (preg_match('/^my_/',$this->table))
            $manage='table_form';
        $this->manage=new $manage;
    }
    function list_action() {
        $set1=settings::getInstance();
        $sets1=$set1->getrow(array('tag'=>'table-'.$this->table));
        $setsdata1=unserialize($sets1['value']);
        $this->view->settings=$setsdata1;
        $where=null;
        $ordre='`id` DESC';
        if (preg_match('/^archive|special$/',$this->table)) {
            $ordre="`listorder` asc,`adddate` DESC";
        }
        if (preg_match('/^type|category$/',$this->table)) {
            $ordre="`listorder` asc,1";
        }
        if (preg_match('/^user$/',$this->table)) {
            $ordre='`userid` DESC';
        }
        if (preg_match('/^my_/',$this->table)) {
            $ordre='`fid` DESC';
        }
        if ($this->table == 'archive') {
            $where=$this->_table->get_where('manage');
            if (!front::post('search_catid')  && front::get('type') != 'search')
                session::del('search_catid');
            if (get('search_catid')) {
                $catid=get('search_catid');
                session::set('search_catid',$catid);
                $this->category=category::getInstance();
                $categories=$this->category->sons($catid);
                $categories[]=$catid;
                $where .=' and catid in('.trim(implode(',',$categories),',').')';
            }
            if (get('catid')) {
                $catid=get('catid');
                $where .=' and catid='.$catid;
            }
            if (!front::post('search_typeid')  && front::get('type') != 'search')
                session::del('search_typeid');
            if (get('search_typeid')) {
                $typeid=get('search_typeid');
                session::set('search_typeid',$typeid);
                $this->type=type::getInstance();
                $types=$this->type->sons($typeid);
                $types[]=$typeid;
                $where .=' and typeid in('.trim(implode(',',$types),',').')';
            }
            if (get('typeid')) {
                $typeid=get('typeid');
                $where .=' and typeid='.$typeid;
            }
            if (!front::post('search_title')  && front::get('type') != 'search')
                session::del('search_title');
            if (get('search_title')) {
                $title=get('search_title');
                session::set('search_title',$title);
                $where .=" and title like '%$title%' ";
            }
            if (!front::post('search_province_id')  && front::get('type') != 'search')
                session::del('search_province_id');
            if (get('search_province_id')) {
                $proid=get('search_province_id');
                session::set('search_province_id',$proid);
                $where .=' and province_id='.$proid;
            }
            if (!front::post('search_city_id')  && front::get('type') != 'search')
                session::del('search_city_id');
            if (get('search_city_id')) {
                $cityid=get('search_city_id');
                session::set('search_city_id',$cityid);
                $where .=' and city_id='.$cityid;
            }
            if (!front::post('search_section_id')  && front::get('type') != 'search')
                session::del('search_section_id');
            if (get('search_section_id')) {
                $sectionid=get('search_section_id');
                session::set('search_section_id',$sectionid);
                $where .=' and section_id='.$sectionid;
            }
            if (!front::post('search_spid')  && front::get('type') != 'search')
                session::del('search_spid');
            if (get('search_spid')) {
                $sectionid=get('search_spid');
                session::set('search_spid',$sectionid);
                $where .=' and spid='.$sectionid;
            }
        }
        if ($this->table == 'templatetag') {
            if (front::get('tagfrom')) {
                $where="tagfrom='".front::get('tagfrom')."'";
            }
            else
                $where="tagfrom='define'";
            $where .=" and (`tagvar` IS NULL OR `tagvar` = '') ";
        }
        if ($this->table == 'option') {
            $ballot=new ballot();
            $where=array('bid'=>front::$get['bid']);
            session::set('bid',front::$get['bid']);
            $row=$ballot->getrow(array('id'=>front::$get['bid']));
            $this->view->ballot=$row;
        }
        if (get('spid')) {
            $sp=new special();
            $sp=$sp->getrow('spid='.get('spid'));
            $this->view->special=$sp;
        }
        $limit=((front::get('page') -1) * $this->_pagesize).','.$this->_pagesize;
        if ($this->table == 'category'||$this->table == 'type') {
            $where .= " `parentid`='0' ";
        }
        $this->_view_table=$this->_table->getrows($where,$limit,$ordre,$this->_table->getcols('manage'));
        $this->view->record_count=$this->_table->record_count;
    }
    function addballot_action() {
        $this->render('dialog/addballot.php');
    }
    function add_action() {
        if (front::post('submit') &&$this->manage->vaild()) {
            $this->manage->filter($this->Exc);
            $this->manage->add_before($this);
            $this->manage->save_before();
            front::$post['catname']=str_replace(' ','&nbsp;',front::$post['catname']);
            front::$post['htmldir']=str_replace(' ','_',front::$post['htmldir']);
            if(front::$post['introduce'] == ''){
               front::$post['introduce'] = mb_substr(preg_replace('/&(.*?);/is','', strip_tags(front::$post['content'])),0,200).'...';
            }
            //var_dump(front::$post);exit;
            $insert=$this->_table->rec_insert(front::$post);
            $_insertid=$this->_table->insert_id();
            if ($insert <1) {
                front::flash("{$this->tname}添加失败！");
            }
            else {
                $this->manage->save_after($_insertid);
                $info='';
                if ($this->table == 'archive') {
                    $url=url('archive/show/aid/'.$_insertid,false);
                    if (front::get('site') == 'default'||front::get('site') == '') {
                        $info='<a href="'.$url.'" target="_blank">查看</a>';
                    }
                }
                front::flash("{$this->tname}添加成功！$info");
                if (front::get('type') == 'dialog') {
                    if ($this->table == 'option') {
                        front::flash();
                        exit('添加成功！');
                    }
                }
                if ($this->table == 'templatetag') {
                    front::refresh(url::modify('act/list/tagfrom/content',true));
                }
                else {
                    front::refresh(url::modify('act/list',true));
                }
            }
        }
        $this->_view_table=array();
        $this->_view_table['data']=array();
    }
    function getfield_action() {
        if (get('aid')) {
            $data=$this->_table->getrow(get('aid'),1,'1 desc',$this->_table->getcols('modify'));
        }
        $field=$this->_table->getFields();
        $set_field=category::getpositionlink(get('catid'));
        foreach ($set_field as $key=>$value) {
            $set_fields[]=$value[id];
        }
        $code='<table>';
        foreach ($field as $f) {
            $name=$f['name'];
            if (setting::$var['archive'][$name]['catid'] &&!in_array(setting::$var['archive'][$name]['catid'],$set_fields)) {
                unset($field[$name]);
                continue;
            }
            if (!preg_match('/^my_/',$name)) {
                unset($field[$name]);
                continue;
            }
            if (!isset($data[$name]))
                $data[$name]='';
            $code .= '<tr>';
            $code .= '<td>'.setting::$var['archive'][$name]['cname'].'</td><td width="1%">&nbsp;</td>';
            $code .= '<td>';
            $code .= form::getform($name,$form,$field,$data);
            $code .= '</td></tr>';
        }
        $code .= '</table>';
        echo $code;
    }
    function edit_action() {
        if (front::post('submit') &&$this->manage->vaild()) {
            $this->manage->filter($this->Exc);
            $this->manage->edit_before();
            $this->manage->save_before();
            if ($this->table == 'user'&&front::get('id') == '1') {
                $this->_table1=new operators();
                $update=$this->_table1->rec_update(array('password'=>front::post('password')),'id='.front::get('id'));
            }
            $update=$this->_table->rec_update(front::$post,front::get('id'));
            if($this->table == 'category' && front::post('image') != '' && front::post('image_del')){
                @unlink(front::post('image'));
                $update=$this->_table->rec_update(array('image'=>''),front::get('id'));
            }
            if ($this->table == 'templatetag') {
                if (front::$post['tagfrom'] == 'content') {
                    $path=ROOT.'/config/tag/content_'.front::get('id').'.php';
                }
                else {
                    $path=ROOT.'/config/tag/category_'.front::get('id').'.php';
                }
                $tag_config=serialize(front::$post);
                file_put_contents($path,$tag_config);
            }
            if ($update <1) {
                front::flash("{$this->tname}修改失败！");
            }
            else {
                $this->manage->save_after(front::get('id'));
                $info='';
                if ($this->table == 'archive') {
                    $url=url('archive/show/aid/'.front::get('id'),false);
                    if (front::get('site') == 'default'||front::get('site') == '') {
                        $info='<a href="'.$url.'" target="_blank">查看</a>';
                    }
                }
                front::flash("{$this->tname}修改成功！$info");
                $from=session::get('from');
                session::del('from');
                if (!front::post('onlymodify'))
                    front::redirect(url::modify('act/list',true));
            }
        }
        if (!session::get('from'))
            session::set('from',front::$from);
        if (!front::get('id'))
            exit("PAGE_NOT FOUND!");
        $this->_view_table=$this->_table->getrow(front::get('id'),'1',$this->_table->getcols('modify'));
        if (!is_array($this->_view_table))
            exit("PAGE_NOT FOUND!");
        $this->manage->view_before($this->_view_table);
    }
    function mail_action() {
        $where=null;
        $ordre='1 desc';
        if ($this->table == 'archive') {
            $ordre="`order`,1 DESC";
            $where=$this->_table->get_where('manage');
            if (!front::post('_typeid'))
                session::del('_typeid');
            if (get('_typeid')) {
                $typeid=get('_typeid');
                session::set('_typeid',$typeid);
                $this->type=type::getInstance();
                $types=$this->type->sons($typeid);
                $types[]=$typeid;
                $where .=' and typeid in('.trim(implode(',',$types),',').')';
            }
            if (get('typeid')) {
                $typeid=get('typeid');
                $where .=' and typeid='.$typeid;
            }
            if (!front::post('_title'))
                session::del('_title');
            if (get('_title')) {
                $title=get('_title');
                session::set('_title',$title);
                $where .=" and title like '%$title%' ";
            }
        }
        if ($this->table == 'templatetag') {
            if (front::get('tagfrom')) {
                $where="tagfrom='".front::get('tagfrom')."'";
            }
            else
                $where="tagfrom='define'";
            $where .=" and (`tagvar` IS NULL OR `tagvar` = '') ";
        }
        if ($this->table == 'option') {
            $ballot=new ballot();
            $where=array('bid'=>front::$get['bid']);
            session::set('bid',front::$get['bid']);
            $row=$ballot->getrow(array('id'=>front::$get['bid']));
            $this->view->ballot=$row;
        }
        $limit=((front::get('page') -1) * $this->_pagesize).','.$this->_pagesize;
        $this->_view_table=$this->_table->getrows($where,$limit,$ordre,$this->_table->getcols('manage'));
        $this->view->record_count=$this->_table->record_count;
    }
    function send_action() {
        if (front::post('submit') &&$this->manage->vaild()) {
            $_POST['mail_address']=strtr($_POST['mail_address'],'[','<');
            $_POST['mail_address']=strtr($_POST['mail_address'],']','>');
            include_once(ROOT.'/lib/plugins/smtp.php');
            $mailsubject = mb_convert_encoding($title,'GB2312','UTF-8');
            $mailtype = "HTML";
            $smtp = new include_smtp(config::get('smtp_mail_host'),config::get('smtp_mail_port'),config::get('smtp_mail_auth'),config::get('smtp_mail_username'),config::get('smtp_mail_password'));
            $smtp->debug = false;
            $smtp->sendmail($_POST['mail_address'],config::get('smtp_user_add'),$_POST['title'],$_POST['content'],$mailtype);
            front::flash('<font color=red>发送邮件成功!</font>');
        }
        if (!session::get('from'))
            session::set('from',front::$from);
        $this->_view_table=$this->_table->getrow(front::get('id'),'1',$this->_table->getcols('modify'));
        $this->manage->view_before($this->_view_table);
    }
    function viewcnzz_action() {
        $cnzz=new cnzz();
        $url=$cnzz->autologin(config::get('cnzz_user'),config::get('cnzz_pass'));
        $this->view->url=$url;
        $this->_view_table=$this->_table->getrow(front::get('id'),'1',$this->_table->getcols('modify'));
        $this->manage->view_before($this->_view_table);
    }
    function show_action() {
        front::check_type(front::$get['id']);
        $this->_view_table=$this->_table->getrow(front::$get['id'],1,'1 desc',$this->_table->getcols('modify'));
    }
    function batch_action() {
        if (front::post('batch') &&front::post('select')) {
            $select=implode(',',front::post('select'));
            $select=$this->_table->primary_key.' in ('.$select.')';
            if (front::post('batch') == 'check') {
                $check=$this->_table->rec_update(array('checked'=>1),$select);
                if ($check >0)
                    front::flash("{$this->tname}审核完成！");
                else
                    front::flash("没有{$this->tname}被审核！");
            }
            elseif (front::post('batch') == 'move'&&front::post('typeid')) {
                if (in_array(front::post('typeid'),front::post('select')))
                    front::flash("不能移动到本分类下！");
                else {
                    $check=$this->_table->rec_update(array('parentid'=>front::post('typeid')),$select);
                    if ($check >0)
                        front::flash("分类移动成功！");
                    else
                        front::flash("没有分类被移动！");
                }
            }
            elseif (front::post('batch') == 'move'&&front::post('catid')) {
                if (in_array(front::post('catid'),front::post('select')))
                    front::flash("不能移动到本栏目下！");
                else {
                    $check=$this->_table->rec_update(array('parentid'=>front::post('catid')),$select);
                    if ($check >0)
                        front::flash("栏目移动成功！");
                    else
                        front::flash("没有栏目被移动！");
                }
            }
            elseif (front::post('batch') == 'movelist'&&front::post('catid')) {
                $check=$this->_table->rec_update(array('catid'=>front::post('catid')),$select);
                if ($check >0)
                    front::flash("移动成功！");
                else
                    front::flash("没有内容被移动！");
            }
            elseif (front::post('batch') == 'recommend'&&front::post('attr1')) {
                $check=$this->_table->rec_update(array('attr1'=>front::post('attr1')),$select);
                if ($check >0)
                    front::flash("设置推荐成功！");
                else
                    front::flash("没有内容被设置！");
            }
            elseif (front::post('batch') == 'deletestate') {
                $deletestate=$this->_table->rec_update(array('state'=>-1),$select);
                if ($deletestate >0)
                    front::flash("{$this->tname}已被移到回收站！");
                else
                    front::flash("没有{$this->tname}被移到回收站！");
            }
            elseif (front::post('batch') == 'restore') {
                $deletestate=$this->_table->rec_update(array('state'=>0),$select);
                if ($deletestate >0)
                    front::flash("{$this->tname}已被还原！");
                else
                    front::flash("没有{$this->tname}被还原！");
            }
            elseif (front::post('batch') == 'delete') {
                foreach (front::post('select') as $id) {
                    $this->manage->delete_before($id);
                }
                $delete=$this->_table->rec_delete($select);
                if ($delete >0)
                    front::flash("成功删除{$this->tname}！");
                else
                    front::flash("没有{$this->tname}被删除！");
            }
            elseif (front::post('batch') == 'addtospecial') {
                $add=$this->_table->rec_update(array('spid'=>front::post('spid')),$select);
            }
            elseif (front::post('batch') == 'removefromspecial') {
                $add=$this->_table->rec_update(array('spid'=>null),$select);
            }
        }
        if (front::post('batch') == 'listorder') {
            $orders=front::post('listorder');
            if (is_array($orders))
                foreach ($orders as $id=>$order) {
                    $this->_table->rec_update(array('listorder'=>$order),$id);
                }
        }
        front::redirect(front::$from);
    }
    function delete_action() {
        $this->manage->delete_before(front::get('id'));
        $delete=$this->_table->rec_delete(front::get('id'));
        if ($delete)
            front::flash("删除{$this->tname}成功！");
        front::redirect(url::modify('act/list/table/'.$this->table.'/bid/'.session::get('bid')));
    }
    function setting_action() {
        $this->_view_table=false;
        $set=settings::getInstance();
        $sets=$set->getrow(array('tag'=>'table-'.$this->table));
        $data=unserialize($sets['value']);
        if (front::post('submit')) {
            $var=front::$post;
            unset($var['submit']);
            $set->rec_replace(array('value'=>serialize($var),'tag'=>'table-'.$this->table,'array'=>var_export($var,true)));
            front::flash("内容推荐配置成功！");
        }
        $this->view->settings=$data;
    }
    function view($table) {
        $this->view->data=$table['data'];
        $this->view->field=$table['field'];
    }
    function end() {
        if (!isset($this->_view_table))
            return;
        if (!isset($this->_view_table['data']))
            $this->_view_table['data']=$this->_view_table;
        $this->_view_table['field']=$this->_table->getFields();
        $this->view->fieldlimit=$this->_table->getcols(front::$act == 'list'?'manage': 'modify');
        $this->view($this->_view_table);
        if (!preg_match('/^my_/',$this->table))
            manage_form::table($this);
        if (front::post('onlymodify'))
            $this->render();
        else
        if (front::get('main'))
            $this->render();
        else
            $this->render('index.php');
    }
}