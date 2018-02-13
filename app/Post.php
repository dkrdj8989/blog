<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{	
	// 이객체는 category 객체에 속한다.
    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function tags(){
    	return $this->belongsToMany('App\Tag');
    }

    public function comments(){
    	return $this->hasMany('App\Comment');
    }
}
