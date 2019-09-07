@extends('layout.master')
@section('jsheader')
	<link href="{{{ asset('assets/css/datepicker.css') }}}" rel="stylesheet">
@stop
@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i><a href="{{{ URL::action('DashboardController@getIndex') }}}">Home</a>
			</li>
			<li><a href="{{{ URL::action('GroupController@getIndex') }}}">Award / Gift / Certificate</a></li>
			<li class="active">Detail</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Award / Gift / Certificate<small><i class="ace-icon fa fa-angle-double-right"></i> Detail</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="tabbable tabs-right">
					<ul class="nav nav-tabs" id="ModuleTab">
						<li class="active">
							<a data-toggle="tab" href="#home">
								<i class="blue fa fa-dashboard bigger-110"></i>
								Info
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#events">
								<i class="purple fa fa-calendar bigger-110"></i>
								Events
							</a>
						</li>
						@if ($RECE05R == 't') 
							<li>
								<a data-toggle="tab" href="#reports">
									<i class="green fa fa-user bigger-110"></i>
									Reports
								</a>
							</li>
						@endif
						@if ($RECE01R == 't') 
							<li>
								<a data-toggle="tab" href="#logs">
									<i class="fa fa-book"></i>
									Logs
								</a>
							</li>
						@endif
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane in active">
							@foreach ($result as $result)
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box collapsed">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Award / Gift / Certificate Information - {{ $result->awardtitle }}
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
												{{ Form::open(array('action' => 'AwardController@putAward', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														{{ Form::label('awarddate', 'Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('awarddate', date("d-M-Y",strtotime($result->awarddate)), array('class' => 'date-picker col-xs-12 col-sm-9', 'data-date-format' => 'dd-M-yyyy'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('awardtitle', 'Title:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('awardtitle', $result->awardtitle, array('class' => 'col-xs-12 col-sm-9'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('description', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::textarea('description' , $result->description, array('class' => 'col-xs-12 col-sm-9', 'rows' => '3'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('awardtype', 'Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('awardtype', $type_options, $result->awardtype, array('class' => 'col-xs-12 col-sm-9', 'id' => 'awardtype'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('country', 'Country:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('country', $result->country, array('class' => 'col-xs-12 col-sm-9'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('awardby', 'Given By:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('awardby', $result->awardby, array('class' => 'col-xs-12 col-sm-9'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('createat', 'Created At:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('createat', $result->created_at, array('class' => 'col-xs-12 col-sm-9'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														<div class="col-md-offset-5 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('<i class="fa fa-check fa fa-on-right"></i> Save', array('type' => 'Search', 'class' => 'btn btn-info btn-lg' )); }}
															</div>
														</div>
													</div>
													<div hidden>
														<div class="form-group">
															{{ Form::label('awardid', 'Award ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('awardid', $result->uniquecode, array('class' => 'col-xs-12 col-sm-9', 'id' => 'awardid'));}}
																</div>
															</div>
														</div>
													</div>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div>
							@endforeach <!-- Group Information -->
							<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
								<div class="widget-box collapsed widget-color-green">
									<div class="widget-header widget-header-small">
										<h6 class="widget-title">
											<i class="icon-sort"></i>
											Register Member By NRIC
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
											{{ Form::open(array('action' => 'AwardDetailController@postNricSearch', 'id' => 'resourcenricesearch', 'class' => 'form-horizontal')) }}
												<br />
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
															{{ Form::button('<i class="fa fa-search fa fa-on-right"></i> Search', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
														</div>
													</div>
												</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div> <!-- Register Member By NRIC -->
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Award Detail</h5>
										<div class="widget-toolbar">
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<table id="tdefault" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="hidden-480">Name</th>
														<th class="hidden-480">RHQ</th>
														<th class="hidden-480">Zone</th>
														<th class="hidden-480">Chapter</th>
														<th class="hidden-480">District</th>
														<th class="hidden-480">Division</th>
														<th class="hidden-480">Position</th>
														<th class="hidden-480">Remarks</th>
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
							</div> <!-- Group Members - Datatable-->
							<div id="btnresourceadd" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'AwardDetailController@postAddMember', 'id' => 'resourceaddmember', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Add Record</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div class="form-group">
															{{ Form::label('membername', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('membername', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'membername'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('nric', 'Nric:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('nric', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nric'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('position', 'Poistion:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('position', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'position'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('division', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('division', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'division'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('rhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('rhq', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'rhq'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('zone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('zone', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'zone'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('chapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('chapter', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'chapter'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('district', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('district', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'district'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('remarks', 'Remark:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::textarea('remarks' , '', array('class' => 'col-xs-12 col-sm-9', 'rows' => '3'));}}
																</div>
															</div>
														</div>
														<div hidden>
															<div class="form-group">
																{{ Form::label('memberid', 'Member ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('memberid', '', array('class' => 'col-xs-12 col-sm-9'));}}
																	</div>
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
													{{ Form::button('<i class="icon-ok"></i> <strong>Add</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourceadd')); }}
												</div>
											</fieldset>
										{{ Form::close() }}
									</div>
								</div>
							</div> <!-- Add Group Member -->
						</div>
						<div id="events" class="tab-pane">
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Event Detail</h5>
										<div class="widget-toolbar">
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<table id="teventdefault" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="hidden-480">Event Date</th>
														<th class="hidden-480">Description</th>
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
							</div> <!-- Group Members - Datatable-->
						</div>
						@if ($RECE05R == 't') 
							<div id="reports" class="tab-pane">
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Print Detail Listing</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('id' => 'fAwardDetailListingPrint', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Contacts Information Accepted Participant No Group Code -->
							</div>
						@endif
						@if ($RECE01R == 't') 
							<div id="logs" class="tab-pane">
							</div>
						@endif
					</div>
				</div>
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript" src="{{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}}"></script>
	<script type="text/javascript">
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})

		$('#resourceaddmember').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postAddMember/' + $("#awardid").val(),
		        type: 'POST',
		        data: { remarks: $("#remarks").val(), membername: $("#membername").val(), awardid: $("#awardid").val(), position: $("#position").val(), memberid: $("#memberid").val()},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').dataTable();
		        		oTable.fnDraw();
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
		        		$("#search").focus();
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
		
		$('#fAwardDetailListingPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'AcceptedNoGroupCode/' + {{ $rid }},
		        type: 'POST',
		        data: { id: $('#eventid').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Print!!',
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
		        		$("#search").focus();
		        		noty({
							layout: 'topRight', type: 'error', text: txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
			var url = '/public/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=AwardDetailListing.mrt&param1=' + {{ $rid }};
			window.open(url, '_blank');
		    e.preventDefault();
		});
	</script>
	<script type="text/javascript">
		function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').dataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.fnGetPosition(this); // getting the clicked row position
                RowID = oTable.fnGetData(position); // getting the value of the first (invisible) column
                // $("#evalue1").val(RowID.value);
                // $("#evalue").val(RowID.lineno);
                // $("#epositionid").val(submit);
            });

            // $("#resourceedit").modal('show');
	    } // Edit Member Information

	    function deleterow(submit){ 
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
					        url: 'deleteGroupMember/' + submit,
					        type: 'POST',
					        data: { dposition: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oTable = $('#tdefault').dataTable();
					        		oTable.fnDraw();
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
	    } // Delete Member
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(function() {
				var oTable = $('#tdefault').DataTable({
			        "iDisplayLength": 10, // Default No of Records per page on 1st load
			        "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        //"aaSorting": [[0, "desc"]], // Default 1st column sorting
			        "bStateSave": true, // Remember paging & filters
			        "bAutoWidth": true,
			        "bScrollCollapse": true,
			        "bServerSide": true,
			        "fnServerData": fnDataTablesPipeline,
			        "sPaginationType": "bootstrap", // Include page number
			        "sAjaxSource": 'getDetailListing/' + {{ $rid }},
			        "aoColumns": [
	                    { "mData": "name", "bSortable": false,  "sWidth": "200px" },
	                    { "mData": "rhq", "bSortable": false},
	                    { "mData": "zone", "bSortable": false},
	                    { "mData": "chapter", "bSortable": false},
	                    { "mData": "district", "bSortable": false},
	                    { "mData": "division", "bSortable": false},
	                    { "mData": "position", "bSortable": false},
	                    { "mData": "remarks", "bSortable": false},
	                    { "mData": "uniquecode", "bSortable": false, "sWidth": "150px" } ],
	                "aoColumnDefs": [
	            	{
				    	"aTargets": [ 8 ], "mData": "uniquecode",
				    	"mRender": function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		return '<a href="#resourceedit" role="button" onClick=editrow('+ data +') class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> <button type="submit" onClick=deleterow('+ data +') class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Award Members
			});
		});
	</script>
	<script type="text/javascript">
		$('#resourcenricesearch').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Searching Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postNricSearch/' + $("#groupid").val(),
		        type: 'POST',
		        data: { nricsearch: $("#nricsearch").val(), groupid: $("#groupid").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var now = moment(data).format("DD-MM-YYYY");
		        		$("#enrolleddate").val(now);
		        		$("#membername").val(data.name);
		        		$("#nric").val(data.nric);
		        		$("#division").val(data.division);
		        		$("#position").val(data.position);
		        		$("#rhq").val(data.rhq);
		        		$("#zone").val(data.zone);
		        		$("#chapter").val(data.chapter);
		        		$("#district").val(data.district);
		        		$("#memberid").val(data.uniquecode);
		        		$("#nricsearch").val("");
		        		$("#btnresourceadd").modal('show');
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Found!! ' + data.name,
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
	    }); // Search Members NRIC

		$('#resourceupdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putAward/' + {{$rid}},
		        type: 'POST',
		        data: { awarddate: $("#awarddate").val(), awardtitle: $("#awardtitle").val(), description: $("#description").val(), awardby: $("#awardby").val(), awardtype: $("#awardtype").val(), country: $("#country").val(), awardid: $("#awardid").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
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
		    e.preventDefault();
	    }); // Update Award Information
	</script>
@stop