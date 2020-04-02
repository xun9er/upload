<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">

<form name="settingform" id="settingform"  action="<?php echo uri();?>" method="post">

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">
<thead>
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff"><th colspan="3">友情链接设置</th>
            </tr>

</thead>
<tbody>

            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">分类</td>
                <td width="320">
                    {form::textarea('types',get('types')?get('types'):$settings['types'],'cols=50 rows=10')}
                </td>
				<td align="top">
				  分类如：<br />
                  (1)网站首页<br />
				  (2)链接首页
				</td>
            </tr>

        </tbody>
    </table>


    <div class="blank20"></div>
    <input type="submit" name="submit" value=" 提交 " class="button" />
</form>


</div>
</div>
</div>
