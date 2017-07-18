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
  <div class="box-body">
      @foreach($materias as $materia)
          @if(sizeof($materia->estudiantes_postulados)>0)
          <div class="col-md-6">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ $materia->sigla }} - {{ $materia->descripcion }}</h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-info circle" data-toggle="modal" data-target="#prerequisiteModal">
                    <i class="fa fa-plus"> Postular</i>
                  </button>
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
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($materia->estudiantes_postulados as $student)
                                          <tr>
                                              <td>{{ $student->carnet_identidad }}</td>
                                              <td>{{ $student->nombre }}</td>
                                              <td>{{ $student->paterno }}</td>
                                              <td>{{ $student->materno }}</td>
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
</div>

@endsection
@push('styles')
@endpush
@push('scripts')
@endpush

