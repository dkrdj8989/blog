@extends('main')

@section('title','게시판')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h5>{{ $post->category->name}}</h5>
			<br>
			<h2>제목 : {{ $post->title }}</h2>
			<hr>
			<p>{!! $post->body !!}</p>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<dl>
						<dt>슬러그</dt>
						<dd><a href={{route('blog.single',$post->slug)}}>{{ route('blog.single',$post->slug) }}</a></dd>

						<dt>작성날짜</dt>
						<dd>{{ $post->created_at }}</dd>

						<dt>업데이트 날짜</dt>
						<dd>{{ $post->updated_at }}</dd>
					</dl>
					<div class="row">
						<div class="col-sm-6">
						{!! Html::linkroute('post.edit','수정',array($post->id),array('class'=>'btn btn-primary btn-block'))!!}
						</div>
						<div class="col-sm-6">
							{!! Form::open(['route'=>['post.destroy',$post->id],'method'=>'delete'])!!}
							
							{!! Form::submit('삭제',['class'=>'btn btn-danger btn-block']) !!}

							{!! Form::close()!!}
						</div>	
					</div>
				</div>
			</div>
		</div>
		<div class="row col-md-12">		
				<div class="tags col-md-8">
					@foreach ($post->tags as $tag)
						<span class="badge badge-secondary">{{ $tag->name }}</span>
					@endforeach
				</div>
		</div>
		<div class="row">
			<hr>
		</div>
		<div class="row" style="margin-top: 40px">
		<div class="col-md-8 col-offset-2">
			<ul class="list-unstyled">
				@if($post->comments()->count())
					@foreach($post->comments as $comment)
					<li class="media" style="margin-top: 15px; margin-bottom: 15px">
						<img class="mr-3" src="{{ 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($comment->email))).'/?f=mm' }}" alt="Generic placeholder image">
						<div class="media-body">
							<h5 class="mt-0 mb-1">댓글</h5>
							{{ $comment->comment}}
						</div>
					</li>
					@endforeach
				@endif
			</ul>

		</div>

		<div class="row">
			<div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
				{{ Form::open(['route' => ['comment.store', $post->id], 'method' => 'POST']) }}
				
				<div class="row">
					<div class="col-md-6">
						{{ Form::label('email', 'Email:') }}
						{{ Form::text('email', null, ['class' => 'form-control']) }}
					</div>
					<div class="col-md-12">
						{{ Form::label('comment', "Comment:") }}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
						{{ Form::submit('댓글 등록', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;']) }}
					</div>
				</div>
				<input type="hidden" name="type" value="post">
				{{ Form::close() }}
			</div>
		</div>
	</div>
@endsection