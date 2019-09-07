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
			<li class="active"><a href="{{{ URL::action('LeadersPortalDiscussionMeetingListingController@getIndex') }}}">Discussing Meeting Listing</a></li>
			<li class="active">{{ $dmname }}</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Discussion Meeting<small><i class="ace-icon fa fa-angle-double-right"></i> {{ $dmname }}</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@if ($gakkaidistrict == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">{{ $dmname }}</h5>
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
								<div class="widget-main">
									<table id="tdistrict" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="hidden-480">Name</th>
												<th class="hidden-480">Division</th>
												<th class="hidden-480">Position</th>
												<th class="hidden-480">Status</th>
												<th class="hidden-480">Action</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
										<a href="#btnresourceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add Friend Attendance</a>
										<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
										<a href="#btnseniorldrsadd" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add SRZC Attendance</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">{{ $dmname }} - Statistic</h5>
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
								<div class="widget-main">
									<table id="tdistrictstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="hidden-480">Division</th>
												<th class="hidden-480">Leaders</th>
												<th class="hidden-480">Members</th>
												<th class="hidden-480">Believers</th>
												<th class="hidden-480">New Friends</th>
												<th class="hidden-480">Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<!-- <tfoot id="tdmstatsfoot">
											<tr>
								                <th>Total</th><th></th><th></th><th></th><th></th><th></th>
								            </tr>
										</tfoot> -->
									</table>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="btnresourceadd" class="modal" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								{{ Form::open(array('action' => 'LeadersPortalDiscussionMeetingController@postNewAttendee', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
									<fieldset>
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="blue bigger">Add Record</h4>
										</div>
										<div class="modal-body overflow-visible">
											<div class="row">
												<div class="form-group">
													{{ Form::label('name', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('name', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'name'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::select('position', $memposition_options, 'NF', array('class' => 'col-xs-12 col-sm-11', 'id' => 'position'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('division', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::select('division', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'division'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('introducer', 'Introducer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('introducer', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'introducer'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('remarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::textarea('remarks', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'remarks', 'rows'=>'3'));}}
														</div>
													</div>
												</div>
												<div class="form-group" hidden>
													{{ Form::label('uniquecode', 'UniqueCode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('uniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'uniquecode'));}}
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-sm" data-dismiss="modal" id="btnclose">
												<i class="icon-remove"></i>
												Cancel
											</button>
											{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourceadd')); }}
										</div>
									</fieldset>
								{{ Form::close() }}
							</div>
						</div>
					</div>
					<div id="btnseniorldrsadd" class="modal" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								{{ Form::open(array('action' => 'LeadersPortalDiscussionMeetingController@postNewAttendee', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
									<fieldset>
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="blue bigger">Add Senior Leaders Attendance</h4>
										</div>
										<div class="modal-body overflow-visible">
											<div class="row">
												<div class="form-group">
													{{ Form::label('md', 'MD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('md', '0', array('class' => 'col-xs-12 col-sm-11', 'id' => 'md'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('wd', 'WD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('wd', '0', array('class' => 'col-xs-12 col-sm-11', 'id' => 'wd'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('ymd', 'YMD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('ymd', '0', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ymd'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('ywd', 'YWD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('ywd', '0', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ywd'));}}
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-sm" data-dismiss="modal" id="btnclose">
												<i class="icon-remove"></i>
												Cancel
											</button>
											{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'seniorldrsadd')); }}
										</div>
									</fieldset>
								{{ Form::close() }}
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

				@if ($gakkaidistrict == 't')
					var oDistrictTable = $('#tdistrict').DataTable({
				        "displayLength": 100, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 1, "asc" ], [2, "asc"], [0, "asc"]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'getDiscussionMeetingAttendees/{{ $rid }}',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
			            	{ "targets": [ 0 ], "data": "name", "searchable": "true" },
					    	{ "targets": [ 1 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 2 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 3 ], "data": "attendancestatus",
						    	"render": function ( data, type, full ){
								    if (data === "Absent"){
								    	return '';
								    }
								  	else if (data === "Attended"){
								    	return '<span class="label label-success arrowed">'+data+'</span>';
								    }
					    		}
				    		},
					    	{
						    	"targets": [ 4 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=attendrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-thumbs-up bigger-120"></i></button> <button type="submit" onClick=absentrow("'+ data +'") class="btn btn-xs btn-warning"><i class="fa fa-thumbs-down bigger-120"></i></button>'
							    }
					    	}
					    ]
				    });
					
					var oDistrictStats = $('#tdistrictstats').DataTable({
				        "displayLength": 25, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": false,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'getdistrictstatsListing/{{ $rid }}',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "division" },
					    	{ "targets": [ 1 ], "data": "LDR" },
					    	{ "targets": [ 2 ], "data": "MEM"  },
					    	{ "targets": [ 3 ], "data": "BEL" },
					    	{ "targets": [ 4 ], "data": "NF" },
					    	{ "targets": [ 5 ], "data": "Total" }]
				    }); // Discussion Meeting Attendance Statistic
				@endif
			});

			$('#resourceadd').submit(function(e){
		    	$.ajax({
			        url: 'postNewAttendee/{{ $rid }}',
			        type: 'POST',
			        data: { name: $("#name").val(), position: $("#position").val(), division: $("#division").val(), id: "{{ $rid }}", introducer: $("#introducer").val(), remarks: $("#remarks").val()},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oDistrictTable = $('#tdistrict').DataTable();
		        			oDistrictTable.clearPipeline().draw();
		        			var oDistrictStats = $('#tdistrictstats').DataTable();
		    				oDistrictStats.clearPipeline().draw();
			        		$("#name").val(''); $("#position").val(''); $("#division").val('');
			        		$("#btnresourceadd").modal('hide');
	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Created!!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	},
			        	400:function(data){ 
			        		var txtMessage;
			        		if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Record already existed!'; }
			        		else if (data.responseJSON.ErrType == "Failed")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else { txtMessage = 'Please check your entry!'; }
			        		$("#description").focus();
			        		noty({
								layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							});
			        	}
			        }
			    });
			    e.preventDefault();
		    });

			$('#seniorldrsadd').submit(function(e){
		    	$.ajax({
			        url: 'postNewAttendee/{{ $rid }}',
			        type: 'POST',
			        data: { md: $("#md").val(), wd: $("#wd").val(), ymd: $("#ymd").val(), id: "{{ $rid }}", ywd: $("#ywd").val()},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oDistrictTable = $('#tdistrict').DataTable();
		        			oDistrictTable.clearPipeline().draw();
		        			var oDistrictStats = $('#tdistrictstats').DataTable();
		    				oDistrictStats.clearPipeline().draw();
			        		$("#md").val(''); $("#wd").val(''); $("#ymd").val('');
			        		$("#btnseniorldrsadd").modal('hide');
	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Created!!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	},
			        	400:function(data){ 
			        		var txtMessage;
			        		if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Record already existed!'; }
			        		else if (data.responseJSON.ErrType == "Failed")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else { txtMessage = 'Please check your entry!'; }
			        		$("#description").focus();
			        		noty({
								layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							});
			        	}
			        }
			    });
			    e.preventDefault();
		    });
		});

		function absentrow(submit){ 
			$.ajax({
		        url: 'putAbsentAttendee/' + submit,
		        type: 'POST',
		        data: { absent: submit },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oDistrictTable = $('#tdistrict').DataTable();
		        		oDistrictTable.clearPipeline().draw();
		        		var otdistrictstats = $('#tdistrictstats').DataTable();
		    			otdistrictstats.clearPipeline().draw();
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		if (data.responseJSON.ErrType == "NoAccess") 
	        			{ txtMessage = 'You do not have access to Update!'; }
		        		else { txtMessage = 'Please check your entry!'; }
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
	    }

	    function attendrow(submit){ 
			$.ajax({
		        url: 'putAttendedAttendee/' + submit,
		        type: 'POST',
		        data: { attended: submit },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oDistrictTable = $('#tdistrict').DataTable();
		        		oDistrictTable.clearPipeline().draw();
		        		var otdistrictstats = $('#tdistrictstats').DataTable();
		    			otdistrictstats.clearPipeline().draw();
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		if (data.responseJSON.ErrType == "NoAccess") 
	        			{ txtMessage = 'You do not have access to Update!'; }
		        		else { txtMessage = 'Please check your entry!'; }
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
	    }

	    function reloaddt(submit){ 
	    	var oDistrictTable = $('#tdistrict').DataTable();
		    oDistrictTable.clearPipeline().draw();
		    var oDistrictStats = $('#tdistrictstats').DataTable();
		    oDistrictStats.clearPipeline().draw();
	    }
	</script>
@stop