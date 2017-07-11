@extends('adminlte::layouts.app')
@section('htmlheader_title')
Estudiante
@endsection
@section('contentheader_title')
Estudiante: {{$student->nombre}} {{$student->paterno}} {{$student->materno}} - {{ $student->carnet_identidad }}
@endsection
@section('main-content')
<div class="row">
	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title">SEMESTRE</h3>
	    <div class="box-tools pull-right">
	    	{{-- code --}}
	    	<a href="#{{-- {{url('materias/create')}} --}}" class="btn btn-info circle" role="button"><i class="fa fa-plus"></i> Postular</a>
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
	  		        </table>
	  		    </div>
	  		</div>
	  	
	  </div>
	</div>

</div>
@endsection
@push('styles')
@endpush
@push('scripts')
<script type="text/javascript">
    $(function () {
        var oTable = $('#materias-table').DataTable({
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
            { data: 'nota', name: 'nota'},
            { data: 'observacion', name: 'observacion'},
            ]
        });
    });
</script>
@endpush
