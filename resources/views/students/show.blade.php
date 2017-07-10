@extends('adminlte::layouts.app')
@section('htmlheader_title')
{{$student->nombre}} {{$student->paterno}} {{$student->materno}}
@endsection
@section('contentheader_title')
Estudiante: {{$student->nombre}} {{$student->paterno}} {{$student->materno}} - {{ $student->carnet_identidad }}
@endsection
@section('main-content')
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary direct-chat direct-chat-primary">
			<div class="box-header with-border">
				<h3 class="box-title">SEMESTRE</h3>
				<div class="box-tools pull-right">
					<span data-toggle="tooltip" title="{{ count($materias) }} Materias Aprobadas" class="badge bg-light-blue">{{ count($materias) }}</span>
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<div class="direct-chat-messages">
					<table class="table table-responsive table-bordered">
						<thead>
							<th style="width: 100px">Sigla</th>
							<th>Materia</th>
							<th style="width: 100px">Nota</th>
							<th>Observacion</th>
						</thead>
						<tbody>
						@foreach($materias as $materia)
						<tr>
							<td>{{ $materia->sigla }}</td>
							<td>{{ $materia->descripcion }}</td>							
							@if($materia->pivot->nota >= 51)
							<td><span class="badge bg-green" style="font-size:1.2em">{{ $materia->pivot->nota }}</span></td>
							<td>Aprobado {{ $materia->pivot->periodo }} </td>
							@endif
						</tr>
						@endforeach	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-primary direct-chat direct-chat-primary">
			<div class="box-header with-border">
				<h3 class="box-title">SEMESTRE</h3>
				<div class="box-tools pull-right">
					<span data-toggle="tooltip" title="{{ count($materias) }} Materias Aprobadas" class="badge bg-light-blue">{{ count($materias) }}</span>
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<div class="direct-chat-messages">
					<table class="table table-responsive table-bordered">
						<thead>
							<th style="width: 100px">Sigla</th>
							<th>Materia</th>
							<th style="width: 100px">Nota</th>
							<th>Observacion</th>
						</thead>
						<tbody>
						@foreach($materias as $materia)
						<tr>
							<td>{{ $materia->sigla }}</td>
							<td>{{ $materia->descripcion }}</td>							
							@if($materia->pivot->nota >= 51)
							<td><span class="badge bg-green" style="font-size:1.2em">{{ $materia->pivot->nota }}</span></td>
							<td>Aprobado</td>
							@endif
						</tr>
						@endforeach	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('styles')
@endpush
@push('scripts')
@endpush
