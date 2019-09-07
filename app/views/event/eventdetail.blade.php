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
			<li class="active">{{ $pagetitle }}</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Events<small><i class="ace-icon fa fa-angle-double-right"></i> {{ $pagetitle }}</small></h1>
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
						<li>
							<a data-toggle="tab" href="#card">
								<i class="blue fa fa-credit-card bigger-110"></i>
								Card
							</a>
						</li> <!-- Card -->
						@if ($REEV07R == 't') 
							<li>
								<a data-toggle="tab" href="#attendance">
									<i class="green fa fa-bullhorn bigger-110"></i>
									Attendance
								</a>
							</li>
						@endif <!-- Attendance -->
						<li>
							<a data-toggle="tab" href="#statistic">
								<i class="green fa fa-bar-chart bigger-110"></i>
								Statistic
							</a>
						</li> <!-- Statistic -->
						@if ($REEV01R == 't') 
							<li>
								<a data-toggle="tab" href="#eventitem">
									<i class="orange fa fa-user bigger-110"></i>
									Event Item
								</a>
							</li>
							<li>
								<a data-toggle="tab" href="#eventgroup">
									<i class="purple fa fa-group bigger-110"></i>
									Groups
								</a>
							</li>
							<li>
								<a data-toggle="tab" href="#eventshow">
									<i class="pink fa fa-film bigger-110"></i>
									Show Dates
								</a>
							</li>
						@endif <!-- Event Item, Event Group, Event Show -->
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
							<li>
								<a data-toggle="tab" href="#accessrights">
									<i class="red fa fa-key"></i>
									Access
								</a>
							</li>
						@endif <!-- Logs, Access Rights -->
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane in active">
							@foreach ($result as $result)
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box widget-color-orange collapsed">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Event Information - {{ $result->description }}
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
												{{ Form::open(array('action' => 'EventController@putEvent', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														{{ Form::label('eventdate', 'Event Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('eventdate', date("d-M-Y",strtotime($result->eventdate)), array('class' => 'date-picker col-xs-12 col-sm-9', 'data-date-format' => 'dd-M-yyyy'));}}
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
														{{ Form::label('location', 'Location:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('location' , $result->location, array('class' => 'col-xs-12 col-sm-9', 'id' => 'location'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('eventype', 'Event Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('eventtype', $eventtype_options, $result->eventtype, array('class' => 'col-xs-12 col-sm-9', 'id' => 'eventtype'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('divisiontype', 'Division Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('divisiontype', $divisiontype_options, $result->divisiontype, array('class' => 'col-xs-12 col-sm-9', 'id' => 'divisiontype'));}}
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
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowmemregistration', 'Allow Member Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowmemregistration', 'false', $result->memregistration, array('id' => 'allowmemregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowshqregistration', 'Allow SHQ Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowshqregistration', 'false', $result->shqregistration, array('id' => 'allowshqregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowregionregistration', 'Allow Region Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowregionregistration', 'false', $result->regionregistration, array('id' => 'allowregionregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowzoneregistration', 'Allow Zone Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowzoneregistration', 'false', $result->zoneregistration, array('id' => 'allowzoneregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowchapterregistration', 'Allow Chapter Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowchapterregistration', 'false', $result->chapterregistration, array('id' => 'allowchapterregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowdistrictregistration', 'Allow District Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowdistrictregistration', 'false', $result->districtregistration, array('id' => 'allowdistrictregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowspecialregistration', 'Special Requirement', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowspecialregistration', 'false', $result->special, array('id' => 'allowspecialregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('readonly', 'Read Only', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('readonly', 'false', $result->readonly, array('id' => 'readonly'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('viewattendance', 'View Attendance', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('viewattendance', 'false', $result->viewattendance, array('id' => 'viewattendance'));}}
															</div>
														</div>
													</div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('sessionselect', 'Select session', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('sessionselect', 'false', $result->sessionselect, array('id' => 'sessionselect'));}}
															</div>
														</div>
													</div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('languageselect', 'Select Language', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('languageselect', 'false', $result->languageselect, array('id' => 'languageselect'));}}
															</div>
														</div>
													</div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('nationalityselect', 'Select Nationality', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('nationalityselect', 'false', $result->nationalityselect, array('id' => 'nationalityselect'));}}
															</div>
														</div>
													</div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('addnontokang', 'Enable "Add Others" Button', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('addnontokang', 'false', $result->addnontokang, array('id' => 'addnontokang'));}}
															</div>
														</div>
													</div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('directaccept', 'Accepted Status', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('directaccept', 'false', $result->directaccept, array('id' => 'directaccept'));}}
															</div>
														</div>
													</div>™
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('createby', 'Create By:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('createby', $result->createby, array('class' => 'col-xs-12 col-sm-9'));}}
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
															{{ Form::label('eventid', 'Event ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('eventid', $result->uniquecode, array('class' => 'col-xs-12 col-sm-9', 'id' => 'eventid'));}}
																</div>
															</div>
														</div>
													</div>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div> <!-- Event Information -->
							@endforeach <!-- Event -->
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
											Forward Participants to Another Event
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
											{{ Form::open(array('action' => 'EventDetailController@postNricSearch', 'id' => 'feventforward', 'class' => 'form-horizontal')) }}
												<br />
												<div class="form-group">
													{{ Form::label('eventforward', 'Event Forward:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('eventforward', $event_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'eventforward'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('eventitemforward', 'Forward Item:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('eventitemforward', 'false', array('id' => 'eventitemforward'));}}
														</div>
													</div>
												</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div> <!-- Forward Participants to Another Event -->
							@if ($REEVGKA == 't')
								<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
									<div class="widget-box collapsed widget-color-purple">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Update UniqueCode
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
												{{ Form::open(array('action' => 'EventDetailController@postUniqueCode', 'id' => 'fUniqueCodeUpdate', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														<div class="col-md-offset-2 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('Update Uniquecode', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
															</div>
														</div>
													</div>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div> <!-- Update uniquecode -->
								<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
									<div class="widget-box collapsed widget-color-purple">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Update Access Rights
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
												{{ Form::open(array('action' => 'EventDetailController@postAttendanceAccessRights', 'id' => 'fAccessRights', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														{{ Form::label('User', 'User:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('user', array('gakkai01' => 'gakkai01', 'gakkai02' => 'gakkai02', 'adult01' => 'adult01', 'adult02' => 'adult02', 'preadmin' => 'preadmin', 'preadmin02' => 'preadmin02', 'youth01' => 'youth01', 'youth02' => 'youth02'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'user'));}}
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-offset-3 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('Assign', array('type' => 'Submit', 'class' => 'btn btn-warning btn-lg', 'id' => 'accessrights' )); }}
															</div>
														</div>
													</div>
													
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div> <!-- Update Access Rights -->
								<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
									<div class="widget-box collapsed widget-color-purple">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Register All Leaders
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
												{{ Form::open(array('action' => 'EventDetailController@postAllLeaders', 'id' => 'fAllLeaders', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														<div class="col-md-offset-2 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('All Leaders', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
															</div>
														</div>
													</div>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div> <!-- Registered All Leaders into Event -->
								<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
									<div class="widget-box collapsed widget-color-purple">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Register Youth Leaders
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
												{{ Form::open(array('action' => 'EventDetailController@postYouthLeaders', 'id' => 'fYouthLeaders', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														<div class="col-md-offset-2 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('Youth Leaders', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
															</div>
														</div>
													</div>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div> <!-- Registered Youth Leaders into Event -->
								<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
									<div class="widget-box collapsed widget-color-purple">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Register Youth SR Leaders
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
												{{ Form::open(array('action' => 'EventDetailController@postYouthSRLeaders', 'id' => 'fYouthSRLeaders', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														<div class="col-md-offset-2 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('Youth SR Leaders', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
															</div>
														</div>
													</div>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div> <!-- Registered Youth Leaders into Event -->
							@endif
							@if ($REEV06A == 't')
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box collapsed widget-color-green">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Register Member By Name and NRIC
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
												{{ Form::open(array('action' => 'EventDetailController@postNricSearch', 'id' => 'resourcenamesearch', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														{{ Form::label('namesearch', 'Search (Name / NRIC):', array('class' => 'control-label col-xs-12 col-sm-4 no-padding-right')); }}
														<div class="col-xs-12 col-sm-8">
															<div class="clearfix">
																{{ Form::text('namesearch', '', array('class' => 'ui-autocomplete-input col-xs-12 col-sm-9 ', 'id' => 'namesearch', 'autocomplete' => 'off'));}}
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
								</div> <!-- Register Member By NRIC and Name -->
							@endif
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Participants</h5>
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
											<table id="tdefault" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="hidden-480">Created At</th>
														<th class="hidden-480">Name</th>
														<th class="hidden-480">Item</th>
														<th class="hidden-480">A Code</th>
														<th class="hidden-480">Code</th>
														<th class="hidden-480">RHQ</th>
														<th class="hidden-480">Div</th>
														<th class="hidden-480">Age</th>
														<th class="hidden-480">Role</th>
														<th class="hidden-480">Status</th>
														<th class="hidden-480">Action</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
										<div class="widget-toolbox padding-8 clearfix">
											@if ($REEV06A == 't')
												<a href="{{ URL::action('EventDetailParticipantNewController@getIndex', $rid) }}" role="button" class="btn btn-xs btn-yellow bigger-120 pull-right" data-toggle="modal"><i class="fa fa-plus Add"></i>Add</a>
											@endif
										</div>
									</div>
								</div>
							</div> <!-- Event Member Listing -->
							<div id="btneventmemadd" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'EventDetailController@postAddMember', 'id' => 'resourceaddmember', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Add Record</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div class="form-group">
															{{ Form::label('aeventitem', 'Item:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('aeventitem', $eventitem_options, array('class' => 'col-xs-12 col-sm-11', 'id' => 'aeventitem'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('assaeventgroup', 'Group:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('assaeventgroup', $ssagroup_options, array('class' => 'col-xs-12 col-sm-11', 'id' => 'assaeventgroup'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('arole', 'Role:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('arole', $role_options, 'Participant', array('class' => 'col-xs-12 col-sm-11', 'id' => 'arole'));}}
																</div>
															</div>
														</div>
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
															{{ Form::label('aauditioncode', 'Audition Code:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('aauditioncode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'aauditioncode'));}}
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
							</div> <!-- Add Event Member -->
							<div id="btneventcardadd" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'EventDetailController@postAddEventCard', 'id' => 'resourceaddcard', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Add Card Record</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div class="form-group">
															{{ Form::label('cacardno', 'Card No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('cacardno', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cacardno'));}}
																</div>
															</div>
														</div>
														<div hidden>
															<div class="form-group">
																{{ Form::label('cardmemberid', 'Member ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('cardmemberid', '', array('class' => 'col-xs-12 col-sm-9'));}}
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
							</div> <!-- Add Event Security Pass -->
						</div>
						<div id="card" class="tab-pane">
							<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
								<div class="widget-box collapsed widget-color-green">
									<div class="widget-header widget-header-small">
										<h6 class="widget-title">
											<i class="icon-sort"></i>
											Assign Card By NRIC / Name
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
											{{ Form::open(array('action' => 'EventDetailController@postEventCardAssign', 'id' => 'EventCardAssign', 'class' => 'form-horizontal')) }}
												<br />
												<div class="form-group">
													{{ Form::label('anricsearch', 'NRIC / Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::text('anricsearch', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'anricsearch'));}}
														</div>
													</div>
												</div>
												<div class="space-2"></div>
												<div class="form-group">
													{{ Form::label('acardno', 'Card No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::text('acardno', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'acardno'));}}
														</div>
													</div>
												</div>
												<div class="space-2"></div>
												<div class="form-group">
													<div class="col-md-offset-5 col-xs-12 col-sm-12">
														<div class="clearfix">
															{{ Form::button('<i class="fa fa-check fa fa-on-right"></i> Submit', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
														</div>
													</div>
												</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div> <!-- Assign Card By NRIC / Name -->
							<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
								<div class="widget-box collapsed widget-color-orange">
									<div class="widget-header widget-header-small">
										<h6 class="widget-title">
											<i class="icon-sort"></i>
											Return Card By Card No
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
											{{ Form::open(array('action' => 'EventDetailController@postEventCardReturn', 'id' => 'EventCardReturn', 'class' => 'form-horizontal')) }}
												<br />
												<div class="form-group">
													{{ Form::label('rcardno', 'Card No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::text('rcardno', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'rcardno'));}}
														</div>
													</div>
												</div>
												<div class="space-2"></div>
												<div class="form-group">
													<div class="col-md-offset-5 col-xs-12 col-sm-12">
														<div class="clearfix">
															{{ Form::button('<i class="fa fa-check fa fa-on-right"></i> Submit', array('type' => 'Search', 'class' => 'btn btn-info btn-lg' )); }}
														</div>
													</div>
												</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div> <!-- Return Card By Card No -->
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Card No And Participants</h5>
										<div class="widget-toolbar">
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<table id="dtcardlisting" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="hidden-480">Created At</th>
														<th class="hidden-480">Card No</th>
														<th class="hidden-480">Name</th>
														<th class="hidden-480">Return Date</th>
														<th class="hidden-480">Status</th>
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
							</div> <!-- Event Card Listing -->
						</div>
						@if ($REEV07R == 't')
							<div id="attendance" class="tab-pane">
								<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
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
															<th class="hidden-480">Training Date</th>
															<th class="hidden-480">Event</th>
															<th class="hidden-480">Event Item</th>
															<th class="hidden-480">Description</th>
															<th class="hidden-480">Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												@if ($REEV07A == 't')
													<a href="#btnattendanceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add</a>
												@endif
											</div>
										</div>
									</div>
								</div>
								<div id="btnattendanceadd" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'EventDetailController@postEventAttendance', 'id' => 'attendanceadd', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Add Record</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div class="form-group">
																{{ Form::label('attendancedate', 'Attendance Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('attendancedate', '', array('class' => 'col-xs-11 col-sm-11 input-mask-date', 'id' => 'attendancedate', 'placeholder' => 'DD-MM-YYYY'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('attendancetype', 'AttendanceType:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::select('attendancetype', $attendancetype_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'attendancetype'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('atteventitem', 'Event Item:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::select('atteventitem', $eventitemprint_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'atteventitem'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('attdescription', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::textarea('attdescription', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'attdescription', 'rows' => '3'));}}
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
							</div> <!-- Attendance Listing for Current Event -->
						@endif <!-- Attendance -->
						<div id="statistic" class="tab-pane">
							<div id="progperformer" class="tab-pane">
								<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Registration Stats</h5>
											<div class="widget-toolbar">
												<a href="#reload" data-action="reload" onClick=reloaddt()>
													<i class="fa fa-refresh"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<table id="tprogperformer" class="table table-striped table-bordered table-hover">
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
													<tfoot id="tprogperformerfoot">
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
								</div>
							</div>
							<div id="progrolebystatus" class="tab-pane">
								<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Roles By Status Stats</h5>
											<div class="widget-toolbar">
												<a href="#reload" data-action="reload" onClick=reloaddt()>
													<i class="fa fa-refresh"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<table id="tprogrolebystatus" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Roles</th>
															<th>Accepted</th>
															<th>Processing</th>
															<th>Pending</th>
															<th>Rejected</th>
															<th>Withdrawn</th>
															<th>Reserved</th>
															<th>Interested</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot id="tprogrolebystatusfoot">
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
								</div>
							</div>
							<div id="progperformeronlyallstatus" class="tab-pane">
								<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Performer (All Status) By RHQ Stats</h5>
											<div class="widget-toolbar">
												<a href="#reload" data-action="reload" onClick=reloaddt()>
													<i class="fa fa-refresh"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<table id="tprogperformeronlyallstatus" class="table table-striped table-bordered table-hover">
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
													<tfoot id="tprogperformeronlyallstatusfoot">
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
								</div>
							</div>
							<div id="progperformeronly" class="tab-pane">
								<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Accepted Performer By RHQ Stats</h5>
											<div class="widget-toolbar">
												<a href="#reload" data-action="reload" onClick=reloaddt()>
													<i class="fa fa-refresh"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<table id="tprogperformeronly" class="table table-striped table-bordered table-hover">
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
													<tfoot id="tprogperformeronlyfoot">
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
								</div>
							</div>
						</div> <!-- Statistic -->
						@if ($REEV02R == 't') 
							<div id="eventitem" class="tab-pane">
								<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Event Item</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="reload">
													<i class="fa fa-refresh"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<table id="teventitem" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th class="hidden-480">Created At</th>
															<th class="hidden-480">Event Item</th>
															<th class="hidden-480">Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												{{ Form::open(array('action' => 'EventDetailController@postEventItem', 'id' => 'fEventItemAdd', 'class' => 'form-horizontal')) }}
													<fieldset>
															<div class="col-sm-offset-3 col-xs-8">
																{{ Form::text('txtEIvalue', '', array('class' => 'form-control', 'placeholder' => 'Please enter a value for new record', 'id' => 'txtEIvalue' )); }}
															</div>
															<div hidden>
																{{ Form::text('txtEIeventid', $rid, array('class' => 'form-control', 'placeholder' => 'Please enter a value for new record', 'id' => 'txtEIeventid' )); }}
															</div>
															{{ Form::button('<i class="fa fa-plus Add"></i> Add', array('type' => 'submit', 'class' => 'btn btn-xs bigger-120 btn-yellow bigger pull-right' )); }}
													</fieldset>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div>
								<div id="resourceeiedit" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'EventDetailController@putEventItem', 'id' => 'resourceeiupdate', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Edit Record</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div hidden>
																<div class="form-group">
																	{{ Form::label('eEIvalueid', 'ValueID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-9">
																		<div class="clearfix">
																			{{ Form::text('eEIvalueid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eEIvalueid', 'disabled'));}}
																		</div>
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('eEIvalue', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('eEIvalue', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eEIvalue'));}}
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
							<div id="eventgroup" class="tab-pane">
								<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Event Groups</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="reload">
													<i class="fa fa-refresh"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<table id="teventgroup" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th class="hidden-480">Created At</th>
															<th class="hidden-480">Event Groups</th>
															<th class="hidden-480">Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												{{ Form::open(array('action' => 'EventDetailController@postEventGroup', 'id' => 'fEventGroupAdd', 'class' => 'form-horizontal')) }}
													<fieldset>
															<div class="col-sm-offset-3 col-xs-8">
																{{ Form::select('txtEGvalue', $groups_options, $result->name, array('class' => 'col-xs-12 col-sm-9', 'id' => 'txtEGvalue'));}}
															</div>
															<div hidden>
																{{ Form::text('txtEGeventid', $rid, array('class' => 'form-control', 'placeholder' => 'Please enter a value for new record', 'id' => 'txtEGeventid' )); }}
															</div>
															{{ Form::button('<i class="fa fa-plus Add"></i> Add', array('type' => 'submit', 'class' => 'btn btn-xs bigger-120 btn-yellow bigger pull-right' )); }}
													</fieldset>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="eventshow" class="tab-pane">
								<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Event Show</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="reload">
													<i class="fa fa-refresh"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<table id="teventshow" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Created At</th>
															<th>Line No</th>
															<th>Event Show Date</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												{{ Form::open(array('action' => 'EventDetailController@postEventShow', 'id' => 'fEventShowAdd', 'class' => 'form-horizontal')) }}
													<fieldset>
															<div class="col-sm-offset-2 col-xs-2">
																<div>
																	{{ Form::text('txtESlineno', '', array('class' => 'form-control', 'placeholder' => 'Line No', 'id' => 'txtESlineno' )); }}
																</div>
															</div>
															<div class="col-sm-offset-2 col-xs-5">
																{{ Form::text('txtESvalue', '', array('class' => 'form-control', 'placeholder' => 'Please enter a value for new record', 'id' => 'txtESvalue' )); }}
															</div>
															<div hidden>
																{{ Form::text('txtESeventid', $rid, array('class' => 'form-control', 'placeholder' => 'Please enter a value for new record', 'id' => 'txtESeventid' )); }}
															</div>
															{{ Form::button('<i class="fa fa-plus Add"></i> Add', array('type' => 'submit', 'class' => 'btn btn-xs bigger-120 btn-yellow bigger pull-right' )); }}
													</fieldset>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div>
								<div id="resourceesedit" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'EventDetailController@putEventShow', 'id' => 'resourceesupdate', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Edit Record</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div hidden>
																<div class="form-group">
																	{{ Form::label('eESvalueid', 'ValueID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-9">
																		<div class="clearfix">
																			{{ Form::text('eESvalueid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eESvalueid', 'disabled'));}}
																		</div>
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('eESlineno', 'Line No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('eESlineno', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eESlineno'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('eESvalue', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('eESvalue', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eESvalue'));}}
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
						@endif <!-- Default Items like Event Group / Item -->
						@if ($REEV05R == 't') 
							<div id="reports" class="tab-pane">
								@if ($REEVRAR == 't' or $REEVGKA == 't')
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Detail Listing With Contacts and NRIC (Excel Version)</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postContactByAllPrint', 'id' => 'fRoleListingContactsByAllPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing By Contacts By NRIC For Study Exam Print -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Detail Listing Study Exam with Sensitive (Excel Version)</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postContactByAllStudyExamPrint', 'id' => 'fRoleListingContactsByAllStudyExamPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
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
												<h5 class="widget-title">Event Detail Listing (New Friends) with Contacts (Excel Version)</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postContactByAllPrint', 'id' => 'fNewFriendPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('dddivisionNF', 'Please select a division to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('dddivisionNF', array('MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD', 'YC' => 'YC'), 'MD', array('class' => 'col-xs-12 col-sm-1', 'id' => 'dddivisionNF'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing New Friends -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Gohonzon Statistics Name List</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postGohonzonStatisticPrint', 'id' => 'fGohonzonStatisticPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing By Gohonzon Statistic -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Gohonzon Statistics By Division</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postGohonzonStatisticByDivisionPrint', 'id' => 'fGohonzonStatisticByDivisionPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('dddivisionGSD', 'Please select a division to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('dddivisionGSD', array('MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD', 'YC' => 'YC'), 'MD', array('class' => 'col-xs-12 col-sm-1', 'id' => 'dddivisionGSD'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing New Friends -->
								@endif
								@if ($REEVRRR == 't')
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Detail Listing (Excel Version)</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postContactByAllPrintNoSensitive', 'id' => 'fRoleListingContactsByAllPrintNoSensitive', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing By All no Sensitive -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Detail Listing By Item with Contacts (Excel Version)</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postEventListingByItemWithContactsPrint', 'id' => 'fEventListingByItemWithContactsPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('seventitem', 'Please select an Event Item to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('seventitem', $eventitem_options, '', array('class' => 'col-xs-12 col-sm-4', 'id' => 'seventitem'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing By Item With Contacts Print -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Detail Listing By Status with Contacts (Excel Version)</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postEventListingByStatusWithContactsPrint', 'id' => 'fEventListingByStatusWithContactsPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('seventregstatus', 'Please select a Status to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('seventregstatus', $eventregstatus_options, '', array('class' => 'col-xs-12 col-sm-4', 'id' => 'seventregstatus'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Detail Listing By Status with Contacts (Excel Version) -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Listing By Groups with Costumes Measurement </h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postEventListingByGroupPrint', 'id' => 'fEventListingByGroupPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing By Group Print with Costumes Measurement -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Costume Measurement Listing By Groups with Signature</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postCostumeListingByGroupPrint', 'id' => 'fCostumeListingByGroupPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Costume Measurement Listing By Groups with Signature -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Listing By Groups For Attendance Taking (Performer Only) </h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postEventListingByGroupAttendancePerformerPrint', 'id' => 'fEventListingByGroupAttendancePerformerPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing By Groups For Attendance Taking (Performer Only) -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Listing By Groups For Attendance Taking </h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postEventListingByGroupAttendancePrint', 'id' => 'fEventListingByGroupAttendancePrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('role6', 'Please select a role to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('role6', $roleabbv_options, 'ADM', array('class' => 'col-xs-12 col-sm-4', 'id' => 'role6'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing By Groups For Attendance Taking -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Temporany Passes No Logo</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postTemporanyPassNoLogoPrint', 'id' => 'fTemporanyPassNoLogoPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('title', 'Title:', array('class' => 'control-label col-xs-12 col-sm-1')); }}
																{{ Form::text('title', '', array('class' => 'col-xs-12 col-sm-3', 'id' => 'title', 'placeholder' => 'Title'));}}
																{{ Form::label('startnumber', 'Start Number:', array('class' => 'control-label col-xs-12 col-sm-2')); }}
																{{ Form::text('startnumber', '10000', array('class' => 'col-xs-12 col-sm-1', 'id' => 'startnumber', 'placeholder' => 'Starting Number'));}}
																{{ Form::label('endnumber', 'End Number:', array('class' => 'control-label col-xs-12 col-sm-2')); }}
																{{ Form::text('endnumber', '10100', array('class' => 'col-xs-12 col-sm-1', 'id' => 'endnumber', 'placeholder' => 'Ending Number'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Temporany Passes No Logo -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Statictis By RHQ</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@getRoleStatictisPrint', 'id' => 'fRoleLStatictisPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('role3', 'Please select a role to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('role3', $role_options, $result->role, array('class' => 'col-xs-12 col-sm-4', 'id' => 'role3'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Statictis By RHQ -->
								@endif
								@if ($REEVRRR == 't' or $REEVIRR == 't')
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Detail Listing By Item With Costumes (Excel Version)</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postEventListingByItemPrint', 'id' => 'fEventListingByItemPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('seventitemrole', 'Please select an Event Item to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('seventitemrole', $eventitemprint_options, '', array('class' => 'col-xs-12 col-sm-4', 'id' => 'seventitemrole'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing By Item Print -->
								@endif
								@if ($REEVRRR == 't' or $REGPRRR == 't')
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Event Detail Listing By Group With Costumes (Excel Version)</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postEventListingByGroupPrint', 'id' => 'fEventListingBySSAGroupPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('sssagrouprole', 'Please select a Group to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('sssagrouprole', $ssagroupprint_options, '', array('class' => 'col-xs-12 col-sm-4', 'id' => 'sssagrouprole'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Event Listing By Group Print -->
								@endif
								@if ($REEV01R == 't')
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Listing By RHQ</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@getRoleListingPrint', 'id' => 'fRoleListingPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('role', 'Please select a role to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('role', $role_options, $result->role, array('class' => 'col-xs-12 col-sm-4', 'id' => 'role'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Listing By RHQ -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Listing By RHQ By Division</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postNewFriendContactByDivisionPrint', 'id' => 'fRoleListingByDivisionPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('role2', 'Please select a role to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('role2', $role_options, $result->role, array('class' => 'col-xs-12 col-sm-4', 'id' => 'role2'));}}
																{{ Form::select('dddivision', array('MD' => 'MD', 'WD' => 'WD'), 'MD', array('class' => 'col-xs-12 col-sm-1', 'id' => 'dddivision'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Listing By RHQ By Division -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Contacts Information By RHQ By Division</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postContactByDivisionPrint', 'id' => 'fRoleListingContactsByDivisionPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('role', 'Please select a role to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('role4', $role_options, $result->role, array('class' => 'col-xs-12 col-sm-4', 'id' => 'role4'));}}
																{{ Form::select('dddivision2', array('MD' => 'MD', 'WD' => 'WD'), 'MD', array('class' => 'col-xs-12 col-sm-1', 'id' => 'dddivision2'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Contacts Information By RHQ By Division -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Security Passes By RHQ By Division</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postSecurityPassesByDivisionPrint', 'id' => 'fRoleListingSecurityPassesByDivisionPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('role5', 'Please select a role to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('role5', $role_options, $result->role, array('class' => 'col-xs-12 col-sm-4', 'id' => 'role5'));}}
																{{ Form::select('dddivision3', array('MD' => 'MD', 'WD' => 'WD', 'YMD' => 'YMD', 'YWD' => 'YWD'), 'MD', array('class' => 'col-xs-12 col-sm-1', 'id' => 'dddivision3'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Security Passes By RHQ By Division -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Security Passes By Individual</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postSecurityPassesByIndividualPrint', 'id' => 'fSecurityPassesByIndividual', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
																<a href="#tSecurityPass" role="button" onClick=viewsecuritypasslist class="btn btn-Info bigger pull-right" data-toggle="modal"><i class="fa fa-eye"></i> View List</a>
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Security Passes By Individual -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Temporany Passes</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postTemporanyPassPrint', 'id' => 'fTemporanyPassPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('startnumber', 'Start Number:', array('class' => 'control-label col-xs-12 col-sm-3')); }}
																{{ Form::text('startnumber', '10000', array('class' => 'col-xs-12 col-sm-2', 'id' => 'startnumber', 'placeholder' => 'Starting Number'));}}
																{{ Form::label('endnumber', 'End Number:', array('class' => 'control-label col-xs-12 col-sm-3')); }}
																{{ Form::text('endnumber', '10100', array('class' => 'col-xs-12 col-sm-2', 'id' => 'endnumber', 'placeholder' => 'Ending Number'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Temporany Passes -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Groups</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postGroupsPrint', 'id' => 'fGroupsPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::label('role6', 'Please select a role to print:', array('class' => 'control-label col-xs-12 col-sm-5')); }}
																{{ Form::select('role6', $role_options, $result->role, array('class' => 'col-xs-12 col-sm-4', 'id' => 'role6'));}}
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Groups -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Contacts Information For Accepted Participant But No Group Code</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postAcceptedNoGroupCodePrint', 'id' => 'fContactsAcceptedNoGroupCodePrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Contacts Information Accepted Participant No Group Code -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Costume Measurement Listing By Groups</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postCostumeListingPrint', 'id' => 'fCostumeListingPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Costume Listing By Groups -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Costume Slips</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postCostumesSlipPrint', 'id' => 'fCostumesSlipPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Costumes Slips -->
									<div class="col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Contacts Information By All By Division</h5>
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>
											<div class="widget-body">
												<div class="widget-main">
													<div class="well well-lg">
														{{ Form::open(array('action' => 'EventDetailController@postContactByAllPrint', 'id' => 'fRoleListingContactsByAllPrint', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Contacts Information By All By Division -->
								@endif
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Event Attendance (All)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'EventDetailController@postEventAttendanceAllPrint', 'id' => 'fEventAttendanceAll', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Event Attendance -->
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Event Attendance For Culture Event (All)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'EventDetailController@postEventAttendanceAllPrint', 'id' => 'fEventAttendanceAllCulture', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Event Attendance -->
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Event Attendance By Chapter (All)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'EventDetailController@postEventAttendanceAllByChapterPrint', 'id' => 'fEventAttendanceAllByChapter', 'class' => 'form-horizontal')) }}
															<fieldset>
																{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
															</fieldset>
														{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Event Attendance By Chapter -->
							</div>
						@endif <!-- Reports -->
						@if ($REEV01R == 't') 
							<div id="logs" class="tab-pane">
							</div>
							<div id="accessrights" class="tab-pane">
								<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Event Access Rights</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="reload">
													<i class="fa fa-refresh"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<table id="teventaccessrights" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th class="hidden-480">Created At</th>
															<th class="hidden-480">Event Groups</th>
															<th class="hidden-480">Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif  <!-- Administrator -->
					</div>
				</div>
				<div id="tSecurityPass" class="modal fade" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header no-padding">
								<div class="table-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<span class="white">&times;</span>
									</button>
									Security Pass By Individual
								</div>
							</div>
							<div class="modal-body no-padding">
								<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" id="dtSecurityPassList">
									<thead>
										<tr>
											<th class="hidden-480">Created At</th>
											<th class="hidden-480">Name</th>
											<th class="hidden-480">RHQ</th>
											<th class="hidden-480">Zone</th>
											<th class="hidden-480">Chap</th>
											<th class="hidden-480">Div</th>
											<th class="hidden-480">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="modal-footer no-margin-top">
								<button class="btn btn-sm btn-success pull-right" data-dismiss="modal">
									<i class="fa fa-remove"></i>
									Close
								</button>
								{{ Form::open(array('action' => 'EventDetailController@deleteAllSecurityPass', 'id' => 'fSecurityPassDeleteAll', 'class' => 'form-horizontal')) }}
									<fieldset>
										{{ Form::button('<i class="fa fa-trash-o"></i> Delete All', array('type' => 'Search', 'class' => 'btn btn-sm btn-danger pull-right' )); }}
									</fieldset>
								{{ Form::close() }}
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>
				<div id="btnAccessRigthsAdd" class="modal fade" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'EventController@postEvent', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
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
												{{ Form::label('eventtype', 'Event Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::select('eventtype', $eventtype_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'eventtype'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('description', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('description', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'description'));}}
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
	<script type="text/javascript" src="{{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery-ui.min.js') }}}"></script>
	<script type="text/javascript">
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})

		$('#attendanceadd').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postEventAttendance/' + $("#eventid").val(),
		        type: 'POST',
		        data: { attendancedate: $("#attendancedate").val(), attdescription: $("#attdescription").val(), atteventitem: $("#atteventitem").val(), attendancetype: $("#attendancetype").val()},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oattTable = $('#tattendance').DataTable();
		        		oattTable.clearPipeline().draw();
		        		$("#btnattendanceeadd").modal('hide');
		        		$("#attendancedate").val(''); $("#eventtype").val(''); $("#atteventitem").val('');
		        		$("#attdescription").val('');
		        		$("#btnattendanceadd").modal('hide');
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

		$('#resourceadd').submit(function(e){
			noty({
				layout: 'topRight', type: 'warning', text: 'Redirecting ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'ParticipantNew/' + $('#eventid').val(),
		        type: 'POST',
		        data: { id: $('#eventid').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Successfully Updated!!',
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
		});
		
		$('#resourceaddmember').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postAddMember/' + $("#eventid").val(),
		        type: 'POST',
		        data: { membername: $("#membername").val(), eventid: $("#eventid").val(), memberid: $("#memberid").val(), assaeventgroup: $("#assaeventgroup").val(), aeventitem: $("#aeventitem").val(), arole: $("#arole").val(), aauditioncode: $("#aauditioncode").val()},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
		        		var oprogperformer = $('#tprogperformer').DataTable();
		        		oprogperformer.clearPipeline().draw();
		        		$("#btneventmemadd").modal('hide');
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

	    $('#fUniqueCodeUpdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postUniqueCode/' + $("#eventid").val(),
		        type: 'POST',
		        data: { eventid: $("#eventid").val()},
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

		$('#fAllLeaders').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postAllLeaders/' + $("#eventid").val(),
		        type: 'POST',
		        data: { eventid: $("#eventid").val()},
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

	    $('#fYouthLeaders').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postYouthLeaders/' + $("#eventid").val(),
		        type: 'POST',
		        data: { eventid: $("#eventid").val()},
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
		
		$('#fYouthSRLeaders').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postYouthSRLeaders/' + $("#eventid").val(),
		        type: 'POST',
		        data: { eventid: $("#eventid").val()},
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

	    $('#fAccessRights').submit(function(e){
	    	noty({
				layout: 'center', type: 'confirm', text: 'Do you want to Assign Attendance Rights?',
				animation: { open: 'animated tada', close: 'animated lightSpeedOut', easing: 'swing', speed: 500 },
				timeout: 4000,
				buttons: [
				    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
				    	$noty.close();
				    	noty({
							layout: 'topRight', type: 'warning', text: 'Updating Rights ...',
							animation: { open: 'animated tada', close: 'animated lightSpeedOut', easing: 'swing', speed: 500 },
							timeout: 4000
						});
				    	$.ajax({
					        url: 'postAttendanceAccessRights/' + $('#eventid').val(),
					        type: 'POST',
					        data: { uniquecode: $('#eventid').val(), user: $('#user').val() },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
			            			noty({
										layout: 'topRight', type: 'success', text: 'Rights Assigned!!',
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
							layout: 'topRight', type: 'success', text: 'Cancelled.',
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

		$('#fRoleListingContactsByAllPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintContactsAll/{{ $rid }}',
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventListingContactsByAll.mrt&param1="{{ $rid }}"&param2={{ Auth::user()->id }}';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fRoleListingContactsByAllStudyExamPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintContactsAllStudyExam/{{ $rid }}',
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventListingContactsByAllByStudyExam.mrt&param1="{{ $rid }}"&param2={{ Auth::user()->id }}';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fNewFriendPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postNewFriendContactByDivision/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#eventid').val(), dddivisionNF: $('#dddivisionNF').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventListingNewFriendWithContacts.mrt&param1="{{ $rid }}"&param3={{ Auth::user()->id }}&param2=' + $('#dddivisionNF').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});
		
		$('#fEventListingByItemWithContactsPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintEventListingByItemWithContacts/' + $('#eventid').val(),
		        type: 'POST',
		        data: { id: $('#eventid').val(), seventitem: $('#seventitem').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventParticipantsListingByEventItemWithContactsExcel.mrt&param1={{ $rid }}&param2={{ Auth::user()->uniquecode }}&param3=' + $('#seventitem').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fEventListingByStatusWithContactsPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintEventListingByStatusWithContacts/' + $('#eventid').val(),
		        type: 'POST',
		        data: { id: $('#eventid').val(), seventregstatus: $('#seventregstatus').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventParticipantsListingByEventStatusWithContactsExcel.mrt&param1="{{ $rid }}"&param2={{ Auth::user()->uniquecode }}&param3=' + $('#seventregstatus').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fEventListingByItemPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintEventListingByItem/' + $('#eventid').val(),
		        type: 'POST',
		        data: { id: $('#eventid').val(), seventitemrole: $('#seventitemrole').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventParticipantsListingByEventItemExcel.mrt&param1="{{ $rid }}"&param2=' + $('#seventitemrole').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});
		
		$('#fEventListingBySSAGroupPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintEventListingByGroup/' + $('#eventid').val(),
		        type: 'POST',
		        data: { id: $('#eventid').val(), sssagrouprole: $('#sssagrouprole').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventParticipantsListingByGroupExcel.mrt&param1="{{ $rid }}"&param2=' + $('#sssagrouprole').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fTemporanyPassNoLogoPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintTemporanyPassesNoLogo/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#eventid').val(), title: $('#title').val(), startnumber: $('#startnumber').val(), endnumber: $('#endnumber').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=TemporanyPassNoLogo.mrt&param1={{ Auth::user()->id }}&param2="{{ $rid }}"';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fRoleListingPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintRoleListing/' + $('#eventid').val(),
		        type: 'POST',
		        data: { id: $('#eventid').val(), role: $('#role').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventParticipants.mrt&param1="{{ $rid }}"&param2=' + $('#role').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fRoleListingByDivisionPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintRoleListingByDivision/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#id').val(), dddivision: $('#dddivision').val(), role2: $('#role2').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventParticipantsByDivision.mrt&param1="{{ $rid }}"&param2=' + $('#role2').val() + '&param3=' + $('#dddivision').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fRoleLStatictisPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintRoleStatictis/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#id').val(), role3: $('#role3').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventStatictis.mrt&param1="{{ $rid }}"&param2=' + $('#role3').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});
		
		$('#fRoleListingContactsByDivisionPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintRoleContacts/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#eventid').val(), dddivision2: $('#dddivision2').val(), role4: $('#role4').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=ContactsByDivision.mrt&param1="{{ $rid }}"&param4={{ Auth::user()->id }}&param2=' + $('#role4').val() + '&param3=' + $('#dddivision2').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fRoleListingSecurityPassesByDivisionPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintSecurityPasses/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#eventid').val(), dddivision3: $('#dddivision3').val(), role5: $('#role5').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=SecurityPassByRHQByDivision.mrt&param1="{{ $rid }}"&param4={{ Auth::user()->id }}&param2=' + $('#role5').val() + '&param3=' + $('#dddivision3').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fSecurityPassesByIndividual').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintSecurityPassesIndividual/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#eventid').val(), dddivision3: $('#dddivision3').val(), role5: $('#role5').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=SecurityPassByIndividual.mrt&param1={{ Auth::user()->id }}';
			window.open(url, '_blank');
		    e.preventDefault();
		});
		
		$('#fSecurityPassDeleteAll').submit(function(e) {
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
					        url: 'deleteAllSecurityPass/{{ $rid }}',
					        type: 'POST',
					        data: { id: $('#eventid').val() },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oSPTable = $('#dtSecurityPassList').DataTable();
					        		oSPTable.clearPipeline().draw();
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

		$('#fTemporanyPassPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintTemporanyPasses/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#eventid').val(), startnumber: $('#startnumber').val(), endnumber: $('#endnumber').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=TemporanyPass.mrt&param1={{ Auth::user()->id }}';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fGroupsPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintGroups/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#id').val(), role6: $('#role6').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventGroups.mrt&param2={{ Auth::user()->id }}&param1="{{ $rid }}"';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fContactsAcceptedNoGroupCodePrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'AcceptedNoGroupCode/{{ $rid }}',
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=ContactsAcceptedNoGroupCode.mrt&param2={{ Auth::user()->id }}&param1="{{ $rid }}';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fCostumeListingPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintCostumeListing/' + $('#eventid').val(),
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventCostumes.mrt&param1="{{ $rid }}';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fCostumesSlipPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintCostumesSlip/{{ $rid }}',
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventCostumesSlipEmpty.mrt&param1={{ $rid }}';
			window.open(url, '_blank');
		    e.preventDefault();
		});
		
		$('#fEventAttendanceAll').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintEventAttendanceAll/{{ $rid }}',
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
		        		noty({
							layout: 'topRight', type: 'error', text: txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventAttendanceAll.mrt&param1="{{ $rid }}"';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fEventAttendanceAllCulture').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintEventAttendanceAll/{{ $rid }}',
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
		        		noty({
							layout: 'topRight', type: 'error', text: txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventAttendanceAllCulture.mrt&param1="{{ $rid }}"';
			window.open(url, '_blank');
		    e.preventDefault();
		});
		
		$('#fEventAttendanceAllByChapter').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintEventAttendanceAllByChapter/{{ $rid }}',
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
		        		noty({
							layout: 'topRight', type: 'error', text: txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventAttendanceAllByChapter.mrt&param1="{{ $rid }}"&param2={{ Auth::user()->uniquecode }}';

			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fRoleListingContactsByAllPrintNoSensitive').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintContactsAllNoSensitive/{{ $rid }}',
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventListingContactsByAllNoSensitive.mrt&param1="{{ $rid }}"';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fGohonzonStatisticPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintGohonzonStatistic/{{ $rid }}',
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventListingGohonzonStatistic.mrt&param1="{{ $rid }}"&param2={{ Auth::user()->id }}';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fGohonzonStatisticByDivisionPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintGohonzonStatisticByDivision/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#eventid').val(), dddivisionGSD: $('#dddivisionGSD').val()  },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventListingGohonzonStatisticByDiv.mrt&param1="{{ $rid }}"&param2={{ Auth::user()->id }}&param3=' + $('#dddivisionGSD').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fEventListingByGroupPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintEventListingByGroup/' + $('#eventid').val(),
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventParticipantsListingByGroup.mrt&param1="{{ $rid }}"&param2={{ Auth::user()->id }}';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fCostumeListingByGroupPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintCostumeListingByGroup/' + $('#eventid').val(),
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventParticipantsCostumeListingByGroup.mrt&param1="{{ $rid }}"&param2={{ Auth::user()->id }}';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fEventListingByGroupAttendancePerformerPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintEventListingAttendancePerformerByGroup/' + $('#eventid').val(),
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventParticipantsListingByGroupAttendancePerformer.mrt&param1="{{ $rid }}"';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fEventListingByGroupAttendancePrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintEventListingAttendanceByGroup/' + $('#eventid').val(),
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventParticipantsListingByGroupAttendance.mrt&param1="{{ $rid }}"&param2=' + $('#role6').val();
			window.open(url, '_blank');
		    e.preventDefault();
		});
	</script>
	<script type="text/javascript">
		function viewsecuritypasslist(){
			var oSPTable = $('#dtSecurityPassList').DataTable();
			oSPTable.clearPipeline().draw();
			$('#tSecurityPass').show();
	    }

		function reloaddt(submit){ 
			var oTable = $('#tdefault').DataTable();
		    oTable.clearPipeline().draw();
		    var oprogperformer = $('#tprogperformer').DataTable();
		    oprogperformer.clearPipeline().draw();
		    var oprogperformeronly = $('#tprogperformeronly').DataTable();
			oprogperformeronly.clearPipeline().draw();
			var oprogperformeronlyallstatus = $('#tprogperformeronlyallstatus').DataTable();
		    oprogperformeronlyallstatus.ajax.reload(null, false);
		    var oprogrolebystatus = $('#tprogrolebystatus').DataTable();
		    oprogrolebystatus.clearPipeline().draw();
	    }

		function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                window.location.href = "Participant/" + submit;
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
					        url: 'deleteParticipant/' + submit,
					        type: 'POST',
					        data: { dparticipant: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oTable = $('#tdefault').DataTable();
					        		oTable.clearPipeline().draw();
					        		var oprogperformer = $('#tprogperformer').DataTable();
		    						oprogperformer.clearPipeline().draw();
		    						var oprogrolebystatus = $('#tprogrolebystatus').DataTable();
		    						oprogrolebystatus.clearPipeline().draw();
		    						var oprogperformeronly = $('#tprogperformeronly').DataTable();
		    						oprogperformeronly.clearPipeline().draw();
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

	    function accessrow(submit){ 
	    	noty({
				layout: 'center', type: 'confirm', text: 'Do you want to add this person to mark attendance?',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000,
				buttons: [
				    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
				    	$noty.close();
				    	noty({
							layout: 'topRight', type: 'warning', text: 'Adding Record ...',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
							timeout: 4000
						});
				    	$.ajax({
					        url: 'postAccessRightsTrainer/' + submit,
					        type: 'POST',
					        data: { dparticipant: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oTable = $('#tdefault').DataTable();
					        		oTable.clearPipeline().draw();
			            			noty({
										layout: 'topRight', type: 'success', text: 'Access Rights Added for this user!!',
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

	    function forwardrow(submit){
	    	if ($('#eventforward').val() != "")
	    	{
	    		if ($("#eventitemforward").is(':checked')) { $("#eventitemforward").val('1'); } else {$("#eventitemforward").val('0'); }
	    		noty({
					layout: 'topRight', type: 'warning', text: 'Forwarding participant to ' + $('#eventforward').val(),
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postforwardparticipanttoevent/' + submit,
			        type: 'POST',
			        data: { eventdetailid: submit, eventforward: $('#eventforward').val(), eventitemforward: $('#eventitemforward').val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
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
			        		else if (data.responseJSON.ErrType == "NoAccess") 
			        			{ txtMessage = 'You do not have Access Rights!'; }
			        		else { txtMessage = 'Please check your entry!'; }
			        		$("#role").focus();
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
	    	else
	    	{
	    		noty({
					layout: 'topRight', type: 'error', text: 'Please select an event to forward!',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
	    	}
	    }

	    function deleteeventcardrow(submit){ 
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
					        url: 'deleteEventCard/' + submit,
					        type: 'POST',
					        data: { dparticipant: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oCDTable = $('#dtcardlisting').DataTable();
									oCDTable.clearPipeline().draw();
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

	    function deleteeventcardwithdrawnrow(submit){ 
	    	noty({
				layout: 'center', type: 'confirm', text: 'Do you want to withdrawn record?',
				animation: { open: 'animated tada', close: 'animated lightSpeedOut', easing: 'swing', speed: 500 },
				timeout: 4000,
				buttons: [
				    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
				    	$noty.close();
				    	noty({
							layout: 'topRight', type: 'warning', text: 'Withdrawing Card ...',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
							timeout: 4000
						});
				    	$.ajax({
					        url: 'deleteEventCardWithdrawn/' + submit,
					        type: 'POST',
					        data: { dparticipant: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oCDTable = $('#dtcardlisting').DataTable();
									oCDTable.clearPipeline().draw();
			            			noty({
										layout: 'topRight', type: 'success', text: 'Record Withdrawn!!',
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
							layout: 'topRight', type: 'success', text: 'Wihdrawn Cancelled.',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
				      }
				    }
				]
			});
	    }

	    function deleteeventcardlostrow(submit){ 
	    	noty({
				layout: 'center', type: 'confirm', text: 'Do you want to Cancel Card?',
				animation: { open: 'animated tada', close: 'animated lightSpeedOut', easing: 'swing', speed: 500 },
				timeout: 4000,
				buttons: [
				    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
				    	$noty.close();
				    	noty({
							layout: 'topRight', type: 'warning', text: 'Cancelling Card ...',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
							timeout: 4000
						});
				    	$.ajax({
					        url: 'deleteEventCardLost/' + submit,
					        type: 'POST',
					        data: { dparticipant: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oCDTable = $('#dtcardlisting').DataTable();
									oCDTable.clearPipeline().draw();
			            			noty({
										layout: 'topRight', type: 'success', text: 'Record Cancelled!!',
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

	    function printrow(submit){ 
	    	$.ajax({
		        url: 'PrintApplicationHC/' + submit,
		        type: 'POST',
		        data: { id: submit },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){ 
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
	    	var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventRegistrationHC.mrt&param1=' + {{ Auth::user()->id }} + '&param2="' + submit + '"';
			window.open(url, '_blank');
	    }

	    function addsecurityrow(submit){
	    	$("#cardmemberid").val(submit);
	    	$("#cacardno").focus();
	    	$("#btneventcardadd").modal('show');
	    }

	    function deleteSProw(submit){ 
	    	noty({
				layout: 'center', type: 'confirm', text: 'Do you want to delete record?',
				animation: { open: 'animated tada', close: 'animated lightSpeedOut', easing: 'swing', speed: 500 },
				timeout: 4000,
				buttons: [
				    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
				    	$noty.close();
				    	noty({
							layout: 'topRight', type: 'warning', text: 'Deleting Record ...',
							animation: { open: 'animated tada', close: 'animated lightSpeedOut', easing: 'swing', speed: 500 },
							timeout: 4000
						});
				    	$.ajax({
					        url: 'deleteSecurityPass/' + submit,
					        type: 'POST',
					        data: { deleteSecurityPass: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oSPTable = $('#dtSecurityPassList').DataTable();
					        		oSPTable.clearPipeline().draw();
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

	    function editeirow(submit){ 
			var RowID = "";
	        var oEITable = $('#teventitem').DataTable();
	        $("#teventitem tbody tr").click(function () {
                var position = oEITable.row(this).index();
                RowID = oEITable.row(position).data();
                $("#eEIvalue").val(RowID.name);
                $("#eEIvalueid").val(submit);
                $("#resourceeiedit").modal('show');
            });
	    }

	    function deleteeirow(submit){ 
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
					        url: 'deleteEventItem/' + submit,
					        type: 'POST',
					        data: { deletevalue: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oEITable = $('#teventitem').DataTable();
					        		oEITable.clearPipeline().draw();
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

		function editesrow(submit){ 
			var RowID = "";
	        var oESTable = $('#teventshow').DataTable();
	        $("#teventshow tbody tr").click(function () {
                var position = oESTable.row(this).index();
                RowID = oESTable.row(position).data();
                $("#eESvalue").val(RowID.value);
				$("#eESlineno").val(RowID.lineno);
                $("#eESvalueid").val(submit);
                $("#resourceesedit").modal('show');
            });
	    }

	    function deleteesrow(submit){ 
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
					        url: 'deleteEventShow/' + submit,
					        type: 'POST',
					        data: { deletevalue: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oESTable = $('#teventshow').DataTable();
					        		oESTable.clearPipeline().draw();
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

	    function deleteegrow(submit){ 
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
					        url: 'deleteEventGroup/' + submit,
					        type: 'POST',
					        data: { deletevalue: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oEGTable = $('#teventgroup').DataTable();
					        		oEGTable.clearPipeline().draw();
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

	    function editaerow(submit){ 
			var RowID = "";
	        var oattTable = $('#tattendance').DataTable();
	        $("#tattendance tbody tr").click(function () {
                var position = oattTable.row(this).index();
                RowID = oattTable.row(position).data();
                window.location.href = "EventAttendance/" + submit;
            });
	    }

	    function deleteaerow(submit){ 
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
					        url: 'deleteEventAttendance/' + submit,
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

				$('#nricsearch').keyup(function(){
				    this.value = this.value.toUpperCase();
				});

				$('#namesearch').keyup(function(){
				    this.value = this.value.toUpperCase();
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
			        "deferRender": true,
			        "order": [[ 0, "desc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'getParticipantListing/' + "{{ $rid }}",
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
			    	{ "targets": [ 2 ], "data": "eventitem", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "auditioncode", "searchable": "true" },
			    	{ "targets": [ 4 ], "data": "groupcode", "searchable": "true" },
			    	{ "targets": [ 5 ], "data": "rhq", "searchable": "true" },
			    	{ "targets": [ 6 ], "data": "division", "searchable": "true" },
			    	{
				    	"targets": [ 7 ], "data": "dateofbirth",
				    	"render": function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		var nowyear = moment().format("YYYY");
				    		var birthyear = moment(data).format("YYYY");

				    		var diff = nowyear - birthyear;
				    		if (data == '0000-00-00') { return '';} 
				    		else if (data == '') { return ''; }
				    		else { return diff; }
				    		return data;
					    }
			    	},
			    	{
				    	"targets": [ 8 ], "data": "role",
				    	"render": function ( data, type, full ){
				    		return data.substring(0, 3) + '...';
					    }
			    	},
			    	{
				    	"targets": [ 9 ], "data": "status",
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
			    	{
				    	"targets": [ 10 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		@if ($REEVGKA == 't' || $REEVRAR == 't' || $REEVRRR == 't')
				    			return '<a href="#resourceedit" role="button" onClick=editrow("'+ data +'") class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button> <button type="submit" onClick=addsecurityrow("'+ data +'") class="btn btn-xs btn-purple"><i class="fa fa-bolt bigger-120"></i></button> <button type="submit" onClick=printrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-print bigger-120"></i></button> </button> <button type="submit" onClick=accessrow("'+ data +'") class="btn btn-xs btn-inverse"><i class="fa fa-key bigger-120"></i></button> <button type="submit" onClick=forwardrow("'+ data +'") class="btn btn-xs btn-pink"><i class="fa fa-mail-forward bigger-120"></i></button>'
			    			@else
			    				return '<a href="#resourceedit" role="button" onClick=editrow("'+ data +'") class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button> <button type="submit" onClick=addsecurityrow("'+ data +'") class="btn btn-xs btn-purple"><i class="fa fa-bolt bigger-120"></i></button> <button type="submit" onClick=printrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-print bigger-120"></i></button> </button> <button type="submit" onClick=forwardrow("'+ data +'") class="btn btn-xs btn-pink"><i class="fa fa-mail-forward bigger-120"></i></button>'
		    				@endif
					    }
			    	}]
			    }); // Event Detail Listing

				var oprogperformer = $('#tprogperformer').DataTable({
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
			        "order": [[ 0, "asc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'getEventProgPerformer/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
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
		                    $('#tprogperformerfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    }); // Programme Performer Statistic

				var oprogrolebystatus = $('#tprogrolebystatus').DataTable({
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
			        "order": [[ 0, "asc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'getEventRoleByStatus/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
			        { "targets": [ 0 ], "data": "role" },
	            	{ "targets": [ 1 ], "data": "Accepted" },
	            	{ "targets": [ 2 ], "data": "Processing" },
	            	{ "targets": [ 3 ], "data": "Pending" },
	            	{ "targets": [ 4 ], "data": "Rejected" },
	            	{ "targets": [ 5 ], "data": "Withdrawn" },
	            	{ "targets": [ 6 ], "data": "Reserved" },
	            	{ "targets": [ 7 ], "data": "Interested" },
	            	{ "targets": [ 8 ], "data": "Total" }],
	            	"footerCallback": function () {
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
		                    $('#tprogrolebystatusfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    }); // Programme Role by Status Statistic

				var oprogperformeronly = $('#tprogperformeronly').DataTable({
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
			        "order": [[ 0, "asc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'getEventProgPerformerOnly/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
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
		                    $('#tprogperformeronlyfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
				}); // Programme Performer Only Statistic
				
				var oprogperformeronlyallstatus = $('#tprogperformeronlyallstatus').DataTable({
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
			        "ajax": 'getEventProgPerformerOnlyAllStatus/{{ $rid }}',
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
		                    $('#tprogperformeronlyallstatusfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    }); // Programme Performer (All Status) Only Statistic

				var oSPTable = $('#dtSecurityPassList').DataTable({
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
			            url: 'getSecurityPassListing/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "rhq", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "zone", "searchable": "true" },
			    	{ "targets": [ 4 ], "data": "chapter", "searchable": "true" },
			    	{ "targets": [ 5 ], "data": "district", "searchable": "true" },
			    	{
				    	"targets": [ 6 ], "data": "id",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=deleteSProw("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Security Pass Datatable
				
				var oCDTable = $('#dtcardlisting').DataTable({
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
			            url: 'getEventCardListing/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "updated_at", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "cardno", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "name", "searchable": "true" },
			    	{
				    	"targets": [ 3 ], "data": "returndatetime", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		if (data == '0000-00-00 00:00:00') { return '';} 
				    		else if (data == '') { return ''; }
				    		else if (data == null) { return ''; }
				    		else { return moment(data).format("DD-MMM-YYYY HH:mm:ss"); }
				    		
					    }
			    	},
			    	{ "targets": [ 4 ], "data": "status", "searchable": "true" },
			    	{
				    	"targets": [ 5 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=deleteeventcardrow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button> <button type="submit" onClick=deleteeventcardwithdrawnrow("'+ data +'") class="btn btn-xs btn-inverse"><i class="fa fa-sign-out bigger-120"></i></button> <button type="submit" onClick=deleteeventcardlostrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-life-ring bigger-120"></i></button>'
					    }
			    	}]
			    }); // Card Detail Datatable

				var oEventItem = $('#teventitem').DataTable({
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
			            url: 'getEventItemListing/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			    	{
				    	"targets": [ 2 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=editeirow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleteeirow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Event Item Datatable

				var oEventShow = $('#teventshow').DataTable({
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
			            url: 'getEventShowListing/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
					{ "targets": [ 1 ], "data": "lineno", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "value", "searchable": "true" },
			    	{
				    	"targets": [ 3 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=editesrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleteesrow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Event Item Datatable

				var oEventGroup = $('#teventgroup').DataTable({
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
			            url: 'getEventGroupListing/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			    	{
				    	"targets": [ 2 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=deleteegrow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Event Group Datatable
				
				var oAttendance = $('#tattendance').DataTable({
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
			            url: 'getEventAttendanceListing/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "attendancedate", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "event", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "eventitem", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "description", "searchable": "true" },
			    	{
				    	"targets": [ 4 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=editaerow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleteaerow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Event Item Datatable

				var oEventAccessRights = $('#teventaccessrights').DataTable({
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
			            url: 'getEventGroupListing/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			    	{
				    	"targets": [ 2 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=deleteegrow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Event Access Rights Datatable

			});
		});
	</script>
	<script type="text/javascript">
		$('#resourceupdate').submit(function(e){
			if ($("#allowmemregistration").is(':checked')) { $("#allowmemregistration").val('1'); } else {$("#allowmemregistration").val('0'); }
			if ($("#allowshqregistration").is(':checked')) { $("#allowshqregistration").val('1'); } else {$("#allowshqregistration").val('0'); }
			if ($("#allowregionregistration").is(':checked')) { $("#allowregionregistration").val('1'); } else {$("#allowregionregistration").val('0'); }
			if ($("#allowzoneregistration").is(':checked')) { $("#allowzoneregistration").val('1'); } else {$("#allowzoneregistration").val('0'); }
			if ($("#allowchapterregistration").is(':checked')) { $("#allowchapterregistration").val('1'); } else {$("#allowchapterregistration").val('0'); }
			if ($("#allowdistrictregistration").is(':checked')) { $("#allowdistrictregistration").val('1'); } else {$("#allowdistrictregistration").val('0'); }
			if ($("#allowspecialregistration").is(':checked')) { $("#allowspecialregistration").val('1'); } else {$("#allowspecialregistration").val('0'); }
			if ($("#readonly").is(':checked')) { $("#readonly").val('1'); } else {$("#readonly").val('0'); }
			if ($("#viewattendance").is(':checked')) { $("#viewattendance").val('1'); } else {$("#viewattendance").val('0'); }
			if ($("#sessionselect").is(':checked')) { $("#sessionselect").val('1'); } else {$("#sessionselect").val('0'); }
			if ($("#languageselect").is(':checked')) { $("#languageselect").val('1'); } else {$("#languageselect").val('0'); }
			if ($("#nationalityselect").is(':checked')) { $("#nationalityselect").val('1'); } else {$("#nationalityselect").val('0'); }
			if ($("#addnontokang").is(':checked')) { $("#addnontokang").val('1'); } else {$("#addnontokang").val('0'); }
			if ($("#directaccept").is(':checked')) { $("#directaccept").val('1'); } else {$("#directaccept").val('0'); }
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putEvent/' + $("#eventid").val(),
		        type: 'POST',
		        data: { eventdate: $("#eventdate").val(), description: $("#description").val(), location: $("#location").val(), divisiontype: $("#divisiontype").val(), eventtype: $("#eventtype").val(), status: $("#status").val(), allowshqregistration: $("#allowshqregistration").val(), allowmemregistration: $("#allowmemregistration").val(), allowregionregistration: $("#allowregionregistration").val(), allowzoneregistration: $("#allowzoneregistration").val(), allowchapterregistration: $("#allowchapterregistration").val(), allowdistrictregistration: $("#allowdistrictregistration").val(), special: $("#allowspecialregistration").val(), readonly: $("#readonly").val(), viewattendance: $("#viewattendance").val(), sessionselect: $("#sessionselect").val(), languageselect: $("#languageselect").val(), addnontokang: $("#addnontokang").val(), directaccept: $("#directaccept").val() },
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
		
		$('#fEventItemAdd').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postEventItem',
		        type: 'POST',
		        data: { txtEIvalue: $("#txtEIvalue").val(), txtEIeventid: $("#txtEIeventid").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oEITable = $('#teventitem').DataTable();
						oEITable.clearPipeline().draw();
						$("#txtEIvalue").val('');
						$("#txtEIvalueid").val('');
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
		        		$("#txtEIvalue").focus();
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

		$('#resourceeiupdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putEventItem/' + $("#eEIvalueid").val(),
		        type: 'POST',
		        data: { eEIvalue: $("#eEIvalue").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oEITable = $('#teventitem').DataTable();
						oEITable.clearPipeline().draw();
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						$("#resourceeiedit").modal('hide');
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

		$('#fEventShowAdd').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postEventShow',
		        type: 'POST',
		        data: { txtESvalue: $("#txtESvalue").val(), txtESlineno: $("#txtESlineno").val(), txtESeventid: $("#txtESeventid").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oESTable = $('#teventshow').DataTable();
						oESTable.clearPipeline().draw();
						$("#txtESvalue").val('');
						$("#txtESlineno").val('');
						$("#txtESvalueid").val('');
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
		        		$("#txtEIvalue").focus();
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

		$('#resourceesupdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putEventShow/' + $("#eESvalueid").val(),
		        type: 'POST',
		        data: { eESvalue: $("#eESvalue").val(), eESlineno: $("#eESlineno").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oESTable = $('#teventshow').DataTable();
						oESTable.clearPipeline().draw();
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						$("#resourceesedit").modal('hide');
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

		$('#fEventGroupAdd').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postEventGroup',
		        type: 'POST',
		        data: { txtEGvalue: $("#txtEGvalue").val(), txtEGeventid: $("#txtEGeventid").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#teventgroup').DataTable();
						oTable.clearPipeline().draw();
						$("#txtEGvalue").val('');
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
		        		$("#txtEIvalue").focus();
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

		$('#resourcenricesearch').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Searching Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postNricSearch/' + $("#eventid").val(),
		        type: 'POST',
		        data: { nricsearch: $("#nricsearch").val(), eventid: $("#eventid").val() },
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
		
		$('#EventCardAssign').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Inserting Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postEventCardAssign/' + $("#eventid").val(),
		        type: 'POST',
		        data: { anricsearch: $("#anricsearch").val(), eventid: $("#eventid").val(), acardno: $("#acardno").val()  },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oCDTable = $('#dtcardlisting').DataTable();
						oCDTable.clearPipeline().draw();
						var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
						$("#anricsearch").val('');
						$("#acardno").val('');
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
	        			else if (data.responseJSON.ErrType == "Duplicate") 
	        			{ txtMessage = 'Record already existed!'; }
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

		$('#resourceaddcard').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Inserting Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postAddEventCard/' + $("#cardmemberid").val(),
		        type: 'POST',
		        data: { cardmemberid: $("#cardmemberid").val(), eventid: $("#eventid").val(), cacardno: $("#cacardno").val()  },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oCDTable = $('#dtcardlisting').DataTable();
						oCDTable.clearPipeline().draw();
						var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
						$("#cacardno").val('');
						$("#btneventcardadd").modal('hide');
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Found!! ',
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

		$('#EventCardReturn').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postEventCardReturn/' + $("#eventid").val(),
		        type: 'POST',
		        data: { eventid: $("#eventid").val(), rcardno: $("#rcardno").val()  },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oCDTable = $('#dtcardlisting').DataTable();
						oCDTable.clearPipeline().draw();
						$("#rcardno").val('');
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!! ',
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

		$('#anricsearch').autocomplete({
			source: '../getEventCardNameSearch?eventid=' + $("#eventid").val(),
			minLength: 3	
		});

		$('#resourcenamesearch').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Searching Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postNricSearch/' + $("#eventid").val(),
		        type: 'POST',
		        data: { nricsearch: $("#namesearch").val(), eventid: $("#eventid").val() },
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
		        		$("#namesearch").val("");
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

		$('#namesearch').autocomplete({
			source: "../getNameSearch",
			minLength: 3	
		});
	</script>
@stop