@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">


				     <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover" id="economic_complements-table">
                                <thead>
                                    <tr class="success">
                                        <th class="text-center"><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Número de Trámite">Número</div></th>
                                        <th class="text-left"><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Concepto de Cobro">Número de Carnet</div></th>
                                        <th class="text-left"><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Nombre de Afiliado">Nombre de Beneficiario</div></th>
                                        <th class="text-left"><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Total a Pagar">Fecha Emisión</div></th>
                                        <th clas
                                        s="text-left"><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Estado">Estado</div></th>
                                        <th class="text-left"><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Fecha de Pago">Modalidad</div></th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Convocatoria</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						Esta es la pagina de convocatoria!!!!!!!!!!!!!!!!
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
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
