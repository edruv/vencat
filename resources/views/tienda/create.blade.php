@extends('layouts.app2')
@section('content')
	<div class="container">
		<div class="col-md-8 offset-md-2 col-sm-12">
			<div class="card">
				<div class="card-header text-center bg-light" style="font-size:1.2em;">
					Agregar Tienda
				</div>
				<div class="card-body">
					<form class="" action="{{ route('tienda.store')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="name">Nombre</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="">
							{{-- <p class="help-block">Help text here.</p> --}}
						</div>
						<div class="form-group">
							<label for="avatar">Imagen / Logo</label>
							<input type="file" class="form-control-file" name="avatar" id="avatar" placeholder="">
							{{-- <p class="help-block">Help text here.</p> --}}
						</div>
						<div class="form-group text-center ">
							<input type="submit" class="col-xs-12 col-md-6 btn btn-primary"value="Guardar">
						</div>
					</form>
				</div>
			</div>
			@if ($errors->any())
				<ul class="list-unstyled alert alert-danger" role="alert">
					@foreach ($errors->all() as $error)
						<li><i class="fas fa-exclamation-circle"></i> {{$error}}</li>
					@endforeach
				</ul>
			@endif
		</div>
	</div>
@endsection
