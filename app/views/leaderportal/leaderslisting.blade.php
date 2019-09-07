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
			<li class="active"><a href="{{{ URL::action('LeadersPortalLeadersController@getIndex') }}}">Leaders Listing</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Leaders<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@if ($gakkaishq == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Leaders Listing (SHQ)</h5>
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
									<table id="tshq" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
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
									<div class="col-xs-12">
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
				@if ($gakkairegion == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Leaders Listing (RHQ)</h5>
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
												<th class="hidden-480">Name</th>
												<th class="hidden-480">名字</th>
												<th class="hidden-480">RHQ</th>
												<th class="hidden-480">Zone</th>
												<th class="hidden-480">Chapter</th>
												<th class="hidden-480">District</th>
												<th class="hidden-480">Division</th>
												<th class="hidden-480">Position</th>
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
				@endif
				@if ($gakkaizone == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Leaders Listing (Zone)</h5>
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
									<table id="tzone" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="hidden-480">Name</th>
												<th class="hidden-480">名字</th>
												<th class="hidden-480">RHQ</th>
												<th class="hidden-480">Zone</th>
												<th class="hidden-480">Chapter</th>
												<th class="hidden-480">District</th>
												<th class="hidden-480">Division</th>
												<th class="hidden-480">Position</th>
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
				@endif
				@if ($gakkaichapter == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Leaders Listing (Chapter)</h5>
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
									<table id="tchapter" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="hidden-480">Name</th>
												<th class="hidden-480">名字</th>
												<th class="hidden-480">RHQ</th>
												<th class="hidden-480">Zone</th>
												<th class="hidden-480">Chapter</th>
												<th class="hidden-480">District</th>
												<th class="hidden-480">Division</th>
												<th class="hidden-480">Position</th>
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
				@endif
				@if ($gakkaidistrict == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Leaders Listing (District)</h5>
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
												<th class="hidden-480">Name</th>
												<th class="hidden-480">名字</th>
												<th class="hidden-480">RHQ</th>
												<th class="hidden-480">Zone</th>
												<th class="hidden-480">Chapter</th>
												<th class="hidden-480">District</th>
												<th class="hidden-480">Division</th>
												<th class="hidden-480">Position</th>
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
				@endif
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript">	
		$(document).ready(function () {
			$(function() {
				@if ($gakkaishq == 't')
					var oSHQTable = $('#tshq').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": true,
				        "scrollCollapse": true,
				        "processing": false,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 2, "asc" ],[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 0, "asc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalLeaders/getLeadersListingSHQ',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
			            	{ "targets": [ 0 ], "data": "name", "searchable": "true" },
			            	{ "targets": [ 1 ], "data": "chinesename", "searchable": "true" },
					    	{ "targets": [ 2 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "district", "searchable": "true" },
					    	{ "targets": [ 6 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 7 ], "data": "position", "searchable": "true" }
					    ]
				    });
				@endif

				@if ($gakkairegion == 't')
					var oRHQTable = $('#trhq').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": true,
				        "scrollCollapse": true,
				        "processing": false,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 2, "asc" ],[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 0, "asc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalLeaders/getLeadersListingRHQ',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
			            	{ "targets": [ 0 ], "data": "name", "searchable": "true" },
			            	{ "targets": [ 1 ], "data": "chinesename", "searchable": "true" },
					    	{ "targets": [ 2 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "district", "searchable": "true" },
					    	{ "targets": [ 6 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 7 ], "data": "position", "searchable": "true" }
					    ]
				    });
				@endif

				@if ($gakkaizone == 't')
					var oZoneTable = $('#tzone').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": true,
				        "scrollCollapse": true,
				        "processing": false,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 2, "asc" ],[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 0, "asc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalLeaders/getLeadersListingZone',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
			            	{ "targets": [ 0 ], "data": "name", "searchable": "true" },
			            	{ "targets": [ 1 ], "data": "chinesename", "searchable": "true" },
					    	{ "targets": [ 2 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "district", "searchable": "true" },
					    	{ "targets": [ 6 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 7 ], "data": "position", "searchable": "true" }
					    ]
				    });
				@endif

				@if ($gakkaichapter == 't')
					var oChapterTable = $('#tchapter').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": true,
				        "scrollCollapse": true,
				        "processing": false,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 2, "asc" ],[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 0, "asc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalLeaders/getLeadersListingChapter',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
			            	{ "targets": [ 0 ], "data": "name", "searchable": "true" },
			            	{ "targets": [ 1 ], "data": "chinesename", "searchable": "true" },
					    	{ "targets": [ 2 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "district", "searchable": "true" },
					    	{ "targets": [ 6 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 7 ], "data": "position", "searchable": "true" }
					    ]
				    });
				@endif

				@if ($gakkaidistrict == 't')
					var oDistrictTable = $('#tdistrict').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": true,
				        "scrollCollapse": true,
				        "processing": false,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 2, "asc" ],[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 0, "asc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalLeaders/getLeadersListingDistrict',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
			            	{ "targets": [ 0 ], "data": "name", "searchable": "true" },
			            	{ "targets": [ 1 ], "data": "chinesename", "searchable": "true" },
					    	{ "targets": [ 2 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "district", "searchable": "true" },
					    	{ "targets": [ 6 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 7 ], "data": "position", "searchable": "true" }
					    ]
				    });
				@endif
			});
		});
	</script>
@stop