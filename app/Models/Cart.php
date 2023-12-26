<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded =[];

  

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    
    public function sale()
    {
        return $this->belongsTo(Sale::class,'sale_id');
    }
   
}
