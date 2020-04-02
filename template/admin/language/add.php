{$tips}
<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 
  <div class="table_td" style="margin-top:10px;">
  
编辑语言包 <strong>（{if config::get('lang_type')=='cn'}中文{elseif config::get('lang_type')=='en'}英文{else}{config::get('lang_type')}{/if}）</strong>






<div class="blank10"></div>


<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


<div class="blank10"></div>

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<thead>
 
        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
          <th>中文备注</th>
          <th>调用项</th>
          <th>前台显示值</th>
        </tr>
        </thead>

<tbody id="myList" >
        

     <tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
           <td align="center">
           <input type="text" name="cnnote" size="10" value="">
           </td>
           <td align="center">
           <input type="text" name="key" size="10" value="">
          </td>
           <td align="center">
           <input type="text" name="val" size="40" value="">
           </td>
        </tr>
        
      </tbody>
    </table>



<div class="blank10"></div>
    <input type="submit" value=" 增加 " name="submit" class="button" />



</form> 


</div>
</div>
</div>
</div>
