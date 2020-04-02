<script src="{$base_url}/common/js/jquery/jquery-latest.js"></script>
<script  src="{$base_url}/common/js/jquery/ui/ui.core.js"></script>
<script  src="{$base_url}/common/js/jquery/ui/ui.resizable.js"></script>
<script  src="{$base_url}/common/js/jquery/ui/ui.draggable.js"></script>
<script  src="{$base_url}/common/js/jquery/ui/ui.dialog.js"></script>
<script src="{$base_url}/common/js/jquery/jquery.form.js"></script>
<link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/themes/flora/flora.all.css" type="text/css"/>
<script>
    function hide_edit(id) {
        $(id+'_save_button').css('display','none');
        $(id).hide('fast');
        $(id+'_textarea').html('');
        //$(id+'_content').resizable('destroy')
    }

    function show_edit(id) {
        $.ajax({
            url: '<?php echo url('template/fetch',true);?>',
            data:'&id='+id,
            type: 'POST',
            dataType: 'json',
            timeout: 3000,
            error: function(){
            },
            success: function(data){
                $(id+'_textarea').html(data.content);
                if(data.content)
                    $(id+'_save_button').css('display','block');
            }
        });

        $(id).show('fast');
        //$(id+'_content').resizable();
    }


    function show_fckedit(id) {
        $.ajax({
            url: '<?php echo url('template/fckedit',true);?>',
            data:'&id='+id,
            type: 'POST',
            dataType: 'json',
            timeout: 3000,
            error: function(){
            },
            success: function(data){
                $(id+'_textarea').html(data.content);
                if(data.content)
                    $(id+'_save_button').css('display','block');
            }
        });

        $(id).show('fast');
        //$(id+'_content').resizable();
    }

    function toggle_edit(id,fck) {
        if($(id).css('display')=='none') {
            show_edit(id);
            $(id+'_state_toggle').html('[收起]');
        }
        else {
            if(fck)  show_fckedit(id);
            else{
                hide_edit(id);
                $(id+'_state_toggle').html('[编辑]');
            }
        }
    }


    function edit_save(id,content) {
        $('#sid').val(id);
        $('#slen').val(content.length);
        $('#scontent').val(content);
        $('#editform').ajaxSubmit(function(data) {
            if(data=='ok') alert("保存成功!");
            else alert("保存失败!");
        });
    }


    function helper() {
        $("#example").dialog({ modal: true });
    }
</script>

<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 <div class="table_td" style="margin-top:10px;"> 

<form name="form1" id="form1" method="post" action="">

    <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
        <thead>
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <th width="50%">档案</th>
                <th width="25%">名称</th>
                <th width="25%">简短描述</th>
            </tr>
        </thead>
    </table>


    {loop $tps $tpl $tp}
    <?php if (preg_match('/#/',$tp)) continue; ?>
    {php $_tp=str_replace('_html','.html',$tp);}
    {php $_tp=str_replace('_css','.css',$_tp);}
    {php $_tp=str_replace('_js','.js',$_tp);}
    {php $tpt=str_replace('/','_d_',$tpl);}

    {php $cs=preg_replace('%\/.*%', '', $tpl);}


    <div {if preg_match('/\.|└/',$tp)}class="{$cs}_li" style="display:none" {else}id="{$tpt}_div"  style="margin-top:10px" {/if}>

        <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
            <tbody>
                <tr class="s_out" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                    <td width="50%" style="padding-left:10px;"><span style="float:left;">
                            {$_tp}</span>
                        {if preg_match('/.(html|css|js)/',$tp)}
                        <span style="cursor:pointer;padding-left:10px" onclick="toggle_edit('#{$tpt}')" id="{$tpt}_state_toggle">[编辑]</span>
                        {elseif !preg_match('/└/',$_tp)}
                        <span style="float:left;cursor:pointer;" onclick="$('.{$tpt}_li').toggle()" id="{$tpt}_dir_state_toggle"><img src="{$skin_path}/folder.gif" height="20"/></span>
                        {/if}
                    </td>
                    <td  width="25%" style="padding-left:10px;">
                        <input type="text" name="{$tpl}_name" size="15" value="{=@help::tpl_name($tpl)}">
                    </td>
                    <td width="25%" style="padding-left:10px;">
                        <input type="text" name="{$tpl}_note" size="40" value="{=@help::tpl_note($tpl)}">
                    </td>
                </tr>
            </tbody>
        </table>

        <!--dir-->
        <div  id="{$tpt}" style="display:none">
            <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">
                <tbody>
                    <tr class="s_out"  onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td>
                            <div id="{$tpt}_textarea" style="width:100%;">... ...
                                <!--textarea rows="20" cols="78" id="{$tpt}_content" style="font-family: Fixedsys,verdana,宋体; font-size: 12px;" name="{$tpt}_content"></textarea-->
                            </div>
                            <div id="iframe-div">
                                <div style="width:99%;"> <!--iframe src="{url("templatetag/visual/id/$tpt",false)}" id="tageditframe123" style="height:500px;width:100%;"></iframe--></div>
                            </div>
                            <div class="padding10">
                                <div id="{$tpt}_save_button" style="display:none">
                                    <span><input type="button" value="保存" name="{$tpt}_edit" class="button" onclick="if(get('{$tpt}_fck')) content=getContent('{$tpt}_content'); else content=this.form.{$tpt}_content.value;  edit_save('{$tpt}',content);"/>&nbsp;&nbsp;<!--input type="button" value="标签助手" class="greenbtn" onclick="helper()" name="{$tpt}_edit"  id="{$tpt}_edit" /--></span>
                                    <!--<span><a href="{url("templatetag/visual/id/$tpt/prefix/".ADMIN_DIR,false)}" target="_blank">可视化标签管理</a></span>-->
                                    <!--span><a href="javascript:;"  onclick="toggle_edit('#{$tpt}','fck');">使用内容编辑器(非模板使用)</a></span-->
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    {/loop}


    <div class="blank10"></div>
    <input type="submit" value=" 修改 " name="submit" class="button" />




</form>



<form name="editform" id="editform" method="post" action="<?php echo url('template/save');?>">
    <input type="hidden" value="" name="sid" id="sid" />
    <input type="hidden" value="" name="slen" id="slen" />
    <input type="hidden" value="" name="scontent" id="scontent" />
</form>


</div>
</div>
</div>
</div>