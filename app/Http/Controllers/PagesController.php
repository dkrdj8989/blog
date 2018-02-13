<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;

class PagesController extends Controller{
    
    public function getIndex(){
        $posts = Post::orderBy('id','desc')->limit(4)->get();
        $cats = Category::all();
        return view('pages.welcome')->withPosts($posts)->withCats($cats);
    }

    public function getAbout(){
        return view('pages.about');
    }

    public function getContact(){
        return view('pages.contact');
    }
    
    public function getInfo() {
        $user = '이준호';
        $sex = '남자';
        $info = [];
        $info['user'] = $user;
        $info['sex'] = $sex;
        return view('pages.info')->withInfo($info);
    }

    public function getEdit()
    {
        $tags = new Tag;

        return view('tags.aa')->withTags($tags);
    }

}
