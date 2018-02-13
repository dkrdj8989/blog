<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\Comment;
use Session;
use Mail;
use Purifier;

class PostController extends Controller
{   

     public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit','update','destroy'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderby('id','desc')->paginate(5);

        return view('crud.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
        return view('crud.create')->withCats($categories)->withTags($tags2);
    }

    public function create2($id)
    {
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $cat) {
            $cats[$cat->id] = $cat->name;
        }

        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        return view('crud.create')->withCats($cats)->withTags($tags2)->withId($id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        $this ->validate($request,array(
                'category_id' => 'required|integer',
                'title' => 'required|max:255',
                'slug' => 'required|regex:/^[a-zA-Z]+$/u|min:5|max:255|alpha_dash|unique:posts,slug',
                'body' => 'required'
            ));

        //store in the database
        $post = new Post;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = Purifier::clean($request->body);

        $post->save();
        if(isset($request->tags))
        {
            $post->tags()->sync($request->tags,false);
        }
        

        Session::flash('success','글이 등록 되었습니다.');

        return redirect()->route('post.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('crud.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $cats = Category::all();
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        return view('crud.edit')->withPost($post)->withCats($cats)->withTags($tags2);
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
        //validate data
        $post = Post::find($id);
        if($post->slug == $request->slug){
            $this->validate($request,array(
                'title'=>'required|max:255',
                'body'=>'required'
            ));
        }else{
            $this->validate($request,array(
                'title'=>'required|max:255',
                'slug' => 'required|alpha|min:5|max:255|alpha_dash|unique:posts,slug',
                'body'=>'required'
            ));
        }
        //store data in db
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = Purifier::clean($request->body);
        $post->category_id = $request->category_id;
        $post->save();

        $post->tags()->sync($request->tags,true);

        //flash message
        Session::flash('success','글이 수정 되었습니다.');
        //redirect 
        return redirect()->route('post.show',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->comments()->delete();
        $post->delete();

        return redirect()->route('post.index');
    }

    public function sendEmail(Request $request){
        $this->validate($request,[
                'email'=>'required|email',
                'subject'=>'required',
                'message'=>'required'
            ]);
        $data = array(
                'email'=>$request->email,
                'subject'=>$request->subject,
                'body_message'=>$request->message
            );
       
        Mail::send('emails.form',$data,function ($message) use ($data){
            $message->from($data['email']);
            $message->to('fdssdaaf@naver.com');
            $message->subject($data['subject']);
        });
        
        return redirect('/');
    }

    public function storeComment(Request $request,$id){
        $this->validate($request,[
                'email'=>'required|email|max:255',
                'comment'=>'required|max:500',
                'type' => 'required'
            ]);

        $post = Post::find($id);
        $comment = new Comment();

        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->post()->associate($post);

        $comment->save();

        Session::flash('succeess','댓글이 등록되었습니다.');
        
        if($request->type == 'post')
            return redirect()->route('post.show',$id);
        else
            return redirect()->route('blog.single',$post->slug);
        
    }
}
