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
				<form action="#" method="POST" class="form-horizontal">	
					{{-- {!! Form::open(['method'=>'POST','route'=>'check_student','class'=>"form-horizontal"])!!} --}}
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
					{{-- {!! Form::close()!!} --}}
				</form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="box" id="results" >
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
<!-- Modal postulate -->
<div class="modal fade" id="postulateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Verificar Requisitos</h4>
      </div>
      {!! Form::open(['method'=>'POST','route'=>'postulate','id'=>'postulateForm']) !!}
      <div class="modal-body">
        ...
        ...
        ...
        <input type="hidden" name="student_id_postulate" id='student_id_postulate'>
        <input type="hidden" name="materia_id_postulate" id='materia_id_postulate'>
      </div>
      <div class="modal-footer" style="text-align: center">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
      </div>
      {!! Form::close() !!}
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
		$('#check_button').on('click',function (event) {
			event.preventDefault();
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
					var button=$('<button>').attr('data-toggle', 'modal').attr('data-target', '#postulateModal').text('Pre Inscribir').addClass("btn btn-default postulateButton").attr('data-materia-id-postulate', val.materia_id).attr('data-student-id-postulate', val.student_id);
					if (val.status == 'danger') {
						button.attr('disabled', 'disabled');
					}
					td = $('<td>').append(button);
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
		});
		//for postulate student
		var postulate_button;
		$(document).on('click','.postulateButton',function () {
			$('#student_id_postulate').val($(this).data('student-id-postulate'));
			$('#materia_id_postulate').val($(this).data('materia-id-postulate'));
			postulate_button = $(this);
		})
		$('#postulateForm').submit(function(event) {
			event.preventDefault();
			$.ajax({
				type: $(this).attr('method'),
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function() {
					$('#postulateModal').modal('hide');
					postulate_button.parent().parent().remove();
				},
				error:function () {
					alert('error');
				}
			});
		});
	});	
</script>
@endpush