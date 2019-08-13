@extends('layouts.app2')
@section('content')
	<div class="container">
		<div class="col-md-8 offset-md-2 col-sm-12">
			<div class="card">
				<div class="card-header text-center bg-light" style="font-size:1.2em;">
					Agregar Ubicacion
				</div>
				<div class="card-body">
					<form class="" action="{{ route('ubicaciones.store')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="name">Nombre</label>
							<input type="text" class="form-control" name="name" id="name" value="{{ old('name')}}" placeholder="">
							{{-- <p class="help-block">Help text here.</p> --}}
						</div>
						<div class="form-group text-center ">
							<input type="submit" class="col-xs-12 col-md-6 btn btn-primary"value="Guardar">
						</div>
					</form>
				</div>
			</div>
			@include('layouts.partials.form-errors')
		</div>
	</div>
@endsection
