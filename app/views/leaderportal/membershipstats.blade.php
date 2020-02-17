@extends('layout.leadersportalmaster')

@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i><a href="{{{ URL::action('LeadersPortalDashboardController@getIndex') }}}">Home</a>
			</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Membership <small><i class="ace-icon fa fa-angle-double-right"></i> Statistic</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Membership Statistic (By RHQ)</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="fullscreen" class="orange2">
									<i class="ace-icon fa fa-expand"></i>
								</a>
								<a href="#" data-action="reload">
									<i class="fa fa-refresh"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<table id="tdefault" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>RHQ</th>
											<th>MD</th>
											<th>WD</th>
											<th>YM</th>
											<th>YW</th>
											<th>PDYM</th>
											<th>PDYW</th>
											<th>YCYM</th>
											<th>YCYW</th>
											<th>Unknown</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot id="tdefaultfoot">
										<tr>
											<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								<div class="col-xs-12">
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Membership Statistic By RHQ Listing -->
				@if ($gakkaishq == 't' or $gakkairegion == 't')
					<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">By RHQ By Position Stats</h5>
								<div class="widget-toolbar">
									<a href="#" data-action="fullscreen" class="orange2">
										<i class="ace-icon fa fa-expand"></i>
									</a>
									<a href="#" data-action="reload">
										<i class="fa fa-refresh"></i>
									</a>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<table id="trhq" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>RHQ</th>
												<th>Position</th>
												<th>MD</th>
												<th>WD</th>
												<th>YM</th>
												<th>YW</th>
												<th>PDYM</th>
												<th>PDYW</th>
												<th>YCYM</th>
												<th>YCYW</th>
												<th>Unknown</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="trhqfoot">
											<tr>
												<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
											</tr>
										</tfoot>
									</table>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
									</div>
								</div>
							</div>
						</div>
					</div> <!-- Membership Statistic By RHQ By Position Listing -->
				@endif
				@if ($gakkaishq == 't' or $gakkairegion == 't' or $gakkaizone == 't')
					<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">By Zone Position Stats</h5>
								<div class="widget-toolbar">
									<a href="#" data-action="fullscreen" class="orange2">
										<i class="ace-icon fa fa-expand"></i>
									</a>
									<a href="#" data-action="reload">
										<i class="fa fa-refresh"></i>
									</a>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<table id="tzoneposition" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>RHQ</th>
												<th>Zone</th>
												<th>Position</th>
												<th>MD</th>
												<th>WD</th>
												<th>YM</th>
												<th>YW</th>
												<th>PDYM</th>
												<th>PDYW</th>
												<th>YCYM</th>
												<th>YCYW</th>
												<th>Unknown</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tzonepositionfoot">
											<tr>
												<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
											</tr>
										</tfoot>
									</table>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
									</div>
								</div>
							</div>
						</div>
					</div> <!-- Membership Statistic By Position by RHQ By Zone Level Listing -->
				@endif
				@if ($gakkaishq == 't' or $gakkairegion == 't' or $gakkaizone == 't' or $gakkaichapter == 't')
					<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">By Chapter Position Stats</h5>
								<div class="widget-toolbar">
									<a href="#" data-action="fullscreen" class="orange2">
										<i class="ace-icon fa fa-expand"></i>
									</a>
									<a href="#" data-action="reload">
										<i class="fa fa-refresh"></i>
									</a>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<table id="tchapterposition" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>RHQ</th>
												<th>Zone</th>
												<th>Chapter</th>
												<th>Position</th>
												<th>MD</th>
												<th>WD</th>
												<th>YM</th>
												<th>YW</th>
												<th>PDYM</th>
												<th>PDYW</th>
												<th>YCYM</th>
												<th>YCYW</th>
												<th>Unknown</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tchapterpositionfoot">
											<tr>
												<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
											</tr>
										</tfoot>
									</table>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
									</div>
								</div>
							</div>
						</div>
					</div> <!-- Membership Statistic By Position by RHQ By Zone By Chapter Level Listing -->
				@endif
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">By District Position Stats</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="fullscreen" class="orange2">
									<i class="ace-icon fa fa-expand"></i>
								</a>
								<a href="#" data-action="reload">
									<i class="fa fa-refresh"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<table id="tdistrictposition" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chapter</th>
											<th>District</th>
											<th>Position</th>
											<th>MD</th>
											<th>WD</th>
											<th>YM</th>
											<th>YW</th>
											<th>PDYM</th>
											<th>PDYW</th>
											<th>YCYM</th>
											<th>YCYW</th>
											<th>Unknown</th>
											<th>Total</th>
											<th>Description</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot id="tdistrictpositionfoot">
										<tr>
											<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								<div class="col-xs-12">
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Membership Statistic By Position by RHQ By Zone By Chapter By District Level Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">By Age Group By Position Stats</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="fullscreen" class="orange2">
									<i class="ace-icon fa fa-expand"></i>
								</a>
								<a href="#" data-action="reload">
									<i class="fa fa-refresh"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<table id="tpositionagegroup" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chapter</th>
											<th>District</th>
											<th>Position</th>
											<th>Age Group</th>
											<th>MD</th>
											<th>WD</th>
											<th>YM</th>
											<th>YW</th>
											<th>PDYM</th>
											<th>PDYW</th>
											<th>YCYM</th>
											<th>YCYW</th>
											<th>Unknown</th>
											<th>Total</th>
											<th>Description</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot id="tpositionagegroupfoot">
										<tr>
											<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								<div class="col-xs-12">
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Membership Statistic By Position By AgeGroup By District Level Listing -->
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/additional-methods.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>
	<script type="text/javascript">	
		$(document).ready(function () {
			$.mask.definitions['~']='[+-]';
			$('.input-mask-date').mask('99-99-9999');

			$(function() {
				jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
				    return this.flatten().reduce( function ( a, b ) {
				        if ( typeof a === 'string' ) {
				            a = a.replace(/[^\d.-]/g, '') * 1;
				        }
				        if ( typeof b === 'string' ) {
				            b = b.replace(/[^\d.-]/g, '') * 1;
				        }
				        return a + b;
				    }, 0 );
				});

				var oTable = $('#tdefault').DataTable({
			        dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 10, // Default No of Records per page on 1st load
					lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "first_last_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: false,
					serverSide: false,
					searching: true,
					order: [[ 0, "desc" ], [ 1, "asc" ]],
			        ajax: 'BOEPortalMembershipStats/getListing',
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "rhq", searchable: true },
						{ targets: [ 1 ], data: "md", searchable: true },
						{ targets: [ 2 ], data: "wd", searchable: true},
						{ targets: [ 3 ], data: "ym", searchable: true},
						{ targets: [ 4 ], data: "yw", searchable: true},
						{ targets: [ 5 ], data: "pdym", searchable: true},
						{ targets: [ 6 ], data: "pdyw", searchable: true },
						{ targets: [ 7 ], data: "ycym", searchable: true },
						{ targets: [ 8 ], data: "ycyw", searchable: true },
						{ targets: [ 9 ], data: "unknown", searchable: true },
						{ targets: [ 10 ], data: "total", searchable: true }
					],
	            	"footerCallback": function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tdefaultfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
				});
				
				@if ($gakkaishq == 't' or $gakkairegion == 't')
					var oRhqTable = $('#trhq').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "desc" ], [ 1, "asc" ]],
						ajax: 'BOEPortalMembershipStats/getRHQPositionListing',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "positionlevel", searchable: true },
							{ targets: [ 2 ], data: "md", searchable: true },
							{ targets: [ 3 ], data: "wd", searchable: true},
							{ targets: [ 4 ], data: "ym", searchable: true},
							{ targets: [ 5 ], data: "yw", searchable: true},
							{ targets: [ 6 ], data: "pdym", searchable: true},
							{ targets: [ 7 ], data: "pdyw", searchable: true },
							{ targets: [ 8 ], data: "ycym", searchable: true },
							{ targets: [ 9 ], data: "ycyw", searchable: true },
							{ targets: [ 10 ], data: "unknown", searchable: true },
							{ targets: [ 11 ], data: "total", searchable: true }
						],
						"footerCallback": function (row, data, start, end, display) {
							var api = this.api(), data

							// Remove the formatting to get integer data for summation
							var intVal = function ( i ) {
								return typeof i === 'string' ?
									i.replace(/[\$,]/g, '')*1 :
									typeof i === 'number' ?
										i : 0;
							};
							columns = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trhqfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});
				@endif

				@if ($gakkaishq == 't' or $gakkairegion == 't' or $gakkaizone == 't')
					var oZoneTable = $('#tzoneposition').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "desc" ], [ 1, "asc" ]],
						ajax: 'BOEPortalMembershipStats/getZonePositionListing',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "zone", searchable: true },
							{ targets: [ 2 ], data: "positionlevel", searchable: true },
							{ targets: [ 3 ], data: "md", searchable: true },
							{ targets: [ 4 ], data: "wd", searchable: true},
							{ targets: [ 5 ], data: "ym", searchable: true},
							{ targets: [ 6 ], data: "yw", searchable: true},
							{ targets: [ 7 ], data: "pdym", searchable: true},
							{ targets: [ 8 ], data: "pdyw", searchable: true },
							{ targets: [ 9 ], data: "ycym", searchable: true },
							{ targets: [ 10 ], data: "ycyw", searchable: true },
							{ targets: [ 11 ], data: "unknown", searchable: true },
							{ targets: [ 12 ], data: "total", searchable: true }
						],
						"footerCallback": function (row, data, start, end, display) {
							var api = this.api(), data

							// Remove the formatting to get integer data for summation
							var intVal = function ( i ) {
								return typeof i === 'string' ?
									i.replace(/[\$,]/g, '')*1 :
									typeof i === 'number' ?
										i : 0;
							};
							columns = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tzonepositionfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});
				@endif

				@if ($gakkaishq == 't' or $gakkairegion == 't' or $gakkaizone == 't' or $gakkaichapter == 't')
					var oChapterTable = $('#tchapterposition').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "desc" ], [ 1, "asc" ]],
						ajax: 'BOEPortalMembershipStats/getChapterPositionListing',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "zone", searchable: true },
							{ targets: [ 2 ], data: "chapter", searchable: true },
							{ targets: [ 3 ], data: "positionlevel", searchable: true },
							{ targets: [ 4 ], data: "md", searchable: true },
							{ targets: [ 5 ], data: "wd", searchable: true},
							{ targets: [ 6 ], data: "ym", searchable: true},
							{ targets: [ 7 ], data: "yw", searchable: true},
							{ targets: [ 8 ], data: "pdym", searchable: true},
							{ targets: [ 9 ], data: "pdyw", searchable: true },
							{ targets: [ 10 ], data: "ycym", searchable: true },
							{ targets: [ 11 ], data: "ycyw", searchable: true },
							{ targets: [ 12 ], data: "unknown", searchable: true },
							{ targets: [ 13 ], data: "total", searchable: true }
						],
						"footerCallback": function (row, data, start, end, display) {
							var api = this.api(), data

							// Remove the formatting to get integer data for summation
							var intVal = function ( i ) {
								return typeof i === 'string' ?
									i.replace(/[\$,]/g, '')*1 :
									typeof i === 'number' ?
										i : 0;
							};
							columns = [4, 5, 6, 7, 8, 9, 10, 11, 12, 13]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tchapterpositionfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});
				@endif
				
				var oDistrictTable = $('#tdistrictposition').DataTable({
			        dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 10, // Default No of Records per page on 1st load
					lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "first_last_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: false,
					serverSide: false,
					searching: true,
					order: [[ 0, "desc" ], [ 1, "asc" ]],
			        ajax: 'BOEPortalMembershipStats/getDistrictPositionListing',
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "rhq", searchable: true },
						{ targets: [ 1 ], data: "zone", searchable: true },
						{ targets: [ 2 ], data: "chapter", searchable: true },
						{ targets: [ 3 ], data: "district", searchable: true },
						{ targets: [ 4 ], data: "positionlevel", searchable: true },
						{ targets: [ 5 ], data: "md", searchable: true },
						{ targets: [ 6 ], data: "wd", searchable: true},
						{ targets: [ 7 ], data: "ym", searchable: true},
						{ targets: [ 8 ], data: "yw", searchable: true},
						{ targets: [ 9 ], data: "pdym", searchable: true},
						{ targets: [ 10 ], data: "pdyw", searchable: true },
						{ targets: [ 11 ], data: "ycym", searchable: true },
						{ targets: [ 12 ], data: "ycyw", searchable: true },
						{ targets: [ 13 ], data: "unknown", searchable: true },
						{ targets: [ 14 ], data: "total", searchable: true },
						{ targets: [ 15 ], data: "description", searchable: true, visible: false }
					],
	            	"footerCallback": function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [5, 6, 7, 8, 9, 10, 11, 12, 13, 14]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tdistrictpositionfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
				});
				
				var oPositionAgeGroupTable = $('#tpositionagegroup').DataTable({
			        dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 10, // Default No of Records per page on 1st load
					lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "first_last_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: false,
					serverSide: false,
					searching: true,
					order: [[ 0, "desc" ], [ 1, "asc" ]],
			        ajax: 'BOEPortalMembershipStats/getPositionAgeGroupListing',
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "rhq", searchable: true },
						{ targets: [ 1 ], data: "zone", searchable: true },
						{ targets: [ 2 ], data: "chapter", searchable: true },
						{ targets: [ 3 ], data: "district", searchable: true },
						{ targets: [ 4 ], data: "positionlevel", searchable: true },
						{ targets: [ 5 ], data: "agegroup", searchable: true },
						{ targets: [ 6 ], data: "md", searchable: true },
						{ targets: [ 7 ], data: "wd", searchable: true},
						{ targets: [ 8 ], data: "ym", searchable: true},
						{ targets: [ 9 ], data: "yw", searchable: true},
						{ targets: [ 10 ], data: "pdym", searchable: true},
						{ targets: [ 11 ], data: "pdyw", searchable: true },
						{ targets: [ 12 ], data: "ycym", searchable: true },
						{ targets: [ 13 ], data: "ycyw", searchable: true },
						{ targets: [ 14 ], data: "unknown", searchable: true },
						{ targets: [ 15 ], data: "total", searchable: true },
						{ targets: [ 16 ], data: "description", searchable: true, visible: false }
					],
	            	"footerCallback": function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [6, 7, 8, 9, 10, 11, 12, 13, 14, 15]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tpositionagegroupfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    });
			});
		});
	</script>
@stop