<div class="tags">
    <div id="tagscontent">
        <div id="con_one_1">

            <div class="table_td" style="margin-top:10px;">

                <form name="form1" id="form1" method="post" action="{uri()}">

                    <input class="button" type="button" value=" 增加语言项 " name="add" onclick="javascript:window.location.href='<?php echo modify("act/add/table/$table"); ?>'"/>

                    <div class="blank10"></div>

                    <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
                        <thead>
                            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                                <th width="20%">中文备注 / 调用方法</th>
                                <th width="70%">前台显示值</th>
                                <th width="19%">删除</th>
                            </tr>
                        </thead>
                    </table>


                    {loop $sys_lang $key $value}

                    <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
                        <tbody>
                            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                                <td width="20%" align="left" style="padding-left:10px;">{$tips[$key]} / <strong>{lang(</strong>{$key}<strong>)}</strong>
                                </td>
                                <td width="70%" align="left" style="padding-left:10px;">
                                    <input type="text" name="{$key}" size="60" value="{$value}" />
                                </td>
                                <td width="19%" align="left" style="padding-left:10px;">
                                    <input type="checkbox" name="to_delete_items[]" value="{$key}" />
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {/loop}


                    <div class="blank10"></div>
                    <input type="submit" value=" 修改 " name="submit" class="button" />




                </form>



                <form name="editform" id="editform" method="post" action="<?php echo url('template/save'); ?>">
                    <input type="hidden" value="" name="sid" id="sid" />
                    <input type="hidden" value="" name="slen" id="slen" />
                    <input type="hidden" value="" name="scontent" id="scontent" />
                </form>

            </div>
        </div>
    </div>
</div>

