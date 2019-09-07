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
			<li class="active">Dashboard</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		@include('layout/skin')
		<div class="page-header">
			<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@if($RGACRI == 't')
					<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Recent Activities</h5>
								<div class="widget-toolbar">
									<a href="#" data-action="fullscreen" class="orange2">
										<i class="ace-icon fa fa-expand"></i>
									</a>
									<a href="#" data-action="reload">
										<i class="fa fa-refresh"></i>
									</a>

									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-up"></i>
									</a>
									<a href="#" data-action="close">
										<i class="ace-icon fa fa-times"></i>
									</a>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main no-padding">
									<table id="tUserLogs" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="hidden-480">Date</th>
												<th class="hidden-480">Log Type</th>
												<th class="hidden-480">Description</th>
												<th class="hidden-480">ip Address</th>
												<th class="hidden-480">Session ID</th>
												<th class="hidden-480">Status</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
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
		$(function() {
			@if($RGACRI == 't')
				var oTable = $('#tUserLogs').DataTable({
			        "displayLength": 10, // Default No of Records per page on 1st load
			        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        "pagingType": "full_numbers",
			        "responsive": false,
			        "stateSave": true, // Remember paging & filters
			        "autoWidth": true,
			        "scrollCollapse": true,
			        "processing": false,
			        "serverSide": true,
			        "searching": true,
			        "order": [[ 0, "desc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'Dashboard/userlogs',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	                	{
					    	"targets": [ 0 ], "data": "created_at", "width": "200px", "searchable": "true",
					    	"render": function ( data, type, full ){
					    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
						    }
				    	},
				    	{
					    	"targets": [ 1 ], "data": "logtype", "width": "100px", "searchable": "true"
				    	},
				    	{
					    	"targets": [ 2 ], "data": "description", "searchable": "true",
					    	"render": function ( data, type, full ){
					    		return data.substring(0, 200) + ' ...';
						    }
				    	},
				    	{
					    	"targets": [ 3 ], "data": "ipaddress", "searchable": "true"
				    	},
				    	{
					    	"targets": [ 4 ], "data": "session", "searchable": "true",
					    	"render": function ( data, type, full ){
					    		return data.substring(0, 10) + ' ...';
						    }
				    	},
				    	{
					    	"targets": [ 5 ], "data": "status", "searchable": "true",
					    	"render": function ( data, type, full ){
							    if (data === 'Failed'){
							    	return '<span class="label label-danger arrowed-in">'+data+'</span>';
							    }
							  	else if (data === 'Success'){
							    	return '<span class="label label-success arrowed">'+data+'</span>';
							    }
				    		}
			    		}
				    ]
			    });
			@endif
		});
	</script>
@stop