<?php
/*
  $id=get('id');
  $path=ROOT.'/config/tag/content_'.$id.'.php';
  $tag_config=array();
  $tag_config_content=@file_get_contents($path);
  if ($tag_config_content) {
  $tag_config=unserialize($tag_config_content);
  }
  else {
  $tag_config['length']=20;
  $tag_config['limit']=10;
  $tag_config['thumb']=0;
  }
 */
$tplarray=include(ROOT.'/template/'.config::get('template_dir').'/tpltag/tag.config.php');
$tplarray=$tplarray['content'];
?>

<div class="padding10" id="listtaghelper" style="display:block;">

    <div id="list_tool">
        <?php
        echo '<div id="helpbox">';
        echo '栏目:'.form::select('catid', $tag_config['catid'], category::option());
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo '分类:'.form::select('typeid', $tag_config['typeid'], type::option());
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo '专题:'.form::select('spid', $tag_config['spid'], special::option());
        echo '<br/>';
        echo '地区:';
        echo form::select('province_id', $tag_config['province_id'], area::province_option());
        echo form::select('city_id', $tag_config['city_id'], area::city_option());
        echo form::select('section_id', $tag_config['section_id'], area::section_option());
        echo '<br/>';
        echo '标题截取字数:';
        echo form::input('length', $tag_config['length'], 'size=5');
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo '排序方式:';
        echo form::select('ordertype', $tag_config['ordertype'],
                array(
            'aid-desc'=>'最新(按发布先后、按aid倒序)',
            'aid-asc'=>'最早(按发布先后、按aid顺序)',
            'view-desc'=>'最热(按view倒序)',
            'comment_num-desc'=>'热评(按comment_num倒序)',
            'rand()'=>'随机',
        ));
        echo '<br/>';
        echo '调用记录条数:';
        echo form::input('limit', $tag_config['limit'], 'size=5');
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo '缩略图:';
        echo '<input type="checkbox" name="thumb" id="thumb" '.$checked.' />';
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo '推荐位:';
        echo form::select('attr1', $tag_config['attr1'], array(0=>'请选择...', 1=>'首页推荐', 2=>'首页焦点', 3=>'首页头条', 4=>'列表页推荐', 5=>'内容页推荐'));
        echo "<br />";
        echo '标签模板:';
        echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);
        echo '&nbsp;标签模板文件存放在&nbsp;template/当前使用模板目录/tpltag/tag_content_*.html</div><br/><div style="display:none">';
        //echo form::getform('tagcontent',$form,$field,$data);
        echo form::textarea('tagcontent', 'null', 'cols="70" rows="20"');
        echo '</div>';
        ?>
    </div>

</div>