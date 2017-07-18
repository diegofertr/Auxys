@extends('adminlte::layouts.app')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection
@section('contentheader_title')
Inscribiendo Estudiante
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="css/select2.min.css">
<link rel="stylesheet" type="text/css" href="/css/footable.bootstrap.min.css">
<style type="text/css">
		
	.footable.breakpoint > tbody > tr:hover:not(.footable-row-detail) {
	  cursor: pointer;
	}
	tr{
		border-bottom: 2px solid rgba(60, 60, 60,.5)
	}
	.footable.breakpoint.toggle-arrow-tiny > tbody > tr.footable-detail-show > td > span.footable-toggle:before {
  content: "\e01f";
}
.footable.breakpoint.toggle-arrow-tiny > tbody > tr > td > span.footable-toggle:before {
  content: "\e080";
}
</style>
@endpush
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<!-- Default box -->
				<div class="box">
					{!! Form::open(['method'=>'POST','route'=>'check_student','class'=>"form-horizontal"])!!}
					<div class="box-header with-border">
						<h3 class="box-title">Inscribir Alumno</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
						    {!! Form::label('cedula_identidad', 'Ci: ', ['class' => 'col-md-4 control-label']) !!}
						    <div class="col-md-6">
						        {!! Form::text('cedula_identidad', null, ['class'=> 'form-control', 'required' => 'required', 'placeholder'=>'123456']) !!}
						        <span class="help-block">Cedula de Identidad</span>
						    </div>
						</div>
						<div class="form-group">
						    {!! Form::label('materias', 'Materias: ', ['class' => 'col-md-4 control-label']) !!}
						    <div class="col-md-6">
						        {!! Form::select('materias', [null]	, null, ['class'=> 'form-control', 'required' => 'required', 'multiple','name'=>'materias[]']) !!}
						        <span class="help-block">Materias a postular</span>
						    </div>
						</div>
					</div>
					<div class="box-footer" style="text-align: center;">
					    <button type="button" id='check_button' class="btn btn-success ">Verificar</button>
					</div>
					{!! Form::close()!!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="box" id="results" >
				{!! Form::open(['method'=>'POST','route'=>'check_student','class'=>"form-horizontal"])!!}
				<div class="box-header with-border">
					<h3 class="box-title" id='results-title'></h3>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-condensed toggle-arrow-tiny" id="results-student-table" data-toggle-column="first">
						<thead>
							<tr>
								<th>#</th>
								<th>Estado</th>
								<th>Sigla</th>
								<th>Descripcion</th>
								<th>Opciones</th>
								<th data-breakpoints="all" data-title="Aprobo Materia:"></th>
								<th data-breakpoints="all" data-title="Pre-requisitos:"></th>
								<th data-breakpoints="all" data-title="Semestre:"></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
<script src="/js/select2.full.min.js"></script>
<script src="/js/footable.core.min.js"></script>
<script>
	$(document).ready(function() {
		$('.table').footable();
		//$('#results').hide();
		$('select').select2({
			placeholder: 'Escriba las siglas de las materias',
            minimumInputLength: 2,
            ajax: {
                url: '/get_list_materias',
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
		});
		//for check student
		$('#check_button').on('click',function () {
			$.ajax({
				url: '/check_student',
				type: 'GET',
				data: {
					cedula_identidad : $('#cedula_identidad').val(),
					materias : $('#materias').val()
				},
			})
			.done(function(data) {
				//$('#results').show('fast');
				var table=$('#results-student-table').find('tbody');
				table.html(null);
				var i=1;
				$.each(data, function(index, val) {
					var tr = $('<tr>').addClass(val.status);
					var td = $('<td>').append(i++);
					tr.append(td);
					td = $('<td>').append($('<span>').addClass('fa fa-'+val.icon)).css('color',val.color);
					tr.append(td);
					td = $('<td>').append(val.sigla);
					tr.append(td);
					td = $('<td>').append(val.descripcion);
					tr.append(td);
					td = $('<td>').append('opciones');
					tr.append(td);
					td = $('<td>').append($('<span>').addClass('fa fa-'+val.materia_icon)).css('color',val.materia_color);
					tr.append(td);
					td = $('<td>').append($('<span>').addClass('fa fa-'+val.prerequisitos_icon)).css('color',val.prerequisitos_color);
					tr.append(td);
					td = $('<td>').append($('<span>').addClass('fa fa-'+val.semestre_icon)).css('color',val.semestre_color);
					tr.append(td);
					table.append(tr);
				});
				$('.table').footable();
			});
			$.ajax({
				url: '/get_student_info',
				type: 'GET',
				data: {cedula_identidad: $('#cedula_identidad').val()},
			})
			.done(function(data) {
				$('#results-title').html(null);
				console.log(data);
				$('#results-title').append('Resultados de: '+data.paterno+' '+data.materno+' '+data.nombre+' - '+data.carnet_identidad);
			});
			
			/*$('#results-student-table').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                	url:'/check_student',
		            data:function (d) {	
		            	d.cedula_identidad = $('#cedula_identidad').val(),
		            	d.materias = $('#materias').val()
		            }
                },
                
                columns: [
                    {data: 'status'},
                    {data: 'materia_id'},
                    {data: 'sigla'},
                    {data: 'descripcion'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });*/
		});
	});	
</script>
@endpush