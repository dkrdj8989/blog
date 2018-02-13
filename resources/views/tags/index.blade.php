@extends('main')

@section('title',' All categories')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>이름</th>
						<th> </th>
					</tr>
				</thead>

				<tbody>
				@foreach($tags as $t)
					<tr>
						<td>{{ $t->id}}</td>
						<td>{{ $t->name}}</td>
						<td>
							<a href="{{ route('tag.show',$t->id)}}" class="btn btn-default">보기</a>
							{!! Form::open(['route'=>['tag.destroy',$t->id],'method'=>'delete','style'=>'display:inline-block'])!!}
							{!! Form::submit('삭제',['class'=>'btn btn-danger']) !!}
							{!! Form::close()!!}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
			<div class="col-md-4 offset-md-2">
				<div class="card">
					<h3>태그 생성</h3>
					{!! Form::open(['route' => 'tag.store','method'=>'POST']) !!}
			    {{-- 	{{ Form::label('name','제목') }}
			    	{{ Form::text('name',null,array('class'=>'form-control'))}} --}}
			    	<label for='name'>제목</label>
					<input type="text" name="name" class="from-control">
			    	{{ Form::submit('추가',array('class'=>'btn btn-success btn-lg btn-block','style' => 'margin-top:20px;'))}}
					{!! Form::close() !!}
				</div>
				<div class="card">
					<a href="{{ route('tag.edit_index')}}" class="btn btn-success btn-lg btn-block">
						태그 수정
					</a>
				</div>
			</div>
	</div>
@stop