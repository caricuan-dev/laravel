<?php

use App\Models\Menu;
use App\Models\SistemInfo;

if (!function_exists('getSysInfo')){
    function getSysInfo()
    {
        return SistemInfo::first();
    }
}

if (!function_exists('getAdmMenuHeaders')){
    function getAdmMenuHeaders()
    {
        return Menu::join('permissions', 'menus.permission', 'permissions.id')
        ->select('menus.id', 'menus.display', 'menus.header', 'menus.menu_title', 'menus.parent_id', 'menus.sort_order', 'menus.icon', 'menus.slug', 'permissions.name AS permission')
        ->where('menus.display', '=', 'Admin')
        ->where('menus.header', '=', 'Yes')
        ->get();
    }
}

if (!function_exists('getUserMenuHeaders')){
    function getUserMenuHeaders()
    {
        return Menu::join('permissions', 'menus.permission', 'permissions.id')
        ->select('menus.id', 'menus.display', 'menus.header', 'menus.menu_title', 'menus.parent_id', 'menus.sort_order', 'menus.icon', 'menus.slug', 'permissions.name AS permission')
        ->where('menus.display', '=', 'User')
        ->where('menus.header', '=', 'Yes')
        ->get();
    }
}
