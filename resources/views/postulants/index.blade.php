@extends('adminlte::layouts.app')
@section('htmlheader_title')
Postulantes
@endsection
@section('contentheader_title')
Lista de Postulantes
@endsection
@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
          Tooltip on top
        </button>
    </div>
  </div>
</div>

@endsection
@push('styles')
@endpush
@push('scripts')
@endpush

