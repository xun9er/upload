<script language="javascript" src="{$base_url}/common/js/common.js"></script>
<div class="tags">
    <div id="tagscontent">
        <div id="con_one_1">

<form method="post" name="form1" action="<?php
if (front::$act == 'edit')
    $id="/id/".$data[$primary_key]."/tagfrom/".$_GET['tagfrom']; else
    $id=''; echo modify("/act/".front::$act."/table/".$table.$id);
?>"  onsubmit="return checkform();">
    <input type="hidden" name="onlymodify" value=""/>
    <table border="0" cellspacing="2" cellpadding="1" class="list" name="table" id="table">
                    <tbody>


                        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                            <td><strong>标签名称</strong></td></tr>


                        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                            <td style="border:none;">
                    {form::getform('name',$form,$field,$data)}                </td>
            </tr>


            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td></td>
            </tr>
            <tr>
                <td id="tag_box">
                    <strong>标签配置</strong><br /><style type="text/css">#tag_box {line-height:32px;}#tag_box input {height:16px;line-height:16px;}#tag_box table {width:100%;}#tag_box table tr td {border-bottom:1px solid #E8EEF6;color:#666;}</style>

                    {if get('tagfrom')=='category'}
                    <input type="'hidden" name="tagfrom" value="{get('tagfrom')}"/>
                    {template 'table/templatetag/listtag_helper_edit_cat.php'}
                    {elseif get('tagfrom')=='content'}
                    <input type="'hidden" name="tagfrom" value="{get('tagfrom')}"/>
                    {template 'table/templatetag/listtag_helper_edit.php'}
                    {else}
                    {form::getform('tagcontent',$form,$field,$data)}
                    {/if}
					</td>
            </tr>






        </tbody></table>
    <div class="blank20"></div>
    <input type="submit" name="submit" value="提交" class="button" />
</form>

 </div>
    </div>
</div>