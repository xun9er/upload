<div class="tags">

  <form name="settingform" id="settingform"  action="<?php echo uri();?>" method="post">
  <div id="tagscontent">
    <div id="con_one_1">
     <div class="table_td">

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<tbody>
            <tr>
                <td> 
                <div  style="margin-left:10px; margin-top:10px;">                   {form::textarea('attr1',get('attr1')?get('attr1'):$settings['attr1'],'cols=50 rows=10')}
                    <span>
                        <br/>每行一项，格式： (值)项，如：
                        <br/>(1)首页推荐
                        <br/>(2)首页焦点
                        <br/>(3)首页头条
                        <br/>(4)列表页推荐
                        <br/>(5)内容页推荐
                    </span>
                  </div>
                </td>
            </tr>

        </tbody>
    </table>
   </div>

<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="button"/>
</form>
   </div>
  </div>
</div>

