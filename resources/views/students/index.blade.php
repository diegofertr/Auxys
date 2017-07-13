@extends('adminlte::layouts.app')
@section('htmlheader_title')
Estudiantes{{-- {{ trans('adminlte_lang::message.home') }} --}}
@endsection
@section('contentheader_title')
Lista de Estudiantes
@endsection
@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn bg-navy" data-toggle="modal" data-target="#myModal">
        <i class='glyphicon glyphicon-import '></i>
      </button>
      <a href="{{url('students/create')}}" class="btn bg-olive" role="button"  data-toggle="tooltip" data-placement="top" title="Crear Estudiante">
      <i class="fa fa-plus"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Importar nuevos datos de los estudiantes</h4>
      </div>
      {!!Form::open(['url' => 'importStudents','method'=>'POST', 'files' => true])!!}
      <div class="modal-body">
        <div class="container-fluid spark-screen">
            <div class="row">
            {!!Form::file('file', ['class' => 'form-control-file'])!!}
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {!!Form::submit('Importar', ['class'=>"btn btn-primary"])!!}
      </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>
{{-- End Modal --}}
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

