<?php

if (!defined('ROOT')) exit('Can\'t Access !');
class table_announcement extends table_mode {
    function add_before(act $act) {
        front::$post['adddate']=date('Y-m-d H:i:s');
    }
}