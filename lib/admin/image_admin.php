<?php
class image_admin extends admin{
   function init(){
   }
   function listdir_action(){
       $file_dir = ROOT.'/upload/images/';
       $dir_arr = array();
       if($ch = opendir($file_dir)){
       	  while($dir = readdir($ch))
       	  {
       	  	 if(!strstr('..',$dir))
       	  	    $dir_arr[] = $dir;
       	  }
       }
       $this->view->dir_arr = $dir_arr;
   }
   function listimg_action(){
   	   if(!front::get('dir'))
   	       return;
   	   $image_dir = ROOT.'/upload/images/'.front::get('dir');
       if(!is_dir($image_dir))
           return;
   	   $handle = opendir($image_dir); //当前目录
   	   $img_array = array();
       while (false !== ($file = readdir($handle))) { //遍历该php文件所在目录
	      list($filesname,$kzm)=explode(".",$file);//获取扩展名
	        if($kzm=="gif" or $kzm=="jpg" or $kzm=="png") { //文件过滤
	          if (!is_dir('./'.$file)) { //文件夹过滤
	            $img_arr[]=$file;//把符合条件的文件名存入数组
	           }
	          }
        }
        $this->view->img_arr = $img_arr;

   }
   function deleteimg_action(){
   	   if(!front::get('dir') || !front::get('imgname'))
   	       return;
   	   $img = ROOT.'/upload/images/'.front::get('dir').'/'.str_replace('___','.',front::get('imgname'));
       if(!file_exists($img))
       	    front::flash('图片不存在');
       if(!unlink($img))
            front::flash('删除失败，请检查权限');
       else
            front::flash('图片已删除');
       front::redirect(url::modify('act/listimg/dir/'.front::get('dir')));
   }
   function end() {
        $this->render('index.php');
   }
}
