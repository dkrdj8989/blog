@extends('main')

@section('title','전체 글 보기')
@section('stylesheets')
{!! Html::style('css/index.css') !!}
@stop
@section('content')

<div class="row ">
	<div class="col-md-8">
		<h1>전체 글 보기</h1>
	</div>
	<div class="col-md-4">
		<a href={{ route('post.create')}} class="btn btn-default btn-lg">글 쓰기</a>
	</div>
	<div class="row">
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<th>#</th>
				<th>제목</th>
				<th>내용</th>
				<th>작성날짜</th>
				<th></th>
			</thead>

			<tbody>
				@foreach($posts as $post)
				<tr>
					<th>{{ $post->id }}</th>
					<td>{{ $post->title }}</td>
					<td>{{ substr(strip_tags($post->body),0,50)}} {{ strlen(strip_tags($post->body)) > 50 ? '...' : "" }}</td>
					<td>{{ $post->created_at }}</td>
					<td><a href={{ route('post.show',$post->id) }} class="btn btn-default btn-sm">보기</a>
						<a href={{ route('post.destroy',$post->id) }} class="btn btn-default btn-sm">삭제</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
			<div class="text-center">				
				{{ $posts->links() }}
			</div>
				
			
	</div>
</div>

@stop