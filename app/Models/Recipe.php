<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $guarded =[]; 
    //RELACIONES 
        //1:N PLIMORFICA
            public function comments(){
                return $this->morphMany('App\Models\Comment','commentable');
            }

            public function multimedia()
            {
                return $this->morphMany(Multimedia::class, 'multimediaable');
            }
        //1:N
            public function ingredients()
            {
                return $this->hasMany(Ingredient::class);
            }
            public function preparationSteps()
            {
                return $this->hasMany(PreparationStep::class);
            }
    //RELACIONES INVERSAS
        //1:N inversa
        public function user(){
            return $this->belongsTo('App\Models\User');
        }
        public function category(){
            return $this->belongsTo('App\Models\Category');
        }
   

}
