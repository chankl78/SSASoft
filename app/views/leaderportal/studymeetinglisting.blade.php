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
				@if ($gakkaidistrict == 't')
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
												<th class="hidden-480">Date</th>
												<th class="hidden-480">Description</th>
												<th class="hidden-480">RHQ</th>
												<th class="hidden-480">Zone</th>
												<th class="hidden-480">Chapter</th>
												<th class="hidden-480">District</th>
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
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript">	
		$(document).ready(function () {
			$(function() {
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
				        "order": [[ 0, "desc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDiscussionMeetingListing/getDiscussionMeetingListingDistrict',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
			            	{
						    	"targets": [ 0 ], "data": "attendancedate", "width": "150px", "searchable": "true",
						    	"render": function ( data, type, full ){
						    		return moment(data).format("MMM-YYYY");
							    }
					    	},
			            	{ "targets": [ 1 ], "data": "description", "searchable": "true" },
					    	{ "targets": [ 2 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "district", "searchable": "true" },
					    	{
						    	"targets": [ 6 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=editrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button>'
							    }
					    	}
					    ]
				    });
				@endif
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