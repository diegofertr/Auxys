@extends('adminlte::layouts.app')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection
@section('contentheader_title')
Inscribiendo Estudiante
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<!-- Default box -->
				<div class="box">
					{!! Form::open(['method'=>'POST','','class'=>"form-horizontal"])!!}
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
						        {!! Form::select('materias', [null]	, null, ['class'=> 'form-control', 'required' => 'required', 'multiple']) !!}
						        <span class="help-block">Materias a postular</span>
						    </div>
						</div>
					</div>
					<div class="box-footer" style="text-align: center;">
					    <button type="submit" class="btn btn-success ">Verificar</button>
					</div>
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="css/select2.min.css">
@endpush
@push('scripts')
<script src="/js/select2.full.min.js"></script>
<script>
	$(document).ready(function() {
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
	});	
</script>
@endpush