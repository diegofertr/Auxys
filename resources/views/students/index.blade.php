@extends('adminlte::layouts.app')
@section('htmlheader_title')
Estudiantes{{-- {{ trans('adminlte_lang::message.home') }} --}}
@endsection
@section('contentheader_title')
Lista de Estudiantes
@endsection
@section('main-content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools pull-right">
      <a href="{{url('students/create')}}" class="btn btn-success" role="button">
      <i class="fa fa-plus"></i></a>
      <a href="{{url('student/import')}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Importar Estudiantes"><i class='glyphicon glyphicon-import '></i></a>
    </div>
  </div>
  <div class="box-body">
      <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="table-responsive">
            <table id="students-table" class="table  table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Ci</th>
                <th>Nombre</th>
                <th>Ap. Paterno</th>
                <th>Ap. Materno</th>
                <th>Opciones</th>
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
@push('styles')
<link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.min.css">
<style type="text/css">
    #students-table thead th{
        background: rgba(12,122,191,.8);
        color:#fff;
    }
    #students-table tbody tr:hover{
        background: rgba(109,109,109,.3);
    }
</style>
@endpush
@push('scripts')
<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#students-table').DataTable({
                serverSide: true,
                processing: true,
                ajax: '/getStudents',
                columns: [
                    {data: 'carnet_identidad'},
                    {data: 'nombre'},
                    {data: 'paterno'},
                    {data: 'materno'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush

