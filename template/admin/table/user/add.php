<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>

<div class="tags">
 <div id="tagstitle">
   <a id="one1" onclick="setTab('one',1,6)" class="hover">基本信息</a>
   <a id="one2" onclick="setTab('one',2,6)">自定义信息</a>
  </div> 
 <div id="tagscontent"> 
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
      <input type="hidden" name="onlymodify" value=""/>
      
      <div id="con_one_1">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">

        <tbody>
            
                                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">用户名</td>
                <td>
                        {form::getform('username',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">密码</td>
                <td>
                        <input type="text" name="passwordnew" id="passwordnew" value=""  />                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">昵称</td>
                <td>
                        {form::getform('nickname',$form,$field,$data)}                </td>
            </tr>

                     <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">安全问题</td>
                <td>{form::getform('question',$form,$field,$data)}</td>
            </tr> 
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">您的答案</td>
                <td>{form::getform('answer',$form,$field,$data)}</td>
            </tr>              
     
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">用户组</td>
                <td>
                        {form::getform('groupid',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">QQ号码</td>
                <td>
                        {form::getform('qq',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">E-Mail</td>
                <td>
                        {form::getform('e_mail',$form,$field,$data)}                </td>
            </tr>

                            
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">电话</td>
                <td>
                        {form::getform('tel',$form,$field,$data)}                </td>
            </tr>



        </tbody></table>


    
    
    </div>
    <div id="con_one_2" style="display:none">
    
    <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">

        <tbody>
        
        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff"><th colspan="5">自定义字段</th></tr>
            {loop $field $f}
            <?php
            $name=$f['name'];
            if(!preg_match('/^my_/',$name)) {
            unset($field[$name]);
            continue;
            }
            if(!isset($data[$name])) $data[$name]='';
            ?>
            <tr>
                <td class="left"><?php echo setting::$var['user'][$name]['cname']; ?></td>
                <td>
                    <?php echo form::getform($name,$form,$field,$data); ?>
                </td>
            </tr>
            {/loop}
        
        
        </tbody>
    </table>
    
    </div>
    
  
    
        <div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="button" />
    </form>
      </div>
   </div>