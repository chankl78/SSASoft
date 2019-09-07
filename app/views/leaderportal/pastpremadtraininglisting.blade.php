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
			<h1>Past Pre M&D Training Attendance<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Past Pre M&D Training Attendance Listing</h5>
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
											<th>Description</th>
											<th>Name</th>
											<th>名字</th>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chapter</th>
											<th>District</th>
											<th>Division</th>
											<th>Position</th>
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
			        responsive: true,
			        stateSave: true, // Remember paging & filters
			        autoWidth: false,
			        paging: true,
			        scrollCollapse: true,
			        processing: false,
			        serverSide: false,
			        deferRender: true,
			        order: [[3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [7, "asc"], [1, "asc"]],
			        ajax: 'BOEPortalPastPreMADTrainingListing/getListing',
			        columnDefs: [
			        	{ responsivePriority: 1, targets: 0 },
			        	{ responsivePriority: 2, targets: 1 },
			        	{ responsivePriority: 3, targets: -1 },
            			{ responsivePriority: 4, targets: -2 },
            			{ responsivePriority: 5, targets: -3 },
						{ targets: [ 0 ], data: "description", searchable: true },
		            	{ targets: [ 1 ], data: "name", searchable: true },
		            	{ targets: [ 2 ], data: "chinesename", searchable: true },
						{ targets: [ 3 ], data: "rhq", searchable: true },
						{ targets: [ 4 ], data: "zone", searchable: true },
		            	{ targets: [ 5 ], data: "chapter", searchable: true },
		            	{ targets: [ 6 ], data: "district", searchable: true },
				    	{ targets: [ 7 ], data: "division", searchable: true },
				    	{ targets: [ 8 ], data: "position", searchable: true }
				    ]
			    });
			});
		});
	</script>
@stop