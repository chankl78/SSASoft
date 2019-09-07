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
			<li class="active"><a href="{{{ URL::action('LeadersPortalEventPastListingController@getIndex') }}}">Past Events</a></li>
			<li class="active">{{ $eventname }}</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Past Event<small><i class="ace-icon fa fa-angle-double-right"></i> {{ $eventname }}</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@if ($gakkaidistrict == 't' or $gakkaichapter == 't' or $gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
					<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">{{ $eventname }}</h5>
								<div class="widget-toolbar">
									<a href="#" data-action="fullscreen" class="orange2">
										<i class="ace-icon fa fa-expand"></i>
									</a>
									<a href="#" data-action="reload" onClick=reloaddt()>
										<i class="fa fa-refresh"></i>
									</a>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
									</div>
								</div>
								<div class="widget-main">
									<table id="tdistrict" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Created At</th>
												<th>Name</th>
												<th>名字</th>
												<th>RHQ</th>
												<th>Zone</th>
												<th>Chapter</th>
												<th>District</th>
												<th>Division</th>
												<th>Position</th>
												<th>Status</th>
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
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
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

				var oDistrictTable = $('#tdistrict').DataTable({
					dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
					displayLength: 10, // Default No of Records per page on 1st load
					lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
					pagingType: "first_last_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					deferRender: true,
					processing: false,
					serverSide: false,
					searching: true,
					@if ($readonly == 0)
						order: [[2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [7, "asc"], [0, "asc"]],
					@else
						order: [[3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [7, "asc"], [8, "asc"], [1, "asc"]],
					@endif
					ajax: 'getEventParticipant/{{ $rid }}',
					columnDefs: [
						@if ($readonly == 0)
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: -1 },
							{ responsivePriority: 4, targets: -2 },
							{ responsivePriority: 5, targets: -3 },
						@else
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: 7 },
							{ responsivePriority: 4, targets: 8 },
							{ responsivePriority: 5, targets: 9 },
						@endif
						{
							targets: [ 0 ], data: "created_at", width: "170px", searchable: "true",
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
						{
							targets: [ 9 ], data: "status",
							render: function ( data, type, full ){
								if (data === 'Rejected'){
									return '<span class="label label-danger arrowed-in">'+data+'</span>';
								}
								else if (data === 'Accepted'){
									return '<span class="label label-success arrowed">'+data+'</span>';
								}
								else if (data === 'Pending'){
									return '<span class="label label-yellow arrowed">'+data+'</span>';
								}
								else if (data === 'Processing'){
									return '<span class="label label-info">'+data+'</span>';
								}
								else if (data === 'Reserved'){
									return '<span class="label label-purple">'+data+'</span>';
								}
								else if (data === 'Withdrawn'){
									return '<span class="label label-inverse">'+data+'</span>';
								}
								else if (data === 'Interested'){
									return '<span class="label label-pink">'+data+'</span>';
								}
							}
						}
					]
				});
			});
		});

	    function reloaddt(submit){ 
	    	var oDistrictTable = $('#tdistrict').DataTable();
		    oDistrictTable.ajax.reload(null, false);
	    }
	</script>
@stop