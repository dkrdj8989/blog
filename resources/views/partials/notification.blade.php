@if(Session::has('success'))
		<div class="alert alert-success" role="alert">
			<p>{{ Session::get('success') }}</p>
		</div>
@endif

@if(count($errors) > 0)
	<div class="alert alert-danger" role="alert">
	  <ul>
	  	<strong>Error :</strong>
	  	@foreach($errors->all() as $error)
	  	<li>{{ $error }}</li>
	  	@endforeach
	  </ul>
	</div>
@endif