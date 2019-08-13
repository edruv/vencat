@extends('layouts.app2')
@section('content')
	<div class="container">
		<div class="col-md-8 offset-md-2 col-sm-12">
			<div class="card">
				<div class="card-header text-center bg-light" style="font-size:1.2em;">
					Agregar Usuario
				</div>
				<div class="card-body">
					<form class="" action="{{ route('usuarios.store')}}" method="post">
						@csrf
						<div class="form-group">
							<label for="name">Nombre(s) <small class="text-danger"><i class="fa fa-asterisk"></i></small> </label>
							<input type="text" class="form-control" name="name" id="name" value="{{ old('name')}}" placeholder="">
						</div>
						<div class="form-group">
							<label for="lastn">Apellido(s)</label>
							<input type="text" class="form-control" name="lastn" id="lastn" value="{{ old('lastn')}}" placeholder="">
						</div>
						<div class="form-group">
							<label for="alias">Alias</label>
							<input type="text" class="form-control" name="alias" id="alias" value="{{ old('alias')}}" placeholder="">
						</div>
						<div class="form-group">
							<label for="email">Email <small class="text-danger"><i class="fa fa-asterisk"></i></small> </label>
							<input type="email" class="form-control" name="email" id="email" value="{{ old('email')}}" placeholder="">
						</div>
						<div class="form-group">
							<label for="passw">Contraseña <small class="text-danger"><i class="fa fa-asterisk"></i></small> </label>
							<input type="password" class="form-control" name="passw" id="passw" value="{{ old('passw')}}" placeholder="">
						</div>
						<div class="form-group">
							<label for="place">Ubicacion <small class="text-danger"><i class="fa fa-asterisk"></i></small> </label>
							<select class="form-control" name="place">
								<option selected disabled>Area / Lugar donde frecuenta</option>
								@foreach ($ubics as $ubic)
									<option value="{{ $ubic->id }}">{{ $ubic->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label >Tipo de usuario <small class="text-danger"><i class="fa fa-asterisk"></i></small> </label>
							@foreach ($roles as $rol)
								<div class="form-check">
									<input class="form-check-input" type="radio" name="role" id="{{$rol->slug}}" value="{{$rol->id}}">
									<label class="form-check-label" for="{{$rol->slug}}">
										{{ $rol->name }} <span class="text-muted d-sm-none d-md-block">{{$rol->description}}</span><small class="text-muted d-none d-sm-block d-md-none">{{$rol->description}}</small>
									</label>
								</div>
							@endforeach
						</div>
						<div class="form-group">
							<p class="text-muted">* Campos obligatorios</p>
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

	<script type="text/javascript">
		$(document).ready(function() {
			$('#email').parent().hide();
			$('#passw').parent().hide();

			$('.form-check-input').change(function() {
				var role = $(this).attr('id')
				if (role == 'admin' || role == 'seller') {
					$('#email').parent().show();
					$('#passw').parent().show();
				}else {
					$('#email').parent().hide();
					$('#passw').parent().hide();
				}
			});
		});
	</script>
@endsection
