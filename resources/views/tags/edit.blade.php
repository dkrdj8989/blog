@extends('main')

@section('title',' 태그수정')

@section('content')
	<div class="row">
		<div class="col-md-8  md-offset-2">
		{!! Form::model($tag,['route'=>['tag.update',$tag->id],'method'=>'PUT'])!!}
			{{ Form::label('name','태그명 ')}}
			{{ Form::text('name',null,['class' => 'form-control'])}}	
			{{ Form::submit('저장',['class'=>'btn btn-success btn-block'])}}
			{!! Form::close()!!}
		</div>	
	</div>

@stop