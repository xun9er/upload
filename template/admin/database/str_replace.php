<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 <div class="table_td" style="margin-top:10px;"> 

<strong>您可以批量替换数据库中某字段的内容，<span style="color:red">此操作非常危险，请谨慎使用 ! </span></strong>


<div class="blank10"></div>

<script src="{$base_url}/common/js/jquery-1.2.6.min.js"></script>
<script>

    $(document).ready(function() {

        $('#stable').change(function() {
            showfield($('#stable').val());
        });

    });


    function showfield(table) {
        $.ajax({
            url: '<?php echo url('database/dbfield_select',true);?>',
            data:'&stable='+table,
            type: 'POST',
            dataType: 'json',
            timeout: 1000,
            error: function(){

            },
            success: function(data){
                $('#'+data.id).html(data.content);
            }
        });
    }
</script>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

    <table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table">

        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
            <td>

                <div style="float:left;display:inline;">
                    数据表=>
                    {form::select('stable',0,$tables,'style="font-size:12px"')}
                </div>
                <div style="float:left;display:inline;" id="fieldlist">
                </div>

            </td>
        </tr>


        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
            <td>把<br>{form::textarea('replace1','','cols="50" rows="3"')}</td>
        </tr>

        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
            <td>替换成<br>{form::textarea('replace2','','cols="50" rows="3"')}</td>
        </tr>

        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
            <td>条件<br>{form::input('where','','size="60"')}</td>
        </tr>

        <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
            <td>{form::submit()}</td>
        </tr>

    </table>

</form>


</div>
</div>
</div>
</div>