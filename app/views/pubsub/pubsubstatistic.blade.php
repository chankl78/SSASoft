@extends('layout.master')

@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i><a href="{{{ URL::action('DashboardController@getIndex') }}}">Home</a>
			</li>
			<li class="active"><a href="{{{ URL::action('PubSubStatisticController@getIndex') }}}">Publication Subscription Statistic</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Publication Subscription<small><i class="ace-icon fa fa-angle-double-right"></i> Statistic</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
					<div class="widget-box widget-color-red">
						<div class="widget-header">
							<h5 class="widget-title">Step 1 - Import</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="well well-lg">
									{{ Form::open(array('action' => 'PubSubStatisticController@postImport', 'id' => 'fimport', 'class' => 'form-horizontal')) }}
										<div class="form-group">
											<div class="col-md-offset-3 col-xs-12 col-sm-12">
												{{ Form::button('Import', array('type' => 'Search', 'class' => 'btn btn-danger btn-lg' )); }}
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Import Data -->
				<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
					<div class="widget-box widget-color-orange">
						<div class="widget-header">
							<h5 class="widget-title">Step 2 - Update Stats</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="well well-lg">
									{{ Form::open(array('action' => 'PubSubStatisticController@postStatsUpdate', 'id' => 'fstatsupdate', 'class' => 'form-horizontal')) }}
										<div class="form-group">
											<div class="col-md-offset-3 col-xs-12 col-sm-12">
												{{ Form::button('Update', array('type' => 'Search', 'class' => 'btn btn-info btn-lg' )); }}
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Update Data -->
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
											{{ Form::select('ddyear', $psyear_options, $currentyear, array('class' => 'col-xs-12 col-sm-6', 'id' => 'ddyear')); }}
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Year Selection -->
				<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
					<div class="widget-box widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">Select Division to view Statistic</h5>
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
											{{ Form::label('dddivisiontype', 'Division: ', array('class' => 'control-label col-xs-12 col-sm-4')); }}
											{{ Form::select('dddivisiontype', $divisiontype_options, 'All', array('class' => 'col-xs-12 col-sm-6', 'id' => 'dddivisiontype')); }}
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Division Type Selection -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">By Creative Life Stats</h5>
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
								<table id="trhqcl" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>RHQ</th>
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
									<tfoot id="trhqclfoot">
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
				</div> <!-- Publication Subscription Statistic CL By Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">By Soka Times Stats</h5>
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
								<table id="trhqst" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>RHQ</th>
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
									<tfoot id="trhqstfoot">
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
				</div> <!-- Publication Subscription Statistic ST By Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Creative Life By AgeGroup</h5>
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
								<table id="tclagegroup" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
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
									<tfoot id="tclagegroupfoot">
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
				</div> <!-- Publication Subscription Statistic CL By Age Group Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">Soka Times By AgeGroup</h5>
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
								<table id="tstagegroup" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
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
									<tfoot id="tstagegroupfoot">
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
				</div> <!-- Publication Subscription Statistic ST By Age Group Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Creative Life By Position Level</h5>
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
								<table id="tclpositionlevel" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Pos Level</th>
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
									<tfoot id="tclpositionlevelfoot">
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
				</div> <!-- Publication Subscription Statistic CL By Position Level Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">Soka Times By Position Level</h5>
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
								<table id="tstpositionlevel" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Pos Level</th>
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
									<tfoot id="tstpositionlevelfoot">
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
				</div> <!-- Publication Subscription Statistic ST By Position Level Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Name List (CL)</h5>
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
								<table id="tclname" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Name</th>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chap</th>
											<th>Dist</th>
											<th>Div</th>
											<th>Pos</th>
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
									<tfoot id="tclnamefoot">
										<tr>
											<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
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
				</div> <!-- Publication Subscription Statistic CL By Name By RHQ Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">Name List (ST)</h5>
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
								<table id="tstname" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Name</th>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chap</th>
											<th>Dist</th>
											<th>Div</th>
											<th>Pos</th>
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
									<tfoot id="tstnamefoot">
										<tr>
											<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
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
				</div> <!-- Publication Subscription Statistic CL By Name By RHQ Listing -->
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

				var oRhqClTable = $('#trhqcl').DataTable({
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
					order: [[ 0, "desc" ]],
			        ajax: 'PubSub/getRHQCLStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "rhq", searchable: true },
						{ targets: [ 1 ], data: "jan", searchable: true},
						{ targets: [ 2 ], data: "feb", searchable: true},
						{ targets: [ 3 ], data: "mar", searchable: true},
						{ targets: [ 4 ], data: "apr", searchable: true},
						{ targets: [ 5 ], data: "may", searchable: true },
						{ targets: [ 6 ], data: "jun", searchable: true },
						{ targets: [ 7 ], data: "jul", searchable: true },
						{ targets: [ 8 ], data: "aug", searchable: true },
						{ targets: [ 9 ], data: "sep", searchable: true },
						{ targets: [ 10 ], data: "oct", searchable: true },
						{ targets: [ 11 ], data: "nov", searchable: true },
						{ targets: [ 12 ], data: "dec", searchable: true },
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
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#trhqclfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
				});
				
				var oRhqStTable = $('#trhqst').DataTable({
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
					order: [[ 0, "desc" ]],
			        ajax: 'PubSub/getRHQSTStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "rhq", searchable: true },
						{ targets: [ 1 ], data: "jan", searchable: true},
						{ targets: [ 2 ], data: "feb", searchable: true},
						{ targets: [ 3 ], data: "mar", searchable: true},
						{ targets: [ 4 ], data: "apr", searchable: true},
						{ targets: [ 5 ], data: "may", searchable: true },
						{ targets: [ 6 ], data: "jun", searchable: true },
						{ targets: [ 7 ], data: "jul", searchable: true },
						{ targets: [ 8 ], data: "aug", searchable: true },
						{ targets: [ 9 ], data: "sep", searchable: true },
						{ targets: [ 10 ], data: "oct", searchable: true },
						{ targets: [ 11 ], data: "nov", searchable: true },
						{ targets: [ 12 ], data: "dec", searchable: true },
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
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#trhqstfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    });

				var oAgeGrpCLTable = $('#tclagegroup').DataTable({
			        dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 20, // Default No of Records per page on 1st load
					lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "first_last_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: false,
					serverSide: false,
					searching: true,
					order: [[ 0, "asc" ]],
			        ajax: 'PubSub/getAgeGroupCLStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "agegroup", searchable: true },
						{ targets: [ 1 ], data: "jan", searchable: true},
						{ targets: [ 2 ], data: "feb", searchable: true},
						{ targets: [ 3 ], data: "mar", searchable: true},
						{ targets: [ 4 ], data: "apr", searchable: true},
						{ targets: [ 5 ], data: "may", searchable: true },
						{ targets: [ 6 ], data: "jun", searchable: true },
						{ targets: [ 7 ], data: "jul", searchable: true },
						{ targets: [ 8 ], data: "aug", searchable: true },
						{ targets: [ 9 ], data: "sep", searchable: true },
						{ targets: [ 10 ], data: "oct", searchable: true },
						{ targets: [ 11 ], data: "nov", searchable: true },
						{ targets: [ 12 ], data: "dec", searchable: true }
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
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tclagegroupfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
				});
				
				var oAgeGrpSTTable = $('#tstagegroup').DataTable({
			        dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 20, // Default No of Records per page on 1st load
					lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "first_last_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: false,
					serverSide: false,
					searching: true,
					order: [[ 0, "asc" ]],
			        ajax: 'PubSub/getAgeGroupSTStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "agegroup", searchable: true },
						{ targets: [ 1 ], data: "jan", searchable: true},
						{ targets: [ 2 ], data: "feb", searchable: true},
						{ targets: [ 3 ], data: "mar", searchable: true},
						{ targets: [ 4 ], data: "apr", searchable: true},
						{ targets: [ 5 ], data: "may", searchable: true },
						{ targets: [ 6 ], data: "jun", searchable: true },
						{ targets: [ 7 ], data: "jul", searchable: true },
						{ targets: [ 8 ], data: "aug", searchable: true },
						{ targets: [ 9 ], data: "sep", searchable: true },
						{ targets: [ 10 ], data: "oct", searchable: true },
						{ targets: [ 11 ], data: "nov", searchable: true },
						{ targets: [ 12 ], data: "dec", searchable: true }
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
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tstagegroupfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
				});
				
				var oPosLvlCLTable = $('#tclpositionlevel').DataTable({
			        dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 20, // Default No of Records per page on 1st load
					lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "first_last_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: false,
					serverSide: false,
					searching: true,
					order: [[ 0, "asc" ]],
			        ajax: 'PubSub/getPositionLevelCLStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "positionlevel", searchable: true },
						{ targets: [ 1 ], data: "jan", searchable: true},
						{ targets: [ 2 ], data: "feb", searchable: true},
						{ targets: [ 3 ], data: "mar", searchable: true},
						{ targets: [ 4 ], data: "apr", searchable: true},
						{ targets: [ 5 ], data: "may", searchable: true },
						{ targets: [ 6 ], data: "jun", searchable: true },
						{ targets: [ 7 ], data: "jul", searchable: true },
						{ targets: [ 8 ], data: "aug", searchable: true },
						{ targets: [ 9 ], data: "sep", searchable: true },
						{ targets: [ 10 ], data: "oct", searchable: true },
						{ targets: [ 11 ], data: "nov", searchable: true },
						{ targets: [ 12 ], data: "dec", searchable: true }
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
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tclpositionlevelfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
				});
				
				var oPosLvlSTTable = $('#tstpositionlevel').DataTable({
			        dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 20, // Default No of Records per page on 1st load
					lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "first_last_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: false,
					serverSide: false,
					searching: true,
					order: [[ 0, "asc" ]],
			        ajax: 'PubSub/getPositionLevelSTStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "positionlevel", searchable: true },
						{ targets: [ 1 ], data: "jan", searchable: true},
						{ targets: [ 2 ], data: "feb", searchable: true},
						{ targets: [ 3 ], data: "mar", searchable: true},
						{ targets: [ 4 ], data: "apr", searchable: true},
						{ targets: [ 5 ], data: "may", searchable: true },
						{ targets: [ 6 ], data: "jun", searchable: true },
						{ targets: [ 7 ], data: "jul", searchable: true },
						{ targets: [ 8 ], data: "aug", searchable: true },
						{ targets: [ 9 ], data: "sep", searchable: true },
						{ targets: [ 10 ], data: "oct", searchable: true },
						{ targets: [ 11 ], data: "nov", searchable: true },
						{ targets: [ 12 ], data: "dec", searchable: true }
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
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tstpositionlevelfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
				});
				
				var oCLNameTable = $('#tclname').DataTable({
			        dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 10, // Default No of Records per page on 1st load
					lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "full_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: true,
					serverSide: true,
					searching: true,
					order: [[ 0, "desc" ], [ 1, "asc" ]],
			        ajax: $.fn.dataTable.pipeline({
						url: 'PubSub/getCLNameList/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						pages: 5 // number of pages to cache
					}),
					columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "name", searchable: true },
						{ targets: [ 1 ], data: "rhq", searchable: true },
						{ targets: [ 2 ], data: "zone", searchable: true },
						{ targets: [ 3 ], data: "chapter", searchable: true },
						{ targets: [ 4 ], data: "district", searchable: true },
						{ targets: [ 5 ], data: "division", searchable: true },
						{ targets: [ 6 ], data: "position", searchable: true },
						{ targets: [ 7 ], data: "jan", searchable: true},
						{ targets: [ 8 ], data: "feb", searchable: true},
						{ targets: [ 9 ], data: "mar", searchable: true},
						{ targets: [ 10 ], data: "apr", searchable: true},
						{ targets: [ 11 ], data: "may", searchable: true },
						{ targets: [ 12 ], data: "jun", searchable: true },
						{ targets: [ 13 ], data: "jul", searchable: true },
						{ targets: [ 14 ], data: "aug", searchable: true },
						{ targets: [ 15 ], data: "sep", searchable: true },
						{ targets: [ 16 ], data: "oct", searchable: true },
						{ targets: [ 17 ], data: "nov", searchable: true },
						{ targets: [ 18 ], data: "dec", searchable: true },
						{ targets: [ 19 ], data: "description", searchable: true, visible: false }
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
		                columns = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tclnamefoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
				});
				
				var oSTNameTable = $('#tstname').DataTable({
			        dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 10, // Default No of Records per page on 1st load
					lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "first_last_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: true,
					serverSide: true,
					searching: true,
					order: [[ 0, "desc" ], [ 1, "asc" ]],
			        ajax: $.fn.dataTable.pipeline({
						url: 'PubSub/getSTNameList/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						pages: 5 // number of pages to cache
					}),
					columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 4 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{ targets: [ 0 ], data: "name", searchable: true },
						{ targets: [ 1 ], data: "rhq", searchable: true },
						{ targets: [ 2 ], data: "zone", searchable: true },
						{ targets: [ 3 ], data: "chapter", searchable: true },
						{ targets: [ 4 ], data: "district", searchable: true },
						{ targets: [ 5 ], data: "division", searchable: true },
						{ targets: [ 6 ], data: "position", searchable: true },
						{ targets: [ 7 ], data: "jan", searchable: true},
						{ targets: [ 8 ], data: "feb", searchable: true},
						{ targets: [ 9 ], data: "mar", searchable: true},
						{ targets: [ 10 ], data: "apr", searchable: true},
						{ targets: [ 11 ], data: "may", searchable: true },
						{ targets: [ 12 ], data: "jun", searchable: true },
						{ targets: [ 13 ], data: "jul", searchable: true },
						{ targets: [ 14 ], data: "aug", searchable: true },
						{ targets: [ 15 ], data: "sep", searchable: true },
						{ targets: [ 16 ], data: "oct", searchable: true },
						{ targets: [ 17 ], data: "nov", searchable: true },
						{ targets: [ 18 ], data: "dec", searchable: true },
						{ targets: [ 19 ], data: "description", searchable: true, visible: false }
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
		                columns = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tstnamefoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    });

				$('#ddyear').change(function(){
					var oRhqClTable = $('#trhqcl').DataTable();
					oRhqClTable.destroy();
					$('#trhqcl tbody').remove();

					var oRhqClTable = $('#trhqcl').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "desc" ]],
						ajax: 'PubSub/getRHQCLStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true },
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trhqclfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oRhqStTable = $('#trhqst').DataTable();
					oRhqStTable.destroy();
					$('#trhqst tbody').remove();

					var oRhqStTable = $('#trhqst').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "desc" ]],
						ajax: 'PubSub/getRHQSTStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true },
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trhqstfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oAgeGrpCLTable = $('#tclagegroup').DataTable();
					oAgeGrpCLTable.destroy();
					$('#tclagegroup tbody').remove();

					var oAgeGrpCLTable = $('#tclagegroup').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "asc" ]],
						ajax: 'PubSub/getAgeGroupCLStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "agegroup", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true }
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tclagegroupfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oAgeGrpSTTable = $('#tstagegroup').DataTable();
					oAgeGrpSTTable.destroy();
					$('#tstagegroup tbody').remove();

					var oAgeGrpSTTable = $('#tstagegroup').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "asc" ]],
						ajax: 'PubSub/getAgeGroupSTStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "agegroup", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true }
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tstagegroupfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oPosLvlCLTable = $('#tclpositionlevel').DataTable();
					oPosLvlCLTable.destroy();
					$('#tclpositionlevel tbody').remove();

					var oPosLvlCLTable = $('#tclpositionlevel').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "asc" ]],
						ajax: 'PubSub/getPositionLevelCLStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "positionlevel", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true }
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tclpositionlevelfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oPosLvlSTTable = $('#tstpositionlevel').DataTable();
					oPosLvlSTTable.destroy();
					$('#tstpositionlevel tbody').remove();

					var oPosLvlSTTable = $('#tstpositionlevel').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "asc" ]],
						ajax: 'PubSub/getPositionLevelSTStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "positionlevel", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true }
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tstpositionlevelfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oCLNameTable = $('#tclname').DataTable();
					oCLNameTable.destroy();
					$('#tclname tbody').remove();

					var oCLNameTable = $('#tclname').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "full_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: true,
						serverSide: true,
						searching: true,
						order: [[ 0, "desc" ], [ 1, "asc" ]],
						ajax: $.fn.dataTable.pipeline({
							url: 'PubSub/getCLNameList/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
							pages: 5 // number of pages to cache
						}),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "name", searchable: true },
							{ targets: [ 1 ], data: "rhq", searchable: true },
							{ targets: [ 2 ], data: "zone", searchable: true },
							{ targets: [ 3 ], data: "chapter", searchable: true },
							{ targets: [ 4 ], data: "district", searchable: true },
							{ targets: [ 5 ], data: "division", searchable: true },
							{ targets: [ 6 ], data: "position", searchable: true },
							{ targets: [ 7 ], data: "jan", searchable: true},
							{ targets: [ 8 ], data: "feb", searchable: true},
							{ targets: [ 9 ], data: "mar", searchable: true},
							{ targets: [ 10 ], data: "apr", searchable: true},
							{ targets: [ 11 ], data: "may", searchable: true },
							{ targets: [ 12 ], data: "jun", searchable: true },
							{ targets: [ 13 ], data: "jul", searchable: true },
							{ targets: [ 14 ], data: "aug", searchable: true },
							{ targets: [ 15 ], data: "sep", searchable: true },
							{ targets: [ 16 ], data: "oct", searchable: true },
							{ targets: [ 17 ], data: "nov", searchable: true },
							{ targets: [ 18 ], data: "dec", searchable: true },
							{ targets: [ 19 ], data: "description", searchable: true, visible: false }
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
							columns = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tclnamefoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oSTNameTable = $('#tstname').DataTable();
					oSTNameTable.destroy();
					$('#tstname tbody').remove();

					var oSTNameTable = $('#tstname').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: true,
						serverSide: true,
						searching: true,
						order: [[ 0, "desc" ], [ 1, "asc" ]],
						ajax: $.fn.dataTable.pipeline({
							url: 'PubSub/getSTNameList/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
							pages: 5 // number of pages to cache
						}),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "name", searchable: true },
							{ targets: [ 1 ], data: "rhq", searchable: true },
							{ targets: [ 2 ], data: "zone", searchable: true },
							{ targets: [ 3 ], data: "chapter", searchable: true },
							{ targets: [ 4 ], data: "district", searchable: true },
							{ targets: [ 5 ], data: "division", searchable: true },
							{ targets: [ 6 ], data: "position", searchable: true },
							{ targets: [ 7 ], data: "jan", searchable: true},
							{ targets: [ 8 ], data: "feb", searchable: true},
							{ targets: [ 9 ], data: "mar", searchable: true},
							{ targets: [ 10 ], data: "apr", searchable: true},
							{ targets: [ 11 ], data: "may", searchable: true },
							{ targets: [ 12 ], data: "jun", searchable: true },
							{ targets: [ 13 ], data: "jul", searchable: true },
							{ targets: [ 14 ], data: "aug", searchable: true },
							{ targets: [ 15 ], data: "sep", searchable: true },
							{ targets: [ 16 ], data: "oct", searchable: true },
							{ targets: [ 17 ], data: "nov", searchable: true },
							{ targets: [ 18 ], data: "dec", searchable: true },
							{ targets: [ 19 ], data: "description", searchable: true, visible: false }
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
							columns = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tstnamefoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});
	        	});

				$('#dddivisiontype').change(function(){
					var oRhqClTable = $('#trhqcl').DataTable();
					oRhqClTable.destroy();
					$('#trhqcl tbody').remove();

					var oRhqClTable = $('#trhqcl').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "desc" ]],
						ajax: 'PubSub/getRHQCLStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true },
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trhqclfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oRhqStTable = $('#trhqst').DataTable();
					oRhqStTable.destroy();
					$('#trhqst tbody').remove();

					var oRhqStTable = $('#trhqst').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "desc" ]],
						ajax: 'PubSub/getRHQSTStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true },
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trhqstfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oAgeGrpCLTable = $('#tclagegroup').DataTable();
					oAgeGrpCLTable.destroy();
					$('#tclagegroup tbody').remove();

					var oAgeGrpCLTable = $('#tclagegroup').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "asc" ]],
						ajax: 'PubSub/getAgeGroupCLStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "agegroup", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true }
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tclagegroupfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oAgeGrpSTTable = $('#tstagegroup').DataTable();
					oAgeGrpSTTable.destroy();
					$('#tstagegroup tbody').remove();

					var oAgeGrpSTTable = $('#tstagegroup').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "asc" ]],
						ajax: 'PubSub/getAgeGroupSTStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "agegroup", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true }
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tstagegroupfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oPosLvlCLTable = $('#tclpositionlevel').DataTable();
					oPosLvlCLTable.destroy();
					$('#tclpositionlevel tbody').remove();

					var oPosLvlCLTable = $('#tclpositionlevel').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "asc" ]],
						ajax: 'PubSub/getPositionLevelCLStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "positionlevel", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true }
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tclpositionlevelfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oPosLvlSTTable = $('#tstpositionlevel').DataTable();
					oPosLvlSTTable.destroy();
					$('#tstpositionlevel tbody').remove();

					var oPosLvlSTTable = $('#tstpositionlevel').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 20, // Default No of Records per page on 1st load
						lengthMenu: [[20, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[ 0, "asc" ]],
						ajax: 'PubSub/getPositionLevelSTStats/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "positionlevel", searchable: true },
							{ targets: [ 1 ], data: "jan", searchable: true},
							{ targets: [ 2 ], data: "feb", searchable: true},
							{ targets: [ 3 ], data: "mar", searchable: true},
							{ targets: [ 4 ], data: "apr", searchable: true},
							{ targets: [ 5 ], data: "may", searchable: true },
							{ targets: [ 6 ], data: "jun", searchable: true },
							{ targets: [ 7 ], data: "jul", searchable: true },
							{ targets: [ 8 ], data: "aug", searchable: true },
							{ targets: [ 9 ], data: "sep", searchable: true },
							{ targets: [ 10 ], data: "oct", searchable: true },
							{ targets: [ 11 ], data: "nov", searchable: true },
							{ targets: [ 12 ], data: "dec", searchable: true }
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
							columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tstpositionlevelfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oCLNameTable = $('#tclname').DataTable();
					oCLNameTable.destroy();
					$('#tclname tbody').remove();

					var oCLNameTable = $('#tclname').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "full_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: true,
						serverSide: true,
						searching: true,
						order: [[ 0, "desc" ], [ 1, "asc" ]],
						ajax: $.fn.dataTable.pipeline({
							url: 'PubSub/getCLNameList/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
							pages: 5 // number of pages to cache
						}),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "name", searchable: true },
							{ targets: [ 1 ], data: "rhq", searchable: true },
							{ targets: [ 2 ], data: "zone", searchable: true },
							{ targets: [ 3 ], data: "chapter", searchable: true },
							{ targets: [ 4 ], data: "district", searchable: true },
							{ targets: [ 5 ], data: "division", searchable: true },
							{ targets: [ 6 ], data: "position", searchable: true },
							{ targets: [ 7 ], data: "jan", searchable: true},
							{ targets: [ 8 ], data: "feb", searchable: true},
							{ targets: [ 9 ], data: "mar", searchable: true},
							{ targets: [ 10 ], data: "apr", searchable: true},
							{ targets: [ 11 ], data: "may", searchable: true },
							{ targets: [ 12 ], data: "jun", searchable: true },
							{ targets: [ 13 ], data: "jul", searchable: true },
							{ targets: [ 14 ], data: "aug", searchable: true },
							{ targets: [ 15 ], data: "sep", searchable: true },
							{ targets: [ 16 ], data: "oct", searchable: true },
							{ targets: [ 17 ], data: "nov", searchable: true },
							{ targets: [ 18 ], data: "dec", searchable: true },
							{ targets: [ 19 ], data: "description", searchable: true, visible: false }
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
							columns = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tclnamefoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});

					var oSTNameTable = $('#tstname').DataTable();
					oSTNameTable.destroy();
					$('#tstname tbody').remove();

					var oSTNameTable = $('#tstname').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						processing: true,
						serverSide: true,
						searching: true,
						order: [[ 0, "desc" ], [ 1, "asc" ]],
						ajax: $.fn.dataTable.pipeline({
							url: 'PubSub/getSTNameList/' + $('#ddyear').val() + '/' + $('#dddivisiontype').val(),
							pages: 5 // number of pages to cache
						}),
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 4 },
							{ responsivePriority: 4, targets: 5 },
							{ responsivePriority: 5, targets: 6 },
							{ targets: [ 0 ], data: "name", searchable: true },
							{ targets: [ 1 ], data: "rhq", searchable: true },
							{ targets: [ 2 ], data: "zone", searchable: true },
							{ targets: [ 3 ], data: "chapter", searchable: true },
							{ targets: [ 4 ], data: "district", searchable: true },
							{ targets: [ 5 ], data: "division", searchable: true },
							{ targets: [ 6 ], data: "position", searchable: true },
							{ targets: [ 7 ], data: "jan", searchable: true},
							{ targets: [ 8 ], data: "feb", searchable: true},
							{ targets: [ 9 ], data: "mar", searchable: true},
							{ targets: [ 10 ], data: "apr", searchable: true},
							{ targets: [ 11 ], data: "may", searchable: true },
							{ targets: [ 12 ], data: "jun", searchable: true },
							{ targets: [ 13 ], data: "jul", searchable: true },
							{ targets: [ 14 ], data: "aug", searchable: true },
							{ targets: [ 15 ], data: "sep", searchable: true },
							{ targets: [ 16 ], data: "oct", searchable: true },
							{ targets: [ 17 ], data: "nov", searchable: true },
							{ targets: [ 18 ], data: "dec", searchable: true },
							{ targets: [ 19 ], data: "description", searchable: true, visible: false }
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
							columns = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#tstnamefoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
					});
	        	});
			});
		});

		$('#fimport').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Importing Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PubSub/postImport',
		        type: 'POST',
		        data: { },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		// var oTable = $('#tdefault').DataTable();
						// oTable.ajax.reload(null, false);
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		var txtMessage;
		        		if (data.responseJSON.ErrType == "Duplicate") 
		        			{ txtMessage = 'Record already existed!';  }
		        		else if (data.responseJSON.ErrType == "Failed")
		        			{ txtMessage = 'Please check your entry!'; }
		        		else if (data.responseJSON.ErrType == "CannotUpdate")
		        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
		        		else { txtMessage = 'Please check your entry!'; }
		        		noty({
							layout: 'topRight', type: 'error', text: txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
		        	}
		        }
		    });
		    e.preventDefault();
	    });

		$('#fstatsupdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PubSub/postStatsUpdate',
		        type: 'POST',
		        data: { },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		// var oTable = $('#tdefault').DataTable();
						// oTable.ajax.reload(null, false);
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		var txtMessage;
		        		if (data.responseJSON.ErrType == "Duplicate") 
		        			{ txtMessage = 'Record already existed!';  }
		        		else if (data.responseJSON.ErrType == "Failed")
		        			{ txtMessage = 'Please check your entry!'; }
		        		else if (data.responseJSON.ErrType == "CannotUpdate")
		        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
		        		else { txtMessage = 'Please check your entry!'; }
		        		noty({
							layout: 'topRight', type: 'error', text: txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
		        	}
		        }
		    });
		    e.preventDefault();
	    });
	</script>
@stop