@extends('layouts.app2')
@section('content')
	<div class="container">
		@include('layouts.partials.status')
		<div class="card">
			<div class="card-header text-center">
					Informacion del <span class="text-lowercase">{{$user->role}}</span>
			</div>
			<div class="card-body row">
				<div class="col-md-6 col-sm-12">
					<p><span class="font-weight-bold" style="width:25%;">Nombre: </span> {{$user->name}} {{$user->lastN}}<p>
				</div>
				<div class="col-md-6 col-sm-12">
					<p><span class="font-weight-bold" style="width:25%;">Email: </span> {{$user->email}}<p>
				</div>
				<div class="col-md-6 col-sm-12">
					<p><span class="font-weight-bold" style="width:25%;">Alias: </span> {{$user->alias}}<p>
				</div>
				<div class="col-md-6 col-sm-12">
					<p><span class="font-weight-bold" style="width:25%;">Ubicacion: </span> {{$user->ubicacion}}<p>
				</div>
				<div class="col-md-6 col-sm-12">
					<p><span class="font-weight-bold" style="width:25%;">Rol: </span> {{$user->role}}<p>
				</div>
				<div class="col-md-12 text-center">
					{{-- <a href="" class="btn btn-success">
						<span class="fa-stack fa-md">
							<i class="fa fa-user fa-stack-2x"></i>
							<i class="fa fa-level-up fa-stack-1x "style="margin:.45em .4em;color:#000"></i>
						</span>
					</a> --}}
					{{-- <a href="{{ route('usuarios.edit',$user->id)}}" class="btn btn-success"> --}}
					<a href="{{ route('usuarios.edit',[$user->id,'up'=>"true",'#roles'])}}" class="btn btn-success">
						<span class="fa-stack fa-md">
							<i class="fa fa-user fa-stack-2x"></i>
							<i class="fa fa-level-up fa-stack-2x "style="margin:5px 10px;color:#000;"></i>
						</span>
					</a>
					<a href="{{ route('usuarios.edit', $user->id)}}" class="btn btn-primary"> <i class="fa fa-2x fa-pencil"></i></a>
					<form action="{{ route('usuarios.destroy',$user->id)}}" method="post" class="btn">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger"><i class="fa fa-2x fa-user-times"></i></button>
					</form>
					{{-- <a href="" class="btn btn-danger"> <i class="fa fa-2x fa-user-times"></i></a> --}}
				</div>
			</div>
			{{-- {{$user}} --}}
		</div>
		<div class="card border-primary mt-5">
			<div class="card-header bg-primary text-white">Pedidos</div>
		</div>

	</div>
@endsection
