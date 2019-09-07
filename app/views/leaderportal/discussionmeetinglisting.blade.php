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
			<li class="active"><a href="{{{ URL::action('LeadersPortalDiscussionMeetingListingController@getIndex') }}}">Discussing Meeting Attendance Listing</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Discussion Meeting Attendance Listing<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Discussion Meeting Attendance Listing</h5>
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
											<th>Date</th>
											<th>Description</th>
											<th>Mbship</th>
											<th>MD</th>
											<th>WD</th>
											<th>YMD</th>
											<th>YWD</th>
											<th>PD</th>
											<th>YC</th>
											<th>Total</th>
											<th>Ldr</th>
											<th>Mem</th>
											<th>Bel</th>
											<th>NF</th>
											<th>Action</th>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chapter</th>
											<th>District</th>
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
					pagingType: "first_last_numbers",
					responsive: true,
					processing: false,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: false,
					serverSide: false,
					searching: true,
					order: [[ 0, "desc" ], [ 1, "asc" ]],
					ajax: 'BOEPortalDiscussionMeetingListing/getDiscussionMeetingListingSummary/',
					columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 14 },
						{ responsivePriority: 3, targets: 9 },
						{ responsivePriority: 4, targets: 2 },
						{ responsivePriority: 5, targets: 13 },
						{
							targets: [ 0 ], data: "attendancedate", searchable: true, visible: false,
							render: function ( data, type, full ){
								return moment(data).format("YYYY-MM-DD");
							}
						},
						{ targets: [ 1 ], data: "description", searchable: true },
						{ targets: [ 2 ], data: "tokangmembership", searchable: true },
						{ targets: [ 3 ], data: "md", searchable: true },
						{ targets: [ 4 ], data: "wd", searchable: true },
						{ targets: [ 5 ], data: "ymd", searchable: true },
						{ targets: [ 6 ], data: "ywd", searchable: true },
						{ targets: [ 7 ], data: "pd", searchable: true },
						{ targets: [ 8 ], data: "yc", searchable: true },
						{ targets: [ 9 ], data: "attendancetotal", searchable: true },
						{ targets: [ 10 ], data: "ldr", searchable: true },
						{ targets: [ 11 ], data: "mem", searchable: true },
						{ targets: [ 12 ], data: "bel", searchable: true },
						{ targets: [ 13 ], data: "nf", searchable: true },
						{
							targets: [ 14 ], data: "uniquecode",
							render: function ( data, type, full ){
								return '<button type="submit" onClick=editrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button>'
							}
						},
						{ targets: [ 15 ], data: "rhq", searchable: true, visible: false },
						{ targets: [ 16 ], data: "zone", searchable: true, visible: false },
						{ targets: [ 17 ], data: "chapter", searchable: true, visible: false },
						{ targets: [ 18 ], data: "district", searchable: true, visible: false }
					]
				});
			});
		});

		function editrow(submit){ 
			var RowID = "";
			var oDistrictTable = $('#tdistrict').DataTable();
			$("#tdistrict tbody tr").click(function () {
				var position = oDistrictTable.row(this).index();
				RowID = oDistrictTable.row(position).data();
				$.ajax({
					url: 'BOEPortalDiscussionMeetingListing/postdistrictattendees',
					type: 'POST',
					data: { id: submit },
					dataType: 'json',
					statusCode: { 
						200:function(){
							window.location.href = "BOEPortalDiscussionMeeting/" + submit;
						},
						400:function(data){ 
							var txtMessage = 'Please check your entry!!';
							$("#erole").focus();
							noty({
								layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
						}
					}
				});
			});
	    }
	</script>
@stop