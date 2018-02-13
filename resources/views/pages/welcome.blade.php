@extends('main')

@section('title','Welcome');
 
@section('home')
  active
@endsection

@section('content')
    <div class="row">
      <div class="col-md-10">
        <div class="post">
          @foreach($posts as $post)
          <h1>{{ $post->title}}</h1>
          <p>{{ substr(strip_tags($post->body), 0,300)}} {{ strlen(strip_tags($post->body)) > 300 ? "..." : ""}}</p>
          <a href="{{ route('blog.single',$post->slug)}}"class="btn btn-primary">더 보기</a>
          <hr>
          @endforeach          
        </div>

      </div>
      <div class="col-md-2">
        <h2>side bar</h2>
        <ul style="list-style: none; padding:0">
        @foreach($cats as $cat)
          <a href="{{ route('category.show',$cat->id)}}">
            <li>{{ $cat -> name}}</li>
          </a>
        @endforeach
        </ul>
      </div>
    </div>
 @endsection