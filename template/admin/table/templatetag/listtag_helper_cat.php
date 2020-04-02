<?php
/*
  $id = get('id');
  $path=ROOT.'/config/tag/category_'.$id.'.php';
  $tag_config = array();
  $tag_config_content = @file_get_contents($path);
  if($tag_config_content){
  $tag_config = unserialize($tag_config_content);
  }else{
  $tag_config['length'] = 20;
  $tag_config['limit'] = 10;
  $tag_config['thumb'] = 0;
  } */
$tplarray=include(ROOT.'/template/'.config::get('template_dir').'/tpltag/tag.config.php');
$tplarray=$tplarray['category'];
$tag_config=$data['setting'];
?>

<div class="padding10" id="listtaghelper" style="display:block;">

    <div id="list_tool">
        <?php
        echo '<div id="helpbox">';
        echo '栏目:'.form::select('catid', $tag_config['catid'], category::option()).'默认为所有栏目<br />';
        echo '子栏目:';
        echo '<input type="checkbox" name="subcat" id="subcat" '.$subcatchecked.'  />';
        echo '<br />';
        echo '栏目名称:';
        echo '<input type="checkbox" name="catname" id="catname" '.$catnamechecked.'  />';
        echo '&nbsp;&nbsp;';
        echo '封面内容:';
        echo '<input type="checkbox" name="categorycontent" id="categorycontent" '.$categorycontentchecked.'  />';
        echo '&nbsp;&nbsp;';
        echo '栏目图片:';
        echo '<input type="checkbox" name="catimage" id="catimage" '.$catimagechecked.'  />';
        echo '<br />';
        echo '标签模板:';
        echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);
        echo '&nbsp;标签模板文件存放在&nbsp;template/当前使用模板目录/tpltag/tag_category_*.html</div><br/><div style="display:none">';
        //echo form::getform('tagcontent',$form,$field,$data);
        echo form::textarea('tagcontent', 'null', 'cols="70" rows="20"');
        echo '</div>';
        ?>
    </div>

</div>