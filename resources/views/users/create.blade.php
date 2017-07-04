@extends('adminlte::layouts.app')
@section('htmlheader_title')
Usuarios{{-- {{ trans('adminlte_lang::message.home') }} --}}
@endsection
@section('contentheader_title')
Lista de usuarios
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    {!! Form::open(['url' => 'users', 'method'=>'POST','class'=>'form-horizontal']) !!}
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="panel-title">Datos del nuevo Usuario</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('name', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('name', null, ['class'=> 'form-control', 'required' => 'required']) !!}
                                    <span class="help-block">Nombre Completo</span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('username', 'Usuario', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('username', null, ['class'=> 'form-control', 'required' => 'required']) !!}
                                    <span class="help-block">Nombre de Usuario</span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', 'Contraseña', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
                                    <span class="help-block">Ingrese la Contraseña</span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('confirm_password', 'Repetir Contraseña', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required']) !!}
                                    <span class="help-block">Ingrese de nuevo la Contraseña</span>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
<div class="row text-center">
    <div class="form-group">
        <div class="col-md-12">
            <a href="{!! url('users') !!}" class="btn btn-raised btn-warning" data-toggle="tooltip" data-placement="bottom" data-original-title="Cancelar">&nbsp;<i class="glyphicon glyphicon-remove"></i>&nbsp;</a>
            &nbsp;&nbsp; <button type="submit" class="btn btn-raised btn-success" data-toggle="tooltip" data-placement="bottom" data-original-title="Guardar">&nbsp;<i class="glyphicon glyphicon-floppy-disk"></i>&nbsp;</button>
        </div>
    </div>
</div>
{!! Form::close() !!}
</div>
@endsection
@push('styles')
@endpush
@push('scripts')
@endpush
