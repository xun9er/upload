<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 
  <div class="table_td" style="margin-top:10px;">
<?php
$st=$_GET['st'];
if(front::get('type')=='subscription'){
	
	
	if($_GET['site']!='default'){
		$path = config::get('site_url').'/data/subscriptionmail.txt';
	}else{
		$path = ROOT.'/data/subscriptionmail.txt';
	}
	
	
	$maillist = file_get_contents($path);
	$maillist = preg_match_all('/\[(.*?)\]/is',$maillist,$out);
	$out[1] = array_unique($out[1]);
	$maillist = implode(',',$out[1]);
	if($maillist[strlen($maillist)-1] == ',') $maillist = substr($maillist,0,-1);
}
?>

<form method="post" name="mail_form1" action=""  onsubmit="return checkform();">
      <input type="hidden" name="onlymodify" value=""/>
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">

        <tbody>
            
                                            
            <tr>
                <td class="left">用户名</td>                
                <td><textarea name="mail_address" id="mail_address" cols="50" rows="20"><?php if($st) {?>{table_user::mail_before()}<?php }?><?php if(front::get('type')=='subscription'){ echo $maillist; }?></textarea>
                <br />发送格式示例: username1@cmseasy.cn,username2@cmseasy.cn....usernameN@cmseas.cn             </td>
            </tr>
            
            <tr>
                <td class="left">邮件标题</td>                
                <td><input name="title" type="text" value="" size="50" />                </td>
            </tr>
            
            <tr>
                <td class="left">发送内容</td>
                <td>
                       <div style="width:99%;">
<textarea name="content" id="sendmail" cols="50" rows="20"></textarea><br />可以输入合法的html代码.
             
</div>            </td>
            </tr>

   
            

        </tbody></table>

<div class="blank20"></div>
<input type="submit" name="submit" value="发送" class="button" />
    </form>
    
    </div>
</div>
</div>
</div>