@extends('adminlte::layouts.app')
@section('htmlheader_title')
Estudiante
@endsection
@section('contentheader_title')
Estudiante: {{$student->nombre}} {{$student->paterno}} {{$student->materno}} - {{ $student->carnet_identidad }}
@endsection
@section('main-content')
<div class="row">
@foreach($semestres as $semestre)
    <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">{{ $semestre->nombre }}</h3>
            <div class="box-tools pull-right">
                {{-- code --}}
                <button type="button" class="btn btn-info circle" data-toggle="modal" data-target="#prerequisiteModal">
              <i class="fa fa-plus"> Postular</i>
            </button>
            </div>
          </div>
          <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="materias-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sigla</th>
                                    <th>Materia</th>
                                    <th>Nota</th>
                                    <th>Observacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->materiasSemestre($semestre->id) as $materia)
                                    <tr>
                                        <td>{{ $materia->sigla }}</td>
                                        <td>{{ $materia->descripcion }}</td>
                                        <td><span class="badge bg-green" style="font-size:1.2em">{{$materia->pivot->nota}}</span></td>
                                        <td>Aprobado {{$materia->pivot->periodo}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            
          </div>
        </div>
    </div>
@endforeach

</div>

<!-- Modal Crear-Pre-requisito -->
<div class="modal fade" id="prerequisiteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {{-- {!! Form::open(['url' => 'prerequisites']) !!} --}}
    {!! Form::open(['method' => 'POST', 'route' => ['cumple_requisito'], 'class' => 'form-horizontal']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
            Postular a Auxiliatura
        </h4>
      </div>
      <div class="modal-body">
        {!! Form::token() !!}
        {!! Form::label('materia', 'Materia', ['']) !!}

        <div class="form-group">
        {!! Form::select('materia', $materias_list, ' ', ['class' => 'col-md-2 combobox form-control','id' => 'prereselect','required' => 'required']) !!}
        </div> 
        {!! Form::hidden('estudiante_id', $student->id) !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">
            Cancelar
        </button>
        {!! Form::submit('Verificar',['class'=>"btn btn-primary"]) !!}
      </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>
{{-- End Modal --}}

@endsection
@push('styles')
@endpush
@push('scripts')
<script type="text/javascript">
    $(function () {
        /*var oTable = $('#materias-table').DataTable({
            "dom": '<"top">t<"bottom"p>',
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('materiaStudent') !!}',
                data: function (d) {
                    d.id = {{ $student->id }};
                }
            },
            columns: [
            { data: 'sigla', name: 'sigla'},
            { data: 'descripcion', name: 'descripcion'},
            { data: 'action', name: 'action'},
            { data: 'observacion', name: 'observacion'}
            ]
        });*/
    });
</script>
@endpush
