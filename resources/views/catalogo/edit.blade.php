@extends('layouts.app2')
@section('content')
	<div class="container">
		<div class="col-md-8 offset-md-2 col-sm-12">
			<div class="card">
				<div class="card-header text-center bg-light" style="font-size:1.2em;">
					Agregar Catalogo
				</div>
				<div class="card-body">
					<form class="" action="{{ route('catalogos.update',$catalogo->id)}}" method="post" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" name="nombre" value="{{ old('nombre',$catalogo->nombre) }}" id="nombre" placeholder="">
							{{-- <p class="help-block">Help text here.</p> --}}
						</div>
						<div class="form-group">
							<label for="temporada">Temporada</label>
							<input type="text" class="form-control" name="temporada" value="{{ old('temporada',$catalogo->temporada) }}" id="temporada" placeholder="">
							{{-- <p class="help-block">Help text here.</p> --}}
						</div>
						<div class="form-group">
							<label for="year">Año</label>
							<select class="form-control" name="year" id="year">
								{{-- <option value="2018">2018</option>
								<option selected value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option> --}}
								@foreach ($years as $y)
									@if ($catalogo->year)
										@if ($y == $catalogo->year)
											<option selected value="{{$y}}">{{ $y }}</option>
										@endif
									@else
										@if ($y == now()->year)
											<option selected value="{{$y}}">{{ $y }}</option>
										@endif
									@endif
									<option value="{{$y}}">{{ $y }}</option>
								@endforeach
							</select>
							{{-- <p class="help-block">Help text here.</p> --}}
						</div>
						<div class="form-group">
							<label for="tienda">Tienda</label>
							<select class="form-control" name="tienda" id="tienda">
								<option selected disabled>Selecciona una Tienda/Proveedor</option>
								@foreach ($tiendas as $tienda)
									@if ($catalogo->tienda == $tienda->id)
										<option selected value="{{ $tienda->id }}">{{ $tienda->name }}</option>
									@else
										<option value="{{ $tienda->id }}">{{ $tienda->name }}</option>
									@endif
								@endforeach
							</select>
							{{-- <p class="help-block">Help text here.</p> --}}
						</div>
						<div class="form-group">
							<label for="portada">Portada del catalogo actual</label>
							<br>
							<img class="img-fluid  text-center" style="max-width:40%;" src="/images/catalogos/{{$catalogo->portada}}" alt="{{$catalogo->portada}}">
							{{-- <input type="file" class="form-control-file" name="portada" id="portada" placeholder=""> --}}
							{{-- <p class="help-block">Help text here.</p> --}}
						</div>
						<div class="form-group">
							<label for="portada">Portada del catalogo</label>
							<input type="file" class="form-control-file" name="portada" id="portada" placeholder="">
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
