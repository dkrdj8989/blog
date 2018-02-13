<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getSingle($slug){
    	$post = Post::where('slug','=',$slug)->first();

    	return view('pages.single')->withPost($post);
    }
}
