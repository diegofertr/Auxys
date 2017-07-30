@extends('adminlte::layouts.app')
@section('htmlheader_title')
Postulantes
@endsection
@section('contentheader_title')
Lista de Postulantes
@endsection
@section('main-content')
<div class="box box-primary">
<div class="box-body">
	@foreach($materias as $materia)
		@if(sizeof($materia->estudiantes_postulados)>0)
		<div class="modal" tabindex="-1">
			<iframe src="{!! route('print_postulants',$materia->id) !!}" id="materia{{ $materia->id }}"></iframe>
		</div>
		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
				<h3 class="box-title">{{ $materia->sigla }} - {{ $materia->descripcion }}</h3>
				<div class="box-tools pull-right" data-toggle="tooltip" data-placement="left" title="Imprimir Lista">
					<a href="" class="btn btn-sm btn-raised btn-success dropdown-toggle enabled" data-toggle="modal" value="Print" onclick="printTrigger('materia{{ $materia->id }}');" >
					&nbsp;<span class="glyphicon glyphicon-print"></span>&nbsp;
				</a>
				</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<table id="materias-table" class="table table-bordered table-striped">
								<thead>
									<tr class="info">
										<th>Ci</th>
										<th>Nombre</th>
										<th>Paterno</th>
										<th>Materno</th>
										<th>ACTA DE CALIFICACION</th>
									</tr>
								</thead>
								<tbody>
									@foreach($materia->estudiantes_postulados as $student)
										<tr>
											<td>{{ $student->carnet_identidad }}</td>
											<td>{{ $student->nombre }}</td>
											<td>{{ $student->paterno }}</td>
											<td>{{ $student->materno }}</td>
											<td><div class="box-tools pull-right" data-toggle="tooltip" data-placement="left" title="Imprimir Acta de Calificación">
					<a href="" class="btn btn-sm btn-raised btn-success dropdown-toggle enabled" data-toggle="modal" value="Print" onclick=print_postulant" >
					&nbsp;<span class="glyphicon glyphicon-print"></span>&nbsp;
				</a>
				</div></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	@endforeach
</div>
@endsection
@push('styles')
@endpush
@push('scripts')
<script type="text/javascript">
	function printTrigger(elementId) {
		var getMyFrame = document.getElementById(elementId);
		getMyFrame.focus();
		getMyFrame.contentWindow.print();
	}
	$(document).ready(function() {
		
	});
</script>
@endpush

