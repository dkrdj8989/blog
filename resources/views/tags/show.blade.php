@extends('main')

@section('title',' 태그')

@section('content')
	<div class="row">
		<div class="col-md-8  md-offset-2">
			<h2>태그명 :{{ $tag->name}} </h2>
		</div>	
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>글 이름 </th>
				</thead>

				<tbody>
					@foreach($tag->posts as $post)
					<tr>
						<td>{{ $post->id}}</td>
						<td>{{ $post->title}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop