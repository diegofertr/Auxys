@extends('adminlte::layouts.app')
@section('htmlheader_title')
Creando Nueva Convocatoria
@endsection
@section('contentheader_title')
Creando Nueva Convocatoria
@endsection
@section('main-content')
<div class="row">
<div class="col-md-12">
	
{!!Form::open(['url' => 'convocatoria','method'=>'POST'])!!}
<div class="box box-primary box-solid">
    <div class="box-header with-border">
        <h3 class="panel-title">Datos para la convocatoria</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                	<label for="sigla" class="col-md-4 control-label">Sigla</label>
                    <div class="col-md-6">
                        <input class="form-control" required="required" name="sigla" type="text" id="sigla">
                        <span class="help-block">Sigla</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="descripcion" class="col-md-4 control-label">Descripci&oacute;n</label>
                    <div class="col-md-6">
                        <input class="form-control" required="required" name="descripcion" type="text" id="descripcion">
                        <span class="help-block">Descripción</span>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
{!!Form::close()!!}
</div>
</div>
@endsection
@push('styles')
@endpush
@push('scripts')
@endpush
