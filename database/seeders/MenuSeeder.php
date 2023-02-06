<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            //Header
            [ 'display' => 'Admin', 'header' => 'Yes', 'menu_title' => 'Dashboard', 'parent_id' => 0, 'sort_order' => 1, 'icon' => '', 'slug' => '#', 'permission' => '1', 'status' => '1'], //1
            [ 'display' => 'Admin', 'header' => 'Yes', 'menu_title' => 'Pengaturan', 'parent_id' => 0, 'sort_order' => 2, 'icon' => '', 'slug' => '#', 'permission' => '2', 'status' => '1'], //2
            [ 'display' => 'Admin', 'header' => 'Yes', 'menu_title' => 'Master', 'parent_id' => 0, 'sort_order' => 3, 'icon' => '', 'slug' => '#', 'permission' => '3', 'status' => '1'], //3
             //Main
            [ 'display' => 'Admin', 'header' => 'No', 'menu_title' => 'Sistem', 'parent_id' => 3, 'sort_order' => 1, 'icon' => 'fa-tools', 'slug' => 'admin/sistem', 'permission' => '4', 'status' => '1'], //4
            [ 'display' => 'Admin', 'header' => 'No', 'menu_title' => 'Navigasi', 'parent_id' => 3, 'sort_order' => 2, 'icon' => 'fa-compass', 'slug' => 'admin/navigasi', 'permission' => '5', 'status' => '1'], //5
            [ 'display' => 'Admin', 'header' => 'No', 'menu_title' => 'Admin', 'parent_id' => 3, 'sort_order' => 3, 'icon' => 'fa-user-secret', 'slug' => 'admin/admin', 'permission' => '6', 'status' => '1'], //6
            [ 'display' => 'Admin', 'header' => 'No', 'menu_title' => 'User', 'parent_id' => 3, 'sort_order' => 2, 'icon' => 'fa-user', 'slug' => 'admin/user', 'permission' => '7', 'status' => '1'], //7
            //Sub
            [ 'display' => 'Admin', 'header' => 'No', 'menu_title' => 'Info', 'parent_id' => 4, 'sort_order' => 1, 'icon' => 'fa-info-circle', 'slug' => 'info', 'permission' => '8', 'status' => '1'], //8
            [ 'display' => 'Admin', 'header' => 'No', 'menu_title' => 'Status', 'parent_id' => 4, 'sort_order' => 1, 'icon' => 'fa-spell-check', 'slug' => 'status', 'permission' => '9', 'status' => '1'], //9
            [ 'display' => 'Admin', 'header' => 'No', 'menu_title' => 'Daftar', 'parent_id' => 6, 'sort_order' => 1, 'icon' => 'fa-user-alt', 'slug' => 'admin-list', 'permission' => '10', 'status' => '1'], //10
            [ 'display' => 'Admin', 'header' => 'No', 'menu_title' => 'Hak Akses', 'parent_id' => 6, 'sort_order' => 2, 'icon' => 'fa-user-shield', 'slug' => 'admin-role', 'permission' => '11', 'status' => '1'], //11
            [ 'display' => 'Admin', 'header' => 'No', 'menu_title' => 'Daftar', 'parent_id' => 7, 'sort_order' => 1, 'icon' => 'fa-user-alt', 'slug' => 'user-list', 'permission' => '12', 'status' => '1'], //12
            [ 'display' => 'Admin', 'header' => 'No', 'menu_title' => 'Hak Akses', 'parent_id' => 7, 'sort_order' => 2, 'icon' => 'fa-user-shield', 'slug' => 'user-role', 'permission' => '13', 'status' => '1'], //13
            


            //[ 'display' => 'User', 'header' => 'Yes', 'menu_title' => 'Dashboard', 'parent_id' => 0, 'sort_order' => 1, 'icon' => '', 'slug' => '#', 'permission' => '4', 'status' => '1'], //4
            //[ 'display' => 'User', 'header' => 'Yes', 'menu_title' => 'Pengaturan', 'parent_id' => 0, 'sort_order' => 2, 'icon' => '', 'slug' => '#', 'permission' => '5', 'status' => '1'], //5
            //[ 'display' => 'User', 'header' => 'Yes', 'menu_title' => 'Master', 'parent_id' => 0, 'sort_order' => 3, 'icon' => '', 'slug' => '#', 'permission' => '6', 'status' => '1'], //6
            //[ 'display' => 'Public', 'header' => 'Yes', 'menu_title' => 'Menu', 'parent_id' => 0, 'sort_order' => 1, 'icon' => '', 'slug' => '#', 'permission' => '7', 'status' => '1'], //7
           
            
        ];
        foreach ($menus as $menu) {
            Menu::Create($menu);
        }
    }
}
