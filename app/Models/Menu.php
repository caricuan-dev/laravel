<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['menu_title','parent_id'];

    public function childs() {

        return $this->hasMany(Menu::class,'parent_id','id')
        ->join('permissions', 'menus.permission', 'permissions.id')
        ->select('menus.id', 'menus.display', 'menus.header', 'menus.menu_title', 'menus.parent_id', 'menus.sort_order', 'menus.icon', 'menus.slug', 'permissions.name AS permission');

    }
}
