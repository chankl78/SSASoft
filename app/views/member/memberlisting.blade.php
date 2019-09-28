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
			<li class="active"><a href="{{{ URL::action('MemberController@getIndex') }}}">Members</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Members<small><i class="ace-icon fa fa-angle-double-right"></i> Listing</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
					<div class="widget-box collapsed widget-color-green">
						<div class="widget-header widget-header-small">
							<h6 class="widget-title">
								<i class="icon-sort"></i>
								Search Member By NRIC
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
								{{ Form::open(array('action' => 'MemberController@postNricSearch', 'id' => 'resourcenricesearch', 'class' => 'form-horizontal')) }}
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
				<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
					<div class="widget-box collapsed widget-color-green">
						<div class="widget-header widget-header-small">
							<h6 class="widget-title">
								<i class="icon-sort"></i>
								Print Leaders Attendance By Region
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
								{{ Form::open(array('action' => 'MemberController@postPrintLeadersAttendanceByRegion', 'id' => 'fLeadersAttendanceByRegion', 'class' => 'form-horizontal')) }}
									<fieldset>
										<div class="form-group">
											{{ Form::label('ddrhq1', 'Select HQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('ddrhq1', $rhq_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'ddrhq1'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											<div class="col-md-offset-5 col-xs-12 col-sm-12">
												<div class="clearfix">
													{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger' )); }}
												</div>
											</div>
										</div>
									</fieldset>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div> <!-- Print Region Leaders Attendance List -->
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Members</h5>
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
											<th>Created</th>
											<th>Name</th>
											<th>CName</th>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chap</th>
											<th>Dist</th>
											<th>Div</th>
											<th>Pos</th>
											<th>Class</th>
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
				<div id="btnmeminfo" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('id' => 'fmemberinfo', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">View Record</h4>
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
												{{ Form::label('dateofbirth', 'DOB:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('dateofbirth', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'dateofbirth'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('position', $position_options, array('class' => 'col-xs-12 col-sm-11', 'id' => 'position'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('division', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('division', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD', 'YC' => 'YC'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'division'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('cbrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('cbrhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbrhq'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('cbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix" id="zonediv">
														{{ Form::select('cbzone', $zone_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbzone'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('cbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix" id="chapterdiv">
														{{ Form::select('cbchapter', $chapter_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbchapter'));}}
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
												{{ Form::label('tel', 'Tel:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('tel', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'tel'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('mobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('mobile', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'mobile'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('email', 'Email:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('email', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'email'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('personid', 'PersonID (MMS):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('personid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'personid'));}}
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
												<div class="form-group">
													{{ Form::label('uniquecode', 'Uniquecode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::text('uniquecode', '', array('class' => 'col-xs-12 col-sm-9'));}}
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										@if ($REME04D == 't')
											{{ Form::button('<i class="fa fa-trash-o"></i> <strong>Delete</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-danger', 'id' => 'resourcedelete')); }}
										@endif
										<button class="btn btn-sm" data-dismiss="modal" id="btnclose">
											<i class="icon-remove"></i>
											Close
										</button>
										@if ($REME04U == 't')
											{{ Form::button('<i class="fa fa-check"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourceupdate')); }}
										@endif
									</div>
								</fieldset>
							{{ Form::close() }}
						</div>
					</div>
				</div> <!-- Add Member Information -->
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript">
		function getinforow(submit){ 
			$.ajax({
		        url: 'Members/getMemberInfo/' + submit,
		        type: 'POST',
		        data: { value: submit },
		        dataType: 'json',
		        statusCode: {
		        	200:function(data){
		        		$("#memberid").val(submit);
		        		$("#membername").val(data.name);
		        		$("#division").val(data.division);
		        		$("#cbrhq").val(data.rhq);
		        		$("#cbzone").val(data.zone);
		        		$("#cbchapter").val(data.chapter);
		        		$("#district").val(data.district);
		        		$("#position").val(data.position);
		        		$("#nric").val(data.nric);
						$("#dateofbirth").val(data.dateofbirth);
		        		$("#mobile").val(data.mobile);
		        		$("#tel").val(data.tel);
		        		$("#email").val(data.email);
		        		$("#personid").val(data.personid);
		        		$("#uniquecode").val(data.uniquecode);

            			noty({
							layout: 'topRight', type: 'success', text: 'Record Retrieved!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});

						$("#btnmeminfo").modal('show');
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Retrieve Data!! ',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
	    }

	    $('#resourcenricesearch').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Searching Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Members/postNricSearch/' + $("#nricsearch").val(),
		        type: 'POST',
		        data: { nricsearch: $("#nricsearch").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var now = moment(data).format("DD-MM-YYYY");
		        		$("#membername").val(data.name);
		        		$("#nric").val(data.nric);
		        		$("#division").val(data.division);
		        		$("#position").val(data.position);
		        		$("#cbrhq").val(data.rhq);
		        		$("#cbzone").val(data.zone);
		        		$("#cbchapter").val(data.chapter);
		        		$("#district").val(data.district);
						$("#tel").val(data.tel);
						$("#mobile").val(data.mobile);
						$("#email").val(data.email);
						$("#personid").val(data.personid);
		        		$("#uniquecode").val(data.uniquecode);
		        		$("#nricsearch").val("");
		        		$("#btnmeminfo").modal('show');
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
	    });

		$('#fLeadersAttendanceByRegion').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postPrintLeadersAttendanceByRegion',
		        type: 'POST',
		        data: { rhq: $('#ddrhq1').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=LeadersAttendance.mrt&param1=' + $('#ddrhq1').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(function() {
				var oTable = $('#tdefault').dataTable({
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
			            url: 'Members/getMemberListing',
			            pages: 5 // number of pages to cache
			        }),
	                "aoColumnDefs": [
	                {
				    	"targets": [ 0 ], "data": "created_at", "width": "100px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
	            	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "chinesename", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "rhq", "searchable": "true" },
			    	{ "targets": [ 4 ], "data": "zone", "searchable": "true" },
			    	{ "targets": [ 5 ], "data": "chapter", "searchable": "true" },
			    	{ "targets": [ 6 ], "data": "district", "searchable": "true" },
			    	{ "targets": [ 7 ], "data": "division", "searchable": "true" },
			    	{ "targets": [ 8 ], "data": "position", "searchable": "true" },
			    	{ "targets": [ 9 ], "data": "classification", "searchable": "true" },
			    	{
				    	"targets": [ 10 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=getinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-edit bigger-120"></i></button>'
					    }
			    	}]
			    });

			    $('#cbrhq').change(function(){
	        		$.ajax({
	        			url: '../Members/getZone/' + $('#cbrhq').val(),
	        			type: 'get',
	        			dataType: 'html',
	        			statusCode: { 
	        				200:function(data){
	        					$('#zonediv').html(data);
	        					$('#cbchapter').val('');
	        				}
	        			}
	        		});
	        	});

			    $("body").delegate('#cbzone','change',function(){
	        		$.ajax({
	        			url: '../Members/getChapter/' + $('#cbzone').val(),
	        			type: 'get',
	        			dataType: 'html',
	        			statusCode: { 
	        				200:function(data){
	        					$('#chapterdiv').html(data);
	        				}
	        			}
	        		});
	        	});
			});

			$('#resourcedelete').click(function(e){
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
						        url: '/Members/deleteMember/' + $("#uniquecode").val(),
						        type: 'POST',
						        data: { uniquecode: $("#uniquecode").val() },
						        dataType: 'json',
						        statusCode: { 
						        	200:function(){
						        		var oTable = $('#tdefault').DataTable();
					        			oTable.clearPipeline().draw();

					    				$("#btnmeminfo").modal('hide');

				            			noty({
											layout: 'topRight', type: 'success', text: 'Record Deleted!!',
											animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500
												},
											timeout: 4000
										});
						        	},
						        	400:function(data){ 
						        		var txtMessage;
						        		if (data.responseJSON.ErrType == "NoAccess") 
						        			{ txtMessage = 'You do not have Access Rights!'; }
						        		else if (data.responseJSON.ErrType == "Over") 
		        							{ txtMessage = 'Discussion Meeting had already over! If you want to add new friend or believer, please proceed to New Friend List or Believer List'; }
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
			    e.preventDefault();
		    });

		    $('#resourceupdate').click(function(e)
		    {
		    	$.ajax({
			        url: '/Members/putMember/' + $("#uniquecode").val(),
			        type: 'POST',
			        data: { nric: $("#nric").val(), name: $("#membername").val(), email: $("#email").val(), tel: $("#tel").val(), mobile: $("#mobile").val(), personid: $("#personid").val(), rhq: $("#cbrhq").val(), zone: $("#cbzone").val(), chapter: $("#cbchapter").val(), district: $("#district").val(), position: $("#position").val(), division: $("#division").val(), uniquecode: $("#uniquecode").val()},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
		        			oTable.clearPipeline().draw();

		    				$("#btnmeminfo").modal('hide');

	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Updated!!',
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
			        		$("#ediscussionmeeting").focus();
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
	</script>
@stop