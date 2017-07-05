@extends('adminlte::layouts.app')
@section('htmlheader_title')
Importacion
@endsection
@section('contentheader_title')
Importar Nuevos Datos de los Estudiantes
@endsection
@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
        {!!Form::open(['url' => 'importStudents','method'=>'POST', 'files' => true])!!}
        {!!Form::file('file', $attributes = [])!!}
        {!!Form::submit('go')!!}
        {!!Form::close()!!}
        </div>
    </div>
@endsection
@push('styles')
@endpush
@push('scripts')
@endpush
