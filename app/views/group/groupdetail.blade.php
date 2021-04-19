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
			<li><a href="{{{ URL::action('GroupController@getIndex') }}}">Groups</a></li>
			<li class="active">{{ $pagetitle }}</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Groups<small><i class="ace-icon fa fa-angle-double-right"></i> {{ $pagetitle }}</small></h1>
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
							<a data-toggle="tab" href="#otherlist">
								<i class="gray fa fa-circle-o bigger-110"></i>
								Other List
							</a>
						</li> <!-- Other List -->
						<li>
							<a data-toggle="tab" href="#events">
								<i class="purple fa fa-calendar bigger-110"></i>
								Events
							</a>
						</li> <!-- Events -->
						<li>
							<a data-toggle="tab" href="#premadkenshu">
								<i class="purple fa fa-heartbeat bigger-110"></i>
								Pre M&D Kenshu
							</a>
						</li> <!-- Events -->
						<li>
							<a data-toggle="tab" href="#attendance">
								<i class="blue fa fa-star bigger-110"></i>
								Attendance
							</a>
						</li> <!-- Attendance -->
						@if ($REGP02R == 't') 
							<li>
								<a data-toggle="tab" href="#zposition">
									<i class="inverse fa fa-group bigger-110"></i>
									Position
								</a>
							</li>
							<li>
								<a data-toggle="tab" href="#zcontactgroup">
									<i class="pink fa fa-bullhorn bigger-110"></i>
									Contact Group
								</a>
							</li>
						@endif <!-- Position -->
						@if ($REGP05R == 't') 
							<li>
								<a data-toggle="tab" href="#reports">
									<i class="green fa fa-user bigger-110"></i>
									Reports
								</a>
							</li>
						@endif <!-- Reports -->
						@if ($REGP01R == 't') 
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
						@endif <!-- Logs -->
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane in active">
							@foreach ($result as $result)
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box collapsed">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Group Information - {{ $result->name }}
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
												{{ Form::open(array('action' => 'GroupController@putGroup', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														{{ Form::label('groupformed', 'Formation Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('groupformed', date("d-M-Y",strtotime($result->groupformed)), array('class' => 'date-picker col-xs-12 col-sm-9', 'data-date-format' => 'dd-M-yyyy'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('name', 'Group Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('name', $result->name, array('class' => 'col-xs-12 col-sm-9', 'id' => 'name'));}}
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
														{{ Form::label('grouptype', 'Group Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('grouptype', $grouptype_options, $result->grouptype, array('class' => 'col-xs-12 col-sm-9', 'id' => 'grouptype'));}}
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
																{{ Form::select('status', $status_options, $result->status, array('class' => 'col-xs-12 col-sm-9', 'id' => 'status'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('groupceased', 'Ceased Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																@if($result->groupceased == NULL)
																	{{ Form::text('groupceased', '', array('class' => 'date-picker col-xs-12 col-sm-9', 'data-date-format' => 'dd-M-yyyy'));}}
																@else
																	{{ Form::text('groupceased', date("d-M-Y",strtotime($result->groupceased)), array('class' => 'date-picker col-xs-12 col-sm-9', 'data-date-format' => 'dd-M-yyyy'));}}
																@endif
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
															{{ Form::label('groupid', 'group ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('groupid', $result->uniquecode, array('class' => 'col-xs-12 col-sm-9', 'id' => 'groupid'));}}
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
											{{ Form::open(array('action' => 'GroupDetailController@postNricSearch', 'id' => 'resourcenricesearch', 'class' => 'form-horizontal')) }}
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
								<div id="btnmemadd" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'GroupDetailController@postAddNewMember', 'id' => 'resourceaddnewmember', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Add Record</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div class="form-group">
																{{ Form::label('addmembername', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('addmembername', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'addmembername'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('addnric', 'Nric:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('addnric', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'addnric'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('adddateofbirth', 'DOB:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('adddateofbirth', '', array('class' => 'col-xs-12 col-sm-11', 'placeholder' => 'YYYY-MM-DD'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('addposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::select('addposition', $memposition_options, 'NF', array('class' => 'col-xs-12 col-sm-11', 'id' => 'addposition'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('adddivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::select('adddivision', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'adddivision'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('addrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::select('addrhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'addrhq'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('addzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::select('addzone', $zone_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'addzone'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('addchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::select('addchapter', $chapter_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'addchapter'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('district', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('adddistrict', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'adddistrict'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('addtel', 'Tel (Home):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('addtel', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'addtel'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('addmobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('addmobile', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'addmobile'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('addemail', 'Email:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('addemail', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'addemail'));}}
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
							</div> <!-- Register Member By NRIC -->
							@if ($REEVGKA == 't' or $REGP01R == 't')
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box collapsed widget-color-green">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Register Member By Name
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
												{{ Form::open(array('action' => 'GroupDetailController@postNricSearch', 'id' => 'resourcenamesearch', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														{{ Form::label('namesearch', 'Search (Name):', array('class' => 'control-label col-xs-12 col-sm-4 no-padding-right')); }}
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
								</div>
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
												{{ Form::open(array('action' => 'GroupDetailController@postUniqueCode', 'id' => 'fUniqueCodeUpdate', 'class' => 'form-horizontal')) }}
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
							@endif <!-- Register Member By NRIC and Name and Update UniqueCode-->
							<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
								<div class="widget-box collapsed widget-color-green">
									<div class="widget-header widget-header-small">
										<h6 class="widget-title">
											<i class="icon-sort"></i>
											Forward Member to Event
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
											{{ Form::open(array('id' => 'fforwardevent', 'class' => 'form-horizontal')) }}
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
													{{ Form::label('role', 'Event Role:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('role', $role_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'role'));}}
														</div>
													</div>
												</div>
											{{ Form::close() }}
											{{ Form::open(array('action' => 'GroupDetailController@postMassImporttoEvent', 'id' => 'fMassImporttoEvent', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														<div class="col-md-offset-3 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('Mass Import to Event', array('type' => 'Search', 'class' => 'btn btn-danger btn-lg' )); }}
															</div>
														</div>
													</div>
												{{ Form::close() }}
										</div>
									</div>
								</div>
							</div> <!-- Forward Participants to Another Event -->
							<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
								<div class="widget-box collapsed widget-color-orange">
									<div class="widget-header widget-header-small">
										<h6 class="widget-title">
											<i class="icon-sort"></i>
											Forward Member to Group
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
											{{ Form::open(array('id' => 'fforwardgroup', 'class' => 'form-horizontal')) }}
												<br />
												<div class="form-group">
													{{ Form::label('groupforward', 'Group to Forward:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('groupforward', $group_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'groupforward'));}}
														</div>
													</div>
												</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div> <!-- Forward Participants to Another Event -->
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Group Members</h5>
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
														<th>Name</th>
														<th>Enrolled</th>
														<th>Position</th>
														<th>Contact Group</th>
														<th>Status</th>
														<th>Action</th>
														<th>F RHQ</th>
														<th>F Zone</th>
														<th>F Chapter</th>
														<th>F District</th>
														<th>F Division</th>
														<th>F Org Position</th>
														<th>Current RHQ</th>
														<th>Current Zone</th>
														<th>Current Chapter</th>
														<th>Current District</th>
														<th>Current Division</th>
														<th>Current Org Position</th>
														<th>Age</th>
														<th>DOB</th>
														<th>campusfaculty</th>
														<th>course</th>
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
										{{ Form::open(array('action' => 'GroupDetailController@postAddMember', 'id' => 'resourceaddmember', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Add Record</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div class="form-group">
															{{ Form::label('enrolleddate', 'Enrolled Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('enrolleddate', '', array('class' => 'col-xs-11 col-sm-11 input-mask-date', 'id' => 'enrolleddate', 'placeholder' => 'DD-MM-YYYY'));}}
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
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::select('position', $position_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'position'));}}
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
															{{ Form::label('contactgroup', 'Contact Group:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::select('contactgroup', $contactgroup_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'contactgroup'));}}
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
							<div id="btnresourceedit" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'GroupDetailController@putGroupMember', 'id' => 'fresourceupdate', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Edit Record</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div hidden>
															<div class="form-group">
																{{ Form::label('emoduledetailid', 'ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('emoduledetailid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'emoduledetailid'));}}
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('eenrolleddate', 'Enrolled Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('eenrolleddate', '', array('class' => 'col-xs-11 col-sm-11 input-mask-date', 'id' => 'eenrolleddate', 'placeholder' => 'DD-MM-YYYY'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('ename', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('ename', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ename'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('egrpposition', 'Group Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::select('egrpposition', $position_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'egrpposition'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('egrpcontactgroup', 'Contact Group:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::select('egrpcontactgroup', $contactgroup_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'egrpcontactgroup'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('estatus', 'Status:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::select('estatus', $memberstatus_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'estatus'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('egraduationdate', 'Graduation Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('egraduationdate', '', array('class' => 'col-xs-11 col-sm-11 input-mask-date', 'id' => 'egraduationdate', 'placeholder' => 'DD-MM-YYYY'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('eremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::textarea('eremarks' , '', array('class' => 'col-xs-12 col-sm-11', 'rows' => '3', 'id' => 'eremarks'));}}
																</div>
															</div>
														</div>
														<hr>
														<div class="form-group">
															{{ Form::label('ecampusfaculty', 'Campus / Faculty:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('ecampusfaculty', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ecampusfaculty'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('ecourse', 'Course:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('ecourse', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ecourse'));}}
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button class="btn btn-sm" data-dismiss="modal" id="close">
														<i class="icon-remove"></i>
														Cancel
													</button>
													{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourceupdate')); }}
												</div>
											</fieldset>
										{{ Form::close() }}
									</div>
								</div>
							</div> <!-- Edit Group Member -->
							<div id="btnmeminfo" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'GroupDetailController@putMemberInfo', 'id' => 'fmeminfo', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Member Information</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div class="col-sm-12 widget-container-col">
															<div class="widget-box transparent">
																<div class="widget-header">
																	<h4 class="widget-title lighter"></h4>
																	<div class="widget-toolbar no-border">
																		<ul class="nav nav-tabs" id="tabmemberinfo">
																			<li class="active">
																				<a data-toggle="tab" href="#morginfo">Org</a>
																			</li>
																			<li>
																				<a data-toggle="tab" href="#mpersonalcontact">Personal</a>
																			</li>
																			<li>
																				<a data-toggle="tab" href="#mothers">Others</a>
																			</li>
																			<li>
																				<a data-toggle="tab" href="#memergency">Emer</a>
																			</li>
																			<li>
																				<a data-toggle="tab" href="#mgroups">Groups</a>
																			</li>
																			<li>
																				<a data-toggle="tab" href="#mmedical">Med</a>
																			</li>
																			<li>
																				<a data-toggle="tab" href="#mallergy">Allergy</a>
																			</li>
																			<li>
																				<a data-toggle="tab" href="#mgrposhist">Grp Pos Hist</a>
																			</li>
																		</ul>
																	</div>
																</div>
																<div class="widget-body">
																	<div class="widget-main padding-12 no-padding-left no-padding-right">
																		<div class="tab-content padding-4">
																			<div id="morginfo" class="tab-pane in active">
																				<div class="scrollable" data-size="100">
																					<br />
																					<div class="form-group" hidden>
																						{{ Form::label('tbpersonid', 'Personid:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbpersonid', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbpersonid'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						{{ Form::label('tbname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbname', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbname'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						{{ Form::label('tbregion', 'Region:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbregion', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbregion', 'readonly' => 'true'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::select('tbzone', $zone_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbzone'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::select('tbchapter', $chapter_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbchapter'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbdistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbdistrict', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbdistrict'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																					{{ Form::label('tbdivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::select('tbdivision', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbdivision'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::select('tbposition', $memposition_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbposition'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						{{ Form::label('tbdiscussionmeetingday', 'Dis. Mtg Day:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::select('tbdiscussionmeetingday', array('' => '', 'Sun' => 'Sunday', 'Mon' => 'Monday', 'Tue' => 'Tuesday', 'Wed' => 'Wednesday', 'Thu' => 'Thursday', 'Fri' => 'Friday', 'Sat' => 'Saturday'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbdiscussionmeetingday'));}}
																							</div>
																						</div>
																					</div>
																					<br />
																				</div>
																			</div>
																			<div id="mpersonalcontact" class="tab-pane">
																				<div class="scrollable" data-size="100">
																					<div class="form-group">
																						{{ Form::label('tbdateofbirth', 'DOB:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbdateofbirth', '', array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD', 'id' => 'tbdateofbirth'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						{{ Form::label('tbage', 'Age:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbage', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbage'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbemail', 'Email:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::email('tbemail', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbemail'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbtel', 'Tel (Home):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="input-group">
																								<span class="input-group-addon">
																									<i class="fa fa-phone"></i>
																								</span>
																								{{ Form::text('tbtel', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbtel'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbmobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="input-group">
																								<span class="input-group-addon">
																									<i class="fa fa-mobile"></i>
																								</span>
																								{{ Form::text('mobile', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbmobile'));}}
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div id="mothers" class="tab-pane">
																				<div class="scrollable" data-size="100">
																					<div class="form-group">
																						{{ Form::label('tbbloodgroup', 'Blood Group:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbbloodgroup', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbbloodgroup'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbnationality', 'Nationality:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbnationality', '', array('class' => 'col-xs-12 col-sm-9'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbcountryofbirth', 'Country of Birth:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbcountryofbirth', '', array('class' => 'col-xs-12 col-sm-9'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						{{ Form::label('tbrace', 'Race:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbrace', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbrace'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tboccupation', 'Occupation:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tboccupation', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tboccupation'));}}
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div id="memergency" class="tab-pane">
																				<div class="scrollable" data-size="100" data-position="left">
																					<div class="form-group">
																						{{ Form::label('tbemergencyname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbemergencyname', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbemergencyname'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbemergencyrelationship', 'Relationship:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbemergencyrelationship' ,'', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbemergencyrelationship'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbemergencytel', 'Tel:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('tbemergencytel', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbemergencytel'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('tbemergencymobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('emergencymobile', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'tbemergencymobile'));}}
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div id="mgroups" class="tab-pane">
																				<div class="scrollable" data-size="100">
																					<table id="tgroup" class="table table-striped table-bordered table-hover">
																						<thead>
																							<tr>
																								<th>Group</th>
																								<th>Joined</th>
																								<th>Position</th>
																								<th>Status</th>
																							</tr>
																						</thead>
																						<tbody>
																						</tbody>
																					</table>
																				</div>
																			</div>
																			<div id="mmedical" class="tab-pane">
																				<div class="scrollable" data-size="100">
																					<table id="tmedical" class="table table-striped table-bordered table-hover">
																						<thead>
																							<tr>
																								<th>Date</th>
																								<th>Event</th>
																								<th>History</th>
																								<th>Remarks</th>
																							</tr>
																						</thead>
																						<tbody>
																						</tbody>
																					</table>
																				</div>
																			</div>
																			<div id="mallergy" class="tab-pane">
																				<div class="scrollable" data-size="100">
																					<table id="tallergy" class="table table-striped table-bordered table-hover">
																						<thead>
																							<tr>
																								<th>Date</th>
																								<th>Event</th>
																								<th>Allergy</th>
																							</tr>
																						</thead>
																						<tbody>
																						</tbody>
																					</table>
																				</div>
																			</div>
																			<div id="mgrposhist" class="tab-pane">
																				<div class="scrollable" data-size="100">
																					<table id="tgrpposhist" class="table table-striped table-bordered table-hover">
																						<thead>
																							<tr>
																								<th>Grp Position</th>
																								<th>Appointed On</th>
																								<th>End On</th>
																								<th>Action</th>
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
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button class="btn btn-sm" data-dismiss="modal" id="close">
														<i class="icon-remove"></i>
														Cancel
													</button>
													{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourceupdate')); }}
												</div>
											</fieldset>
										{{ Form::close() }}
									</div>
								</div>
							</div> <!-- Edit Group Info -->
						</div>
						<div id="otherlist" class="tab-pane">
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Group Members (Others)</h5>
										<div class="widget-toolbar">
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<table id="tdefaultothers" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Name</th>
														<th>Enrolled</th>
														<th>Graduated</th>
														<th>Position</th>
														<th>Status</th>
														<th>Action</th>
														<th>F RHQ</th>
														<th>F Zone</th>
														<th>F Chapter</th>
														<th>F District</th>
														<th>F Division</th>
														<th>F Org Position</th>
														<th>Current RHQ</th>
														<th>Current Zone</th>
														<th>Current Chapter</th>
														<th>Current District</th>
														<th>Current Division</th>
														<th>Current Org Position</th>
														<th>Age</th>
														<th>DOB</th>
														<th>campusfaculty</th>
														<th>course</th>
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
							</div> <!-- Group Members (Others) - Datatable-->
							<div id="btnresourceothersedit" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'GroupDetailController@putGroupMemberOthers', 'id' => 'fresourceupdateothers', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Edit Record</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div class="form-group" hidden>
															{{ Form::label('eomoduledetailid', 'ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('eomoduledetailid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eomoduledetailid'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('eoenrolleddate', 'Enrolled Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('eoenrolleddate', '', array('class' => 'col-xs-11 col-sm-11 input-mask-date', 'id' => 'eoenrolleddate', 'placeholder' => 'DD-MM-YYYY'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('eoname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('eoname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eoname'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('eogropposition', 'Group Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::select('eogropposition', $position_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'eogropposition'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('eostatus', 'Status:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::select('eostatus', $memberstatus_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'eostatus'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('eograduationdate', 'Graduation Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('eograduationdate', '', array('class' => 'col-xs-11 col-sm-11 input-mask-date', 'id' => 'eograduationdate', 'placeholder' => 'DD-MM-YYYY'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('eoremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::textarea('eoremarks' , '', array('class' => 'col-xs-12 col-sm-11', 'rows' => '3', 'id' => 'eoremarks'));}}
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button class="btn btn-sm" data-dismiss="modal" id="close">
														<i class="icon-remove"></i>
														Cancel
													</button>
													{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourceupdateothers')); }}
												</div>
											</fieldset>
										{{ Form::close() }}
									</div>
								</div>
							</div> <!-- Edit Group Member (Others) -->
						</div>
						<div id="events" class="tab-pane">
							<table id="tgroupevent" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Date</th>
										<th>Event Type</th>
										<th>Description</th>
										<th>Location</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div id="premadkenshu" class="tab-pane">
							<table id="tgroupprekenshu" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Contact Group</th>
										<th>Pos</th>
										<th>Name</th>
										<th>Rhq</th>
										<th>Zone</th>
										<th>Chap</th>
										<th>Dist</th>
										<th>Div</th>
										<th>Org Pos</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div id="attendance" class="tab-pane">
							<table id="tgroupattendance" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Date</th>
										<th>Attendance Type</th>
										<th>Description</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						@if ($REGP02R == 't') 
							<div id="zposition" class="tab-pane">
								<div class="col-sm-offset-2 col-xs-12 col-sm-8 widget-container-col ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Group Position</h5>
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
												<table id="tzdefault" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Date</th>
															<th>Line No</th>
															<th>Description</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												{{ Form::open(array('action' => 'GroupzPositionController@postPosition', 'id' => 'ResourceAdd', 'class' => 'form-horizontal')) }}
													<fieldset>
															<div class="col-sm-offset-4 col-xs-2">
																{{ Form::text('txtpositionvalue1', '', array('class' => 'form-control', 'placeholder' => 'Line No', 'id' => 'txtpositionvalue1' )); }}
															</div>
															<div class="col-sm-5 col-xs-5">
																{{ Form::text('txtpositionvalue', '', array('class' => 'form-control', 'placeholder' => 'Please enter a value for new record', 'id' => 'txtpositionvalue' )); }}
															</div>
															{{ Form::button('<i class="fa fa-plus Add"></i> Add', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger pull-right' )); }}
														
													</fieldset>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div>
								<div id="resourcepositionedit" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'GroupzPositionController@putPosition', 'id' => 'resourceupdateposition', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Edit Record</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div hidden>
																<div class="form-group">
																	{{ Form::label('epositionid', 'ValueID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-9">
																		<div class="clearfix">
																			{{ Form::text('epositionid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'epositionid'));}}
																		</div>
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('evalue', 'Line No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('evalue', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'evalue'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('evalue1', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('evalue1', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'evalue1'));}}
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
							<div id="zcontactgroup" class="tab-pane">
								<div class="col-sm-offset-2 col-xs-12 col-sm-8 widget-container-col ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Contact Group</h5>
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
												<table id="tzdefaultcontactgroup" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Date</th>
															<th>Description</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												{{ Form::open(array('action' => 'GroupzContactGroupController@postContactGroup', 'id' => 'ResourceAddContactGroup', 'class' => 'form-horizontal')) }}
													<fieldset>
															<div class="col-sm-offset-6 col-xs-5">
																{{ Form::text('txtcontactgroupvalue', '', array('class' => 'form-control', 'placeholder' => 'Please enter a value for new record', 'id' => 'txtcontactgroupvalue' )); }}
															</div>
															{{ Form::button('<i class="fa fa-plus Add"></i> Add', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger pull-right' )); }}
														
													</fieldset>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div>
								<div id="resourcecontactgroupedit" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'GroupzContactGroupController@putContactGroup', 'id' => 'resourceupdatecontactgroup', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Edit Record</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div hidden>
																<div class="form-group">
																	{{ Form::label('econtactgroupid', 'ValueID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-9">
																		<div class="clearfix">
																			{{ Form::text('econtactgroupid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'econtactgroupid'));}}
																		</div>
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('econtactgroup', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		{{ Form::text('econtactgroup', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'econtactgroup'));}}
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
						@endif
						<div id="reports" class="tab-pane">
							@if ($REEVGKA == 't')
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Group Members Listing With Contacts (Excel)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'GroupDetailController@postGroupMembersListingWithContactsPrint', 'id' => 'fGroupMembersListingWithContacts', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Group Members Listing With Contacts (Excel) -->
							@endif
							@if ($REGP05R == 't')
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Group Members Listing with Sensitive Data (Excel)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'GroupDetailController@postGroupMembersListingWithSensitiveDataPrint', 'id' => 'fGroupMembersListingWithSensitiveData', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Group Members Listing with Sensitive Data (Excel) -->
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Group Members (Active)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'GroupDetailController@postGroupMembersListingPrint', 'id' => 'fGroupMembersListing', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Group Members Listing -->
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Group Members (Active) Registration Form</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'GroupDetailController@postGroupMembersRegistrationFormActivePrint', 'id' => 'fGroupMembersRegistrationFormsActive', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Group Members Registration Forms Active -->
							@endif
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Registration Form (Empty)</h5>
										<div class="widget-toolbar">
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<div class="well well-lg">
												{{ Form::open(array('id' => 'fRegistrationFormEmpty', 'class' => 'form-horizontal')) }}
													<fieldset>
														{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
													</fieldset>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div>
							</div> <!-- Print Registration Form (Empty) -->
						</div>
						@if ($REGP01R == 't') 
							<div id="logs" class="tab-pane">
							</div>
							<div id="accessrights" class="tab-pane">
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
	<script type="text/javascript" src="{{{ asset('assets/js/jquery-ui.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript">
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		
		$('#ResourceAdd').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postPosition/' + $("#groupid").val(),
		        type: 'POST',
		        data: { txtpositionvalue: $("#txtpositionvalue").val(), txtpositionvalue1: $("#txtpositionvalue1").val(), groupid: $("#groupid").val()},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var ozTable = $('#tzdefault').DataTable();
		        		ozTable.clearPipeline().draw();
		        		$("#txtvalue").val('');
		        		$("#txtvalue1").val('');
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
		        		else if (data.responseJSON.ErrType == "CannotUpdate")
		        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
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

		$('#ResourceAddContactGroup').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postContactGroup/' + $("#groupid").val(),
		        type: 'POST',
		        data: { txtcontactgroupvalue: $("#txtcontactgroupvalue").val(), groupid: $("#groupid").val()},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var ozTableContactGroup = $('#tzdefaultcontactgroup').DataTable();
		        		ozTableContactGroup.clearPipeline().draw();
		        		$("#txtcontactgroupvalue").val('');
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
		        		else if (data.responseJSON.ErrType == "CannotUpdate")
		        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
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
		        url: 'postAddMember/' + $("#groupid").val(),
		        type: 'POST',
		        data: { enrolleddate: $("#enrolleddate").val(), membername: $("#membername").val(), groupid: $("#groupid").val(), position: $("#position").val(), memberid: $("#memberid").val(), name: $("#name").val(), contactgroup: $("#contactgroup").val()},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
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
		
		$('#fGroupMembersListing').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintGroupMemberslisting/' + "{{ $rid }}",
		        type: 'POST',
		        data: { groupid: $('#groupid').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=GroupMembersListing.mrt&param1="{{ $rid }}"';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fRegistrationFormEmpty').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=GroupRegistrationHCEmpty.mrt';
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fGroupMembersListingWithSensitiveData').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintGroupMembersListingWithSensitiveData/{{ $rid }}',
		        type: 'POST',
		        data: { groupid: $('#groupid').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=GroupsMembersListingWithSensitiveExcel.mrt&param1="{{ $rid }}"&param2=' + {{ Auth::user()->id }};
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fGroupMembersListingWithContacts').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintGroupMembersWithContactslisting/{{ $rid }}',
		        type: 'POST',
		        data: { groupid: $('#groupid').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=GroupsMembersListingWithContactsExcel.mrt&param1="{{ $rid }}"&param2=' + {{ Auth::user()->id }};
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fGroupMembersRegistrationFormsActive').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'PrintGroupMembersRegistrationFormActive/{{ $rid }}',
		        type: 'POST',
		        data: { groupid: $('#groupid').val() },
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
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=GroupMembersRegistrationFormActive.mrt&param1="{{ $rid }}"&param2=' + {{ Auth::user()->id }};
			window.open(url, '_blank');
		    e.preventDefault();
		});

		$('#fUniqueCodeUpdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postUniqueCode/' + $("#groupid").val(),
		        type: 'POST',
		        data: { groupid: $("#groupid").val()},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'UniqueCode Updated!!',
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

		$('#fMassImporttoEvent').submit(function(e){
			if ($('#eventforward').val() != "")
	    	{
				noty({
					layout: 'topRight', type: 'warning', text: 'Importing Records to Event ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
					url: 'postMassImporttoEvent/' + $("#groupid").val(),
					type: 'POST',
					data: { groupid: $("#groupid").val(), eventforward: $('#eventforward').val(), role: $('#role').val()},
					dataType: 'json',
					statusCode: { 
						200:function(){
							noty({
								layout: 'topRight', type: 'success', text: 'Mass Import Done!!',
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
	    	else
	    	{
	    		noty({
					layout: 'topRight', type: 'error', text: 'Please select an event to forward!',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
	    	}
	    });
	</script>
	<script type="text/javascript">
		function editpositionrow(submit){ 
			var RowID = "";
	        var ozTable = $('#tzdefault').DataTable();
	        $("#tzdefault tbody tr").click(function () {
                var position = ozTable.row(this).index();
                RowID = ozTable.row(position).data();
                $("#evalue1").val(RowID.value);
                $("#evalue").val(RowID.lineno);
                $("#epositionid").val(submit);
            });
            $("#resourcepositionedit").modal('show');
	    }

	    function deletepositionrow(submit){ 
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
					        url: 'deletePosition/' + submit,
					        type: 'POST',
					        data: { dposition: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var ozTable = $('#tzdefault').DataTable();
					        		ozTable.clearPipeline().draw();
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

	    function editcontactgrouprow(submit){ 
			var RowID = "";
	        var ozTablecontactgroup = $('#tzdefaultcontactgroup').DataTable();
	        $("#tzdefaultcontactgroup tbody tr").click(function () {
                var position = ozTablecontactgroup.row(this).index();
                RowID = ozTablecontactgroup.row(position).data();
                $("#econtactgroup").val(RowID.value);
                $("#econtactgroupid").val(submit);
            });
            $("#resourcecontactgroupedit").modal('show');
	    }

	    function deletecontactgrouprow(submit){ 
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
					        url: 'deleteContactGroup/' + submit,
					        type: 'POST',
					        data: { dposition: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var ozTablecontactgroup = $('#tzdefaultcontactgroup').DataTable();
					        		ozTablecontactgroup.clearPipeline().draw();
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

	    function memberinforow(submit){ 
			$.ajax({
		        url: 'getMemberInfo/' + submit,
		        type: 'POST',
		        data: { value: submit },
		        dataType: 'json',
		        statusCode: {
		        	200:function(data){
		        		$("#tbpersonid").val(submit);
		        		$("#tbname").val(data.name);
		        		$("#tbdivision").val(data.division);
		        		$("#tbregion").val(data.rhq);
		        		$("#tbzone").val(data.zone);
		        		$("#tbchapter").val(data.chapter);
		        		$("#tbdistrict").val(data.district);
		        		$("#tbposition").val(data.position);
		        		$("#tbdiscussionmeetingday").val(data.discussionmeetingday);
		        		$("#tbdateofbirth").val(data.dateofbirth);
		        		$("#tbemail").val(data.email);
		        		$("#tbtel").val(data.tel);
		        		$("#tbmobile").val(data.mobile);
		        		$("#tbbloodgroup").val(data.bloodgroup);
		        		$("#tbnationality").val(data.nationality);
		        		$("#tbcountryofbirth").val(data.countryofbirth);
		        		$("#tbrace").val(data.race);
		        		$("#tboccupation").val(data.occupation);
		        		$("#tbemergencyname").val(data.emergencyname);
		        		$("#tbemergencyrelationship").val(data.emergencyrelationship);
		        		$("#tbemergencytel").val(data.emergencytel);
		        		$("#tbemergencymobile").val(data.emergencymobile);

		        		if (data.dateofbirth == '0000-00-00') { $("#tbage").val('Unknown'); }
		        		else if (data.dateofbirth == '') { $("#tbage").val('Unknown'); }
		        		else if (data.dateofbirth == null) { $("#tbage").val('Unknown'); }
		        		else 
	        			{
	        				var nowyear = moment().format("YYYY");
				    		var birthyear = moment(data.dateofbirth).format("YYYY");

				    		var diff = nowyear - birthyear;
				    		$("#tbage").val(diff);
	        			}

		        		var oGroupTable = $('#tgroup').DataTable();
		        		oGroupTable.destroy();
		        		oGroupTable = $('#tgroup').DataTable({
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
					            url: 'getMemberGroupInfo/' + submit,
					            pages: 5 // number of pages to cache
					        }),
					        "columnDefs": [
					        { "targets": [ 0 ], "data": "groupname", "searchable": "true" },
			            	{
						    	"targets": [ 1 ], "data": "enrolleddate", "width": "150px", "searchable": "true",
						    	"render": function ( data, type, full ){
						    		return moment(data).format("DD-MMM-YYYY");
							    }
					    	},
					    	{ "targets": [ 2 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 3 ], "data": "status",
						    	"render": function ( data, type, full ){
								    if (data === 'Rejected'){
								    	return '<span class="label label-danger arrowed-in">'+data+'</span>';
								    }
								  	else if (data === 'Active'){
								    	return '<span class="label label-success arrowed">'+data+'</span>';
								    }
								    else if (data === 'Inactive'){
								    	return '<span class="label label-yellow arrowed">'+data+'</span>';
								    }
								    else if (data === 'Alumni'){
								    	return '<span class="label label-info">'+data+'</span>';
								    }
								    else if (data === 'Graduated'){
								    	return '<span class="label label-purple">'+data+'</span>';
								    }
								    else if (data === 'Withdrawn'){
								    	return '<span class="label label-inverse">'+data+'</span>';
								    }
								    else {
								    	return '<span class="label label-inverse">'+data+'</span>';
								    }
					    		}
				    		}]
					    }); // Group Members for Individual Person

						var oMedicalTable = $('#tmedical').DataTable();
		        		oMedicalTable.destroy();
		        		oMedicalTable = $('#tmedical').DataTable({
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
					            url: 'getMemberEventMedicalInfo/' + submit,
					            pages: 5 // number of pages to cache
					        }),
					        "columnDefs": [
				            	{
							    	"targets": [ 0 ], "data": "created_at", "searchable": "true",
							    	"render": function ( data, type, full ){
							    		return moment(data).format("DD-MMM-YYYY");
								    }
						    	},
						    	{ "targets": [ 1 ], "data": "eventname", "searchable": "true" },
						    	{ "targets": [ 2 ], "data": "medicalhistory", "searchable": "true" },
						    	{ "targets": [ 3 ], "data": "medicalremarks", "searchable": "true" }]
					    }); // Group Members Medical Remarks
						
						var oAllergyTable = $('#tallergy').DataTable();
		        		oAllergyTable.destroy();
		        		oAllergyTable = $('#tallergy').DataTable({
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
					            url: 'getMemberEventAllergyInfo/' + submit,
					            pages: 5 // number of pages to cache
					        }),
					        "columnDefs": [
				            	{
							    	"targets": [ 0 ], "data": "created_at", "searchable": "true",
							    	"render": function ( data, type, full ){
							    		return moment(data).format("DD-MMM-YYYY");
								    }
						    	},
						    	{ "targets": [ 1 ], "data": "eventname", "searchable": "true" },
						    	{ "targets": [ 2 ], "data": "drugallergy", "searchable": "true" }]
					    }); // Group Members Allergy
						
						var oGrpPosHistTable = $('#tgrpposhist').DataTable();
		        		oGrpPosHistTable.destroy();
						oGrpPosHistTable = $('#tgrpposhist').DataTable({
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
					            url: 'getMemberGroupPositionHistory/' + submit,
					            pages: 5 // number of pages to cache
					        }),
					        "columnDefs": [
						        { "targets": [ 0 ], "data": "position", "searchable": "true" },
				            	{
							    	"targets": [ 1 ], "data": "appointeddate", "searchable": "true",
							    	"render": function ( data, type, full ){
							    		return moment(data).format("DD-MMM-YYYY");
								    }
						    	},
						    	{
							    	"targets": [ 2 ], "data": "graduateddate", "searchable": "true",
							    	"render": function ( data, type, full ){
							    		return moment(data).format("DD-MMM-YYYY");
								    }
						    	},
						    	{
							    	"targets": [ 3 ], "data": "id",
							    	"render": function ( data, type, full ){
							    		return '<button type="submit" onClick=editpositionrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deletepositionrow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
								    }
							    }]
						    }); // Group Position History

            			noty({
							layout: 'topRight', type: 'success', text: 'Record Retrieved!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});

						$("#btnmeminfo").modal('show');
		        		// $("#btnmeminfo").tabs({ active: 0 });
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Retrieve Data!! ' + txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
	    }

	    function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                $.ajax({
			        url: 'getMemberDetailInfo/' + submit,
			        type: 'POST',
			        data: { id: submit },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(data){
			        		$("#eremarks").val(data.remark);
							$("#ecampusfaculty").val(data.campusfaculty); $("#ecourse").val(data.course);
							if (data.graduationdate == "") { $("#egraduationdate").val(""); }
							else if (data.graduationdate == "0000-00-00") { $("#egraduationdate").val(""); }
							else { $("#egraduationdate").val(moment(data.graduationdate).format("DD-MM-YYYY")); }
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
	            $("#ename").val(RowID.name);
	            $("#eenrolleddate").val(moment(RowID.enrolleddate).format("DD-MM-YYYY"));
	            $("#estatus").val(RowID.status);
	            $("#egrpposition").val(RowID.position);
	            $("#egrpcontactgroup").val(RowID.contactgroup);
	            $("#emoduledetailid").val(submit);
	            $("#btnresourceedit").modal('show');
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
					        url: 'deleteGroupMember/' + submit,
					        type: 'POST',
					        data: { dposition: submit },
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

	    function printrow(submit){ 
	    	$.ajax({
		        url: 'PrintApplicationHC/' + submit,
		        type: 'POST',
		        data: { id: submit },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Printing ...',
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
	    	var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=GroupRegistrationHC.mrt&param1={{ Auth::user()->id }}&param2=' + "submit";
			window.open(url, '_blank');
	    }

	    function editothersrow(submit){ 
			var RowID = "";
	        var oTableOthers = $('#tdefaultothers').DataTable();
	        $("#tdefaultothers tbody tr").click(function () {
                var position = oTableOthers.row(this).index();
                RowID = oTableOthers.row(position).data();
                $.ajax({
			        url: 'getMemberDetailOthersInfo/' + submit,
			        type: 'POST',
			        data: { id: submit },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(data){
			        		$("#eoremarks").val(data.remark);
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
                $("#eoname").val(RowID.name);
                $("#eoenrolleddate").val(moment(RowID.enrolleddate).format("DD-MM-YYYY"));
                $("#eograduationdate").val(moment(RowID.graduationdate).format("DD-MM-YYYY"));
                $("#eostatus").val(RowID.status);
                $("#eogropposition").val(RowID.position);
                $("#eomoduledetailid").val(submit);
                $("#btnresourceothersedit").modal('show');
            });
	    }

	    function deleteothersrow(submit){ 
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

	    function accessrightsadd(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
            });
            $.ajax({
		        url: 'PrintCostumesSlip/{{ $rid }}',
		        type: 'POST',
		        data: { id: $('#eventid').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		$("#btnAccessRigthsAdd").modal('show');
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

	    function forwardrow(submit){ 
	    	if ($('#eventforward').val() != "")
	    	{
	    		noty({
					layout: 'topRight', type: 'warning', text: 'Forwarding member to ' + $('#eventforward').val(),
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postforwardparticipanttoevent/' + submit,
			        type: 'POST',
			        data: { eventdetailid: submit, eventforward: $('#eventforward').val(), name: $('#name').val(), role: $('#role').val(), grouptype: $('#grouptype').val() },
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

	    function forwardrowgroup(submit){ 
	    	if ($('#groupforward').val() != "")
	    	{
	    		noty({
					layout: 'topRight', type: 'warning', text: 'Forwarding member to ' + $('#groupforward').val(),
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postforwardparticipanttogroup/' + submit,
			        type: 'POST',
			        data: { groupdetailid: submit, groupforward: $('#groupforward').val(), name: $('#name').val()},
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
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(function() {
				var oTable = $('#tdefault').DataTable({
					dom: 'Bflrtip',
					buttons: [ 'copy', 'excel', 'pdf' ],
					displayLength: 10, // Default No of Records per page on 1st load
			        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        pagingType: "full_numbers",
			        responsive: false,
			        processing: false,
			        stateSave: true, // Remember paging & filters
			        autoWidth: true,
			        scrollCollapse: true,
			        serverSide: false,
			        searching: true,
			        order: [[ 0, "desc" ]],
			        ajax: 'getMemberListing/{{ $rid }}',
			        columnDefs: [
			        { targets: [ 0 ], data: "name", searchable: "true" },
	            	{
				    	targets: [ 1 ], data: "enrolleddate", width: "150px", searchable: "true",
				    	render: function ( data, type, full ){
				    		return moment(data).format("DD-MM-YYYY");
					    }
			    	},
			    	{ targets: [ 2 ], data: "position", searchable: "true" },
			    	{ targets: [ 3 ], data: "contactgroup", searchable: "true" },
			    	{
				    	targets: [ 4 ], data: "status",
				    	render: function ( data, type, full ){
						    if (data === 'Rejected'){
						    	return '<span class="label label-danger arrowed-in">'+data+'</span>';
						    }
						  	else if (data === 'Active'){
						    	return '<span class="label label-success arrowed">'+data+'</span>';
						    }
						    else if (data === 'Inactive'){
						    	return '<span class="label label-yellow arrowed">'+data+'</span>';
						    }
						    else if (data === 'Alumni'){
						    	return '<span class="label label-info">'+data+'</span>';
						    }
						    else if (data === 'Graduated'){
						    	return '<span class="label label-purple">'+data+'</span>';
						    }
						    else if (data === 'Withdrawn'){
						    	return '<span class="label label-inverse">'+data+'</span>';
						    }
						    else {
						    	return '<span class="label label-inverse">'+data+'</span>';
						    }
			    		}
		    		},
			    	{
				    	targets: [ 5 ], data: "uniquecode",
				    	render: function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		return '<a href="#resourceedit" role="button" onClick=editrow("'+ data +'") class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button> <button type="submit" onClick=printrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-print bigger-120"></i></button> <button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-inverse"><i class="fa fa-legal bigger-120"></i></button> <button type="submit" onClick=forwardrow("'+ data +'") class="btn btn-xs btn-pink"><i class="fa fa-mail-forward bigger-120"></i></button> <button type="submit" onClick=forwardrowgroup("'+ data +'") class="btn btn-xs btn-purple"><i class="fa fa-mail-forward bigger-120"></i></button>'
					    }
			    	},
					{ targets: [ 6 ], data: "rhq", searchable: "true", visible: false },
					{ targets: [ 7 ], data: "zone", searchable: "true", visible: false },
					{ targets: [ 8 ], data: "chapter", searchable: "true", visible: false },
					{ targets: [ 9 ], data: "district", searchable: "true", visible: false },
					{ targets: [ 10 ], data: "division", searchable: "true", visible: false },
					{ targets: [ 11 ], data: "positionorg", searchable: "true", visible: false },
					{ targets: [ 12 ], data: "currentrhq", searchable: "true", visible: false },
					{ targets: [ 13 ], data: "currentzone", searchable: "true", visible: false },
					{ targets: [ 14 ], data: "currentchapter", searchable: "true", visible: false },
					{ targets: [ 15 ], data: "currentdistrict", searchable: "true", visible: false },
					{ targets: [ 16 ], data: "currentdivision", searchable: "true", visible: false },
					{ targets: [ 17 ], data: "currentposition", searchable: "true", visible: false },
					{ targets: [ 18 ], data: "age", searchable: "true", visible: false },
					{ targets: [ 19 ], data: "dateofbirth", searchable: "true", visible: false },
					{ targets: [ 20 ], data: "campusfaculty", searchable: "true", visible: false },
					{ targets: [ 21 ], data: "course", searchable: "true", visible: false }]
			    }); // Group Members
				
				var oTableOthers = $('#tdefaultothers').DataTable({
					dom: 'Bflrtip',
					buttons: [ 'copy', 'excel', 'pdf' ],
			        displayLength: 10, // Default No of Records per page on 1st load
			        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        pagingType: "full_numbers",
			        responsive: false,
			        processing: false,
			        stateSave: true, // Remember paging & filters
			        autoWidth: true,
			        scrollCollapse: true,
			        serverSide: false,
			        searching: true,
			        order: [[ 0, "desc" ]],
			        ajax: 'getMemberListingOthers/{{ $rid }}',
			        columnDefs: [
			        { targets: [ 0 ], data: "name", searchable: "true" },
	            	{
				    	targets: [ 1 ], data: "enrolleddate", width: "150px", searchable: "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MM-YYYY");
					    }
			    	},
			    	{
				    	targets: [ 2 ], data: "graduationdate", width: "150px", searchable: "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MM-YYYY");
					    }
			    	},
			    	{ targets: [ 3 ], data: "position", searchable: "true" },
			    	{
				    	targets: [ 4 ], data: "status",
				    	render: function ( data, type, full ){
						    if (data === 'Rejected'){
						    	return '<span class="label label-danger arrowed-in">'+data+'</span>';
						    }
						  	else if (data === 'Active'){
						    	return '<span class="label label-success arrowed">'+data+'</span>';
						    }
						    else if (data === 'Inactive'){
						    	return '<span class="label label-yellow arrowed">'+data+'</span>';
						    }
						    else if (data === 'Alumni'){
						    	return '<span class="label label-info">'+data+'</span>';
						    }
						    else if (data === 'Graduated'){
						    	return '<span class="label label-purple">'+data+'</span>';
						    }
						    else if (data === 'Withdrawn'){
						    	return '<span class="label label-inverse">'+data+'</span>';
						    }
						    else {
						    	return '<span class="label label-inverse">'+data+'</span>';
						    }
			    		}
		    		},
			    	{
				    	targets: [ 5 ], data: "uniquecode",
				    	render: function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		return '<button type="submit" onClick=editothersrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleteothersrow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	},
					{ targets: [ 6 ], data: "rhq", searchable: "true", visible: false },
					{ targets: [ 7 ], data: "zone", searchable: "true", visible: false },
					{ targets: [ 8 ], data: "chapter", searchable: "true", visible: false },
					{ targets: [ 9 ], data: "district", searchable: "true", visible: false },
					{ targets: [ 10 ], data: "division", searchable: "true", visible: false },
					{ targets: [ 11 ], data: "positionorg", searchable: "true", visible: false },
					{ targets: [ 12 ], data: "currentrhq", searchable: "true", visible: false },
					{ targets: [ 13 ], data: "currentzone", searchable: "true", visible: false },
					{ targets: [ 14 ], data: "currentchapter", searchable: "true", visible: false },
					{ targets: [ 15 ], data: "currentdistrict", searchable: "true", visible: false },
					{ targets: [ 16 ], data: "currentdivision", searchable: "true", visible: false },
					{ targets: [ 17 ], data: "currentposition", searchable: "true", visible: false },
					{ targets: [ 18 ], data: "age", searchable: "true", visible: false },
					{ targets: [ 19 ], data: "dateofbirth", searchable: "true", visible: false },
					{ targets: [ 20 ], data: "campusfaculty", searchable: "true", visible: false },
					{ targets: [ 21 ], data: "course", searchable: "true", visible: false }]
			    }); // Group Members (Others)
			
				var oGroupTable = $('#tgroup').DataTable({
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
			            url: 'getMemberGroupInfo/' + '00001',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
			        { "targets": [ 0 ], "data": "groupname", "searchable": "true" },
	            	{
				    	"targets": [ 1 ], "data": "enrolleddate", "width": "150px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 2 ], "data": "position", "searchable": "true" },
			    	{
				    	"targets": [ 3 ], "data": "status",
				    	"render": function ( data, type, full ){
						    if (data === 'Rejected'){
						    	return '<span class="label label-danger arrowed-in">'+data+'</span>';
						    }
						  	else if (data === 'Active'){
						    	return '<span class="label label-success arrowed">'+data+'</span>';
						    }
						    else if (data === 'Inactive'){
						    	return '<span class="label label-yellow arrowed">'+data+'</span>';
						    }
						    else if (data === 'Alumni'){
						    	return '<span class="label label-info">'+data+'</span>';
						    }
						    else if (data === 'Graduated'){
						    	return '<span class="label label-purple">'+data+'</span>';
						    }
						    else if (data === 'Withdrawn'){
						    	return '<span class="label label-inverse">'+data+'</span>';
						    }
						    else {
						    	return '<span class="label label-inverse">'+data+'</span>';
						    }
			    		}
		    		}]
			    }); // Group Members
				
				var oMedicalTable = $('#tmedical').DataTable({
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
			            url: 'getMemberEventMedicalInfo/' + '00001',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
			        { "targets": [ 0 ], "data": "eventid", "searchable": "true" },
	            	{
				    	"targets": [ 1 ], "data": "created_at", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 2 ], "data": "medicalhistory", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "medicalremarks", "searchable": "true" }]
			    }); // Group Members Medical Remarks
				
				var oAllergyTable = $('#tallergy').DataTable({
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
			            url: 'getMemberEventAllergyInfo/' + '00001',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
			        { "targets": [ 0 ], "data": "eventname", "searchable": "true" },
	            	{
				    	"targets": [ 1 ], "data": "created_at", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 2 ], "data": "drugallergy", "searchable": "true" }]
			    }); // Group Members Allegry

				var oGrpPosHistTable = $('#tgrpposhist').DataTable({
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
			            url: 'getMemberGroupPositionHistory/' + '00001',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
			        { "targets": [ 0 ], "data": "position", "searchable": "true" },
	            	{
				    	"targets": [ 1 ], "data": "appointeddate", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{
				    	"targets": [ 2 ], "data": "graduateddate", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	}]
			    }); // Group Position History

				var ozTable = $('#tzdefault').DataTable({
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
			        "order": [[ 1, "asc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'getPositionListing/' + $('#groupid').val(),
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "200px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "lineno", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "value", "searchable": "true" },
			    	{
				    	"targets": [ 3 ], "data": "id",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=editpositionrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deletepositionrow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Group Position

				var ozContactGroupTable = $('#tzdefaultcontactgroup').DataTable({
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
			        "order": [[ 1, "asc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'getContactGroupListing/' + $('#groupid').val(),
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "200px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "value", "searchable": "true" },
			    	{
				    	"targets": [ 2 ], "data": "id",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=editcontactgrouprow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deletecontactgrouprow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Group Position

				var oEventTable = $('#tgroupevent').DataTable({
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
			            url: 'getGroupEventListing/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "eventdate", "width": "150px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "eventtype", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "description", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "location", "searchable": "true" },
			    	{ 
			    		"targets": [ 4 ], "data": "status", "searchable": "true",
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
			    	}]
			    });

			    var oAttendanceTable = $('#tgroupattendance').DataTable({
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
			            url: 'getGroupAttendanceListing/' + "{{ $rid }}",
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
			    	{ "targets": [ 2 ], "data": "description", "searchable": "true" },
			    	{ 
			    		"targets": [ 3 ], "data": "status", "searchable": "true",
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
				    	"targets": [ 4 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=editrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button>'
					    }
			    	}]
			    });

				var oPreKenshuTable = $('#tgroupprekenshu').DataTable({
			        dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
			        displayLength: 10, // Default No of Records per page on 1st load
			        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        pagingType: "full_numbers",
			        responsive: false,
			        processing: false,
			        stateSave: true, // Remember paging & filters
			        autoWidth: true,
			        scrollCollapse: true,
			        processing: false,
			        serverSide: false,
			        searching: true,
			        order: [[ 0, "asc" ]],
			        ajax: 'getGroupPreMADKebshuListing/' + "{{ $rid }}",
			        columnDefs: [
	            	{ targets: [ 0 ], data: "contactgroup", searchable: true },
			    	{ targets: [ 1 ], data: "position", searchable: true },
			    	{ targets: [ 2 ], data: "name", searchable: true },
			    	{ targets: [ 3 ], data: "rhq", searchable: true },
			    	{ targets: [ 4 ], data: "zone", searchable: true },
			    	{ targets: [ 5 ], data: "chapter", searchable: true },
			    	{ targets: [ 6 ], data: "district", searchable: true },
					{ targets: [ 7 ], data: "division", searchable: true },
			    	{ targets: [ 8 ], data: "orgposition", searchable: true }]
			    });
			});
		});
	</script>
	<script type="text/javascript">
		$('#resourceupdateposition').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putPosition/' + $('#epositionid').val(),
		        type: 'POST',
		        data: { epositionid: $('#epositionid').val(), evalue: $("#evalue").val(), evalue1: $("#evalue1").val() },
		        dataType: 'json',
		        statusCode: {
		        	200:function(){
		        		var ozTable = $('#tzdefault').DataTable();
		        		ozTable.clearPipeline().draw();
		        		$("#evalue").val('');
		        		$("#evalue1").val('');
		        		$("#epositionid").val('');
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						$("#resourcepositionedit").modal('hide');
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		$("#evalue").focus();
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

		$('#resourceupdatecontactgroup').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putContactGroup/' + $('#econtactgroupid').val(),
		        type: 'POST',
		        data: { econtactgroupid: $('#econtactgroupid').val(), econtactgroup: $("#econtactgroup").val() },
		        dataType: 'json',
		        statusCode: {
		        	200:function(){
		        		var ozTableContactGroup = $('#tzdefaultcontactgroup').DataTable();
		        		ozTableContactGroup.clearPipeline().draw();
		        		$("#econtactgroup").val('');
		        		$("#econtactgroupid").val('');
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						$("#resourcecontactgroupedit").modal('hide');
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		$("#evalue").focus();
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

		$('#fresourceupdate').submit(function(e){
			e.preventDefault();
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putGroupMember/' + $('#emoduledetailid').val(),
		        type: 'POST',
		        data: { emoduledetailid: $('#emoduledetailid').val(), ename: $("#ename").val(), eenrolleddate: $("#eenrolleddate").val(), egraduationdate: $("#egraduationdate").val(), estatus: $("#estatus").val(), egrpposition: $("#egrpposition").val(), egrpcontactgroup: $("#egrpcontactgroup").val(), eremarks: $("#eremarks").val(), ecampusfaculty: $("#ecampusfaculty").val(), ecourse: $("#ecourse").val() },
		        dataType: 'json',
		        statusCode: {
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();

		        		var oTableOthers = $('#tdefaultothers').DataTable();
		        		oTableOthers.clearPipeline().draw();

		        		$("#emoduledetailid").val('');
		        		$("#ename").val('');
		        		$("#eenrolleddate").val('');
		        		$("#egraduationdate").val('');
		        		$("#egrpposition").val('');
		        		$("#egrpcontactgroup").val('');
						$("#ecampusfaculty").val('');
						$("#ecourse").val('');

            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						$("#btnresourceedit").modal('hide');
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		$("#ename").focus();
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
		
		$('#fmeminfo').submit(function(e){
			e.preventDefault();
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putMemberInfo/' + $('#tbpersonid').val(),
		        type: 'POST',
		        data: { tbpersonid: $('#tbpersonid').val(), tbbloodgroup: $("#tbbloodgroup").val(), tbnationality: $("#tbnationality").val(), tbcountryofbirth: $("#tbcountryofbirth").val(), tboccupation: $("#tboccupation").val(), tbrace: $("#tbrace").val(), tbemergencyname: $("#tbemergencyname").val(), tbemergencyrelationship: $("#tbemergencyrelationship").val(), tbemergencytel: $("#tbemergencytel").val(), tbemergencymobile: $("#tbemergencymobile").val() },
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

		$('#fresourceupdateothers').submit(function(e){
			e.preventDefault();
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putGroupMemberOthers/' + $('#eomoduledetailid').val(),
		        type: 'POST',
		        data: { eomoduledetailid: $('#eomoduledetailid').val(), eoname: $("#eoname").val(), eoenrolleddate: $("#eoenrolleddate").val(), eograduationdate: $("#eograduationdate").val(), eostatus: $("#eostatus").val(), eoremarks: $("#eoremarks").val(), eogropposition: $("#eogropposition").val() },
		        dataType: 'json',
		        statusCode: {
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();

		        		var oTableOthers = $('#tdefaultothers').DataTable();
		        		oTableOthers.clearPipeline().draw();

		        		$("#eomoduledetailid").val(''); $("#eoname").val(''); $("#eoenrolleddate").val(''); $("#eograduationdate").val('');
		        		$("#eogrpoposition").val(''); $("#eoremarks").val('');
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated !!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						$("#btnresourceothersedit").modal('hide');
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		$("#eoname").focus();
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

		$('#resourceupdate').submit(function(e){
			e.preventDefault();
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putGroup/' + $('#groupid').val(),
		        type: 'POST',
		        data: { groupid: $('#groupid').val(), groupformed: $("#groupformed").val(), name: $("#name").val(), description: $("#description").val(), status: $("#status").val(), grouptype: $("#grouptype").val(), divisiontype: $("#divisiontype").val(), groupceased: $("#groupceased").val() },
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
		        		$("#name").focus();
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
		        		if ($("#enrolleddate").val() == "") { $("#enrolleddate").val(now); }
		        		$("#membername").val(data.name);
		        		$("#nric").val(data.nric);
		        		$("#division").val(data.division);
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
		        		{ 
		        			txtMessage = 'NRIC does not Exist!  Please check again';

		        			noty({
								layout: 'center', type: 'confirm', text: 'NRIC does not Exist! Do you want to Add New Member Record?',
								animation: { open: 'animated tada', close: 'animated lightSpeedOut', easing: 'swing', speed: 500 },
								timeout: 4000,
								buttons: [
								    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
								    	$noty.close();
								    	$("#btnmemadd").modal('show');
								      }
								    },
								    {addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
								        $noty.close();
								        noty({
											layout: 'topRight', type: 'success', text: 'Action Cancelled.',
											animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
												},
											timeout: 4000
										}); 
								      }
								    }
								]
							});
		        		}
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

		$('#resourcenamesearch').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Searching Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postNricSearch/' + $("#groupid").val(),
		        type: 'POST',
		        data: { nricsearch: $("#namesearch").val(), groupid: $("#groupid").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var now = moment(data).format("DD-MM-YYYY");
		        		if ($("#enrolleddate").val() == "") { $("#enrolleddate").val(now); }
		        		$("#membername").val(data.name);
		        		$("#nric").val(data.nric);
		        		$("#division").val(data.division);
		        		$("#rhq").val(data.rhq);
		        		$("#zone").val(data.zone);
		        		$("#chapter").val(data.chapter);
		        		$("#district").val(data.district);
		        		$("#memberid").val(data.uniquecode);
		        		$("#namesearch").val("");
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
	        			{ txtMessage = '1111 NRIC does not Exist!  Please check again'; }
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

		$('#resourceaddnewmember').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			rules: {
				membername: {
					required: true,
					minlength: 3
				},
				nric: {
					required: true
				},
				position: {
					required: true
				},
				division: {
					required: true
				},
				mobile: {
					required: true
				},
				email: {
					email:true
				}
			},
	
			messages: {
				
			},
	
			invalidHandler: function (event, validator) { //display error alert on form submit   
				$('.alert-danger', $('.resourceaddnewmember')).show();
			},
	
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
	
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
	
			errorPlacement: function (error, element) {
				if(element.is(':checkbox') || element.is(':radio')) {
					var controls = element.closest('div[class*="col-"]');
					if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
					else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
				}
				else if(element.is('.select2')) {
					error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
				}
				else if(element.is('.chosen-select')) {
					error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
				}
				else error.insertAfter(element.parent());
			}
		});

		$('#resourceaddnewmember').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postAddNewMember/' + $("#groupid").val(),
		        type: 'POST',
		        data: { nric: $("#addnric").val(), groupid: $("#groupid").val(), dateofbirth: $("#adddateofbirth").val(), membername: $("#addmembername").val(), division: $("#adddivision").val(), addposition: $("#addposition").val(), rhq: $("#addrhq").val(), zone: $("#addzone").val(), chapter: $("#addchapter").val(), district: $("#adddistrict").val(), tel: $("#addtel").val(), mobile: $("#addmobile").val(), email: $("#addemail").val(), name: $("#name").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var now = moment(data).format("DD-MM-YYYY");
		        		$("#adddateofbirth").val(""); $("#addmembername").val(""); $("#addnric").val(""); $("#adddivision").val("");
		        		$("#addrhq").val(""); $("#addzone").val(""); $("#addchapter").val(""); $("#adddistrict").val(""); $("#addtel").val("");
		        		$("#addmobile").val(""); $("#addemail").val("");

		        		var oTable = $('#tdefault').DataTable();
					    oTable.clearPipeline().draw();
					    $("#btnmemadd").modal('hide');

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
		        		{ 
		        			txtMessage = 'Unable to Add Record into Database!  Please check again';
		        		}
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
	</script>
@stop