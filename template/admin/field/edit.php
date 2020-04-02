<script language="javascript" src="{$base_url}/common/js/common.js"></script>

<script>
    function checktovarchar() {
        if($("#selecttype").val()=='0') {
            $(".varchar2").show("slow");
            $(".select2").hide("slow");
            $("#type").attr('value','varchar');
        }
    }
    function checktoselect() {
        $("#issearch").attr('checked',false);
        if($("#type").val()=='varchar'){
            $("#issearch").attr('disabled',false);
        }
        else
        {
            $("#issearch").attr('disabled',true);
        }
        if($("#type").val()=='0') {
            $(".select2").show("slow");
            $(".varchar2").hide("slow");
            $("#selecttype").attr('value','select');
        }
    }

    function form_preview() {
        if($("#type").val()=='0') {
            //$('#form_preview').html(get('form1').cname.value+'：<input name="'+get('form1').name.value+'" size="'+get('form1').len.value+'">');

            if($("#selecttype").val()=='select') {
                select='<select name="'+get('form1').name.value+ '">';
                subject=get('form1').select.value;
                var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                var match = myregexp.exec(subject);
                while (match != null) {
                    select += '<option value="'+match[1]+'">'+match[2]+'</option>';
                    match = myregexp.exec(subject);
                }
                select +='</select>';
            }
            else {
                select='';
                subject=get('form1').select.value;
                var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                var match = myregexp.exec(subject);
                while (match != null) {

                    if($("#selecttype").val()=='checkbox')
                        select += match[2]+'<input type="checkbox" value="'+match[1]+'" name="'+get('form1').name.value+ '[]">&nbsp;&nbsp;';
                    else
                        select += match[2]+'<input type="radio" value="'+match[1]+'" name="'+get('form1').name.value+ '">&nbsp;&nbsp;';
                    match = myregexp.exec(subject);
                }
            }

            $('#form_preview').html(select);
            $('#form_preview_title').html(get('form1').cname.value);
            $('#form_preview_tips').html(get('form1').tips.value);
        }
    }

    function checkform1() {
        $('#select_preview').html('');
    }


</script>

<div class="tags">



 <div id="tagscontent">
<a href="<?php echo modify("/act/add/table/".$table);?>" class="button">添加字段</a>   <a href="<?php echo modify("/act/list/table/".$table);?>" class="button">查看列表</a>
<div class="blank10"></div><div class="blank10"></div>

<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">

    <table border="0" cellspacing="1" cellpadding="4" class="list" name="table" id="table" width="100%">

<tbody>
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">字段名</td>
<td width="10"></td>
				<td>
	{if front::$act=='edit'}
                    <b>{$field.name}</b>
                    <input type="hidden"  name="name" id="name" value="{$field.name}" />
	{else}
                    <input size="20" name="name" id="name" value="my_"   onblur="form_preview()"/><img src="{$skin_path}/cuo.gif" alt="" width="14" height="14" / style="margin-left:10px; margin-right:5px;"> <span class="tips">必填</span>
	{/if}
                </td>
				
            </tr>
			

            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">字段中文名</td>
				<td width="10"></td>
                <td><input size="20" name="cname" id="cname" value="<?php echo @setting::$var[$table][$field['name']]['cname'];?>"   onblur="form_preview()"/><img src="{$skin_path}/cuo.gif" alt="" width="14" height="14" / style="margin-left:10px; margin-right:5px;"> <span class="tips">必填</span></td>
            </tr>

            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">提示信息</td>
				<td width="10"></td>
                <td><input size="40" name="tips" id="tips" value="<?php echo @setting::$var[$table][$field['name']]['tips'];?>"   onblur="form_preview()"/></td>
            </tr>
            <?php
//phpox1104 自定义表单 添加字段
            if($table == 'archive') {
                ?>
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">绑定栏目:</td>
				<td width="10"></td>
                <td>{form::getform('catid',$form,$field,$data)}</td>
            </tr>
                <?php } ?>
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td class="left">是否必填</td>
				<td width="10"></td>
                <td><input type="checkbox" size="10" name="isnotnull" id="isnotnull" value="1" <?php echo @setting::$var[$table][$field['name']]['isnotnull']=='1'?'checked':''?>  onblur="form_preview()"/></td>
            </tr>
        </tbody>
    </table>


    <div  class="varchar2" >
        <table border="0" cellspacing="1" cellpadding="4" class="list" name="table" id="table" width="100%">
            <thead>
                <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                    <th>
                        一般类
                    </th>
					<th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                    <td class="left">类型</td>
					<td width="10"></td>
                    <td><select name="type" id="type" onchange="checktoselect(); form_preview();">
                            <option value="int" <?php echo @setting::$var[$table][$field['name']]['type']=='int'?'selected':''?>>整数</option>
                            <option value="varchar" <?php echo @setting::$var[$table][$field['name']]['type']=='varchar'?'selected':''?>>单行文本</option>
                            <option value="text" <?php echo @setting::$var[$table][$field['name']]['type']=='text'?'selected':''?>>多行文本</option>
                            <option value="mediumtext" <?php echo @setting::$var[$table][$field['name']]['type']=='mediumtext'?'selected':''?>>超文本</option>

                            <option value="datetime" <?php echo @setting::$var[$table][$field['name']]['type']=='datetime'?'selected':''?>>日期</option>

                            <option value="_image" <?php echo @setting::$var[$table][$field['name']]['filetype']=='image'?'selected':''?>>图片</option>
                            <option value="_file" <?php echo @setting::$var[$table][$field['name']]['filetype']=='file'?'selected':''?>>附件</option>

                            <option value="0">[选择类...]</option>

                        </select>
                    </td>
                </tr>


                <tr id="len" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                    <td class="left">长度</td>
					<td width="10"></td>
                    <td><input size="10" name="len" id="len" value="{=@$field[len]}"  onblur="form_preview()"/><img src="{$skin_path}/cuo.gif" alt="" width="14" height="14" / style="margin-left:10px; margin-right:5px;"> <span class="tips">必填，请填写阿拉伯数字！</span></td>
                </tr>
                <!--phpox 加入是否搜索 start -->
                <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                    <td class="left">允许搜索</td>
					<td width="10"></td>
                    <td><input <?php echo @setting::$var[$table][$field['name']]['type']!='varchar'?'disabled':''?> type="checkbox" size="10" name="issearch" id="issearch" value="1" <?php echo @setting::$var[$table][$field['name']]['issearch']=='1'?'checked':''?>  onblur="form_preview()"/></td>
                </tr>
                <!--phpox 加入是否搜索 end -->
            </tbody>
        </table>
    </div>

    <div class="select2" style="display:none">
        <table border="0" cellspacing="1" cellpadding="4" class="list" name="table" id="table" width="100%">
            <tbody>
                <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
				<th>选择类</th>
                    <th colspan="2"></th>
                </tr>

                <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                    <td class="left">类型</td>
					<td width="10"></td>
                    <td><select name="selecttype"  id="selecttype" onchange="checktovarchar(); form_preview();">
                            <option value="radio" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='radio'?'selected':''?>>单选</option>
                            <option value="checkbox" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='checkbox'?'selected':''?>>多选</option>
                            <option value="select" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='select'?'selected':''?>>下拉选择</option>
                            <option value="0">[非选择类...]</option>
                        </select>
                    </td>
                </tr>


                <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                    <td class="left">选项 </td>
					<td width="10"></td>
                    <td>{form::textarea('select',@setting::$var[$table][$field['name']]['select'],' rows="6" cols="40" onblur="form_preview();" ')}&nbsp;<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14" / style="margin-left:10px; margin-right:5px;">每行一项，格式： (值)项，如：(1)非常好<div class="blank10"></div></td>
                </tr>
            </tbody>
        </table>
		
    </div>


    <div class="select2" style="display:none" id="select_preview">
        <table border="0" cellspacing="1" cellpadding="4" class="list" name="table" id="table" width="100%">
            <thead>
                <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
				<th>预览</th>
                    <th colspan="2">  </th>
                </tr>
            </thead>
            <tbody>
                <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                    <td class="left">
                        <span id="form_preview_title">
                        </span>&nbsp;
                    </td>
                    <td>
                        <span id="form_preview">
                        </span>

                    </td>
                    <td>
                        <span id="form_preview_tips">&nbsp;&nbsp;
                        </span>
                    </td>
                </tr>
            </tbody></table>
    </div>

    <div class="blank10"></div>

    <script>
        {if @setting::$var[$table][$field['name']]['selecttype']}
        $(".select2").show("fast");
        $(".varchar2").hide("fast");
        $("#selecttype").attr('value','{=@setting::$var[$table][$field['name']]['selecttype']}');
        $("#type").val('0');
        form_preview();
        {else}
        $("#selecttype").val('0');
        {/if}
    </script>

    <div class="blank10"></div>

    <?php if($table == 'user') { ?>
    <div>
        <table border="0" cellspacing="1" cellpadding="4" border="0" class="list" id="table">
            <thead>
                <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                    <th colspan="3">
                        选项
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                    <td class="left">在注册页面显示</td>
					<td width="10"></td>
                    <td><?php echo form::checkbox('showinreg', 1,@setting::$var[$table][$field['name']]['showinreg']);?></td>
                </tr>
            </tbody>
        </table>
    </div>
        <?php } ?>

    <input type="submit" name="submit" value=" 提交 " class="button" />

</form>

</div>
</div>