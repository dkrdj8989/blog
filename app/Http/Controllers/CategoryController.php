<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Session;

class CategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('auth',['except'=>['show'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // veiw of categories 
        $categories = Category::all();

        return view('category.index')->withCategories($categories);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data  
        $this -> validate($request,[
                'name'=> 'required'
            ]);
        // store in db 
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        Session::flash('success','카테고리가 생성되었습니다.');

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Category::find($id);
        $pages = $cat->posts()->orderBy('id','desc')->paginate(5);

        return view('category.show')->withCat($cat)->withPages($pages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::find($id);
        foreach($cat->posts as $post)
        {
            $post->tags()->detach();
            $post->comments()->delete();
            $post->delete();
        }
        $cat->delete();


        return redirect()->route('category.index');
    }
}
