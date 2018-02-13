<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    //이 객체는 많은 post모델을 포함한다. 
    public function posts(){
    	return $this -> hasMany('App\Post');
    }
}
