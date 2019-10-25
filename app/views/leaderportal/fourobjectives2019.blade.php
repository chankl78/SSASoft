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
			<h1>2019 4 Objectives <small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">2019 4 Objectives</h5>
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
											<th>Rhq</th>
											<th>Zone</th>
											<th>Chap</th>
											<th>Dist</th>
											<th>4 Goals</th>
											<th>3 Goals</th>
											<th>2 Goals</th>
											<th>1 Goal</th>
											<th>0 Goal</th>
											<th>DM Target</th>
											<th>DM Actual</th>
											<th>Exam Target</th>
											<th>Exam Actual</th>
											<th>BOE Target</th>
											<th>BOE Actual</th>
											<th>YS Target</th>
											<th>YS Actual</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
							</div>
						</div>
					</div>
				</div>
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
			$(function() {
				var oTable = $('#tdefault').DataTable({
					dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
			        displayLength: 100, // Default No of Records per page on 1st load
			        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        pagingType: "first_last_numbers",
			        responsive: false,
			        stateSave: true, // Remember paging & filters
			        autoWidth: false,
			        paging: true,
			        scrollCollapse: true,
			        processing: false,
			        serverSide: false,
			        deferRender: true,
			        order: [[0, "asc"]],
			        ajax: 'BOEPortal20194Objects/getListing',
			        columnDefs: [
			        	{ targets: [ 0 ], data: "rhq", searchable: true },
						{ targets: [ 1 ], data: "zone", searchable: true },
						{ targets: [ 2 ], data: "chapter", searchable: true },
						{ targets: [ 3 ], data: "district", searchable: true },
						{ targets: [ 4 ], data: "4goal", searchable: true },
						{ targets: [ 5 ], data: "3goal", searchable: true },
						{ targets: [ 6 ], data: "2goal", searchable: true },
						{ targets: [ 7 ], data: "1goal", searchable: true },
						{ targets: [ 8 ], data: "0goal", searchable: true },
						{ targets: [ 9 ], data: "dmtarget", searchable: true },
						{ targets: [ 10 ], data: "dmactual", searchable: true },
						{ targets: [ 11 ], data: "setarget", searchable: true },
						{ targets: [ 12 ], data: "seactual", searchable: true },
						{ targets: [ 13 ], data: "boetarget", searchable: true },
						{ targets: [ 14 ], data: "boeactual", searchable: true },
						{ targets: [ 15 ], data: "ystarget", searchable: true },
						{ targets: [ 16 ], data: "ysactual", searchable: true }
				    ]
			    });
			});
		});
	</script>
@stop