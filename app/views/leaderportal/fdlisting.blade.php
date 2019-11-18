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
			<li class="active"><a href="{{{ URL::action('LeadersPortalFDController@getIndex') }}}">Youth List (Age 13 to 17)</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Youth List (Age 13 to 17)<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Youth Listing (Age 13 to 17)</h5>
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
								<table id="tdistrict" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Create</th>
											<th>Name</th>
											<th>名字</th>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chapter</th>
											<th>District</th>
											<th>Division</th>
											<th>Position</th>
											<th>Age</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								<div class="col-xs-12">
								</div>
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
	<script type="text/javascript">	
		$(document).ready(function () {
			$(function() {
				var oDistrictTable = $('#tdistrict').DataTable({
					dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 10, // Default No of Records per page on 1st load
					lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "full_numbers",
					responsive: true,
					processing: false,
					stateSave: true, // Remember paging & filters
					autoWidth: true,
					scrollCollapse: true,
					serverSide: false,
					searching: true,
					order: [[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 8, "asc" ],[ 1, "asc" ]],
					ajax: 'BOEPortalFDListing/getListing',
					columnDefs: [
						{ responsivePriority: 1, targets: 1 },
						{ responsivePriority: 2, targets: 5 },
						{ responsivePriority: 3, targets: 6 },
						{ responsivePriority: 4, targets: 9 },
						{
							targets: [ 0 ], data: "created_at", "width": "100px", searchable: true,
							render: function ( data, type, full ){
								return moment(data).format("DD-MMM-YYYY HH:mm:ss");
							}
						},
						{ targets: [ 1 ], data: "name", searchable: true },
						{ targets: [ 2 ], data: "chinesename", searchable: true },
						{ targets: [ 3 ], data: "rhq", searchable: true },
						{ targets: [ 4 ], data: "zone", searchable: true },
						{ targets: [ 5 ], data: "chapter", searchable: true },
						{ targets: [ 6 ], data: "district", searchable: true },
						{ targets: [ 7 ], data: "division", searchable: true },
						{ targets: [ 8 ], data: "position", searchable: true },
						{ targets: [ 9 ], data: "age", searchable: true }
					]
				});
			});
		});
	</script>
@stop