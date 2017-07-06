@extends('adminlte::layouts.app')
@section('htmlheader_title')
Estudiantes{{-- {{ trans('adminlte_lang::message.home') }} --}}
@endsection
@section('contentheader_title')
Lista de Estudiantes
@endsection
@section('main-content')
    <div class="container-fluid spark-screen">
    <div class="row">
    </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-12">
                        <table id="students-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ci</th>
                                    <th>Nombre</th>
                                    <th>Ap. Paterno</th>
                                    <th>Ap. Materno</th>
                                    {{-- <th>Action</th> --}}
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
            $('#students-table').DataTable({
                serverSide: true,
                processing: true,
                ajax: '/getStudents'
            });
        });
    </script>
@endpush
