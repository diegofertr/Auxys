@extends('adminlte::layouts.app')
@section('htmlheader_title')
@endsection
@section('contentheader_title')

@endsection
@section('main-content')
<div class="row">
    <div class="col-md-4 caja">
        <h2>
            Materia: <b>{{ $materia->sigla }}</b>
        </h2>
        <p>
            {{ $materia->descripcion }}
        </p>
    </div>
    <div class="col-md-7 caja">
        <h3>Prerequisitos {{ $materia->sigla }}</h3>
        <a href="{{url('materias/create')}}" class="btn btn-success" role="button"><i class="fa fa-plus"></i></a>
        
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <table id="prerequisitos-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Materia_ID</th>
                                    <th>Requisito_ID</th>
                                    {{-- <th>Acción</th> --}}
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.min.css">
<style>
    .caja{
        margin-left:3px;
        margin-right:3px;
        border: 1px solid black;
        border-radius: 10px;
    }
</style>
@endpush
@push('scripts')
<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function () {
        var oTable = $('#prerequisitos-table').DataTable({
            "dom": '<"top">t<"bottom"p>',
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('materiaPrerequisitos') !!}',
                data: function (d) {
                    d.id = {{ $materia->id }};
                }
            },
            columns: [
            { data: 'materia_id', name: 'materia_id'},
            { data: 'materia_req_id', name: 'materia_req_id'},
            // { data: 'action', name: 'action'}
            ]
        });

    });
</script>
@endpush
