@extends('adminlte::layouts.app')
@section('htmlheader_title')
Estudiante
@endsection
@section('contentheader_title')
Estudiante: {{$estudiante->nombre}} {{$estudiante->paterno}} {{$estudiante->materno}} - {{ $estudiante->carnet_identidad }}
@endsection
@section('main-content')
	<div class="info-box">
	<a href="/student/{{ $estudiante->id }}">
	  <span class="info-box-icon bg-green">
	  		<i class="fa fa-arrow-left"></i>
	  </span></a>
  <div class="info-box-content">
    <span class="info-box-text">{{$estudiante->nombre}} {{$estudiante->paterno}} {{$estudiante->materno}}</span>
    <span class="info-box-number">Cumple!!!</span>
  </div>
</div>
@endsection
@push('styles')
@endpush
@push('scripts')
@endpush
