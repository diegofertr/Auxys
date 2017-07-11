@extends('adminlte::layouts.app')
@section('htmlheader_title')
Materia
@endsection
@section('contentheader_title')
Materia
@endsection
@section('main-content')
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h2 class="box-title"><b>{{ $materia->sigla }}</b></h2>
            <div class="box-tools pull-right"></div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <h4>{{ $materia->descripcion }}</h4>
          </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Pre-requisítos</h3>
            <div class="box-tools pull-right">
            
              <button type="button" class="btn btn-info circle" data-toggle="modal" data-target="#prerequisiteModal">
                <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="prerequisitos-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>Sigla</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
          </div>
        </div>        
    </div>
</div>

<!-- Modal Crear-Pre-requisito -->
<div class="modal fade" id="prerequisiteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {{-- {!! Form::open(['url' => 'prerequisites']) !!} --}}
    {!! Form::open(['method' => 'POST', 'route' => ['add_prerequisite_m'], 'class' => 'form-horizontal']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
            Añadir pre-requisitos a {{ $materia->sigla }}
        </h4>
      </div>
      <div class="modal-body">
        {!! Form::token() !!}
        {!! Form::label('materia', 'Materias', ['']) !!}

        <div class="form-group">
        {!! Form::select('requisites[]', $materias_list, ' ', ['class' => 'col-md-2 combobox form-control selectpicker','id' => 'prereselect','required' => 'required', 'multiple']) !!}
        </div> 
        {!! Form::hidden('materia_id', $materia->id) !!}
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

@endsection
@push('styles')
<style>
    .circle {
        border-radius: 50%;
    }
    #prerequisitos-table thead th{
        background: rgba(12,122,191,.8);
        color:#fff;
    }
    #prerequisitos-table tbody tr:hover{
        background: rgba(109,109,109,.3);
    }
</style>
@endpush
@push('scripts')
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
            { data: 'materia_req_sigla', name: 'materia_req_sigla'},
            { data: 'materia_req_desc', name: 'materia_req_desc'},
            // { data: 'action', name: 'action'}
            ]
        });
    });
</script>
@endpush
