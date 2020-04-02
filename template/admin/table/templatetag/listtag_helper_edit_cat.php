<?php
/*


  $tag_config['length'] = 20;
  $tag_config['limit'] = 10;
  $tag_config['thumb'] = 0;
 */
$tplarray=include(ROOT.'/template/'.config::get('template_dir').'/tpltag/tag.config.php');
$tplarray=$tplarray['category'];
$tag_config=$data['setting'];


  if($tag_config['subcat'] == 'on'){
      $subcatchecked = 'checked';
  }else{
      $subcatchecked = '';
  }
  if($tag_config['catname'] == 'on'){
      $catnamechecked = 'checked';
  }else{
      $catnamechecked = '';
  }
  if($tag_config['categorycontent'] == 'on'){
      $categorycontentchecked = 'checked';
  }else{
     $categorycontentchecked = '';
  }
  if($tag_config['catimage'] == 'on'){
      $catimagechecked = 'checked';
  }else{
      $catimagechecked = '';
  }
?>

<div class="padding10" id="listtaghelper" style="display:block;">

    <div id="list_tool">
        <?php
        echo "<table><tr onmouseover=this.bgColor='#F5F5F5'; onmouseout=this.bgColor='ffffff'; bgcolor=#ffffff>";
        echo '<td class="left">栏目</td><td>'.form::select('catid', $tag_config['catid'], category::option()).'<span class="tips">默认为所有栏目</span>';
       echo "</td></tr><tr onmouseover=this.bgColor='#F5F5F5'; onmouseout=this.bgColor='ffffff'; bgcolor=#ffffff>";
        echo '<td class="left">子栏目</td><td>';
        echo '<input type="checkbox" name="subcat" id="subcat" '.$subcatchecked.'  /><img src="images/cuo.gif" alt="" width="14" height="14" style="margin-left:10px; margin-right:5px;" /> <span class="tips">是否调用栏目下级子栏目</span>';
        echo "</td></tr><tr onmouseover=this.bgColor='#F5F5F5'; onmouseout=this.bgColor='ffffff'; bgcolor=#ffffff>";
        echo '<td class="left">栏目名称</td><td>';
        echo '<input type="checkbox" name="catname" id="catname" '.$catnamechecked.'  /><img src="images/cuo.gif" alt="" width="14" height="14" style="margin-left:10px; margin-right:5px;" /> <span class="tips">是否调用栏目下级子栏目</span>';
        echo "</td></tr><tr onmouseover=this.bgColor='#F5F5F5'; onmouseout=this.bgColor='ffffff'; bgcolor=#ffffff>";
        echo '<td class="left">封面内容</td><td>';
        echo '<input type="checkbox" name="categorycontent" id="categorycontent" '.$categorycontentchecked.'  /><img src="images/cuo.gif" alt="" width="14" height="14" style="margin-left:10px; margin-right:5px;" /> <span class="tips">是否显示栏目封面内容</span>';
        echo "</td></tr><tr onmouseover=this.bgColor='#F5F5F5'; onmouseout=this.bgColor='ffffff'; bgcolor=#ffffff>";
        echo '<td class="left">栏目图片</td><td>';
        echo '<input type="checkbox" name="catimage" id="catimage" '.$catimagechecked.'  /><img src="images/cuo.gif" alt="" width="14" height="14" style="margin-left:10px; margin-right:5px;" /> <span class="tips">是否调用栏目说明图片</span>';
        echo "</td></tr><tr onmouseover=this.bgColor='#F5F5F5'; onmouseout=this.bgColor='ffffff'; bgcolor=#ffffff>";
        echo '<td class="left">标签模板</td><td>';
        echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);
        echo '<img src="images/cuo.gif" alt="" width="14" height="14" style="margin-left:10px; margin-right:5px;" /> <span class="tips">标签模板文件存放在&nbsp;template/当前使用模板目录/tpltag/tag_category_*.html</span><div style="display:none">';
        //echo form::getform('tagcontent',$form,$field,$data);
        echo form::textarea('tagcontent', 'null', 'cols="70" rows="20"');
        echo '</div></td></tr>';
        echo '</table>';
        ?>
    </div>

</div>