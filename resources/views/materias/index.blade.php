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

{{-- Modal Editar-Prerequisito --}}
<div class="modal fade" id="editprerequisiteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Prerequisitos</h4>
      </div>
      <div class="modal-body">
        <div class="row"> 
            <div class="col-md-12"> 
                <table id="editprerequisitos-table" class="table table-bordered"> 
                    <thead> 
                        <tr> 
                            <th>Materia</th> 
                            <th>Sigla</th> 
                            <th>Acción</th> 
                        </tr> 
                    </thead> 
                </table> 
            </div> 
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">
            Cancelar
        </button>
        <button type="button" class="btn btn-success" data-dismiss="modal">
            Guardar
        </button>
      </div>
    </div>
  </div>
</div>
{{-- End Modal --}} 

{{-- Modal Editar Materia --}}
<div class="modal fade" id="editmateriaModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Editar Materia</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'materias', 'method'=>'PUT','class'=>'form-horizontal']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('sigla', 'Sigla', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('sigla', null, ['class'=> 'form-control', 'required' => 'required', 'id' =>'sigla']) !!}
                                <span class="help-block">Sigla</span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('descripcion', 'Descripción', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('descripcion', null, ['class'=> 'form-control', 'required' => 'required', 'id' =>'descripcion']) !!}
                                <span class="help-block">Descripción</span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('semester_id', 'Semestre ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('semester_id', $semestres, ' ', ['class'=> 'form-control', 'required' => 'required', 'id' =>'semestre']) !!}
                                
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-raised btn-success" data-toggle="tooltip" data-placement="bottom" data-original-title="Guardar">&nbsp;<i class="glyphicon glyphicon-floppy-disk"></i>&nbsp;</button>
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

        $('#editmateriaModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var sigla = button.data('sigla');
            var descripcion = button.data('descripcion');
            var semestre_id = button.data('semestre_id');
            var modal = $(this);
            // modal.find('#sigla').val(sigla)
            modal.find('.modal-title').text('Editar Materia ' + sigla)
            modal.find('#sigla').val(sigla)
            modal.find('#descripcion').val(descripcion)
            modal.find('#semestre').val(semestre_id)

        });

        $(".js-example-multiple").select2({
            minimumInputLength: 2,
        });

        $('#editprerequisiteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            let id_materia = button.data('id');

            var editPrerequisitoTable = $('#editprerequisitos-table').DataTable({ 
                "dom": '<"top">t<"bottom"p>', 
                processing: true, 
                serverSide: true, 
                ajax: { 
                    url: '{!! route('materiaPrerequisitos') !!}', 
                    data: function (d) { 
                        d.id = id_materia;
                    } 
                }, 
                columns: [ 
                { data: 'materia_req_sigla', name: 'materia_req_sigla'}, 
                { data: 'materia_req_desc', name: 'materia_req_desc'}, 
                { data: 'action', name: 'action'} 
                ] 
            }); 
        });


    });
</script>
@endpush
