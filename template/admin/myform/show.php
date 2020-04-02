<div class="tags">
 <div id="tagstitle">
   <a id="one1" class="hover">浏览表单提交结果</a>
  </div> 
 <div id="tagscontent"> 
 <div id="con_one_1">

<div class="blank10"></div>

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
        <thead>
            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <th align="center" width="180">字段名称</td>
                <th align="center" width="480">内容</td>
            </tr>
            </thead>
        <tbody>
{user_cb_data($data,$table)}
            {loop $field $f}
                <?php

                $name=$f['name'];
                if(!preg_match('/^my_/',$name)) continue;

                if(!isset($data[$name])) $data[$name]='';
                ?>

            <tr onmouseover="this.bgColor='#F5F5F5';" onmouseout="this.bgColor='ffffff';" bgcolor="#ffffff">
                <td width="180" align="center">{$name|lang}</td>
                <td width="480" align="center">{$data[$name]}</td>
            </tr>

            {/loop}

        </tbody></table>

		</div></div></div>
