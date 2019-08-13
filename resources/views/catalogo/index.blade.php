@extends('layouts.app2')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<div class="float-left mt-2">
				<h5>Catalogos</h5>
			</div>
			<div class="float-right">
				<a href="{{ route('catalogos.create')}}" class=" btn btn-primary"><i class="fa fa-plus"></i>	</a>
			</div>

		</div>
		@if ($catalogos->isEmpty())
			<div class="bg-secondary text-white">
				<h4 class="text-center mt-2">No hay catalogos registradas</h4>
			</div>
		@else
			<table class="table card-table table-responsive-sm">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="">Tienda</th>
						<th scope="col" style="">Catalogo</th>
						<th scope="col" style="">Temporada</th>
						<th scope="col" style="">Año</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($catalogos as $catalogo)
						<tr>
							<td>{{ $catalogo->tienda }}</td>
							<td>{{ $catalogo->nombre }}</td>
							<td>{{ $catalogo->temporada }}</td>
							<td>{{ $catalogo->year }}</td>
							<td>
								<div class="btn-group btn-group-sm" role="group" aria-label="actions" idi={{ $catalogo->id }}>
									{{-- <button type="button" class="btn btn-outline-dark"><i class="fa fa-eye"></i></button> --}}
									<a href="{{ route('catalogos.edit',$catalogo->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
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
							<h5 class="modal-title" id="exampleModalLabel">Eliminar Catalogo?</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<table class="table">
								<tbody>
									<tr>
										<th style="width:20%;" scope="row">Catalogo:</th>
										<td colspan="3" class="mna"></td>
									</tr>
									<tr>
										<th style="width:20%;" scope="row">Temporada:</th>
										<td colspan="3" class="mtm"></td>
									</tr>
									<tr>
										<th style="width:20%;" scope="row">Tienda:</th>
										<td class="mst"></td>
										<th style="width:20%;" scope="row">Año:</th>
										<td class="mye"></td>
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
							<form action="/catalogos/" method="post">
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
		$('.fa-trash').parent().click(function(event) {
			$('#delModal .tri').hide();
			var id = $(this).parent().attr('idi');
			$.ajax({
				url: '/catalogos/'+id,
				type: 'GET',
			})
			.done(function(c) {
				$('#delModal .mna').append(c.nombre);
				$('#delModal .mtm').append(c.temporada);
				$('#delModal .mst').append(c.tienda);
				$('#delModal .mye').append(c.year);
				if (c.portada) {
					$('#delModal .tri').show();
					$('#delModal .tri img').attr('src', '/images/catalogos/'+c.portada);
					$('#delModal .tri img').attr('alt', c.portada);
				}
				$('#delModal form').attr('action', '/catalogos/'+c.id);
				// console.log(t);
				// console.log("success");
			})
			.fail(function(c) {
				$('#delModal .mna').append('Error');
				$('#delModal .mtm').append('Error');
				$('#delModal .mst').append('Error');
				$('#delModal .mye').append('Error');
				console.log(c);
			});
		});
		$('#delModal').on('hidden.bs.modal', function(e) {
			$('#delModal .mna').text('');
			$('#delModal .mtm').text('');
			$('#delModal .mst').text('');
			$('#delModal .mye').text('');
		});

	});
</script>
@endsection
