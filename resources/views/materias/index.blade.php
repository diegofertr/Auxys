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
        <a href="{{url('materias/create')}}" class="btn bg-navy circle" role="button"><i class="fa fa-plus"></i></a>
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
                        <th>Prerequisitos</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
            {{-- <table id="materias-table" class="footable toggle-circle" data-toggle-column="last">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Sigla</th>
                  <th>Descripción</th>
                  <th>Acción</th>
                  <th data-breakpoints="all" data-title="Prerequisitos: "></th>
                </tr>
              </thead>
            </table> --}}
        </div>
    </div>
  </div>
</div>

<!-- Modal Crear-Pre-requisito -->
<div class="modal fade" id="prerequisiteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {!! Form::open(['method' => 'POST', 'route' => ['add_prerequisite_m'], 'class' => 'form-horizontal']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New </h4>
      </div>
      <div class="modal-body">
        {!! Form::token() !!}
        <div class="form-group">
        {!! Form::label('materia', 'Materias:  ', ['for' => 'id_label_multiple']) !!}
        {!! Form::select('requisites[]', $materias_list, ' ', ['class' => 'col-md-6 js-example-multiple js-states form-control', 'id' => 'id_label_multiple','required' => 'required', 'multiple', 'style'=>'width: 75%' ]) !!}
        </div>
        {!! Form::hidden('materia_id', '', ['id' => 'materia_id']) !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">
            Cancelar
        </button>
        {!! Form::submit('Guardar pre-requisito',['class'=>"btn btn-primary"]) !!}
      </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>
{{-- End Modal --}} 
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
<script src="/js/footable.core.min.js"></script>
<script type="text/javascript">
    $(function () {
      
        // $("#materias-table").footable();

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
            { data: 'prerequisites', name: 'prerequisites'},
            { data: 'action', name: 'action'},
        ]
        });

        $('#prerequisiteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var sigla = button.data('sigla');
            console.log(sigla, id);
            var modal = $(this);
            // modal.find('#sigla').val(sigla)
            modal.find('.modal-title').text('Añadir prerequisitos a ' + sigla)
            modal.find('#materia_id').val(id)
        });

        $(".js-example-multiple").select2({
            minimumInputLength: 2,
        });
    });
</script>
@endpush
