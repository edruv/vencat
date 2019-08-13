@extends('layouts.app2')
@section('content')
	<div class="container">
		<div class="col-md-8 offset-md-2 col-sm-12">
			<div class="card">
				<div class="card-header text-center bg-light" style="font-size:1.2em;">
					Modificar Ubicacion
				</div>
				<div class="card-body">
					<form class="" action="{{ route('ubicaciones.update',$ubicacion->id)}}" method="post">
						@csrf
						@method('put')
						<div class="form-group">
							<label for="name">Nombre</label>
							<input type="text" class="form-control" name="name" value="{{ old('name',$ubicacion->name) }}" id="name" placeholder="">
							{{-- <p class="help-block">Help text here.</p> --}}
						</div>
						<div class="form-group text-center ">
							<input type="submit" class="col-xs-12 col-md-6 btn btn-primary"value="Modificar">
						</div>
					</form>
				</div>
			</div>
			@include('layouts.partials.form-errors')
		</div>
	</div>
@endsection
