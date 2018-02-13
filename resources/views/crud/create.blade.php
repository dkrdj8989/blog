@extends('main')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	<script>
	  tinymce.init({
	    selector: 'textarea',
	    menubar: false
	  });	
	</script>

@endsection


@section('content')
	<br>
	<div class="row">
		<div class="col-md-8">
			<h1>글 쓰기</h1>
		</div>
	</div>
	<hr>
	{!! Form::open(['route' => 'post.store']) !!}
		@if(isset($id))
		{{ Form::select('category_id',$cats,$id,['class'=>'form-control'] )}}
		@else
		<p>
			<select name='category_id' class="form-control-sm">
				@foreach($cats as $cat)
				<option value="{{ $cat->id}}">{{$cat->name}}</option>
				@endforeach
			</select>	
		</p>
		@endif 
    	{{ Form::label('title','제목 :') }}
    	{{ Form::text('title',null,array('class'=>'form-control','required'))}}
    	{{ Form::label('slug','슬러그')}}
    	{{ Form::text('slug',null,['class'=>'form-control','required'])}}
    	{{ Form::label('body','내용',['class'=>'form-spacing-top'])}}
    	{{ Form::textarea('body',null,array('class'=>'form-control form-margin-bottom'))}}
    	{{ Form::select('tags[]',$tags,null,['class'=>'js-example-basic-multiple form-control','multiple'=>"multiple"])}}
    	{{ Form::submit('저장',array('class'=>'btn btn-success btn-lg btn-block','style' => 'margin-top:20px;'))}}
	{!! Form::close() !!}

@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}
	<script type="text/javascript">
		$(document).ready(function() {
		    $('.js-example-basic-multiple').select2();
		});
	</script>

@endsection