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
			<li class="active"><a href="{{{ URL::action('LeadersPortalEventListingController@getIndex') }}}">Event Registration</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Events<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Event Registration Listing</h5>
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
											<th>Date</th>
											<th>Event Type</th>
											<th>Description</th>
											<th>Location</th>
											<th>Status</th>
											<th>Action</th>
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
		function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                window.location.href = "BOEPortalEvent/" + submit;
            });
	    }
	</script>
	<script type="text/javascript">	
		$(document).ready(function () {
			$.mask.definitions['~']='[+-]';
			$('.input-mask-date').mask('99-99-9999');

			$(function() {
				var oTable = $('#tdefault').DataTable({
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
					deferRender: true,
					order: [[0, "DESC"]],
					ajax: 'BOEPortalEventListing/getEventListing',
					columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: -1 },
						{ responsivePriority: 3, targets: 2 },
						{
							targets: [ 0 ], data: "eventdate", width: "150px", searchable: true,
							render: function ( data, type, full ){
								return moment(data).format("YYYY-MM-DD");
							}
						},
						{ targets: [ 1 ], data: "eventtype", searchable: true },
						{ targets: [ 2 ], data: "description", searchable: true },
						{ targets: [ 3 ], data: "location", searchable: true },
						{ 
							targets: [ 4 ], data: "status", searchable: true,
							render: function ( data, type, full ){
								if (data === 'Void'){
									return '<span class="label label-danger arrowed-in">'+data+'</span>';
								}
								else if (data === 'Active'){
									return '<span class="label label-success arrowed">'+data+'</span>';
								}
								else if (data === 'Closed'){
									return '<span class="label label-info">'+data+'</span>';
								}
							}
						},
						{
							targets: [ 5 ], data: "uniquecode",
							render: function ( data, type, full ){
								return '<a href="#resourceedit" role="button" onClick=editrow("'+ data +'") class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> '
							}
						}]
			    });
			});
		});
	</script>
@stop