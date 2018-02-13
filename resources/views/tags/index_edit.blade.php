@extends('main')

@section('title',' 태그수정')

@section('content')
<div class="row">
	<div class="col-md-8 md-offset-2">
		<table class="table">
			<thead>
				<th>#</th>
				<th>이름</th>
				<th> </th>
			</thead>

			<tbody>
				<tbody>

					@foreach($tags as $t)
					<tr>
						<th>{{ $t->id}}</th>
						<td>{{ $t->name}}</td>
						<td>
							<a href="{{ route('tag.edit',$t->id)}}" class="btn btn-default">수정</a>
						</td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>

	@stop
