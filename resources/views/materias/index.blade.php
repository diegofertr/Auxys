@extends('adminlte::layouts.app')
@section('htmlheader_title')
Materias
@endsection
@section('contentheader_title')
Lista de materias
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
    <a href="{{url('materias/create')}}" class="btn btn-success" role="button"><i class="fa fa-plus"></i></a>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <table id="materias-table" class="table table-bordered">
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
    </div>
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var oTable = $('#materias-table').DataTable({
            "dom": '<"top">t<"bottom"p>',
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
