<?php
//仅支持以 .htm 结尾的规则 即 .htm$

return

array(
array('list_(\d+)\.htm$','archive/list/catid/$1'),
array('list_(\d+)_(\d+)\.htm$','archive/list/catid/$1/page/$2'),
array('show_(\d+)\.htm$','archive/show/aid/$1'),
array('show_(\d+)_(\d+)\.htm$','archive/show/aid/$1/page/$2'),
);

