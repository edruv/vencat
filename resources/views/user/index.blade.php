@extends('layouts.app2')

@section('content')
	<div class="container">
		@include('layouts.partials.status')
		<div class="card">
			<ul class="nav nav-tabs" id="users">
				<li class="nav-item">
					<a class="nav-link active" name="customer" href="#">Clientes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" name="user" href="#">Usuarios</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" name="seller" href="#">Vendedores</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" name="admin" href="#">Admins</a>
				</li>
				<li class="nav-item ml-auto">
					<a href="{{ route('usuarios.create')}}" name="create" class="bg-primary text-white nav-link"><i class="fa fa-plus"></i>	</a>
				</li>
			</ul>
		{{-- </div>


		<div class="card"> --}}
			<table class="table card-table table-responsive-sm" id="tUsers">
				<thead class="thead-dark">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Nombe</th>
						<th scope="col">Alias</th>
						<th scope="col" class="email">Email</th>
						<th scope="col">Ubicacion</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr role="{{$user->role}}">
							<th>{{ $user->id }}</th>
							<td>{{ $user->name }} {{ $user->lastN }}</td>
							<td>{{ $user->alias }}</td>
							<td class="email">{{ $user->email }}</td>
							<td>{{ $user->ubicacion }}</td>
							<td>
								<div class="btn-group btn-group-sm" role="group" aria-label="actions" idi={{ $user->id }}>
									{{-- <button type="button" class="btn btn-outline-dark"><i class="fa fa-eye"></i></button> --}}
									<a href="{{ route('usuarios.show',$user->id) }}" class="btn btn-outline-dark"><i class="fa fa-eye"></i></a>
									<a href="{{ route('usuarios.edit',$user->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-trash"></i></button>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table">
							<tbody>
								<tr>
									<th style="width:20%;" scope="row">ID:</th>
									<td colspan="3" class="mid"></td>
								</tr>
								<tr>
									<th style="width:20%;" scope="row">Nombre:</th>
									<td colspan="3" class="mna"></td>
								</tr>
								<tr>
									<th style="width:20%;" scope="row">Alias:</th>
									<td colspan="3" class="mal"></td>
								</tr>
								<tr>
									<th style="width:20%;" scope="row">Ubicacion:</th>
									<td class="mub"></td>
								</tr>
								<tr>
									<th style="width:20%;" scope="row">Correo:</th>
									<td class="mem"></td>
								</tr>
								<tr class="tri">
									<td colspan="4" class="text-center">
										<img src="" alt="" class="img-fluid">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<form action="" method="post">
							@csrf
							@method('DELETE')
							<input class="btn btn-danger" type="submit" value="Eliminar">
						</form>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		{{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">1.</div>
			<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2.</div>
			<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3.</div>
		</div> --}}
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.email').hide();
			$('#tUsers tbody > tr').each(function() {
				var role = $(this).attr('role');
				if (role != 'customer') {
					$(this).hide();
				}
			});

			$('.nav-link').click(function(e) {
				var name = $(this).attr('name');
				if (name != 'create') {
					e.preventDefault();
					$('#users a').removeClass('active');
					$(this).addClass('active');

					$('#tUsers tbody > tr').each(function() {
						var role = $(this).attr('role');
						if (role == name) {
							$(this).show();
						}else {
							$(this).hide();

						}
					});

					if (name == 'customer') {
						$('.email').hide();
					}else {
						$('.email').show();
					}
				}

				/*microservices*/
				// $.ajax({
				// 	url: '/usuarios/rol/'+name,
				// })
				// .done(function(u) {
				// 	console.log(u);
				// 	console.log("success");
				// 	switch (name) {
				// 		case 'customer':
				//
				// 		break;
				// 		case 'user':
				//
				// 		break;
				// 		case 'seller':
				//
				// 		break;
				// 		case 'admin':
				//
				// 		break;
				// 	}
				// })
				// .fail(function() {
				// 	console.log("error");
				// })
				// .always(function() {
				// 	console.log("complete");
				// });


			});

			$('.fa-trash').parent().click(function(event) {
				$('#delModal .tri').hide();
				var id = $(this).parent().attr('idi');
				$.ajax({
					url: '/usuarios/'+id,
					type: 'GET',
				})
				.done(function(c) {
					$('#delModal .mid').append(c.id);
					$('#delModal .mna').append(c.name+' '+c.lastN);
					$('#delModal .mal').append(c.alias);
					$('#delModal .mub').append(c.ubicacion);
					if (c.email) {
						$('#delModal .mem').append(c.email);
					}
					$('#delModal form').attr('action', '/usuarios/'+c.id);
					console.log(c);
					// console.log("success");
				})
				.fail(function(c) {
					$('#delModal .mid').append('Error');
					$('#delModal .mna').append('Error');
					$('#delModal .mal').append('Error');
					$('#delModal .mub').append('Error');
					console.log(c);
				});
			});
			$('#delModal').on('hidden.bs.modal', function(e) {
				$('#delModal .mid').text('');
				$('#delModal .mna').text('');
				$('#delModal .mal').text('');
				$('#delModal .mub').text('');
				$('#delModal .mem').text('');
			});
		});
	</script>
@endsection
