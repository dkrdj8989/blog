@extends('main')

@section('title',' Single')

@section('content')
	<div class="row ">
		<div class="col-md-8 offset-md-2">
			<h4 style="margin-top: 30px">{{ $post->category->name}}</h4>
			<h1 style="margin-top: 20px">{{ $post->title}}</h1>
			<hr>
			<p>{!! $post->body !!}</p>
			<hr>
			<div class="tags">
				@foreach ($post->tags as $tag)
					<span class="badge badge-secondary">{{ $tag->name }}</span>
				@endforeach
			</div>		
		</div>	

	</div>

	<div class="row" style="margin-top: 40px">
		<div class="col-md-8 offset-md-2">
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

		<div class="row col-md-8 offset-md-2">
			<div id="comment-form" class="col-md-12" style="margin-top: 50px;">
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
				{{ Form::text('type','slug',['style'=>'display : none'])}}
				{{ Form::close() }}
			</div>
		</div>

	</div>
@stop