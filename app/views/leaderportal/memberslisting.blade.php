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
			<li class="active"><a href="{{{ URL::action('LeadersPortalMembersController@getIndex') }}}">Members List</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Members List<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@if ($gakkaishq == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Members List (SHQ)</h5>
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
												<th>Action</th>
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
								<h5 class="widget-title">Members List (RHQ)</h5>
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
												<th class="hidden-480">Action</th>
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
								<h5 class="widget-title">Members List (Zone)</h5>
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
												<th class="hidden-480">Action</th>
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
								<h5 class="widget-title">Members List (Chapter)</h5>
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
												<th class="hidden-480">Action</th>
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
								<h5 class="widget-title">Members List (District)</h5>
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
												<th class="hidden-480">Action</th>
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
				<div id="btnmeminfo" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('id' => 'fmeminfo', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Member Information</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div class="col-sm-12 widget-container-col">
												<div class="widget-box transparent">
													<div class="widget-header">
														<h4 class="widget-title lighter"></h4>
														<div class="widget-toolbar no-border">
															<ul class="nav nav-tabs" id="tabmemberinfo">
																<li>
																	<a data-toggle="tab" href="#mmeetingattended">Meeting Attended</a>
																</li>
															</ul>
														</div>
													</div>
													<div class="widget-body">
														<div class="widget-main padding-12 no-padding-left no-padding-right">
															<div class="tab-content padding-4">
																<div id="mmeetingattended" class="tab-pane in active">
																	<div class="scrollable" data-size="100">
																		<table id="tgroup" class="table table-striped table-bordered table-hover">
																			<thead>
																				<tr>
																					<th class="hidden-480">Date</th>
																					<th class="hidden-480">Event</th>
																				</tr>
																			</thead>
																			<tbody>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn btn-sm" data-dismiss="modal" id="close">
											<i class="icon-remove"></i>
											Close
										</button>
									</div>
								</fieldset>
							{{ Form::close() }}
						</div>
					</div>
				</div> <!-- Edit Believer Info -->
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
					var oShqTable = $('#tshq').DataTable({
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
				            url: 'BOEPortalMembers/getMembersListingSHQ',
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
					    	{ "targets": [ 7 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 8 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-puzzle-piece bigger-120"></i></button>'
							    }
					    	}
					    ]
				    });
				@endif

				@if ($gakkairegion == 't')
					var oRhqTable = $('#trhq').DataTable({
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
				            url: 'BOEPortalMembers/getMembersListingRHQ',
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
					    	{ "targets": [ 7 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 8 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-puzzle-piece bigger-120"></i></button>'
							    }
					    	}
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
				            url: 'BOEPortalMembers/getMembersListingZone',
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
					    	{ "targets": [ 7 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 8 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-puzzle-piece bigger-120"></i></button>'
							    }
					    	}
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
				            url: 'BOEPortalMembers/getMembersListingChapter',
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
					    	{ "targets": [ 7 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 8 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-puzzle-piece bigger-120"></i></button>'
							    }
					    	}
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
				            url: 'BOEPortalMembers/getMembersListingDistrict',
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
					    	{ "targets": [ 7 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 8 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-puzzle-piece bigger-120"></i></button>'
							    }
					    	}
					    ]
				    });
				@endif
			});
		});

		function memberinforow(submit){ 
			$.ajax({
		        url: '/BOEPortalMembers/getMembersInfo/' + submit,
		        type: 'GET',
		        data: { value: submit },
		        dataType: 'json',
		        statusCode: {
		        	200:function(data){
		        		var oGroupTable = $('#tgroup').DataTable();
		        		oGroupTable.destroy();
		        		oGroupTable = $('#tgroup').DataTable({
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
					        "order": [[ 0, "desc" ]],
					        "ajax": $.fn.dataTable.pipeline({
					            url: '/BOEPortalMembers/getMembersInfo/' + submit,
					            pages: 5 // number of pages to cache
					        }),
					        "columnDefs": [
					        {
						    	"targets": [ 0 ], "data": "attendancedate", "width": "150px", "searchable": "true",
						    	"render": function ( data, type, full ){
						    		return moment(data).format("DD-MMM-YYYY");
							    }
					    	},
					    	{ "targets": [ 1 ], "data": "description", "searchable": "true" }]
					    }); // Group Members for Individual Person


						$("#btnmeminfo").modal('show');
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Retrieve Data!! ' + txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
			$("#btnmeminfo").modal('show');
	    }
	</script>
@stop