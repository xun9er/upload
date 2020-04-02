<div class="tags">

<div id="tagscontent">
	<div id="con_one_1">
<table border="0" cellspacing="1" cellpadding="4" class="list" name="table" id="table">
  <form name='formxmlmap' method='post' action='<?php echo url('cache/make_baidu') ?>'>
    <tr>
      <td> 总输出数量
        <input name='XmlOutNum' id='XmlOutNum' value='450' size=10 maxlength='5'>
        &nbsp;<font color=#888888>地图总输出数量</font><br>
        每页连接数
        <input name='XmlMaxPerPage' id='XmlMaxPerPage' value='90' size=10 maxlength='4'>
        &nbsp;<font color=#888888>每页连接数,百度规范要求不得大于100</font><br>
        &nbsp;&nbsp;更新频率
        <input name='frequency' id='frequency' value='1440' size=10 maxlength='6'>
        &nbsp;<font color=#888888>更新周期，以分钟为单位。</font><br>
        <input name='submit' type='submit' id='submit' value='生成' class="button"></td>
    </tr>
  </form>
</table>
</div>
</div>
</div>
