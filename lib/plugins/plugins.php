<?php

class plugins {
    static function categoryinfo($id) {
        if($id==0) {
            $category=category::getInstance();
            if (is_array($id)) $id=$id['catid'];
            $categories=$category->son($id);
            $cats=array();
            foreach ($categories as $catid) {
                $_category=$category->category[$catid];
                if ($stype &&!preg_match('/-/',$stype) &&$_category['stype'] <>$stype) continue;
                if ($stype &&preg_match('/-/',$stype) &&'-'.$_category['stype'] == $stype) continue;
                $_category['url']=category::url($_category['catid']);
                $cats[]=$_category;
            }
            return $cats;
        }
        $category=category::getInstance();
        $catinfo[] = $category->category[$id];
        $catinfo[0]['url'] = category::url($id);
        return $catinfo;
    }
}