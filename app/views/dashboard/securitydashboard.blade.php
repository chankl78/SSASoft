@extends('layout.securitymaster')

@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i><a href="{{{ URL::action('SecurityDashboardController@getIndex') }}}">Home</a>
			</li>
			<li class="active">Security Dashboard</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		@include('layout/securityskin')
		<div class="page-header">
			<h1>Security Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
					<div class="widget-box widget-color-green">
						<div class="widget-header widget-header-small">
							<h6 class="widget-title">
								<i class="icon-sort"></i>
								Security Sign In
							</h6>
							<div class="widget-toolbar">
								<a href="#" data-action="fullscreen" class="orange2">
									<i class="ace-icon fa fa-expand"></i>
								</a>
								<a href="#" data-action="reload">
									<i class="fa fa-refresh"></i>
								</a>
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-down"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main no-padding">
								{{ Form::open(array('action' => 'SecurityDashboardController@postNricSearch', 'id' => 'resourcenricesearch', 'class' => 'form-horizontal')) }}
									<br />
									<div class="form-group">
										{{ Form::label('shifttype', 'Shift:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('shifttype', $shifttype_options, 'Evening', array('class' => 'col-xs-12 col-sm-9', 'id' => 'shifttype'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('nricsearch', 'Search (NRIC):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('nricsearch', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'nricsearch'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										<div class="col-md-offset-5 col-xs-12 col-sm-12">
											<div class="clearfix">
												{{ Form::button('<i class="fa fa-search fa fa-on-right"></i> Sign In', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
											</div>
										</div>
									</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div> <!-- Attendance Sign In -->
				<div id="attendance" class="tab-pane">
					<div class="col-xs-12 col-sm-8 widget-container-col ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Attendance</h5>
								<div class="widget-toolbar">
									<a href="#" data-action="reload">
										<i class="fa fa-refresh"></i>
									</a>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<table id="tattendance" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="hidden-480">Login</th>
												<th class="hidden-480">Centre</th>
												<th class="hidden-480">Shift</th>
												<th class="hidden-480">Name</th>
												<th class="hidden-480">Logout</th>
												<th class="hidden-480">Action</th>
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
				</div> <!-- Attendance Listing for Current Date -->
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Occurance</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<table id="toccurance" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th class="hidden-480">Date</th>
											<th class="hidden-480">Centre</th>
											<th class="hidden-480">Type</th>
											<th class="hidden-480">Name</th>
											<th class="hidden-480">Status</th>
											<th class="hidden-480">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								<a href="#btnresourceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add</a>
							</div>
						</div>
					</div>
				</div> <!-- Security Occurance Listing -->
				<div id="btnresourceadd" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'SecurityDashboardController@postOccurance', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Add Record</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div class="form-group">
												{{ Form::label('eventdate', 'Event Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('eventdate', '', array('class' => 'col-xs-11 col-sm-11 input-mask-date', 'id' => 'eventdate', 'placeholder' => 'DD-MM-YYYY'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('occurencetype', 'Occurence Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::select('occurencetype', $occurancetype_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'occurencetype'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('description', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::textarea('description', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'description'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('location', 'Location:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('location', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'location'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('reportby', 'Report By:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('reportby', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'reportby'));}}
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
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript">
		$(document).ready(function () {
			$(function() {
				var oattendance = $('#tattendance').DataTable({
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
			            url: 'Security/getSecurityAttendanceListing',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "login", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "location", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "shifttype", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "name", "searchable": "true" },
			    	{
				    	"targets": [ 4 ], "data": "logout", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		if (data == '0000-00-00 00:00:00') { return '';} 
				    		else if (data == '') { return ''; }
				    		else if (data == null) { return ''; }
				    		else { return moment(data).format("DD-MMM-YYYY HH:mm:ss"); }
					    }
			    	},
			    	{
				    	"targets": [ 5 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=postlogout('+ data +') class="btn btn-xs btn-success"><i class="fa fa-sign-out bigger-120"></i></button> <button type="submit" onClick=deletesecurityattendance('+ data +') class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Attendance Datatable

				var toccurance = $('#toccurance').DataTable({
			        "displayLength": 10, // Default No of Records per page on 1st load
			        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        "pagingType": "full_numbers",
			        "responsive": true,
			        "processing": true,
			        "stateSave": true, // Remember paging & filters
			        "autoWidth": true,
			        "scrollCollapse": true,
			        "processing": false,
			        "serverSide": true,
			        "searching": true,
			        "order": [[ 0, "desc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'Security/getSecurityOccuranceListing',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "resourcedate", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "location", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "occurancetype", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "status", "searchable": "true" },
			    	{ "targets": [ 4 ], "data": "name", "searchable": "true" },
			    	{
				    	"targets": [ 5 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=deleteegrow('+ data +') class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Occurance Datatable
			});
		});

		$('#resourcenricesearch').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Searching Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Security/postNricSearch',
		        type: 'POST',
		        data: { nricsearch: $("#nricsearch").val(), shifttype: $("#shifttype").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oTable = $('#tattendance').DataTable();
		        		oTable.clearPipeline().draw();
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Added!! ',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		if (data.responseJSON.ErrType == "NoAccess") 
	        			{ txtMessage = 'You do not have access to Update!'; }
	        			else if (data.responseJSON.ErrType == "Does Not Exist")
		        			{ txtMessage = 'NRIC does not Exist!  Please check again'; }
		        		else if (data.responseJSON.ErrType == "Duplicate")
		        			{ txtMessage = 'You have already login!!'; }
		        		else { txtMessage = 'Please check your entry!'; }
		        		noty({
							layout: 'topRight', type: 'error', text: txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });
		
		function deletesecurityattendance(submit){ 
	        noty({
				layout: 'center', type: 'confirm', text: 'Do you want to delete record?',
				animation: { open: 'animated tada', close: 'animated lightSpeedOut', easing: 'swing', speed: 500 },
				timeout: 4000,
				buttons: [
				    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
				    	$noty.close();
				    	noty({
							layout: 'topRight', type: 'warning', text: 'Deleting Record ...',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
							timeout: 4000
						});
				    	$.ajax({
					        url: 'Security/deleteSecurityAttendance/' + submit,
					        type: 'POST',
					        data: { deletevalue: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oattTable = $('#tattendance').DataTable();
					        		oattTable.clearPipeline().draw();
			            			noty({
										layout: 'topRight', type: 'success', text: 'Record Deleted!!',
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500
											},
										timeout: 4000
									}); 
					        	},
					        	400:function(data){ 
					        		var txtMessage;
					        		noty({
										layout: 'topRight', type: 'error', text: 'Failed to Delete Record!! ' + " " + data.responseJSON.value,
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
											},
										timeout: 4000
									}); 
					        	}
					        }
					    });
				      }
				    },
				    {addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
				        $noty.close();
				        noty({
							layout: 'topRight', type: 'success', text: 'Delete Cancelled.',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
				      }
				    }
				  ]
			});
	    }

	    function postlogout(submit){ 
	        noty({
				layout: 'center', type: 'confirm', text: 'Do you want to sign out?',
				animation: { open: 'animated tada', close: 'animated lightSpeedOut', easing: 'swing', speed: 500 },
				timeout: 4000,
				buttons: [
				    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
				    	$noty.close();
				    	noty({
							layout: 'topRight', type: 'warning', text: 'Deleting Record ...',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
							timeout: 4000
						});
				    	$.ajax({
					        url: 'Security/postlogout/' + submit,
					        type: 'POST',
					        data: { deletevalue: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oattTable = $('#tattendance').DataTable();
					        		oattTable.clearPipeline().draw();
			            			noty({
										layout: 'topRight', type: 'success', text: 'Record Deleted!!',
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500
											},
										timeout: 4000
									}); 
					        	},
					        	400:function(data){ 
					        		var txtMessage = 'Please check your entry!!';
					        		if (data.responseJSON.ErrType == "NoAccess") 
				        			{ txtMessage = 'You do not have access to Update!'; }
				        			else if (data.responseJSON.ErrType == "Does Not Exist")
					        			{ txtMessage = 'NRIC does not Exist!  Please check again'; }
					        		else if (data.responseJSON.ErrType == "Logout")
					        			{ txtMessage = 'You have already logout!!'; }
					        		else { txtMessage = 'Please check your entry!'; }
					        		noty({
										layout: 'topRight', type: 'error', text: txtMessage,
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
											},
										timeout: 4000
									});  
					        	}
					        }
					    });
				      }
				    },
				    {addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
				        $noty.close();
				        noty({
							layout: 'topRight', type: 'success', text: 'Delete Cancelled.',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
				      }
				    }
				  ]
			});
	    }

	    $('#resourceadd').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Event/postEvent',
		        type: 'POST',
		        data: { eventdate: $("#eventdate").val(), description: $("#description").val(), location: $("#location").val(), eventtype: $("#eventtype").val(),},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
		        		$("#eventdate").val(''); $("#eventtype").val(''); $("#location").val('');
		        		$("#description").val('');
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
	</script>
@stop