@extends('adminlte::layouts.app')
@section('htmlheader_title')
Usuarios{{-- {{ trans('adminlte_lang::message.home') }} --}}
@endsection
@section('contentheader_title')
Lista de usuarios
@endsection
@section('main-content')
    <div class="container-fluid spark-screen">
    <div class="row">
    <a href="{{url('users/create')}}" class="btn btn-success" role="button"><i class="fa fa-plus"></i></a>
    </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-12">
                        <table id="users-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>userName</th>
                                    <th>Email</th>
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
            $('#users-table').DataTable({
                serverSide: true,
                processing: true,
                ajax: '/getUsers'
            });
        });
    </script>
@endpush
