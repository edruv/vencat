@extends('layouts.app2')

@section('content')
<div class="container">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header">
				<div class="float-left mt-2">
					<h5>Ubicaciones</h5>
				</div>
				<div class="float-right">
					<a href="{{ route('ubicaciones.create')}}" class=" btn btn-primary"><i class="fa fa-plus"></i>	</a>
				</div>

			</div>
			@if ($ubicaciones->isEmpty())
				<div class="bg-secondary text-white">
					<h4 class="text-center mt-2">No hay ubicacioness registradas</h4>
				</div>
			@else
				<table class="card-table table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Id</th>
							<th scope="col" style="width:60%;">Ubicacion</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ubicaciones as $ubic)
							<tr>
								<td>{{ $ubic->id }}</td>
								<td>{{ $ubic->name }}</td>
								<td>
									<div class="btn-group btn-group-sm" role="group" aria-label="actions" idi={{ $ubic->id }}>
										{{-- <button type="button" class="btn btn-outline-dark"><i class="fa fa-eye"></i></button> --}}
										<a href="{{ route('ubicaciones.edit',$ubic->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-trash"></i></button>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Eliminar Ubicacion?</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<table class="table">
									<tbody>
										<tr>
											<th scope="row">ID:</th>
											<td class="mid"></td>
										</tr>
										<tr>
											<th scope="row">Ubicacion:</th>
											<td class="mna"></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="modal-footer">
								<form action="/ubicaciones/" method="post">
									@csrf
									@method('DELETE')
									<input class="btn btn-danger" type="submit" value="Eliminar">
								</form>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.fa-eye').parent().click(function(event) {
			var id = $(this).parent().attr('idi');
			$.ajax({
				url: '/ubicaciones/'+id,
				type: 'GET',
			})
			.done(function(x) {

				console.log(x);
				console.log("success");
			})
			.fail(function(x) {
				console.log(x);
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		});

		$('.fa-trash').parent().click(function(event) {
			var id = $(this).parent().attr('idi');
			$.ajax({
				url: '/ubicaciones/'+id,
				type: 'GET',
			})
			.done(function(u) {
				console.log(u);
				$('#delModal .mid').append(u.id);
				$('#delModal .mna').append(u.name);
				$('#delModal form').attr('action', '/ubicaciones/'+u.id);
				// console.log(u);
				// console.log("success");
			})
			.fail(function(u) {
				$('#delModal .mid').append('Error');
				$('#delModal .mna').append('Error');
				console.log(u);
			});
		});
		$('#delModal').on('hidden.bs.modal', function(e) {
			$('#delModal .mid').text('');
			$('#delModal .mna').text('');
		});

	});
</script>
@endsection
