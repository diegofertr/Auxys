@extends('adminlte::layouts.app')
@section('htmlheader_title')
Convocatoria
@endsection
@section('contentheader_title')
Convocatoria
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Convocatoria</h3>
						<div class="box-tools pull-right">
              <button type="button" class="btn btn-info circle" data-toggle="modal" data-target="#prerequisiteModal">
                <i class="fa fa-plus"></i>
              </button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						Esta es la pagina de convocatoria!!!!!!!!!!!!!!!!
            <a href="{{route('convocatoria.create')}}" role="button" class="btn btn-info">Crear Convocatoria</a>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>

<!-- Modal Crear-Pre-requisito -->
<div class="modal fade" id="prerequisiteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {!! Form::open(['url' => 'requisito_c']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
            Crear pre-requisitos de convocatoria
        </h4>
      </div>
      <div class="modal-body">
        {!! Form::token() !!}
        <div class="form-group">
          {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
          {!! Form::text('nombre', null, ['class'=> 'form-control', 'required' => 'required']) !!}
            
        </div>
        <div class="form-group">
          {!! Form::label('descripcion', 'Descripcion', ['class' => 'control-label']) !!}
          {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => 3, 'required' => 'required']) !!}
        </div>
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
@push('scripts')
	
	<script type="text/javascript">

			console.log($('#economic_complements-table').html;

		    var oTable = $('#economic_complements-table').DataTable({
            "dom": '<"top">t<"bottom"p>',
            processing: true,
            serverSide: true,
            pageLength: 8,
            autoWidth: false,
            ajax: {
                url: '{!! route('get_convocatoria') !!}',
           /*     data: function (d) {
                    d.code = $('input[name=code]').val();
                    d.affiliate_identitycard = $('input[name=affiliate_identitycard]').val();
                    d.creation_date = $('input[name=creation_date]').val();
                    d.eco_com_state_id = $('input[name=eco_com_state_id]').val();
                    d.eco_com_modality_id = $('select[name=eco_com_modality_id]').val();
                    d.post = $('input[name=post]').val();
                }*/
            },
            columns: [
                { data: 'gestion', sClass: "text-center" }
                /*{ data: 'affiliate_identitycard', bSortable: false },
                { data: 'affiliate_name', bSortable: false },
                { data: 'created_at', bSortable: false },
                { data: 'eco_com_state', bSortable: false },
                { data: 'eco_com_modality', bSortable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false, bSortable: false, sClass: "text-center" }*/
            ]
        });
	</script>
@endpush
