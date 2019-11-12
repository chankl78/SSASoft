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
			<li class="active"><a href="{{{ URL::action('AttendanceController@getIndex') }}}">Attendance</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Attendance<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box collapsed widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">Create Discussion Meeting (4 Division District)</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="well well-lg">
									{{ Form::open(array('id' => 'fselect', 'class' => 'form-horizontal')) }}
										<fieldset>
											{{ Form::label('txtdescription', 'Description:', array('class' => 'control-label col-xs-12 col-sm-2')); }}
											{{ Form::text('txtdescription', '', array('class' => 'col-xs-12 col-sm-3', 'id' => 'txtdescription')); }}
											{{ Form::label('ddday', 'Day:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddday', array('01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29', '30' => '30', '31' => '31'), '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddday'));}}
											{{ Form::label('ddmonth', 'Month:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddmonth', array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddmonth'));}}
											{{ Form::label('ddrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddrhq', $rhq_options, array('class' => 'col-xs-12 col-sm-2', 'id' => 'ddrhq')); }}
											{{ Form::button('<i class="fa fa-plus"></i> Create', array('type' => 'Search', 'class' => 'btn btn-warning bigger pull-right' )); }}
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Creation of New Discussion Meeting -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box collapsed widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">Create Discussion Meeting (By Level By Division)</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="well well-lg">
									{{ Form::open(array('id' => 'fcdselect', 'class' => 'form-horizontal')) }}
										<fieldset>
											{{ Form::label('txtcddescription', 'Description:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::text('txtcddescription', '', array('class' => 'col-xs-12 col-sm-2', 'id' => 'txtcddescription')); }}
											{{ Form::label('ddcdday', 'Day:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddcdday', array('01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29', '30' => '30', '31' => '31'), '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddcdday'));}}
											{{ Form::label('ddcdmonth', 'Month:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddcdmonth', array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddcdmonth'));}}
											{{ Form::select('ddcdleveltype', $leveltype_options, '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddcdleveltype')); }}
											{{ Form::select('ddcddivisiontype', $divisiontype_options, '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddcddivisiontype')); }}
											{{ Form::select('ddcdrhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddcdrhq')); }}
											{{ Form::button('<i class="fa fa-plus"></i> Create', array('type' => 'Search', 'class' => 'btn btn-warning bigger pull-right' )); }}
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Creation of New Discussion Meeting By Level By Division -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box collapsed widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">Create Training Attendance (By Event)</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="well well-lg">
									{{ Form::open(array('id' => 'feventselect', 'class' => 'form-horizontal')) }}
										<fieldset>
											{{ Form::label('txtevdescription', 'Description:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::text('txtevdescription', '', array('class' => 'col-xs-12 col-sm-2', 'id' => 'txtevdescription')); }}
											{{ Form::label('ddevday', 'Day:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddevday', array('01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29', '30' => '30', '31' => '31'), '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddevday'));}}
											{{ Form::label('ddevmonth', 'Month:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddevmonth', array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddevmonth'));}}
											{{ Form::select('ddevleveltype', $leveltype_options, '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddevleveltype')); }}
											{{ Form::label('ddevevents', 'Event:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddevevents', $event_options, '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddevevents')); }}
											{{ Form::select('ddevrhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddevrhq')); }}
											{{ Form::button('<i class="fa fa-plus"></i> Create', array('type' => 'Search', 'class' => 'btn btn-warning bigger pull-right' )); }}
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Creation of New Training Attendance -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box collapsed widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">Create Training Attendance (By Group Code Prefix)</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="well well-lg">
									{{ Form::open(array('id' => 'fgcpselect', 'class' => 'form-horizontal')) }}
										<fieldset>
											{{ Form::label('txtgcpdescription', 'Description:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::text('txtgcpdescription', '', array('class' => 'col-xs-12 col-sm-2', 'id' => 'txtgcpdescription')); }}
											{{ Form::label('ddgcpday', 'Day:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddgcpday', array('01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29', '30' => '30', '31' => '31'), '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddgcpday'));}}
											{{ Form::label('ddgcpmonth', 'Month:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddgcpmonth', array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddgcpmonth'));}}
											{{ Form::select('ddgcpleveltype', $leveltype_options, '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddgcpleveltype')); }}
											{{ Form::label('ddgcpevents', 'Event:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
											{{ Form::select('ddgcpevents', $event_options, '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddgcpevents')); }}
											{{ Form::select('ddgcprhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-1', 'id' => 'ddgcprhq')); }}
											{{ Form::button('<i class="fa fa-plus"></i> Create', array('type' => 'Search', 'class' => 'btn btn-warning bigger pull-right' )); }}
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Creation of New Training Attendance By Group Code Prefix -->
				<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
					<div class="widget-box collapsed widget-color-red">
						<div class="widget-header">
							<h5 class="widget-title">Close Discussion Meeting (All)</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="well well-lg">
									{{ Form::open(array('id' => 'fselectclosed', 'class' => 'form-horizontal')) }}
										<fieldset>
											{{ Form::label('ddmonthclosed', 'Month:', array('class' => 'control-label col-xs-12 col-sm-2')); }}
											{{ Form::select('ddmonthclosed', array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), '', array('class' => 'col-xs-12 col-sm-2', 'id' => 'ddmonthclosed'));}}
											{{ Form::label('txtyear', 'Year:', array('class' => 'control-label col-xs-12 col-sm-2')); }}
											{{ Form::text('txtyear', $currentyear, array('class' => 'col-xs-12 col-sm-2', 'id' => 'txtyear')); }}
											{{ Form::button('<i class="fa fa-plus"></i> Close All', array('type' => 'Search', 'class' => 'btn btn-warning bigger pull-right' )); }}
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Closed of Discussion Meeting All -->
				<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
					<div class="widget-box collapsed widget-color-red">
						<div class="widget-header">
							<h5 class="widget-title">Close Discussion Meeting (Submitted)</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="well well-lg">
									{{ Form::open(array('id' => 'fselectclosedsubmitted', 'class' => 'form-horizontal')) }}
										<fieldset>
											{{ Form::label('ddmonthclosedsubmitted', 'Month:', array('class' => 'control-label col-xs-12 col-sm-2')); }}
											{{ Form::select('ddmonthclosedsubmitted', array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), '', array('class' => 'col-xs-12 col-sm-2', 'id' => 'ddmonthclosedsubmitted'));}}
											{{ Form::label('txtyearsubmitted', 'Year:', array('class' => 'control-label col-xs-12 col-sm-2')); }}
											{{ Form::text('txtyearsubmitted', $currentyear, array('class' => 'col-xs-12 col-sm-2', 'id' => 'txtyearsubmitted')); }}
											{{ Form::button('<i class="fa fa-plus"></i> Close Submitted', array('type' => 'Search', 'class' => 'btn btn-warning bigger pull-right' )); }}
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Closed of Discussion Meeting Submitted -->
				<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
					<div class="widget-box collapsed widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Update Discussion Meeting Statistic</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div class="well well-lg">
									{{ Form::open(array('id' => 'fselectupdatestats', 'class' => 'form-horizontal')) }}
										<fieldset>
											{{ Form::label('ddmonthstatsus', 'Month:', array('class' => 'control-label col-xs-12 col-sm-2')); }}
											{{ Form::select('ddmonthstatsus', array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), '', array('class' => 'col-xs-12 col-sm-2', 'id' => 'ddmonthstatsus'));}}
											{{ Form::label('txtyearus', 'Year:', array('class' => 'control-label col-xs-12 col-sm-2')); }}
											{{ Form::text('txtyearstatsus', $currentyear, array('class' => 'col-xs-12 col-sm-2', 'id' => 'txtyearstatsus')); }}
											{{ Form::button('<i class="fa fa-check"></i> Update', array('type' => 'Search', 'class' => 'btn btn-warning bigger pull-right' )); }}
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Update of Discussion Meeting Stats -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Attendance Listing</h5>
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
											<th>Type</th>
											<th>Event</th>
											<th>Event Item</th>
											<th>Description</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								<div class="col-xs-12">
									@if ($REAT03A == 't')
										<a href="#btnresourceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Attendance Listing -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Discussion Meeting Not Submitted</h5>
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
								<table id="tdmnotsubmitted" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Description</th>
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
				</div> <!-- Discussion Meeting Not Submitted Listing -->
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
			$.ajax({
		        url: 'Attendance/postAttendanceACCheck/' + submit,
		        type: 'POST',
		        data: { value: submit },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var RowID = "";
				        var oTable = $('#tdefault').DataTable();
				        $("#tdefault tbody tr").click(function () {
			                var position = oTable.row(this).index();
			                RowID = oTable.row(position).data();
			                window.location.href = "Attendance/Detail/" + submit;
			            });
		        	},
		        	400:function(data){ 
		        		var txtMessage;
		        		noty({
							layout: 'topRight', type: 'error', text: 'You do not have access rights to see this Attendance Detail!! ',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
	    }

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
					        url: 'Attendance/deleteAttendance/' + submit,
					        type: 'POST',
					        data: { value: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oTable = $('#tdefault').DataTable();
					        		oTable.clearPipeline().draw();
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

	    $('#fselect').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Creating Discussion Meeting Attendance ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Attendance/postCreateDMAttendance',
		        type: 'POST',
		        data: { ddday: $('#ddday').val(), ddmonth: $('#ddmonth').val(), ddrhq: $('#ddrhq').val(), txtdescription: $('#txtdescription').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oTable = $('#tdefault').DataTable();
					    oTable.clearPipeline().draw();
		        		noty({
							layout: 'topRight', type: 'success', text: 'Attendance Created!!',
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

		$('#fcdselect').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Creating Discussion Meeting Attendance By Division By Level ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Attendance/postCreateDMLevelDivisionAttendance',
		        type: 'POST',
		        data: { leveltype: $('#ddcdleveltype').val(), day: $('#ddcdday').val(), month: $('#ddcdmonth').val(), rhq: $('#ddcdrhq').val(), divisiontype: $('#ddcddivisiontype').val(), description: $('#txtcddescription').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oTable = $('#tdefault').DataTable();
					    oTable.clearPipeline().draw();
		        		noty({
							layout: 'topRight', type: 'success', text: 'Attendance Created!!',
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

		$('#feventselect').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Creating Discussion Meeting Attendance By Events ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Attendance/postCreateEventTrainingAttendance',
		        type: 'POST',
		        data: { leveltype: $('#ddevleveltype').val(), event: $('#ddevevents').val(), day: $('#ddevday').val(), month: $('#ddevmonth').val(), rhq: $('#ddevrhq').val(), description: $('#txtevdescription').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oTable = $('#tdefault').DataTable();
					    oTable.clearPipeline().draw();
		        		noty({
							layout: 'topRight', type: 'success', text: 'Attendance Created!!',
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

		$('#fgcpselect').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Creating Discussion Meeting Attendance By Group Code Prefix ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Attendance/postCreateGroupCodePrefixTrainingAttendance',
		        type: 'POST',
		        data: { leveltype: $('#ddgcpleveltype').val(), event: $('#ddgcpevents').val(), day: $('#ddgcpday').val(), month: $('#ddgcpmonth').val(), rhq: $('#ddgcprhq').val(), description: $('#txtgcpdescription').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oTable = $('#tdefault').DataTable();
					    oTable.clearPipeline().draw();
		        		noty({
							layout: 'topRight', type: 'success', text: 'Attendance Created!!',
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

		$('#fselectclosed').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Closing Discussion Meeting Attendance (ALL) ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Attendance/postClosedDMAttendance',
		        type: 'POST',
		        data: { ddmonth: $('#ddmonthclosed').val(), txtyear: $('#txtyear').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oTable = $('#tdefault').DataTable();
					    oTable.clearPipeline().draw();
		        		noty({
							layout: 'topRight', type: 'success', text: 'Attendance Closed!!',
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

		$('#fselectclosedsubmitted').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Closing Discussion Meeting Attendance (Submitted) ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Attendance/postClosedDMAttendanceSubmitted',
		        type: 'POST',
		        data: { ddmonth: $('#ddmonthclosedsubmitted').val(), txtyear: $('#txtyearsubmitted').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oTable = $('#tdefault').DataTable();
					    oTable.clearPipeline().draw();
		        		noty({
							layout: 'topRight', type: 'success', text: 'Attendance Closed!!',
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

		$('#fselectupdatestats').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Updating Discussion Meeting Stats ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Attendance/postDMStatsUpdate',
		        type: 'POST',
		        data: { ddmonth: $('#ddmonthstatsus').val(), txtyear: $('#txtyearstatsus').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oTable = $('#tdefault').DataTable();
					    oTable.clearPipeline().draw();
						var oDMNotSubmittedTable = $('#tdmnotsubmitted').DataTable();
						oDMNotSubmittedTable.ajax.reload(null, false);
		        		noty({
							layout: 'topRight', type: 'success', text: 'Discussion Meeting Statistic Updated!!',
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
	</script>
	<script type="text/javascript">	
		$(document).ready(function () {
			$.mask.definitions['~']='[+-]';
			$('.input-mask-date').mask('99-99-9999');

			$(function() {
				var oTable = $('#tdefault').DataTable({
			        "displayLength": 10, // Default No of Records per page on 1st load
			        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        "pagingType": "first_last_numbers",
			        "responsive": false,
			        "stateSave": true, // Remember paging & filters
			        "autoWidth": true,
			        "scrollCollapse": true,
			        "processing": false,
			        "serverSide": true,
			        "searching": true,
			        "deferRender": true,
			        "order": [[ 0, "desc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'Attendance/getAttendanceListing',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "attendancedate", "width": "150px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "attendancetype", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "event", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "eventitem", "searchable": "true" },
			    	{ "targets": [ 4 ], "data": "description", "searchable": "true" },
			    	{ 
			    		"targets": [ 5 ], "data": "status", "searchable": "true",
			    		"render": function ( data, type, full ){
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
				    	"targets": [ 6 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<a href="#resourceedit" role="button" onClick=editrow("'+ data +'") class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    });

				var oDMNotSubmittedTable = $('#tdmnotsubmitted').DataTable({
			        "displayLength": 10, // Default No of Records per page on 1st load
			        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        "pagingType": "first_last_numbers",
			        "responsive": false,
			        "stateSave": true, // Remember paging & filters
			        "autoWidth": true,
			        "scrollCollapse": true,
			        "processing": false,
			        "serverSide": false,
			        "searching": true,
			        "deferRender": true,
			        "order": [[ 0, "asc" ]],
			        "ajax": 'Attendance/getDiscussionMeetingNotSubmitted',
			        "columnDefs": [ { "targets": [ 0 ], "data": "description", "searchable": "true" }]
			    });
			});
		});
	</script>
@stop