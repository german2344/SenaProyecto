<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $guarded =[];
    
    // Relación con el modelo Product
    // public function menu()
    // {
    //     return $this->belongsTo(Menu::class);
    // }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function delivery(){
        return $this->hasMany(Cart::class);
    }
    //1:N
    public function detailSales(){
        return $this->hasMany('App\Models\Cart');
    }
}
