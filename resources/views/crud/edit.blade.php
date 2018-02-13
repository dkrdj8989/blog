@extends('main')

@section('title','게시판')

@section('stylesheets')
{!! Html::style('css/select2.min.css') !!}
	<script>
	  tinymce.init({
	    selector: 'textarea',
	    menubar: false
	  });	
	</script>
@stop

@section('content')
	<div class="row">
		<div class="col-md-8">
		{!! Form::model($post,['route' => ['post.update', $post->id],'method'=>'put']) !!}
			<p>
				<select name="category_id" class="form-control-sm">
					<?php
						foreach($cats as $cat){
							if($cat->id == $post->category_id)
								echo '<option value='.$cat->id.' selected>'.$cat->name.'</option>';
							else
								echo '<option value='.$cat->id.'>'.$cat->name.'</option>';
						}
					?>
				</select>
			</p>
			{{ Form::label('title','제목 ')}}
			{{ Form::text('title',null,['class' => 'form-control'])}}
			{{ Form::label('body','내용 ')}}
			{{ Form::textarea('body',null,['class'=> 'form-control'])}}
			{{ Form::label('slug','슬러그 ')}}
			{{ Form::text('slug',null,['class'=> 'form-control'])}}
			{{-- <select name="tags[]" class='js-example-basic-multiple form-control' multiple="multiple">
				 @foreach ($tags as $tag)
	                      <option value="{{ $tag->id }}"{{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? " selected" : "" }}>{{ $tag->name }}</option>
	             @endforeach
			</select> --}}
			{{ Form::select('tags[]',$tags,null,['class'=>'js-example-basic-multiple form-control','multiple'=>"multiple"])}}
			<hr>
		
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<dl>
						<dt>슬러그</dt>
						<dd>{{ $post->slug }}</dd>

						<dt>작성날짜</dt>
						<dd>{{ $post->created_at }}</dd>

						<dt>업데이트 날짜</dt>
						<dd>{{ $post->updated_at }}</dd>
					</dl>
					<div class="row">
						<div class="col-sm-6">
						{{ Form::submit('저장',['class'=>'btn btn-success btn-block'])}}
						</div>
						<div class="col-sm-6">
							{!! Html::linkroute('post.destroy','취소',array($post->id),array('class'=>'btn btn-danger btn-block'))!!}
						</div>	
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
@endsection

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$(document).ready(function() {
		    $('.js-example-basic-multiple').select2();
		    $('.js-example-basic-multiple').select2().val({!! json_encode($post->tags->pluck('id'))!!}).trigger("change");
		});
	</script>

@endsection