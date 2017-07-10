@extends('adminlte::layouts.app')
@section('htmlheader_title')
Materias
@endsection
@section('contentheader_title')
Lista de materias
@endsection
@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools pull-right">
        <a href="{{url('materias/create')}}" class="btn btn-info circle" role="button"><i class="fa fa-plus"></i></a>
    </div>
  </div>
  <div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <table id="materias-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sigla</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
  </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.min.css">
<style>
    .circle {
        border-radius: 50px;
    }
    #materias-table thead th{
        background: rgba(12,122,191,.8);
        color:#fff;
    }
    #materias-table tbody tr:hover{
        background: rgba(109,109,109,.3);
    }
</style>
@endpush
@push('scripts')
<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var oTable = $('#materias-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('getMaterias') !!}'
            },
            columns: [
                { data: 'id', name: 'id'},
                { data: 'sigla', name: 'sigla'},
                { data: 'descripcion', name: 'descripcion'},
                { data: 'action', name: 'action'}
            ]
            });

        });
    </script>
@endpush
