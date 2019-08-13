@if ($errors->any())
	<ul class="list-unstyled alert alert-danger" role="alert">
		@foreach ($errors->all() as $error)
			<li><i class="fa fa-exclamation-circle"></i> {{$error}}</li>
		@endforeach
	</ul>
@endif
