<?php

use App\Models\Category;

if (!function_exists('get_menu_prent')) {
    function get_menu_prent() {
        return Category::getParent();
    }
}

if (!function_exists('get_menu_child')) {
    function get_menu_child($id_parent) {
        if (!$id_parent) {
            return null;
        }
        return Category::getChild($id_parent);
    }
}