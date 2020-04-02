<script type="text/javascript">
    function checkform() {
        if(document.form1.catid.value=="0") {
            alert('请选择栏目');
            document.form1.catid.focus();
            return false;
        }
        if(!document.form1.title.value) {
            alert('请填写标题');
            document.form1.title.focus();
            return false;
        }
        {loop $field $f}
<?php
if (!preg_match('/^my_/', $f[name]) || !$f[notnull]) {
    //unset($field[$f[name]]);
    continue;
}
?>
        if(!document.form1.{$f[name]}.value){
            alert("请填写<?php echo setting::$var['archive'][$f['name']]['cname']; ?>");
            setTab('one',6,6);
            document.form1.{$f[name]}.focus();
            return false;
        }
        {/loop}
        return true;
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var swfu;
        var settings = {
            flash_url : "{$base_url}/common/swfupload/swfupload.swf",
            upload_url: "{url('tool/uploadimage/site/'.front::get('site'),false)}",
            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
            file_size_limit : "{ini_get('upload_max_filesize')}B",
            file_types : "*.jpg;*.gif;*.png;*.bmp",
            file_types_description : "图片", //All Files
            file_upload_limit : 100,
            file_queue_limit : 0,
            custom_settings : {
                progressTarget : "fsUploadProgress",
                cancelButtonId : "btnCancel"
            },
            debug: false,

            // Button settings
            //button_image_url: "{$base_url}/common/swfupload/botton.png",
            button_width: "100",
            button_height: "22",
            button_placeholder_id: "spanButtonPlaceHolder",
            button_text: '<span class="theFont">批量上传图片</span>',
            button_text_style: ".theFont{font-size:12px;width:100px;height:22px;line-height:22px;font-weight:bold;}",
            button_text_left_padding: 7,
            button_text_top_padding: 5,
            button_disabled : false,
            button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_cursor: SWFUpload.CURSOR.HAND,

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete	// Queue plugin event
        };

        swfu = new SWFUpload(settings);
    });
</script>
<form method="post" name="form1" action="<?php if (front::$act == 'edit')
    $id="/id/".$data[$primary_key]; else
    $id='';
echo modify("/act/".front::$act."/table/".$table.$id); ?>" enctype="multipart/form-data" onsubmit="return checkform();">
    <input type="hidden" name="onlymodify" value=""/>
    <script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.queue.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/fileprogress.js"></script>
    <script type="text/javascript" src="{$base_url}/common/swfupload/handlers.js"></script>
<link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
    <script language="javascript" src="{$base_url}/common/js/jquery/ui/ui.datepicker.js"></script>

    <script>
        $(document).ready(function(){
            $("#catid").change( function(){
                get_field($("#catid").val());
            });
        });
        function attachment_delect(id) {
            $.ajax({
                url: '{url('tool/deleteattachment/site/'.front::get('site'),false)}&id='+id,
                type: 'GET',
                dataType: 'text',
                timeout: 1000,
                error: function(){
                    //	alert('Error loading XML document');
                },
                success: function(data){
                    document.form1.attachment_id.value=0;
                    get('attachment_path').innerHTML='';
                    get('file_info').innerHTML='';
                }
            });
        }

        function get_field(catid) {
            $.ajax({
                url: '{url('table/getfield/table/archive/',true)}&catid='+catid+'&aid={$data['aid']}',
                type: 'GET',
                dataType: 'text',
                timeout: 1000,
                error: function(){
                    //alert('Error loading XML document');
                },
                success: function(data){
                    $("#con_one_6").html(data);
                }
            });
        }
    </script>



    <div class="tags">
        <div id="tagstitle">
           <a href="#" id="one1" onclick="setTab('one',1,6)" class="hover">基本信息</a>
                <a href="#" id="one2" onclick="setTab('one',2,6)">SEO信息</a>
                <a href="#" id="one3" onclick="setTab('one',3,6)">属性设置</a>
                <a href="#" id="one4" onclick="setTab('one',4,6)">扩展信息</a>
                <a href="#" id="one5" onclick="setTab('one',5,6)">权限审核</a>
                <a href="#" id="one6" onclick="setTab('one',6,6)">自定义字段</a>
        </div>
        <div id="tagscontent">
            <div id="con_one_1">
                <table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style=" width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">栏目</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('catid',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style=" width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">分类</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('typeid',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style=" width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">标题</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('title',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style=" width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">正文</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
                            {form::getform('content',$form,$field,$data)}
                            <div style="width: 680px;margin-top: 0px;">
                                <div class="fieldset flash" id="fsUploadProgress">
                                    <span class="legend"></span>
                                </div>
                                <div id="divStatus"></div>
                                <div>
                                    <span id="spanButtonPlaceHolder"></span>
                                    <input id="btnCancel" type="button" value="取消" disabled="disabled" style="display:none;" />
                                </div>
                            </div>
							<div class="blank30"></div>
                        </td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">内容简介</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('introduce',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style=" width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">标签</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('tag',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style=" width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">发布时间</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%"><input type="text" name="adddate" id="adddate" value="<?php echo date('Y-m-d H:i:s'); ?>" class="skey" /> 格式：2010-08-08 08:08:08</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style=" width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">发布作者</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%"><input type="text" name="author" id="author" value="<?php echo $user['username'] ?>"   class="skey" /></td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">来源</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('attr3',$form,$field,$data)}</td>
                    </tr>
                </table>
            </div>
            <div id="con_one_2" style="display:none">
                <table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">网页标题</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('mtitle',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">关键词</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('keyword',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">页面描述</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('description',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">URL规则</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('htmlrule',$form,$field,$data)}<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> <span class="tips"><a href="javascript:tipsbox('你可以自定生成文件名称<br />例如：abc.html<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{</b>$caturl<b>}</b>/abc.html<br />默认：<b>{</b>$caturl<b>}</b>/show_<b>{</b>$aid<b>}</b>(_<b>{</b>$page<b>}</b>).html<br /><b>{</b>$caturl<b>}</b> = 栏目目录<br /><b>{</b>$aid<b>}</b> = 内容ID<br /><b>{</b>$page<b>}</b> = 内容分页值');">查看帮助</a></span></td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">生成HTML</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('ishtml',$form,$field,$data)}</td>
                    </tr>
                </table>
            </div>
            <div id="con_one_3" style="display:none">
                <table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">内容页模板</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
                            选择模板：{form::getform('template',$form,$field,$data)}
                        </td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">内容页多图</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">

                            <div id="uploadarea">
                                <?php for ($i=0; $i <= 10; $i++) { ?>
                                    <?php $j=$i + 1; ?>
    <?php if ($data[pics.$i]) { ?>
                                        <div id="pics{$i}_up">
                                            <span id="pics{$i}_preview"><img src="<?= $data[pics.$i] ?>" /></span>
                                            <br>地址：<input name="pics{$i}"  id="pics{$i}" value="<?= $data[pics.$i] ?>" size="50"/> <input type="button" id="pics{$i}_del" name="delbutton" value="删除" onclick="pics_delete('{$i}','pics');">
                                            <br>上传：<input type="file" name="pics{$i}_upload" id="pics{$i}_upload" style="width:400px" onchange="image_preview('pics{$i}',this.value,1)"/>&nbsp;&nbsp;<input type="button" name="pics{$i}upload"  id="pics{$i}upload" onclick="return ajaxFileUpload3('pics{$i}_upload','{url('tool/upload2/site/'.front::get('site'),false)}','#pics{$i}_loading',{$j});" value="上传" />
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <?php
                                if (empty($data[pics0])) {
                                    ?>
                                    <DIV id="pics0_up">
                                        <SPAN id="pics0_preview"></SPAN>
                                        <BR>地址：<INPUT id="pics0" size="50" name="pics0"> <INPUT style="DISPLAY: none" id="pics0_del" onclick="pics_delete('0','pics');" value="删除" type="button" name="delbutton">
                                        <BR>上传：<INPUT style="WIDTH: 400px" id="pics0_upload" onchange="image_preview('pics0',this.value,1)" type="file" name="pics0_upload">&nbsp;&nbsp;<INPUT id="pics0upload" onclick="return ajaxFileUpload3('pics0_upload','{url('tool/upload2/site/'.front::get('site'),false)}','#pics0_loading',1);" value="上传" type="button" name="pics0upload">
                                    </DIV>
                                    <?php
                                }
                                ?>
                            </div>

                            <img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"><font color="red">(当<strong>内容页模板</strong>选择"图片内容页(archive/show_pic.html)"设置)</font>
                        </td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">内容推荐位</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%" id="content-recommend">{form::getform('attr1',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">连接跳转到</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('linkto',$form,$field,$data)}<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> <span class="tips">填写后，连接到外部地址</span></td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">内容的评级</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
                            <table width="90%">
                                <tr><td width="20%">评分：{form::getform('grade',$form,$field,$data)}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="con_one_4" style="display:none;">
                <table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">缩略图</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('thumb',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">附件</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
                            <span id="file_info" style="color:red"></span><br>
                            自定义附件路径：<input type="text" name="attachment_path"  id="attachment_path" value="{$data[attachment_path]}" size="50"/>（填写此项无须再上传附件，请填写完整的url地址，例如：http://www.cmseasy.cn/upload/attachment.rar）<br /><br />
                            <input type="hidden" name="attachment_id"  id="attachment_id" value="{=archive_attachment(@$data['aid'],'id')}" size="50"/>
                            描述：<input type="text" name="attachment_intro"  id="attachment_intro" value="{=archive_attachment(@$data['aid'],'intro')}" size="50"/><br>
                            保存路径：<span id="attachment_path">{=archive_attachment(@$data['aid'],'path')}</span> <input type="button" name="delbutton" value="删除" onclick="attachment_delect(get('attachment_id').value)"><br><br>
<?php if (front::$act == 'edit' && $data['attachment_id']) { ?>
                                更改：<?php } ?>

                            上传：<input type="file" name="fileupload" id="fileupload" style="width:400px" />
                            &nbsp;&nbsp;<input type="button"  name="filebuttonUpload"  id="filebuttonUpload" onclick="return ajaxFileUpload('fileupload','{url("tool/uploadfile",false)}','#uploading');" value="上传" />
                                               <img id="uploading" src="{$base_url}/common/js/loading.gif" style="display:none;">
                        </td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">投票</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
<?php for ($i=1; $i <= 8; $i++) { ?>
                                {$i} &nbsp; 标题 {form::input("vote[$i]",vote::title(@$data['aid'],$i))}
                                &nbsp; 图片url {form::input("vote_image[$i]",vote::img(@$data['aid'],$i))}<br />
<?php } ?>

                        </td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">地区</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
                            <?php echo form::select('province_id',
                                    $data['province_id'], area::province_option()); ?>
<?php echo form::select('city_id', $data['city_id'], area::city_option($data['city_id'])); ?>
<?php echo form::select('section_id',
        $data['section_id'], area::section_option($data['section_id'])); ?>
                        </td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">专题</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
<?php echo form::select('spid',
        $data['spid'], special::option()); ?>
                        </td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">产品价格</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('attr2',$form,$field,$data)}<img src="{$skin_path}/cuo.gif" alt="" width="14" height="14"  style="margin-left:10px; margin-right:5px;"> <span class="tips">请填写大于0的数字型字符</span></td>
                    </tr>
                </table>
            </div>
            <div id="con_one_5" style="display:none">
                <table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">审核</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">{form::getform('checked',$form,$field,$data)}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">权限</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
                            <table width="90%">
                                <tr><td width="20%">&nbsp;</td>
                                    <td align="left">浏览(<font color="Red">×</font>)</td>
                                    <td align="left">下载附件(<font color="Red">×</font>)</td>
                                </tr>
                                {loop usergroup::getInstance()->group $group}
<?php if ($group['groupid'] == '888')
    continue; ?>
                                <tr><td align="left">{$group.name}</td>
                                    <td align="left">{form::checkbox("_ranks[".$group['groupid']."][view]",-1, @$data['_ranks'][$group['groupid']]['view'])}</td>
                                    <td align="left">{form::checkbox("_ranks[".$group['groupid']."][down]",-1, @$data['_ranks'][$group['groupid']]['down'])}</td>
                                </tr>
                                {/loop}
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="con_one_6" style="display:none">
                <table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr style="border-bottom:1px solid #900" onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                        <td width="19%" align="right"><span style="border:0px solid #a9bdd8; width:auto; font-weight:bold; padding:1px 20px; line-height:30px;  ">自定义字段</span></td>
                        <td width="1%">&nbsp;</td>
                        <td width="80%">
                            <table>
                                <?php
                                $set_field=category::getpositionlink($data['catid']);
                                foreach ($set_field as $key=>$value) {
                                    $set_fields[]=$value[id];
                                }
                                ?>
                                {loop $field $f}
                                <?php
                                $name=$f['name'];
                                if (!preg_match('/^my_/', $name)) {
                                    unset($field[$name]);
                                    continue;
                                }
								if(setting::$var['archive'][$name]['catid'] != 0 && setting::$var['archive'][$name]['catid'] != $data['catid']){
									unset($field[$name]);
                                    continue;
								}
                                if (!isset($data[$name]))
                                    $data[$name]='';
                                ?>
                                <tr>
                                    <td class="left" width="20%"><?php echo setting::$var['archive'][$name]['cname']; ?></td>
                                    <td width="80%">
<?php echo form::getform($name,
        $form, $field, $data); ?>
                                    </td>
                                </tr>
                                {/loop}
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>




    <div class="blank10"><script type="text/javascript">get_field('<?php echo $data['catid'];?>');</script></div>
    <input type="submit" name="submit" value=" 提交 " class="button" />

</form>
