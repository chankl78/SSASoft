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
			<li><a href="{{{ URL::action('EventController@getIndex') }}}">Events</a></li>
			<li><a href="{{{ URL::action('EventDetailController@getIndex', $eventuniquecode) }}}">{{$eventname}}</a></li>
			<li class="active">{{ $pagetitle }}</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Event Attendance<small><i class="ace-icon fa fa-angle-double-right"></i> {{ $pagetitle }}</small></h1>
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
							<a data-toggle="tab" href="#dashboard">
								<i class="green fa fa-university bigger-110"></i>
								Dashboard
							</a>
						</li>
						@if ($REEV05R == 't') 
							<li>
								<a data-toggle="tab" href="#reports">
									<i class="green fa fa-user bigger-110"></i>
									Reports
								</a>
							</li>
						@endif
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane in active">
							@foreach ($result as $result)
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box widget-color-orange collapsed">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Attendance Information - {{ $result->description }}
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
												{{ Form::open(array('action' => 'EventAttendanceController@putAttendance', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														{{ Form::label('attendancedate', 'Attendance Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('attendancedate', date("d-M-Y",strtotime($result->attendancedate)), array('class' => 'date-picker col-xs-12 col-sm-9', 'data-date-format' => 'dd-M-yyyy'));}}
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
														{{ Form::label('eventattendance', 'Event:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('eventattendance', $event_options, $result->event, array('class' => 'col-xs-12 col-sm-9', 'id' => 'eventattendance'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('atteventitem', 'Event Item:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('atteventitem', $result->eventitem, array('class' => 'col-xs-12 col-sm-9'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('attendancetype', 'Attendance Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('attendancetype', $attendancetype_options, $result->attendancetype, array('class' => 'col-xs-12 col-sm-9', 'id' => 'attendancetype'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('status', 'Status:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('status', $commonstatus_options, $result->status, array('class' => 'col-xs-12 col-sm-9', 'id' => 'status'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('createby', 'Create By:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('createby', $result->createbyname, array('class' => 'col-xs-12 col-sm-9'));}}
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
															{{ Form::label('moduleid', 'Module ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('moduleid', $result->uniquecode, array('class' => 'col-xs-12 col-sm-9', 'id' => 'moduleid'));}}
																</div>
																<div class="clearfix">
																	{{ Form::text('eventid', $result->eventid, array('class' => 'col-xs-12 col-sm-9', 'id' => 'eventid'));}}
																</div>
																<div class="clearfix">
																	{{ Form::text('partname', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'partname'));}}
																</div>
															</div>

														</div>
													</div>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div> <!-- Event Information -->
							@endforeach
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
											{{ Form::open(array('action' => 'EventDetailController@postNricSearch', 'id' => 'resourcenricesearch', 'class' => 'form-horizontal')) }}
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
													<div class="col-md-offset-3 col-xs-12 col-sm-12">
														<div class="clearfix">
															{{ Form::button('<i class="fa fa-search fa fa-on-right"></i> New Friend', array('class' => 'btn btn-info btn-lg', 'id' => 'addnewfriend')); }}
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
											Register Member By Security Pass
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
											{{ Form::open(array('action' => 'EventAttendanceController@postSPSearch', 'id' => 'resourcespsearch', 'class' => 'form-horizontal')) }}
												<br />
												<div class="form-group">
													{{ Form::label('spsearch', 'Search (Pass):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::text('spsearch', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'spsearch'));}}
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
							</div> <!-- Register Member By Security Pass -->
							<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
								<div class="widget-box collapsed widget-color-green">
									<div class="widget-header widget-header-small">
										<h6 class="widget-title">
											<i class="icon-sort"></i>
											Register Member By NRIC (Express Edition)
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
											{{ Form::open(array('action' => 'EventAttendanceController@postNricSearchExpress', 'id' => 'resourcenricesearchexpress', 'class' => 'form-horizontal')) }}
												<br />
												<div class="form-group">
													{{ Form::label('nricsearchexpress', 'Search (NRIC):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::text('nricsearchexpress', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'nricsearchexpress'));}}
														</div>
													</div>
												</div>
												<div class="space-2"></div>
												<div class="form-group">
													<div class="col-md-offset-3 col-xs-12 col-sm-12">
														<div class="clearfix">
															{{ Form::button('<i class="fa fa-search fa fa-on-right"></i> New Friend', array('class' => 'btn btn-info btn-lg', 'id' => 'addnewfriendexpress')); }}
															{{ Form::button('<i class="fa fa-search fa fa-on-right"></i> Search', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
														</div>
													</div>
												</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div> <!-- Register Member By NRIC Express Edition-->
							@if ($REEVROL == 't')
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box collapsed widget-color-purple">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												By Event
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
												{{ Form::open(array('action' => 'EventAttendanceController@postEventAttended', 'id' => 'feventattended', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														<div class="col-md-offset-4 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('<i class="fa fa-thumbs-up fa fa-on-right"></i> Attended', array('type' => 'Search', 'class' => 'btn btn-success btn-lg' )); }}
															</div>
														</div>
													</div>
												{{ Form::close() }}
												{{ Form::open(array('action' => 'EventAttendanceController@postEventAbsent', 'id' => 'feventabsent', 'class' => 'form-horizontal')) }}
													<div class="form-group">
														<div class="col-md-offset-4 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('<i class="fa fa-thumbs-down fa fa-on-right"></i> Absent', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
															</div>
														</div>
													</div>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div> <!-- Attendance By Event -->
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box collapsed widget-color-purple">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												By Event Item
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
												{{ Form::open(array('action' => 'EventAttendanceController@postEventItemAttended', 'id' => 'feventitemattended', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														<div class="col-md-offset-4 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('<i class="fa fa-thumbs-up fa fa-on-right"></i> Attended', array('type' => 'Search', 'class' => 'btn btn-success btn-lg' )); }}
															</div>
														</div>
													</div>
												{{ Form::close() }}
												{{ Form::open(array('action' => 'EventAttendanceController@postEventItemAbsent', 'id' => 'feventitemabsent', 'class' => 'form-horizontal')) }}
													<div class="form-group">
														<div class="col-md-offset-4 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('<i class="fa fa-thumbs-down fa fa-on-right"></i> Absent', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
															</div>
														</div>
													</div>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div> <!-- Attendance By Event Item -->
							@endif
							<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box collapsed widget-color-purple">
									<div class="widget-header widget-header-small">
										<h6 class="widget-title">
											<i class="icon-sort"></i>
											By Event Participants
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
										<div class="widget-main">
											<table id="teventparticipant" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="hidden-480">Created At</th>
														<th class="hidden-480">Name</th>
														<th class="hidden-480">Item</th>
														<th class="hidden-480">Code</th>
														<th class="hidden-480">RHQ</th>
														<th class="hidden-480">Div</th>
														<th class="hidden-480">Role</th>
														<th class="hidden-480">Status</th>
														<th class="hidden-480">Aud Code</th>
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
							</div> <!-- Attendance By Participants in that Event -->
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Attendees</h5>
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
														<th>Created At</th>
														<th>Name</th>
														<th>RHQ</th>
														<th>Zone</th>
														<th>Chap</th>
														<th>Dist</th>
														<th>Div</th>
														<th>Pos</th>
														<th>No of NF</th>
														<th>Remarks</th>
														<th>Attended</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
										<div class="widget-toolbox padding-8 clearfix">
											@if ($REEV08D == 't')
												{{ Form::open(array('action' => 'EventAttendanceController@deleteAllAttendee', 'id' => 'fDeleteAllAttendee', 'class' => 'form-horizontal')) }}
														<fieldset>
																{{ Form::button('<i class="fa fa-trash-o"></i> Delete All', array('type' => 'submit', 'class' => 'btn btn-xs bigger-120 btn-yellow bigger pull-right' )); }}
														</fieldset>
												{{ Form::close() }}
											@endif
										</div>
									</div>
								</div>
							</div> <!-- Event Attendee Listing -->
							<div id="btneventmemadd" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'EventAttendanceController@postAddMember', 'id' => 'resourceaddmember', 'class' => 'form-horizontal')) }}
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
															{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
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
															{{ Form::label('noofnewfriend', 'No of New Friend:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('noofnewfriend', '0', array('class' => 'col-xs-12 col-sm-11', 'id' => 'noofnewfriend'));}}
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
							</div> <!-- Add Attendee -->
							<div id="btneventnewfriendadd" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'EventAttendanceController@postAddNewFriend', 'id' => 'resourceaddnewfriend', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Add New Friend Record</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div class="form-group">
															{{ Form::label('nfname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('nfname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfname'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('nfposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('nfposition', $memposition_options, 'NF', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfposition'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('nfdivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('nfdivision', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD', 'YC' => 'YC'), $result->division, array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfdivision'));}}
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
															{{ Form::label('nfdistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('nfdistrict', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfdistrict'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('nfremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::textarea('nfremarks', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfremarks', 'rows'=>'3'));}}
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
													{{ Form::button('<i class="icon-ok"></i> <strong>Add</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourcenewfriendadd')); }}
												</div>
											</fieldset>
										{{ Form::close() }}
									</div>
								</div>
							</div> <!-- Add New Friend Attendee -->
							<div id="resourceedit" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'EventAttendanceController@putEditMember', 'id' => 'memberupdate', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Edit Record</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div hidden>
															<div class="form-group">
																{{ Form::label('ememberid', 'Member ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('ememberid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ememberid'));}}
																	</div>
																</div>
															</div>
														</div>
														<div>
															<div class="form-group">
																{{ Form::label('ename', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('ename', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ename'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('enoofnf', 'No of New Friend:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('enoofnf', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'enoofnf'));}}
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('eremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::textarea('eremarks', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eremarks'));}}
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
													{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'btnresourceupdate')); }}
												</div>
											</fieldset>
										{{ Form::close() }}
									</div>
								</div>
							</div>
						</div>
						<div id="dashboard" class="tab-pane">
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">RHQ Statistic</h5>
										<div class="widget-toolbar">
											<a href="#reload" data-action="reload" onClick=reloaddt()>
												<i class="fa fa-refresh"></i>
											</a>
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<table id="trhqstats" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>RHQ</th>
														<th>MD</th>
														<th>WD</th>
														<th>YM</th>
														<th>YW</th>
														<th>PD</th>
														<th>Unknown</th>
														<th>Total</th>
														<th>New Friend</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
												<tfoot id="trhqstatsfoot">
													<tr>
										                <th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
										            </tr>
												</tfoot>
											</table>
										</div>
										<div class="widget-toolbox padding-8 clearfix">
										</div>
									</div>
								</div>
							</div> <!-- Statistic By RHQ Listing -->
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Position Statistic</h5>
										<div class="widget-toolbar">
											<a href="#reload" data-action="reload" onClick=reloaddt()>
												<i class="fa fa-refresh"></i>
											</a>
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<table id="tpositionstats" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Position</th>
														<th>MD</th>
														<th>WD</th>
														<th>YM</th>
														<th>YW</th>
														<th>PD</th>
														<th>Unknown</th>
														<th>Total</th>
														<th>New Friend</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
												<tfoot id="tpositionstatsfoot">
													<tr>
										                <th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
										            </tr>
												</tfoot>
											</table>
										</div>
										<div class="widget-toolbox padding-8 clearfix">
										</div>
									</div>
								</div>
							</div> <!-- Statistic By Position Listing -->
						</div>
						@if ($REEV05R == 't')
							<div id="reports" class="tab-pane">
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Attendance Detail Listing For Region (Excel Version)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'EventAttendanceController@postAttendancePrint', 'id' => 'fAttendanceregionPrint', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Attendance Detail Listing For region -->
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Attendance Detail Listing (Excel Version)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'EventAttendanceController@postAttendancePrint', 'id' => 'fAttendancePrint', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Attendance Detail Listing -->
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Attendance Detail Listing By Performer (Excel Version)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'EventAttendanceController@postAttendanceByPerformerPrint', 'id' => 'fAttendanceByPeformerPrint', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Attendance Detail By Performer Listing -->
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Student Division Attendance Listing (Excel Version)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'EventAttendanceController@postStudentDivisionAttendancePrint', 'id' => 'fAttendanceStudentDivisionPrint', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Attendance Detail Listing -->
							</div>
						@endif <!-- Reports -->
					</div>
				</div>
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript">
		function absentrow(submit){ 
			noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putAbsentAttendee/' + submit,
		        type: 'POST',
		        data: { absent: submit },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
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
	    }

	    function attendrow(submit){ 
			noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                $("#partname").val(RowID.name);
            });
			$.ajax({
		        url: 'putAttendedAttendee/' + submit,
		        type: 'POST',
		        data: { attended: submit, partname: $("#partname").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
		        		 $("#partname").val("");
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
	    }

	    function absentaddrow(submit){ 
			noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postAbsentAttendee/' + submit,
		        type: 'POST',
		        data: { absent: submit, moduleid: $("#moduleid").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
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
	        			else if (data.responseJSON.ErrType == "Duplicate") 
		        			{ txtMessage = 'Record already existed!'; }
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

	    function attendaddrow(submit){ 
			noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postAttendedAttendee/' + submit,
		        type: 'POST',
		        data: { attended: submit, moduleid: $("#moduleid").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
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
	        			else if (data.responseJSON.ErrType == "Duplicate") 
		        			{ txtMessage = 'Record already existed!'; }
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

	    function deleterow(submit){ 
	    	noty({
				layout: 'center', type: 'confirm', text: 'Do you want to delete record?',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
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
					        url: 'deleteAttendee/' + submit,
					        type: 'POST',
					        data: { dparticipant: submit },
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

	    function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                $("#enoofnf").val(RowID.noofnewfriend);
                $("#eremarks").val(RowID.remarks);
                $("#ename").val(RowID.name);
                $("#ememberid").val(submit);
                $("#resourceedit").modal('show');
            });
	    }

		function newfriendrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();

                $("#nfposition").val('NF');
                $("#nfdivision").val('YM');
                $("#nfname").val('');
				$("#cbrhq").val(RowID.rhq);
				$("#cbzone").val(RowID.zone);
				$("#cbchapter").val(RowID.chapter);
				$("#nfdistrict").val(RowID.district);
				$("#nfremarks").val('Introducer: ' + RowID.name);
                $("#btneventnewfriendadd").modal('show');
            });
	    }

	    function reloaddt(submit){ 
	    	var oTable = $('#tdefault').DataTable();
		    oTable.clearPipeline().draw();
		    var orhqstats = $('#trhqstats').DataTable();
		    orhqstats.ajax.reload(null, false);
			var opositionstats = $('#tpositionstats').DataTable();
		    opositionstats.ajax.reload(null, false);
	    }

	    $('#fDeleteAllAttendee').submit(function(e) {
			noty({
				layout: 'center', type: 'confirm', text: 'Do you want to delete record?',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000,
				buttons: [
				    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
				    	$noty.close();
				    	noty({
							layout: 'topRight', type: 'warning', text: 'Deleting All Record ...',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
							timeout: 4000
						});
				    	$.ajax({
					        url: 'deleteAllAttendee/{{ $rid }}',
					        type: 'POST',
					        data: { id: $('#moduleid').val() },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		reloaddt();
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
			e.preventDefault();
		});

		$('#memberupdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putEditMember/' + $("#ememberid").val(),
		        type: 'POST',
		        data: { eremarks: $("#eremarks").val(), enoofnf: $("#enoofnf").val(), ememberid: $("#ememberid").val()},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		reloaddt();
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						$("#resourceedit").modal('hide');
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
	    });
	</script>
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

				var oTable = $('#tdefault').DataTable({
			        "displayLength": 10, // Default No of Records per page on 1st load
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
			        "order": [[ 0, "desc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'getAttendeesListing/{{ $rid }}',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "100px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "rhq", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "zone", "searchable": "true" },
			    	{ "targets": [ 4 ], "data": "chapter", "searchable": "true" },
			    	{ "targets": [ 5 ], "data": "district", "searchable": "true" },
			    	{ "targets": [ 6 ], "data": "division", "searchable": "true" },
			    	{ "targets": [ 7 ], "data": "position", "searchable": "true" },
			    	{ "targets": [ 8 ], "data": "noofnewfriend", "searchable": "true" },
			    	{ "targets": [ 9 ], "data": "remarks", "searchable": "true" },
			    	{
				    	"targets": [ 10 ], "data": "attendancestatus",
				    	"render": function ( data, type, full ){
						    if (data === "Absent"){
						    	return '<span class="label label-warning arrowed-in">'+data+'</span>';
						    }
						  	else if (data === "Attended"){
						    	return '<span class="label label-success arrowed">'+data+'</span>';
						    }
			    		}
		    		},
			    	{
				    	"targets": [ 11 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=attendrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-thumbs-up bigger-120"></i></button> <button type="submit" onClick=absentrow("'+ data +'") class="btn btn-xs btn-warning"><i class="fa fa-thumbs-down bigger-120"></i></button> <button type="submit" onClick=newfriendrow("'+ data +'") class="btn btn-xs btn-purple"><i class="fa fa-user-plus bigger-120"></i></button> <button type="submit" onClick=editrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Event Attendance Participant Listing

				var orhqstats = $('#trhqstats').DataTable({
			        "displayLength": 25, // Default No of Records per page on 1st load
			        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        "pagingType": "full_numbers",
			        "info": false,
			        "paging": true,
			        "autoWidth": false,
			        "scrollCollapse": true,
			        "processing": false,
			        "filter": false,
			        "serverSide": false,
			        "order": [[ 0, "asc" ]],
			        "ajax": 'getrhqstatsListing/{{ $rid }}',
			        "columnDefs": [
				        { "targets": [ 0 ], "data": "rhq" },
		            	{ "targets": [ 1 ], "data": "MD" },
		            	{ "targets": [ 2 ], "data": "WD" },
		            	{ "targets": [ 3 ], "data": "YM" },
		            	{ "targets": [ 4 ], "data": "YW" },
		            	{ "targets": [ 5 ], "data": "PD" },
		            	{ "targets": [ 6 ], "data": "UnKnown" },
		            	{ "targets": [ 7 ], "data": "Total" },
		            	{ "targets": [ 8 ], "data": "NewFriend" }],
	            	"footerCallback": function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [1, 2, 3, 4, 5, 6, 7, 8]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#trhqstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    }); // Event RHQ Statistic Listing

				var opositionstats = $('#tpositionstats').DataTable({
			        "displayLength": 25, // Default No of Records per page on 1st load
			        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        "pagingType": "full_numbers",
			        "info": false,
			        "paging": true,
			        "autoWidth": false,
			        "scrollCollapse": true,
			        "processing": false,
			        "filter": false,
			        "serverSide": false,
			        "order": [[ 0, "asc" ]],
			        "ajax": 'getpositionstatsListing/{{ $rid }}',
			        "columnDefs": [
				        { "targets": [ 0 ], "data": "position" },
		            	{ "targets": [ 1 ], "data": "MD" },
		            	{ "targets": [ 2 ], "data": "WD" },
		            	{ "targets": [ 3 ], "data": "YM" },
		            	{ "targets": [ 4 ], "data": "YW" },
		            	{ "targets": [ 5 ], "data": "PD" },
		            	{ "targets": [ 6 ], "data": "UnKnown" },
		            	{ "targets": [ 7 ], "data": "Total" },
		            	{ "targets": [ 8 ], "data": "NewFriend" }],
	            	"footerCallback": function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [1, 2, 3, 4, 5, 6, 7, 8]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tpositionstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    }); // Event Attendance Position Statistic Listing

				var oEventTable = $('#teventparticipant').DataTable({
			        "displayLength": 5, // Default No of Records per page on 1st load
			        "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]], // Set no of records in per page
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
			            url: 'getParticipantListing/{{ $rid }}',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "150px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "eventitem", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "groupcode", "searchable": "true" },
			    	{ "targets": [ 4 ], "data": "rhq", "searchable": "true" },
			    	{ "targets": [ 5 ], "data": "division", "searchable": "true" },
			    	{
				    	"targets": [ 6 ], "data": "role",
				    	"render": function ( data, type, full ){
				    		return data.substring(0, 3) + '...';
					    }
			    	},
			    	{
				    	"targets": [ 7 ], "data": "status",
				    	"render": function ( data, type, full ){
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
		    		},
		    		{ "targets": [ 8 ], "data": "auditioncode", "searchable": "true" },
			    	{
				    	"targets": [ 9 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		return '<button type="submit" onClick=attendaddrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-thumbs-up bigger-120"></i></button> <button type="submit" onClick=absentaddrow("'+ data +'") class="btn btn-xs btn-warning"><i class="fa fa-thumbs-down bigger-120"></i></button>'
					    }
			    	}]
			    }); // Event Detail Listing

			    $('#cbrhq').change(function(){
	        		$.ajax({
	        			url: '../EventAttendance/getZone/' + $('#cbrhq').val(),
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
	        			url: '../EventAttendance/getChapter/' + $('#cbzone').val(),
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
			
			$('#addnewfriend').click(function(){
			    $("#btneventnewfriendadd").modal('show');
			});

			$('#addnewfriendexpress').click(function(){
			    $("#btneventnewfriendadd").modal('show');
			});

			$('#nricsearch').keyup(function(){
			    this.value = this.value.toUpperCase();
			});

			$('#nricsearchexpress').keyup(function(){
			    this.value = this.value.toUpperCase();
			});

			$('#resourceupdate').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'putAttendance/' + $("#moduleid").val(),
			        type: 'POST',
			        data: { attendancedate: $("#attendancedate").val(), description: $("#description").val(), eventattendance: $("#eventattendance").val(), attendancetype: $("#attendancetype").val(), status: $("#status").val(), atteventitem: $("#atteventitem").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Updated!!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							});
							$("#resourceedit").modal('hide');
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
		    });
			
			$('#resourcenricesearch').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Searching Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postNricSearch/"{{ $rid }}"',
			        type: 'POST',
			        data: { nricsearch: $("#nricsearch").val(), attendanceid: "{{ $rid }}" },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(data){
			        		var now = moment(data).format("DD-MM-YYYY");
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
			        		$("#resourceadd").focus();
			        		$("#btneventmemadd").modal('show');
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

		    $('#resourcenricesearchexpress').submit(function(e){
		    	$.ajax({
			        url: 'postNricSearchExpress/"{{ $rid }}"',
			        type: 'POST',
			        data: { nricsearch: $("#nricsearchexpress").val(), attendanceid: "{{ $rid }}" },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(data){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();

			        		$("#nricsearchexpress").val("");
			        		$("#nricsearchexpress").focus;
			        		noty({
								layout: 'topRight', type: 'success', text: 'Record Inserted - ' + data.attendeename,
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							});
			        	},
			        	400:function(data){ 
			        		var txtMessage = 'Please check your entry!!';
			        		if (data.responseJSON.ErrType == "NoAccess") { txtMessage = 'You do not have access to Update!'; }
		        			else if (data.responseJSON.ErrType == "Does Not Exist") { txtMessage = 'NRIC does not Exist!  Please check again'; }
		        			else if (data.responseJSON.ErrType == "NOT IN Database and Event") { txtMessage = 'NRIC does not Exist in Membership database and event!  Please check again'; }
		        			else if (data.responseJSON.ErrType == "Duplicate") { txtMessage = 'Attendee had already been added earlier!'; }
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

			$('#resourceaddmember').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Adding Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postAddMember/{{ $rid }}',
			        type: 'POST',
			        data: { membername: $("#membername").val(), moduleid: $("#moduleid").val(), memberid: $("#memberid").val(), eventattendance: $("#eventattendance").val(), remarks: $("#remarks").val(), noofnewfriend: $("#noofnewfriend").val()},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
			        		$("#btneventmemadd").modal('hide');
			        		$("#nricsearch").focus();
			        		$("#noofnewfriend").val('0');
			        		$("#remarks").val('');
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
			        			{ txtMessage = 'Record already existed!';  }
			        		else if (data.responseJSON.ErrType == "Failed")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else if (data.responseJSON.ErrType == "CannotUpdate")
			        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
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

		    $('#resourceaddnewfriend').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					nfname: { required: true, minlength: 3 },
					nfposition: { required: true },
					nfdivision: { required: true }
				},
				messages: { },
				invalidHandler: function (event, validator) { ('.alert-danger', $('.resourceadd')).show(); },
				highlight: function (e) { $(e).closest('.form-group').removeClass('has-info').addClass('has-error'); },
				success: function (e) { $(e).closest('.form-group').removeClass('has-error').addClass('has-info'); $(e).remove(); },
				errorPlacement: function (error, element) 
				{
					if(element.is(':checkbox') || element.is(':radio'))
					{
						var controls = element.closest('div[class*="col-"]');
						if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
						else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
					}
					else if(element.is('.select2')) { error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)')); }
					else if(element.is('.chosen-select')) { error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)')); }
					else error.insertAfter(element.parent());
				}
			});

		    $('#resourceaddnewfriend').submit(function(e){
		    	if(!$('#resourceaddnewfriend').valid()) return false;
				else
				{
			    	noty({
						layout: 'topRight', type: 'warning', text: 'Adding Record ...',
						animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
						timeout: 4000
					});
					$.ajax({
				        url: 'postAddNewFriend/{{ $rid }}',
				        type: 'POST',
				        data: { membername: $("#nfname").val(), moduleid: $("#moduleid").val(), memberid: 0, eventattendance: $("#eventattendance").val(), remarks: $("#nfremarks").val(), position: $("#nfposition").val(), rhq: $("#cbrhq").val(), zone: $("#cbzone").val(), chapter: $("#cbchapter").val(), district: $("#nfdistrict").val(), division: $("#nfdivision").val()},
				        dataType: 'json',
				        statusCode: { 
				        	200:function(){
				        		var oTable = $('#tdefault').DataTable();
				        		oTable.clearPipeline().draw();
				        		var orhqstats = $('#trhqstats').DataTable();
				        		orhqstats.clearPipeline().draw();
				        		
				        		$("#btneventnewfriendadd").modal('hide');
				        		$("#nricsearch").focus();
				        		$("#noofnewfriend").val('0');
				        		$("#nfremarks").val(''); $("#nfname").val(''); $("#nfdivision").val('');
				        		$("#nfdistrict").val(''); $("#cbrhq").val(''); $("#cbzone").val(''); $("#cbchapter").val('');
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
				        			{ txtMessage = 'Record already existed!';  }
				        		else if (data.responseJSON.ErrType == "Failed")
				        			{ txtMessage = 'Please check your entry!'; }
				        		else if (data.responseJSON.ErrType == "CannotUpdate")
				        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
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
				}
		    });

			$('#resourcespsearch').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Adding Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postSPSearch/{{ $rid }}',
			        type: 'POST',
			        data: { spsearch: $("#spsearch").val(), eventattendance: $("#eventattendance").val()},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(data){
			        		$pname = data.participantname;
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
			        		var orhqstats = $('#trhqstats').DataTable();
			        		orhqstats.clearPipeline().draw();
			        		$("#spsearch").val("");
			        		$("#spsearch").focus();
	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Created!! Welcome ' + $pname,
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	},
			        	400:function(data){ 
			        		var txtMessage;
			        		if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Record already existed!';  }
			        		else if (data.responseJSON.ErrType == "Failed")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else if (data.responseJSON.ErrType == "Does Not Exist")
			        			{ txtMessage = 'Please register your card again!'; }
			        		else if (data.responseJSON.ErrType == "CannotUpdate")
			        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
			        		else { txtMessage = 'Please check your entry!'; }
			        		$("#spsearch").val("");
			        		$("#spsearch").focus();
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
			
			$('#feventattended').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Adding Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postEventAttended/' + "{{ $rid }}",
			        type: 'POST',
			        data: { eventattendance: $("#eventattendance").val(), atteventitem: $("#atteventitem").val()},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
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
			        			{ txtMessage = 'Record already existed!';  }
			        		else if (data.responseJSON.ErrType == "Failed")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else if (data.responseJSON.ErrType == "CannotUpdate")
			        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
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

			$('#feventabsent').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Adding Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postEventAbsent/' + "{{ $rid }}",
			        type: 'POST',
			        data: { eventattendance: $("#eventattendance").val(), atteventitem: $("#atteventitem").val()},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
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
			        			{ txtMessage = 'Record already existed!';  }
			        		else if (data.responseJSON.ErrType == "Failed")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else if (data.responseJSON.ErrType == "CannotUpdate")
			        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
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

			$('#feventitemattended').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Adding Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postEventItemAttended/"{{ $rid }}"',
			        type: 'POST',
			        data: { eventattendance: $("#eventattendance").val(), atteventitem: $("#atteventitem").val()},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
			        		var orhqstats = $('#trhqstats').DataTable();
			        		orhqstats.clearPipeline().draw();
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
			        			{ txtMessage = 'Record already existed!';  }
			        		else if (data.responseJSON.ErrType == "Failed")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else if (data.responseJSON.ErrType == "CannotUpdate")
			        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
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

			$('#feventitemabsent').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Adding Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postEventItemAbsent/"{{ $rid }}"',
			        type: 'POST',
			        data: { eventattendance: $("#eventattendance").val(), atteventitem: $("#atteventitem").val()},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
			        		var orhqstats = $('#trhqstats').DataTable();
			        		orhqstats.clearPipeline().draw();
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
			        			{ txtMessage = 'Record already existed!';  }
			        		else if (data.responseJSON.ErrType == "Failed")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else if (data.responseJSON.ErrType == "CannotUpdate")
			        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
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

			$('#fAttendanceregionPrint').submit(function(e) {
				noty({
					layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'PrintAttendancePrint/"{{ $rid }}"',
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
				var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventAttendanceRegion.mrt&param1="{{ $rid }}"';
				window.open(url, '_blank');
			    e.preventDefault();
			});

			$('#fAttendancePrint').submit(function(e) {
				noty({
					layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'PrintAttendancePrint/"{{ $rid }}"',
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
				var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventAttendance.mrt&param1="{{ $rid }}"';
				window.open(url, '_blank');
			    e.preventDefault();
			});

			$('#fAttendanceStudentDivisionPrint').submit(function(e) {
				noty({
					layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'PrintAttendanceStudentDivisionPrint/"{{ $rid }}"',
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
				var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventAttendanceStudentDivision.mrt&param1="{{ $rid }}"';
				window.open(url, '_blank');
			    e.preventDefault();
			});

			$('#fAttendanceByPeformerPrint').submit(function(e) {
				noty({
					layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'PrintAttendanceByPeformerPrint/' + $('#eventattendance').val(),
			        type: 'POST',
			        data: { id: $('#eventattendance').val() },
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
				var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventAttendanceByPerformer.mrt&param1="' + $('#eventid').val() + '"';
				window.open(url, '_blank');
			    e.preventDefault();
			});
		});
	</script>
@stop