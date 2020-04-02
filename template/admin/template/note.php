<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 <div class="table_td" style="margin-top:10px;"> 

<strong>您可以编辑模板注释，这样在分类和内容选择模板时会更方便。</strong>


<div class="blank10"></div>

<script type="text/javascript" src="{$base_url}/js/list.js"></script>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<div class="blank10"></div>

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<thead>
        <tr>
          <th>档案</th>
          <th>名称</th>
          <th>简短描述</th>
        </tr>
</thead>
<tbody>
        {loop $tps $tpl $tp}
        {php $_tp=str_replace('_html','.html',$tp);}
        {php $_tp=str_replace('_css','.css',$_tp);}
        {php $_tp=str_replace('_js','.js',$_tp);}
      <tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
          <td align="left" style="padding-left:10px;">{$_tp}</td>
           <td align="left" style="padding-left:10px;">
           <input type="text" name="{$tpl}_name" size="15" value="{=@help::$var['template_note'][$tpl.'_name']}">
           </td>
           <td align="left" style="padding-left:10px;">
           <input type="text" name="{$tpl}_note" size="45" value="{=@help::$var['template_note'][$tpl.'_note']}">
           </td>
        </tr>
       {/loop}

      </tbody>
    </table>


<div class="blank10"></div>
    <input type="submit" value=" 修改 " name="submit" class="button" />



</form>


</div>
</div>
</div>
</div>