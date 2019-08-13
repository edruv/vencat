@extends('layouts.app2')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<div class="float-left mt-2">
				<h5>Tiendas / Proveedores</h5>
			</div>
			<div class="float-right">
				<a href="{{ route('tienda.create')}}" class=" btn btn-primary"><i class="fa fa-plus"></i>	</a>
			</div>

		</div>
		@if ($tiendas->isEmpty())
			<div class="bg-secondary text-white">
				<h4 class="text-center mt-2">No hay tiendas registradas</h4>
			</div>
		@else
			<table class="card-table table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Id</th>
						<th scope="col" style="width:70%;">Tienda</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tiendas as $tienda)
						<tr>
							<td>{{ $tienda->id }}</td>
							<td>{{ $tienda->name }}</td>
							<td>
								<div class="btn-group btn-group-sm" role="group" aria-label="actions" idi={{ $tienda->id }}>
									{{-- <button type="button" class="btn btn-outline-dark"><i class="fa fa-eye"></i></button> --}}
									<a href="{{ route('tienda.edit',$tienda->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
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
							<h5 class="modal-title" id="exampleModalLabel">Eliminar Tienda?</h5>
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
										<th scope="row">Tienda:</th>
										<td class="mna"></td>
									</tr>
									<tr class="tri">
										<td colspan="2" class="text-center">
											<img src="" alt="" class="img-fluid">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<form action="/tienda/" method="post">
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
<script type="text/javascript">
	$(document).ready(function() {
		$('.fa-eye').parent().click(function(event) {
			var id = $(this).parent().attr('idi');
			$.ajax({
				url: '/tienda/'+id,
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
			$('#delModal .tri').hide();
			var id = $(this).parent().attr('idi');
			$.ajax({
				url: '/tienda/'+id,
				type: 'GET',
			})
			.done(function(t) {
				$('#delModal .mid').append(t.id);
				$('#delModal .mna').append(t.name);
				if (t.image) {
					$('#delModal .tri').show();
					$('#delModal .tri img').attr('src', '/images/stores/'+t.image);
					$('#delModal .tri img').attr('alt', t.image);
				}
				$('#delModal form').attr('action', '/tienda/'+t.id);
				// console.log(t);
				// console.log("success");
			})
			.fail(function(t) {
				$('#delModal .mid').append('Error');
				$('#delModal .mna').append('Error');
				console.log(t);
			});
		});
		$('#delModal').on('hidden.bs.modal', function(e) {
			$('#delModal .mid').text('');
			$('#delModal .mna').text('');
		});

	});
</script>
@endsection
