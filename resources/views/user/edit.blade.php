@extends('layouts.app2')
@section('content')
	<div class="container">
		<div class="col-md-8 offset-md-2 col-sm-12">
			<div class="card">
				<div class="card-header text-center bg-primary text-white" style="font-size:1.2em;">
					Agregar Usuario
				</div>
				<div class="card-body">
					<form class="" action="{{ route('usuarios.update',$user->id)}}" method="post">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label for="name">Nombre(s) <small class="text-danger"><i class="fa fa-asterisk"></i></small> </label>
							<input type="text" class="form-control" name="name" id="name" value="{{ old('name',$user->name)}}" placeholder="">
						</div>
						<div class="form-group">
							<label for="lastn">Apellido(s)</label>
							<input type="text" class="form-control" name="lastn" id="lastn" value="{{ old('lastn',$user->lastN)}}" placeholder="">
						</div>
						<div class="form-group">
							<label for="alias">Alias</label>
							<input type="text" class="form-control" name="alias" id="alias" value="{{ old('alias',$user->alias)}}" placeholder="">
						</div>
						<div class="form-group">
							<label for="email">Email <small class="text-danger"><i class="fa fa-asterisk"></i></small> </label>
							<input type="email" class="form-control" name="email" id="email" value="{{ old('email',$user->email)}}" placeholder="">
						</div>
						<div class="form-group">
							<label for="place">Ubicacion <small class="text-danger"><i class="fa fa-asterisk"></i></small> </label>
							<select class="form-control" name="place">
								<option disabled>Area / Lugar donde frecuenta</option>
								@foreach ($ubics as $ubic)
									@if ($user->ubicacion == $ubic->id)
										<option selected value="{{ $ubic->id }}">{{ $ubic->name }}</option>
									@else
										<option value="{{ $ubic->id }}">{{ $ubic->name }}</option>
									@endif
								@endforeach
							</select>
						</div>
						@if (app('request')->input('up'))
							<div class="form-group" id="roles">
						@else
							<div class="form-group" id="roles">
						@endif
							<label >Tipo de usuario <small class="text-danger"><i class="fa fa-asterisk"></i></small> </label>
							@foreach ($roles as $rol)
								@if ($user->role == $rol->id)
									<div class="form-check">
										<input class="form-check-input" type="radio" name="role" id="{{$rol->slug}}" value="{{$rol->id}}" checked>
										<label class="form-check-label" for="{{$rol->slug}}">
											{{ $rol->name }} <span class="text-muted d-sm-none d-md-block">{{$rol->description}}</span><small class="text-muted d-none d-sm-block d-md-none">{{$rol->description}}</small>
										</label>
									</div>
								@else
									<div class="form-check">
										<input class="form-check-input" type="radio" name="role" id="{{$rol->slug}}" value="{{$rol->id}}">
										<label class="form-check-label" for="{{$rol->slug}}">
											{{ $rol->name }} <span class="text-muted d-sm-none d-md-block">{{$rol->description}}</span><small class="text-muted d-none d-sm-block d-md-none">{{$rol->description}}</small>
										</label>
									</div>
								@endif
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
			@if ($user->role == 1)
			$('#email').parent().hide();
			$('#passw').parent().hide();
			@endif

			$('.form-check-input').change(function() {
				var role = $(this).attr('id')
				if (role == 'customer') {
					$('#email').parent().hide();
					$('#passw').parent().hide();
				}else {
					$('#email').parent().show();
					$('#passw').parent().show();
				}
			});
		});
	</script>
@endsection
