<style type="text/css">
    #watermark_pos_select {
        width:100px;
        height:100px;
        font-size: 12px;
    }
    #watermark_pos_select td {
        cursor: pointer;
    }
    .pos_hover {
        background-color: yellow;
    }
    .pos_select {
        background-color: yellow;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('#watermark_pos_select td').each(function(){
            if($(this).html()==<?php echo get('watermark_pos') ?>)
            $(this).addClass('pos_select');
        });
        $('#watermark_pos_select td').hover(function(){
            $(this).addClass('pos_hover');
        }, function(){
            $(this).removeClass('pos_hover');
        })
        $('#watermark_pos_select td').click(function(){
            $('#watermark_pos_select td').each(function(){
                $(this).removeClass('pos_select');
            });
            $('#watermark_pos').val($(this).html());
            $(this).addClass('pos_select');
        });
        $('#watermark_pos').click(function(){
            $('#watermark_pos_select td').each(function(){
                $(this).removeClass('pos_select');
            });
            $('#watermark_pos_select td').each(function(){
                if($(this).html()== $('#watermark_pos').val())
                    $(this).addClass('pos_select');
            });
        });
    });
</script>

<div style="display: inline-table">
    <table border="1" width="1"  id="watermark_pos_select" cellpadding="3" cellspacing="3">
        <tbody>
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td align="left" valign="top">1</td>
                <td align="center" valign="top">2</td>
                <td align="right" valign="top">3</td>
            </tr>
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td align="left">4</td>
                <td align="center">5</td>
                <td align="right">6</td>
            </tr>
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td align="left" valign="bottom">7</td>
                <td align="center" valign="bottom">8</td>
                <td align="right" valign="bottom">9</td>
            </tr>
        </tbody>
    </table>
</div>