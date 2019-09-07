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
			<li class="active"><a href="{{{ URL::action('EventSubscriptionController@getIndex') }}}">Subscription</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Subscription<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
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
						</li> <!-- Info -->
						@if ($REEV05R == 't') 
							<li>
								<a data-toggle="tab" href="#reports">
									<i class="green fa fa-user bigger-110"></i>
									Reports
								</a>
							</li>
						@endif <!-- Report -->
						@if ($REEV01R == 't') 
							<li>
								<a data-toggle="tab" href="#logs">
									<i class="fa fa-book"></i>
									Logs
								</a>
							</li>
						@endif <!-- Logs, Access Rights -->
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane in active">
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Subscription Listing</h5>
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
														<th class="hidden-480">Start Date</th>
														<th class="hidden-480">End Date</th>
														<th class="hidden-480">Event</th>
														<th class="hidden-480">Ref No</th>
														<th class="hidden-480">Name</th>
														<th class="hidden-480">Rhq</th>
														<th class="hidden-480">Zone</th>
														<th class="hidden-480">Chap</th>
														<th class="hidden-480">Dist</th>
														<th class="hidden-480">Pos</th>
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
						</div>
						@if ($REEV05R == 't') 
							<div id="reports" class="tab-pane">
								@if ($REEVGKA == 't')
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">SSA Times Mailer</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventSubscriptionController@postEventSTSubscriptionMailer', 'id' => 'fEventSTSubscriptionMailer', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('cbMonth', 'Select Month: ', array('class' => 'control-label col-xs-12 col-sm-5 no-padding-right')); }}
																{{ Form::select('cbMonth', array('' => '', '1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), '', array('class' => 'col-xs-12 col-sm-4', 'id' => 'cbMonth'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing By Contacts By NRIC Print -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Current Month Subscription (Excel Version)</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventSubscriptionController@postEventSTSubscriptionMailerExcel', 'id' => 'fEventSTSubscriptionMailerExcel', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing New Friends -->
								@endif
							</div>
						@endif <!-- Reports -->
						@if ($REEV01R == 't') 
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
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/additional-methods.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>
	
	<script type="text/javascript">	
		$(document).ready(function () {
			$.mask.definitions['~']='[+-]';
			$('.input-mask-date').mask('99-99-9999');

			$(function() {
				var oTable = $('#tdefault').DataTable({
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
			            url: 'EventSubscription/getListing',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "ststartdate", "width": "150px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{
				    	"targets": [ 1 ], "data": "stenddate", "width": "150px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 2 ], "data": "eventname", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "subscriptionref", "searchable": "true" },
			    	{ "targets": [ 4 ], "data": "name", "searchable": "true" },
			    	{ "targets": [ 5 ], "data": "rhq", "searchable": "true" },
			    	{ "targets": [ 6 ], "data": "zone", "searchable": "true" },
			    	{ "targets": [ 7 ], "data": "chapter", "searchable": "true" },
			    	{ "targets": [ 8 ], "data": "district", "searchable": "true" },
			    	{ "targets": [ 9 ], "data": "position", "searchable": "true" }]
			    });
			});

			$('#fEventSTSubscriptionMailer').submit(function(e) {
				noty({
					layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'EventSubscription/EventSTSubscriptionMailer/'  + $("#cbMonth").val(),
			        type: 'POST',
			        data: { cbMonth: $("#cbMonth").val() },
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
				var varstartdate = moment().format('YYYY') + '-' + $("#cbMonth").val() + '-1';
				var varenddate = '';
				if ($("#cbMonth").val() == '1' || $("#cbMonth").val() == '3' || $("#cbMonth").val() == '5' || $("#cbMonth").val() == '7' || $("#cbMonth").val() == '8' || $("#cbMonth").val() == '10' || $("#cbMonth").val() == '12')
				{
					varenddate = moment().format('YYYY') + '-' + $("#cbMonth").val() + '-31';
				}
				else if ($("#cbMonth").val() == '4' || $("#cbMonth").val() == '6' || $("#cbMonth").val() == '9' || $("#cbMonth").val() == '11')
				{
					varenddate = moment().format('YYYY') + '-' + $("#cbMonth").val() + '-30';
				}
				else
				{
					varenddate = moment().format('YYYY') + '-' + $("#cbMonth").val() + '-28';
				}

				var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=STMailHC.mrt' + '&param1=' + {{ Auth::user()->id }} + '&param2=' + varstartdate + '&param3=' + varenddate;
				window.open(url, '_blank');
			    e.preventDefault();
			});

			$('#fEventSTSubscriptionMailerExcel').submit(function(e) {
				noty({
					layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'EventSubscription/EventSTSubscriptionMailerExcel',
			        type: 'POST',
			        data: {  },
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
				var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=STMailExcel.mrt' + '&param1=' + {{ Auth::user()->id }};
				window.open(url, '_blank');
			    e.preventDefault();
			});
		});
	</script>
@stop