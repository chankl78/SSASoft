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
			<h1>Discussion Meeting <small><i class="ace-icon fa fa-angle-double-right"></i> Statistic</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
					<div class="widget-box widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">Select Year to view Statistic</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="well well-lg">
									{{ Form::open(array('id' => 'fselect', 'class' => 'form-horizontal')) }}
										<fieldset>
											{{ Form::label('ddyear', 'Year: ', array('class' => 'control-label col-xs-12 col-sm-4')); }}
											{{ Form::select('ddyear', $dmyear_options, $currentyear, array('class' => 'col-xs-12 col-sm-6', 'id' => 'ddyear')); }}
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Year Selection -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Discussion Meeting Statistic</h5>
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
											<th>Year</th>
											<th>Month</th>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chapter</th>
											<th>District</th>
											<th>Att Total</th>
											<th>MD-L</th>
											<th>MD-M</th>
											<th>MD-B</th>
											<th>MD-NF</th>
											<th>WD-L</th>
											<th>WD-M</th>
											<th>WD-B</th>
											<th>WD-NF</th>
											<th>YM-L</th>
											<th>YM-M</th>
											<th>YM-B</th>
											<th>YM-NF</th>
											<th>YW-L</th>
											<th>YW-M</th>
											<th>YW-B</th>
											<th>YW-NF</th>
											<th>PD</th>
											<th>YC</th>
											<th>Description</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot id="tdefaultfoot">
										<tr>
											<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
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
				</div> <!-- Discussion Meeting Statistic Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">By RHQ Stats</h5>
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
											<th>Zone</th>
											<th>Chap</th>
											<th>Dist</th>
											<th>Jan</th>
											<th>Feb</th>
											<th>Mar</th>
											<th>Apr</th>
											<th>May</th>
											<th>Jun</th>
											<th>Jul</th>
											<th>Aug</th>
											<th>Sep</th>
											<th>Oct</th>
											<th>Nov</th>
											<th>Dec</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot id="trhqfoot">
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
				</div> <!-- Discussion Meeting Statistic By RHQ Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">By RHQ By AgeGroup</h5>
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
								<table id="trhqagegroup" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chap</th>
											<th>Dist</th>
											<th>Age Group</th>
											<th>Jan</th>
											<th>Feb</th>
											<th>Mar</th>
											<th>Apr</th>
											<th>May</th>
											<th>Jun</th>
											<th>Jul</th>
											<th>Aug</th>
											<th>Sep</th>
											<th>Oct</th>
											<th>Nov</th>
											<th>Dec</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot id="trhqagegroupfoot">
										<tr>
											<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
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
				</div> <!-- Discussion Meeting Statistic By RHQ By Age Group Listing -->
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
			        ajax: 'BOEPortalDMStats/getListing/' + $('#ddyear').val(),
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "year", searchable: true },
						{ targets: [ 1 ], data: "month", searchable: true },
						{ targets: [ 2 ], data: "rhq", searchable: true},
						{ targets: [ 3 ], data: "zone", searchable: true},
						{ targets: [ 4 ], data: "chapter", searchable: true},
						{ targets: [ 5 ], data: "district", searchable: true},
						{ targets: [ 6 ], data: "attendancetotal", searchable: true },
						{ targets: [ 7 ], data: "ldrmd", searchable: true },
						{ targets: [ 8 ], data: "memmd", searchable: true },
						{ targets: [ 9 ], data: "belmd", searchable: true },
						{ targets: [ 10 ], data: "nfmd", searchable: true },
						{ targets: [ 11 ], data: "ldrwd", searchable: true },
						{ targets: [ 12 ], data: "memwd", searchable: true },
						{ targets: [ 13 ], data: "belwd", searchable: true },
						{ targets: [ 14 ], data: "nfwd", searchable: true },
						{ targets: [ 15 ], data: "ldrymd", searchable: true },
						{ targets: [ 16 ], data: "memymd", searchable: true },
						{ targets: [ 17 ], data: "belymd", searchable: true },
						{ targets: [ 18 ], data: "nfymd", searchable: true },
						{ targets: [ 19 ], data: "ldrywd", searchable: true },
						{ targets: [ 20 ], data: "memywd", searchable: true },
						{ targets: [ 21 ], data: "belywd", searchable: true },
						{ targets: [ 22 ], data: "nfywd", searchable: true },
						{ targets: [ 23 ], data: "pd", searchable: true },
						{ targets: [ 24 ], data: "yc", searchable: true },
						{ targets: [ 25 ], data: "description", searchable: true, visible: false }
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
		                columns = [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tdefaultfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    });

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
			        ajax: 'BOEPortalDMStats/getRHQStats/' + $('#ddyear').val(),
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
						{ targets: [ 4 ], data: "jan", searchable: true},
						{ targets: [ 5 ], data: "feb", searchable: true},
						{ targets: [ 6 ], data: "mar", searchable: true},
						{ targets: [ 7 ], data: "apr", searchable: true},
						{ targets: [ 8 ], data: "may", searchable: true },
						{ targets: [ 9 ], data: "jun", searchable: true },
						{ targets: [ 10 ], data: "jul", searchable: true },
						{ targets: [ 11 ], data: "aug", searchable: true },
						{ targets: [ 12 ], data: "sep", searchable: true },
						{ targets: [ 13 ], data: "oct", searchable: true },
						{ targets: [ 14 ], data: "nov", searchable: true },
						{ targets: [ 15 ], data: "dec", searchable: true },
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
		                columns = [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#trhqfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    });

				var oRhqAgeGrpTable = $('#trhqagegroup').DataTable({
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
			        ajax: 'BOEPortalDMStats/getRHQAgeGroupStats/' + $('#ddyear').val(),
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
						{ targets: [ 4 ], data: "agegroup", searchable: true },
						{ targets: [ 5 ], data: "jan", searchable: true},
						{ targets: [ 6 ], data: "feb", searchable: true},
						{ targets: [ 7 ], data: "mar", searchable: true},
						{ targets: [ 8 ], data: "apr", searchable: true},
						{ targets: [ 9 ], data: "may", searchable: true },
						{ targets: [ 10 ], data: "jun", searchable: true },
						{ targets: [ 11 ], data: "jul", searchable: true },
						{ targets: [ 12 ], data: "aug", searchable: true },
						{ targets: [ 13 ], data: "sep", searchable: true },
						{ targets: [ 14 ], data: "oct", searchable: true },
						{ targets: [ 15 ], data: "nov", searchable: true },
						{ targets: [ 16 ], data: "dec", searchable: true },
						{ targets: [ 17 ], data: "description", searchable: true, visible: false }
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
		                columns = [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#trhqagegroupfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    });

				$('#ddyear').change(function(){
					var oTable = $('#tdefault').DataTable();
					oTable.destroy();
					$('#tdefault tbody').remove();

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
						ajax: 'BOEPortalDMStats/getListing/' + $('#ddyear').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "year", searchable: true },
							{ targets: [ 1 ], data: "month", searchable: true },
							{ targets: [ 2 ], data: "rhq", searchable: true},
							{ targets: [ 3 ], data: "zone", searchable: true},
							{ targets: [ 4 ], data: "chapter", searchable: true},
							{ targets: [ 5 ], data: "district", searchable: true},
							{ targets: [ 6 ], data: "attendancetotal", searchable: true },
							{ targets: [ 7 ], data: "ldrmd", searchable: true },
							{ targets: [ 8 ], data: "memmd", searchable: true },
							{ targets: [ 9 ], data: "belmd", searchable: true },
							{ targets: [ 10 ], data: "nfmd", searchable: true },
							{ targets: [ 11 ], data: "ldrwd", searchable: true },
							{ targets: [ 12 ], data: "memwd", searchable: true },
							{ targets: [ 13 ], data: "belwd", searchable: true },
							{ targets: [ 14 ], data: "nfwd", searchable: true },
							{ targets: [ 15 ], data: "ldrymd", searchable: true },
							{ targets: [ 16 ], data: "memymd", searchable: true },
							{ targets: [ 17 ], data: "belymd", searchable: true },
							{ targets: [ 18 ], data: "nfymd", searchable: true },
							{ targets: [ 19 ], data: "ldrywd", searchable: true },
							{ targets: [ 20 ], data: "memywd", searchable: true },
							{ targets: [ 21 ], data: "belywd", searchable: true },
							{ targets: [ 22 ], data: "nfywd", searchable: true },
							{ targets: [ 23 ], data: "pd", searchable: true },
							{ targets: [ 24 ], data: "yc", searchable: true },
							{ targets: [ 25 ], data: "description", searchable: true, visible: false }
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
							columns = [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tdefaultfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oRhqTable = $('#trhq').DataTable();
					oRhqTable.destroy();
					$('#trhq tbody').remove();

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
						ajax: 'BOEPortalDMStats/getRHQStats/' + $('#ddyear').val(),
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
							{ targets: [ 4 ], data: "jan", searchable: true},
							{ targets: [ 5 ], data: "feb", searchable: true},
							{ targets: [ 6 ], data: "mar", searchable: true},
							{ targets: [ 7 ], data: "apr", searchable: true},
							{ targets: [ 8 ], data: "may", searchable: true },
							{ targets: [ 9 ], data: "jun", searchable: true },
							{ targets: [ 10 ], data: "jul", searchable: true },
							{ targets: [ 11 ], data: "aug", searchable: true },
							{ targets: [ 12 ], data: "sep", searchable: true },
							{ targets: [ 13 ], data: "oct", searchable: true },
							{ targets: [ 14 ], data: "nov", searchable: true },
							{ targets: [ 15 ], data: "dec", searchable: true },
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
							columns = [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trhqfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oRhqAgeGrpTable = $('#trhqagegroup').DataTable();
					oRhqAgeGrpTable.destroy();
					$('#trhqagegroup tbody').remove();

					var oRhqAgeGrpTable = $('#trhqagegroup').DataTable({
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
						ajax: 'BOEPortalDMStats/getRHQAgeGroupStats/' + $('#ddyear').val(),
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
							{ targets: [ 4 ], data: "agegroup", searchable: true },
							{ targets: [ 5 ], data: "jan", searchable: true},
							{ targets: [ 6 ], data: "feb", searchable: true},
							{ targets: [ 7 ], data: "mar", searchable: true},
							{ targets: [ 8 ], data: "apr", searchable: true},
							{ targets: [ 9 ], data: "may", searchable: true },
							{ targets: [ 10 ], data: "jun", searchable: true },
							{ targets: [ 11 ], data: "jul", searchable: true },
							{ targets: [ 12 ], data: "aug", searchable: true },
							{ targets: [ 13 ], data: "sep", searchable: true },
							{ targets: [ 14 ], data: "oct", searchable: true },
							{ targets: [ 15 ], data: "nov", searchable: true },
							{ targets: [ 16 ], data: "dec", searchable: true },
							{ targets: [ 17 ], data: "description", searchable: true, visible: false }
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
							columns = [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trhqagegroupfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});
	        	});
			});
		});
	</script>
@stop