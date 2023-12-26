<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    use HasFactory;
     //RELACION  UNO A MUCHOS
    public function recipes(){
        return $this->hasMany('App\Models\Recipe');
    }
    public function products(){
        return $this->hasMany('App\Models\Product');
    }
    public function menus(){
        return $this->hasMany('App\Models\Menu');
    }
}
