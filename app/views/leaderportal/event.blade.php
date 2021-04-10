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
			<li class="active"><a href="{{{ URL::action('LeadersPortalEventListingController@getIndex') }}}">Event Registration</a></li>
			<li class="active">{{ $eventname }}</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Event Registration<small><i class="ace-icon fa fa-angle-double-right"></i> {{ $eventname }}</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="tabbable">
					<ul class="nav nav-tabs padding-12" id="ModuleTab">
						<li class="active">
							<a data-toggle="tab" href="#home">
								<i class="blue fa fa-dashboard bigger-110"></i>
								Info
							</a>
						</li> <!-- Info -->
						<li>
							<a data-toggle="tab" href="#statistic">
								<i class="green fa fa-bar-chart bigger-110"></i>
								Statistic
							</a>
						</li> <!-- Statistic -->
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane in active">
							@if ($gakkaidistrict == 't' or $gakkaichapter == 't' or $gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
								<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">{{ $eventname }}</h5>
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
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
													@if ($special == 1) <!-- How to Use for Special Table -->
														<span class="btn btn-purple btn-sm popover-purple" data-rel="popover" data-placement="bottom" title="" data-content="<p>Let's record our joyous progress to encourage every single youth in our district!</p>
															<p>
																<b>Click 'Yes' when you achieve these: </b>
																<ul>
																	<li>
																		<b>Tried</b> - You have tried to contact this youth. It doesn't matter whether you are successful as long as you tried.
																	</li>
																	<li>
																		<b>Met</b> - You have met up with this youth. Congratulations!
																	</li>
																	<li>
																		<b>Sign Up</b> - This youth has signed up to be part of the Youth Summit 2018.
																	</li>
																</ul>
															</p>
															<p><b><u>Homevisit Button</u></b></p>
															<p>Click on the 'Homevisit' button and indicate how many people went to homevisit the youth.
															</br></br>
															For example, if all the 4 division district leaders went, put '1' in each of the boxes for MD, WD, YMD & YWD.</p>

															Thank you! " data-original-title="Instructions for {{ $eventname }}">How to Use?
														</span>
													@endif
													@if ($youthsummittickets == 1) <!-- How to Use for Tickets RSVP -->
														<span class="btn btn-purple btn-sm popover-purple" data-rel="popover" data-placement="bottom" title="" data-content="
															<p>
																<b>Tickets will be allocated based on performance date by individual RHQ </b>
																<ul>
																	<li>
																		<b>Show 1 - 25 August 2018</b> - RHQ 1, 4, 6, 8
																	</li>
																	<li>
																		<b>Show 2 - 26 August 2018</b> - RHQ 2, 3, 5, 7
																	</li>
																</ul>
															</p>
															<p><b><u>Tickets Allocation</u></b></p>
															<p>Tickets is for Youth Audience Above <b>13 years old</b>.</p>
															<p>	Each participant/member can reserve 2 tickets, any request for more than 2 tickets to be made after 30th July.</br></br>
																1st Cut-off for BOE Portal registration for Youth Summit Tickets – 15th July. 2nd Cut off after July Discussion meeting 30th July
															</p>

															Thank you! " data-original-title="Instructions for {{ $eventname }}">Tickets Allocation</span>
													@endif
													@if ($gakkaidistrict == 't' or $gakkaichapter == 't' or $gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
														@if ($eventtype == FALSE)
															@if ($youthsummittickets == 1) <!-- RSVP Buttons (Participants, Youth & Adult Div) -->
																<a href="#btnyouthsummit" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Youth Summit Participants</a> 
																<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
																<a href="#btnyouthsummityouth" role="button" class="btn btn-xs btn-success pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Youth Members</a>
																<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
																<a href="#btnyouthsummityonsha" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal" hidden><i class="fa fa-plus add bigger-120"></i> Adult Division</a>
															@elseif ($readonly == 0) <!-- Disable Write Feature in Database -->
																@if ($addonly == 1)
																	<a href="#btnresourceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add New Record</a> 
																	<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
																	@if ($addnontokang == true)<a href="#btnresourceaddothers" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add Others</a>@endif
																@endif
															@endif
														@else <!-- Normal Usage -->
															<a href="#btnresourcemdadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add Record</a> 
														@endif
													@endif
												</div>
											</div> <!-- How to Use Legends, Buttons for Tickets RSVP, Read Only and Normal Usage -->
											<div class="widget-main">
												@if ($special == 0)
													<table id="tdistrict" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>Created At</th>
																<th>Name</th> <!--01-->
																<th>名字</th> <!--02-->
																<th>RHQ</th> <!--03-->
																<th>Zone</th> <!--04-->
																<th>Chapter</th> <!--05-->
																<th>District</th> <!--06-->
																<th>Division</th> <!--07-->
																<th>Position</th> <!--08-->
																<th>Role</th> <!--09-->
																<th>Status</th> <!--10-->
																@if ($readonly == 0)<th>Action</th> @endif <!--11-->
																@if ($youthsummit == 1)
																	<th>Role</th> <!--11, 12-->
																	<th>GroupCode</th> <!--12, 13-->
																	<th>T-Shirt</th> <!--13, 14-->
																@endif
																@if ($sessionselect == true)
																	<th>Session</th> <!--11, 12, 14, 15-->
																@endif
																@if ($nationalityselect == true)
																	<th>Nationality</th> <!--11, 12, 13, 16-->
																@endif
																@if ($languageselect == true)
																	<th>Language</th> <!--11, 12, 13, 14, 16, 17-->
																@endif
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												@else
													<table id="tspecial" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>Name</th>
																<th>名字</th>
																<th>RHQ</th>
																<th>Zone</th>
																<th>Chap</th>
																<th>Dist</th>
																<th>Div</th>
																<th>Pos</th>
																<th>Tried</th>
																<th>Sign Up</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												@endif
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
													@if ($gakkaidistrict == 't' or $gakkaichapter == 't' or $gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
														@if ($youthsummittickets == 1) <!-- RSVP Buttons (Participants, Youth & Adult Div) -->
															<a href="#btnyouthsummit" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Youth Summit Participants</a> 
															<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
															<a href="#btnyouthsummityouth" role="button" class="btn btn-xs btn-success pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Youth Members</a>
															<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
															<a href="#btnyouthsummityonsha" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Adult Division</a>
														@elseif ($eventtype == FALSE)
															@if ($readonly == 0) <!-- Disable Write Feature in Database -->
																@if ($addonly == 1)
																	<a href="#btnresourceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add New Record</a> 
																	<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
																	@if ($addnontokang == true)<a href="#btnresourceaddothers" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add Others</a>@endif
																@endif
															@endif
														@else <!-- Normal Usage -->
															<a href="#btnresourcemdadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add Record</a> 
														@endif
													@endif
												</div>
											</div> <!-- Buttons for Tickets RSVP, Read Only and Normal Usage -->
										</div>
										@if ($studyeventtype == true)
											@if ($editonly == 1)
												<div id="resourceedit" class="modal" tabindex="-1">
													<div class="modal-dialog">
														<div class="modal-content">
															{{ Form::open(array('action' => 'LeadersPortalEventController@putEventAddInfo', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
																<fieldset>
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="blue bigger">Edit Record</h4>
																	</div>
																	<div class="modal-body overflow-visible">
																		<div class="row">
																			<div hidden>
																				<div class="form-group">
																					{{ Form::label('euniquecode', 'uniquecode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																					<div class="col-xs-12 col-sm-9">
																						<div class="clearfix">
																							{{ Form::text('euniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'euniquecode', 'disabled'));}}
																						</div>
																					</div>
																				</div>
																				<div class="form-group">
																					{{ Form::label('eCostume6', 'MD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																					<div class="col-xs-12 col-sm-9">
																						<div class="clearfix">
																							{{ Form::text('eCostume6', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eCostume6'));}}
																						</div>
																					</div>
																				</div>
																				<div class="form-group">
																					{{ Form::label('eCostume9', 'Show:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																					<div class="col-xs-12 col-sm-9">
																						<div class="clearfix">
																							{{ Form::select('eCostume9', array('' => '', 'Full Dress Rehearsal (22 Aug 2018)' => 'Full Dress Rehearsal (22 Aug 2018)', 'Show 1 (25 Aug 2018)' => 'Show 1 (25 Aug 2018)', 'Show 2 (26 Aug 2018)' => 'Show 2 (26 Aug 2018)'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eCostume9'));}}
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="form-group">
																				{{ Form::label('eName', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																				<div class="col-xs-12 col-sm-9">
																					<div class="clearfix">
																						{{ Form::text('eName', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eName'));}}
																					</div>
																				</div>
																			</div>
																			<div class="form-group">
																				{{ Form::label('eDateofBirth', 'Date of Birth:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																				<div class="col-xs-12 col-sm-9">
																					<div class="clearfix">
																						{{ Form::text('eDateofBirth', '', array('class' => 'col-xs-12 col-sm-11 date-picker', 'id' => 'eDateofBirth'));}}
																					</div>
																				</div>
																			</div>
																			<div class="form-group" @if ($sessionselect== false) hidden @endif>
																				{{ Form::label('esession', 'Session:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																				<div class="col-xs-12 col-sm-8">
																					<div class="clearfix">
																						{{ Form::select('esession', $sessionshow_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'esession'));}}
																					</div>
																				</div>
																			</div>
																			<div class="form-group" @if ($nationalityselect == false) hidden @endif>
																				{{ Form::label('ecountry', 'Country:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																				<div class="col-xs-12 col-sm-8">
																					<div class="clearfix">
																						{{ Form::select('ecountry', $country_options, 'Singapore', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ecountry'));}}
																					</div>
																				</div>
																			</div>
																			<div class="form-group" @if ($languageselect == false) hidden @endif>
																				{{ Form::label('elanguage', 'Language:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																				<div class="col-xs-12 col-sm-8">
																					<div class="clearfix">
																						{{ Form::select('elanguage', $language_options, 'Chinese', array('class' => 'col-xs-12 col-sm-11', 'id' => 'elanguage'));}}
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
											@endif
										@else
											@if ($editonly == 1)
												<div id="resourceedit" class="modal" tabindex="-1">
													<div class="modal-dialog">
														<div class="modal-content">
															{{ Form::open(array('action' => 'LeadersPortalEventController@putEventAddInfo', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
																<fieldset>
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="blue bigger">Edit Record</h4>
																	</div>
																	<div class="modal-body overflow-visible">
																		<div class="row">
																			<div hidden>
																				<div class="form-group">
																					{{ Form::label('euniquecode', 'uniquecode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																					<div class="col-xs-12 col-sm-9">
																						<div class="clearfix">
																							{{ Form::text('euniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'euniquecode', 'disabled'));}}
																						</div>
																					</div>
																				</div>
																				<div class="form-group">
																					{{ Form::label('eCostume6', 'MD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																					<div class="col-xs-12 col-sm-9">
																						<div class="clearfix">
																							{{ Form::text('eCostume6', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eCostume6'));}}
																						</div>
																					</div>
																				</div>
																				<div class="form-group">
																					{{ Form::label('eCostume7', 'WD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																					<div class="col-xs-12 col-sm-9">
																						<div class="clearfix">
																							{{ Form::text('eCostume7', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eCostume7'));}}
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="form-group">
																				{{ Form::label('eName', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																				<div class="col-xs-12 col-sm-9">
																					<div class="clearfix">
																						{{ Form::text('eName', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eName'));}}
																					</div>
																				</div>
																			</div>
																			<div class="form-group">
																				{{ Form::label('eRegisteredSession', 'Registered Session:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																				<div class="col-xs-12 col-sm-9">
																					<div class="clearfix">
																						{{ Form::text('eRegisteredSession', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eRegisteredSession'));}}
																					</div>
																				</div>
																			</div>
																			<div class="form-group" @if ($sessionselect== false) hidden @endif>
																				{{ Form::label('esession', 'Change Session:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																				<div class="col-xs-12 col-sm-8">
																					<div class="clearfix">
																						{{ Form::select('esession', $sessionshow_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'esession'));}}
																					</div>
																				</div>
																			</div>
																			<div class="form-group" @if ($nationalityselect == false) hidden @endif>
																				{{ Form::label('ecountry', 'Country:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																				<div class="col-xs-12 col-sm-8">
																					<div class="clearfix">
																						{{ Form::select('ecountry', $country_options, 'Singapore', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ecountry'));}}
																					</div>
																				</div>
																			</div>
																			<div class="form-group" @if ($languageselect == false) hidden @endif>
																				{{ Form::label('elanguage', 'Language:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																				<div class="col-xs-12 col-sm-8">
																					<div class="clearfix">
																						{{ Form::select('elanguage', $language_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'elanguage'));}}
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
											@endif
										@endif
									</div>
								</div> <!-- Event Detail Listing -->
								@if ($viewattendance == 1)
									<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
										<div class="widget-box widget-color-orange">
											<div class="widget-header">
												<h5 class="widget-title">{{ $eventname }} - Attendance</h5>
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
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
												<div class="widget-main">
													@if ($gakkaishq == 't')
														<table id="tshqeventtraining" class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>RHQ</th>
																	<th>Zone</th>
																	<th>Chapter</th>
																	<th>District</th>
																	<th>Division</th>
																	<th>Position</th>
																	<th>Trg 1</th>
																	<th>Trg 2</th>
																	<th>Trg 3</th>
																	<th>Trg 4</th>
																	<th>Trg 5</th>
																	<th>Trg 6</th>
																	<th>Trg 7</th>
																	<th>Trg 8</th>
																	<th>Trg 9</th>
																	<th>Trg 10</th>
																	<th>Total</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													@endif
													@if ($gakkairegion == 't')
														<table id="trhqeventtraining" class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>RHQ</th>
																	<th>Zone</th>
																	<th>Chapter</th>
																	<th>District</th>
																	<th>Division</th>
																	<th>Position</th>
																	<th>Trg 1</th>
																	<th>Trg 2</th>
																	<th>Trg 3</th>
																	<th>Trg 4</th>
																	<th>Trg 5</th>
																	<th>Trg 6</th>
																	<th>Trg 7</th>
																	<th>Trg 8</th>
																	<th>Trg 9</th>
																	<th>Trg 10</th>
																	<th>Total</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													@endif
													@if ($gakkaizone == 't')
														<table id="tzoneeventtraining" class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>RHQ</th>
																	<th>Zone</th>
																	<th>Chapter</th>
																	<th>District</th>
																	<th>Division</th>
																	<th>Position</th>
																	<th>Trg 1</th>
																	<th>Trg 2</th>
																	<th>Trg 3</th>
																	<th>Trg 4</th>
																	<th>Trg 5</th>
																	<th>Trg 6</th>
																	<th>Trg 7</th>
																	<th>Trg 8</th>
																	<th>Trg 9</th>
																	<th>Trg 10</th>
																	<th>Total</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													@endif
													@if ($gakkaichapter == 't')
														<table id="tchaptereventtraining" class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>RHQ</th>
																	<th>Zone</th>
																	<th>Chapter</th>
																	<th>District</th>
																	<th>Division</th>
																	<th>Position</th>
																	<th>Trg 1</th>
																	<th>Trg 2</th>
																	<th>Trg 3</th>
																	<th>Trg 4</th>
																	<th>Trg 5</th>
																	<th>Trg 6</th>
																	<th>Trg 7</th>
																	<th>Trg 8</th>
																	<th>Trg 9</th>
																	<th>Trg 10</th>
																	<th>Total</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													@endif
													@if ($gakkaidistrict == 't')
														<table id="tdistricteventtraining" class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>RHQ</th>
																	<th>Zone</th>
																	<th>Chapter</th>
																	<th>District</th>
																	<th>Division</th>
																	<th>Position</th>
																	<th>Trg 1</th>
																	<th>Trg 2</th>
																	<th>Trg 3</th>
																	<th>Trg 4</th>
																	<th>Trg 5</th>
																	<th>Trg 6</th>
																	<th>Trg 7</th>
																	<th>Trg 8</th>
																	<th>Trg 9</th>
																	<th>Trg 10</th>
																	<th>Total</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													@endif
												</div>
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Attendance Detail Listing -->
								@endif
								@if ($eventtype == FALSE)
									@if ($youthsummittickets == 0)
										<div id="btnresourceadd" class="modal" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													<fieldset>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="blue bigger">Membership</h4>
														</div>
														<div class="modal-body overflow-visible">
															<div class="row">
																<div class="col-sm-12 widget-container-col">
																	<div class="widget-box widget-color-blue">
																		<div class="widget-header">
																			<h5 class="widget-title">Membership</h5>
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
																				<table id="tmembership" class="table table-striped table-bordered table-hover">
																					<thead>
																						<tr>
																							<th>Name</th>
																							<th>名字</th>
																							<th>Chap</th>
																							<th>Dist</th>
																							<th>Div</th>
																							<th>Pos</th>
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
														<div class="modal-footer">
															<button class="btn btn-sm" data-dismiss="modal" id="close">
																<i class="icon-remove"></i>
																Close
															</button>
														</div>
													</fieldset>
												</div>
											</div>
										</div>
										<div id="btnresourceaddothers" class="modal" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													{{ Form::open(array('action' => 'LeadersPortalEventController@postEventParticipantOthers', 'id' => 'resourceaddothers', 'class' => 'form-horizontal')) }}
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
																		{{ Form::label('cname', '名字:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('cname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cname'));}}
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
																		{{ Form::label('dateofbirthtxt', 'Date of Birth:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('dateofbirthtxt', '', array('class' => 'col-xs-12 col-sm-11 date-picker', 'id' => 'dateofbirthtxt', 'placeholder' => 'YYYY-MM-DD', 'data-date-format' => 'yyyy-mm-dd', ));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('cbrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('cbrhq', $rhq_options, $rhq, array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbrhq'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('cbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix" id="zonediv">
																				{{ Form::select('cbzone', $zone_options, $zone, array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbzone'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('cbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix" id="chapterdiv">
																				{{ Form::select('cbchapter', $chapter_options, $chapter, array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbchapter'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('district', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('district', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'district'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('position', $memposition_options, 'BEL', array('class' => 'col-xs-12 col-sm-11', 'id' => 'position'));}}
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
																		{{ Form::label('introducer', 'Introducer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('introducer', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'introducer'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group"  @if ($nationalityselect == false) hidden @endif>
																		{{ Form::label('country', 'Country:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('country', $country_options, 'Please Select a Country', array('class' => 'col-xs-12 col-sm-11', 'id' => 'country'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group"  @if ($sessionselect == false) hidden @endif>
																		{{ Form::label('session', 'Session:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('session', $sessionshow_options, 'Please Select a Session', array('class' => 'col-xs-12 col-sm-11', 'id' => 'session'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group" @if ($languageselect == false) hidden @endif>
																		{{ Form::label('language', 'Language:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('language', $language_options, 'Please Select a Language', array('class' => 'col-xs-12 col-sm-11', 'id' => 'language'));}}
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
									@else
										<div id="btnyouthsummit" class="modal" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													<fieldset>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="blue bigger">Youth Summit Participants</h4>
														</div>
														<div class="modal-body overflow-visible">
															<div class="row">
																<div class="col-sm-12 widget-container-col">
																	<div class="widget-box widget-color-blue">
																		<div class="widget-header">
																			<h5 class="widget-title">Youth Summit Participants</h5>
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
																				<table id="tysparticipants" class="table table-striped table-bordered table-hover">
																					<thead>
																						<tr>
																							<th>Name</th>
																							<th>名字</th>
																							<th>Zone</th>
																							<th>Chap</th>
																							<th>Dist</th>
																							<th>Div</th>
																							<th>Pos</th>
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
														<div class="modal-footer">
															<button class="btn btn-sm" data-dismiss="modal" id="close">
																<i class="icon-remove"></i>
																Close
															</button>
														</div>
													</fieldset>
												</div>
											</div>
										</div>
										<div id="btnyouthsummityonsha" class="modal" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													<fieldset>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="blue bigger">Adult Division</h4>
														</div>
														<div class="modal-body overflow-visible">
															<div class="row">
																<div class="col-sm-12 widget-container-col">
																	<div class="widget-box widget-color-blue">
																		<div class="widget-header">
																			<h5 class="widget-title">Adult Division</h5>
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
																				<table id="tysyonsha" class="table table-striped table-bordered table-hover">
																					<thead>
																						<tr>
																							<th>Name</th>
																							<th>名字</th>
																							<th>Zone</th>
																							<th>Chap</th>
																							<th>Dist</th>
																							<th>Div</th>
																							<th>Pos</th>
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
														<div class="modal-footer">
															<button class="btn btn-sm" data-dismiss="modal" id="close">
																<i class="icon-remove"></i>
																Close
															</button>
														</div>
													</fieldset>
												</div>
											</div>
										</div>
										<div id="btnyouthsummityouth" class="modal" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													<fieldset>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="blue bigger">Youth Members</h4>
														</div>
														<div class="modal-body overflow-visible">
															<div class="row">
																<div class="col-sm-12 widget-container-col">
																	<div class="widget-box widget-color-blue">
																		<div class="widget-header">
																			<h5 class="widget-title">Youth Members</h5>
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
																				<table id="tysyouth" class="table table-striped table-bordered table-hover">
																					<thead>
																						<tr>
																							<th>Name</th>
																							<th>名字</th>
																							<th>Zone</th>
																							<th>Chap</th>
																							<th>Dist</th>
																							<th>Div</th>
																							<th>Pos</th>
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
														<div class="modal-footer">
															<button class="btn btn-sm" data-dismiss="modal" id="close">
																<i class="icon-remove"></i>
																Close
															</button>
														</div>
													</fieldset>
												</div>
											</div>
										</div>
										<div id="btnresourceaddyouthsummitparticipants" class="modal" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													{{ Form::open(array('action' => 'LeadersPortalEventController@postEventYouthSummitParticipantsTickets', 'id' => 'resourceaddyouthsummitparticipant', 'class' => 'form-horizontal')) }}
														<fieldset>
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="blue bigger">Add Record</h4>
															</div>
															<div class="modal-body overflow-visible">
																<div class="row">
																	<div class="form-group">
																		{{ Form::label('yspcostume9', 'Show:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('yspcostume9', array('' => '','Full Dress Rehearsal (22 Aug 2018)' => 'Full Dress Rehearsal (22 Aug 2018)', 'Show 1 (25 Aug 2018)' => 'Show 1 (25 Aug 2018)', 'Show 2 (26 Aug 2018)' => 'Show 2 (26 Aug 2018)'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspcostume9'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('yspname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('yspname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspname'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('yspcname', '名字:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('yspcname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspcname'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('yspcbrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('yspcbrhq', $rhq_options, $rhq, array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspcbrhq'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('yspcbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix" id="yspzonediv">
																				{{ Form::select('yspcbzone', $zone_options, $zone, array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspcbzone'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('yspcbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix" id="yspchapterdiv">
																				{{ Form::select('yspcbchapter', $chapter_options, $chapter, array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspcbchapter'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('yspdistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('yspdistrict', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspdistrict'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('yspposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('yspposition', $memposition_options, 'NF', array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspposition'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('yspdivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('yspdivision', $division_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspdivision'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('yspintroducer', 'Introducer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('yspintroducer', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspintroducer'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('yspremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::textarea('yspremarks', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspremarks', 'rows'=>'3'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group" hidden>
																		{{ Form::label('yspuniquecode', 'UniqueCode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('yspuniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'yspuniquecode'));}}
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
										<div id="btnresourceaddyouthsummityonsha" class="modal" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													{{ Form::open(array('action' => 'LeadersPortalEventController@postEventYouthSummitYonshaTickets', 'id' => 'resourceaddyouthsummityonsha', 'class' => 'form-horizontal')) }}
														<fieldset>
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="blue bigger">Add Record</h4>
															</div>
															<div class="modal-body overflow-visible">
																<div class="row">
																	<div class="form-group">
																		{{ Form::label('ysycostume9', 'Show:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('ysycostume9', array('' => '','Full Dress Rehearsal (22 Aug 2018)' => 'Full Dress Rehearsal (22 Aug 2018)', 'Show 1 (25 Aug 2018)' => 'Show 1 (25 Aug 2018)', 'Show 2 (26 Aug 2018)' => 'Show 2 (26 Aug 2018)'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysycostume9'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysyname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('ysyname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysyname'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysycname', '名字:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('ysycname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysycname'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysycbrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('ysycbrhq', $rhq_options, $rhq, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysycbrhq'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysycbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix" id="ysyzonediv">
																				{{ Form::select('ysycbzone', $zone_options, $zone, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysycbzone'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysycbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix" id="ysychapterdiv">
																				{{ Form::select('ysycbchapter', $chapter_options, $chapter, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysycbchapter'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysydistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('ysydistrict', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysydistrict'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysyposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('ysyposition', $memposition_options, 'NF', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysyposition'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysydivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('ysydivision', $division_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysydivision'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysyintroducer', 'Introducer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('ysyintroducer', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysyintroducer'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysyremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::textarea('ysyremarks', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysyremarks', 'rows'=>'3'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group" hidden>
																		{{ Form::label('ysyuniquecode', 'UniqueCode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('ysyuniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysyuniquecode'));}}
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
										<div id="btnresourceaddyouthsummityouth" class="modal" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													{{ Form::open(array('action' => 'LeadersPortalEventController@postEventYouthSummitYouthTickets', 'id' => 'resourceaddyouthsummityouth', 'class' => 'form-horizontal')) }}
														<fieldset>
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="blue bigger">Add Record</h4>
															</div>
															<div class="modal-body overflow-visible">
																<div class="row">
																	<div class="form-group">
																		{{ Form::label('ysacostume9', 'Show:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('ysacostume9', array('' => '','Full Dress Rehearsal (22 Aug 2018)' => 'Full Dress Rehearsal (22 Aug 2018)', 'Show 1 (25 Aug 2018)' => 'Show 1 (25 Aug 2018)', 'Show 2 (26 Aug 2018)' => 'Show 2 (26 Aug 2018)'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysacostume9'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysaname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('ysaname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysaname'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysacname', '名字:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('ysacname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysacname'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysacbrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('ysacbrhq', $rhq_options, $rhq, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysacbrhq'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysacbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix" id="ysazonediv">
																				{{ Form::select('ysacbzone', $zone_options, $zone, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysacbzone'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysacbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix" id="ysachapterdiv">
																				{{ Form::select('ysacbchapter', $chapter_options, $chapter, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysacbchapter'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysadistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('ysadistrict', array('' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysadistrict'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysaposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('ysaposition', $memposition_options, 'NF', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysaposition'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysadivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::select('ysaposition', $division_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysadivision'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysaintroducer', 'Introducer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('ysaintroducer', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysaintroducer'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('ysaremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::textarea('ysaremarks', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysaremarks', 'rows'=>'3'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group" hidden>
																		{{ Form::label('ysauniquecode', 'UniqueCode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-8">
																			<div class="clearfix">
																				{{ Form::text('ysauniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ysauniquecode'));}}
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																	{{ Form::button('<i class="fa fa-check"></i> <strong>Invite</strong>', array('class' => 'btn btn-sm btn-success', 'id' => 'resourceinvite')); }}
																<button class="btn btn-sm" data-dismiss="modal" id="btnclose">
																	<i class="fa fa-remove"></i>
																	Cancel
																</button>
																{{ Form::button('<i class="fa fa-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourceadd')); }}
															</div>
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									@endif
								@else
									<div id="btnresourcemdadd" class="modal" tabindex="-1">
										<div class="modal-dialog">
											<div class="modal-content">
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">SSA Mentor and Disciple Kenshu Training</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div class="col-sm-12 widget-container-col">
																<div class="widget-box widget-color-blue">
																	<div class="widget-header">
																		<h5 class="widget-title">SSA Mentor and Disciple Kenshu Training</h5>
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
																			<table id="tpremad" class="table table-striped table-bordered table-hover">
																				<thead>
																					<tr>
																						<th>Name</th>
																						<th>名字</th>
																						<th>Chap</th>
																						<th>Dist</th>
																						<th>Div</th>
																						<th>Pos</th>
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
													<div class="modal-footer">
														<button class="btn btn-sm" data-dismiss="modal" id="close">
															<i class="icon-remove"></i>
															Close
														</button>
													</div>
												</fieldset>
											</div>
										</div>
									</div>
									<div id="btnresourceaddothers" class="modal" tabindex="-1">
										<div class="modal-dialog">
											<div class="modal-content">
												{{ Form::open(array('action' => 'LeadersPortalEventController@postEventParticipantOthers', 'id' => 'resourceaddothers', 'class' => 'form-horizontal')) }}
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
																	{{ Form::label('cname', '名字:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::text('cname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cname'));}}
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
																<div hidden class="form-group">
																	{{ Form::label('dateofbirthtxt', 'Date of Birth:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::text('dateofbirthtxt', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'dateofbirthtxt'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('cbrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('cbrhq', $rhq_options, $rhq, array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbrhq'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('cbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix" id="zonediv">
																			{{ Form::select('cbzone', $zone_options, $zone, array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbzone'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('cbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix" id="chapterdiv">
																			{{ Form::select('cbchapter', $chapter_options, $chapter, array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbchapter'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('district', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('district', array('' => '', '-' => '-', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'district'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('position', $memposition_options, 'BEL', array('class' => 'col-xs-12 col-sm-11', 'id' => 'position'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('division', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('division', $division_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'division'));}}
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
																<div class="form-group"  @if ($nationalityselect == false) hidden @endif>
																	{{ Form::label('country', 'Country:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('country', $country_options, 'Please Select a Country', array('class' => 'col-xs-12 col-sm-11', 'id' => 'country'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group"  @if ($sessionselect == false) hidden @endif>
																	{{ Form::label('session', 'Session:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('session', $sessionshow_options, 'Please Select a Session', array('class' => 'col-xs-12 col-sm-11', 'id' => 'session'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group" @if ($languageselect == false) hidden @endif>
																	{{ Form::label('language', 'Language:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('language', $language_options, 'Please Select a Language', array('class' => 'col-xs-12 col-sm-11', 'id' => 'language'));}}
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
								@endif
							@endif <!-- Event Detail Listing and Attendance Detail Listing -->
						</div>
						<div id="statistic" class="tab-pane">
							@if ($special == 1)
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Tried </h5>
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
												<div class="well well-lg">
													<center><h1> <span id="spantried">{{$tried}}</span> </h1></center>
												</div>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Tried -->
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable" hidden>
									<div class="widget-box widget-color-red">
										<div class="widget-header">
											<h5 class="widget-title">Met</h5>
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
												<div class="well well-lg">
													<center><h1> <span id="spanmet">{{$met}}</span> </h1></center>
												</div>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Met -->
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box widget-color-green">
										<div class="widget-header">
											<h5 class="widget-title">Sign Up</h5>
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
												<div class="well well-lg">
													<center><h1> <span id="spanattending">{{$attending}}</span> </h1></center>
												</div>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Attending -->
								@if ($gakkaishq == 't')
									<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Region Total</h5>
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
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
												<div class="widget-main">
													<table id="tspecialrhqstats" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>RHQ</th>
																<th>Tried</th>
																<th>Sign Up</th>
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
									</div> <!-- Region Stats -->
								@endif
								@if ($gakkairegion == 't' or $gakkaishq == 't')
									<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Zone Total</h5>
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
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
												<div class="widget-main">
													<table id="tspecialzonestats" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>RHQ</th>
																<th>Zone</th>
																<th>Tried</th>
																<th>Sign Up</th>
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
									</div> <!-- Zone Stats -->
								@endif
								@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
									<div class="col-xs-12 col-sm-5 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">Chapter Total</h5>
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
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
												<div class="widget-main">
													<table id="tspecialchapterstats" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>RHQ</th>
																<th>Zone</th>
																<th>Chapter</th>
																<th>Tried</th>
																<th>Sign Up</th>
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
									</div> <!-- Chapter Stats -->
								@endif
								@if ($gakkaichapter == 't')
									<div class="col-xs-12 col-sm-5 widget-container-span ui-sortable">
										<div class="widget-box widget-color-blue">
											<div class="widget-header">
												<h5 class="widget-title">District Total</h5>
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
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
												<div class="widget-main">
													<table id="tspecialdistrictstats" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>Chapter</th>
																<th>District</th>
																<th>Tried</th>
																<th>Sign Up</th>
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
									</div> <!-- District Stats -->
								@endif
							@endif
							@if ($rsvpeventtype == true)
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box widget-color-orange">
										<div class="widget-header">
											<h5 class="widget-title">Reserved (aka Processing) </h5>
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
												<div class="well well-lg">
													<center><h1> <span id="spanrsvpeventtypeprocessing">{{$rsvpeventtypeprocessing}}</span> </h1></center>
												</div>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Processing -->
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box widget-color-green">
										<div class="widget-header">
											<h5 class="widget-title">Confirmed (aka Accepted)</h5>
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
												<div class="well well-lg">
													<center><h1> <span id="spanrsvpeventtypeaccepted">{{$rsvpeventtypeaccepted}}</span> </h1></center>
												</div>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Attending -->
							@endif
							<!-- By Role -->
							@if ($gakkaishq == 't')
								<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Region By Role By Division Total</h5>
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
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
											<div class="widget-main">
												<table id="troledivisionrhqstats" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>RHQ</th>
															<th>MD</th>
															<th>WD</th>
															<th>YMD</th>
															<th>YWD</th>
															<th>PD</th>
															<th>YC</th>
															<th>Others</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot id="troledivisionrhqstatsfoot">
														<tr>
															<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- RHQ No of Participants Stats -->
							@endif
							@if ($gakkairegion == 't' or $gakkaishq == 't')
								<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Zone By Role By Division Total</h5>
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
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
											<div class="widget-main">
												<table id="troledivisionzonestats" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>RHQ</th>
															<th>Zone</th>
															<th>MD</th>
															<th>WD</th>
															<th>YMD</th>
															<th>YWD</th>
															<th>PD</th>
															<th>YC</th>
															<th>Others</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot id="troledivisionzonestatsfoot">
														<tr>
															<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Zone No of Participants Stats -->
							@endif
							@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
								<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Chapter By Role By Division Total</h5>
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
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
											<div class="widget-main">
												<table id="troledivisionchapterstats" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>RHQ</th>
															<th>Zone</th>
															<th>Chapter</th>
															<th>MD</th>
															<th>WD</th>
															<th>YMD</th>
															<th>YWD</th>
															<th>PD</th>
															<th>YC</th>
															<th>Others</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot id="troledivisionchapterstatsfoot">
														<tr>
															<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Chapter No of Participants Stats -->
							@endif
							@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaichapter == 't')
								<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">District By Role By Division Total</h5>
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
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
											<div class="widget-main">
												<table id="troledivisiondistrictstats" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>RHQ</th>
															<th>Zone</th>
															<th>Chapter</th>
															<th>District</th>
															<th>MD</th>
															<th>WD</th>
															<th>YMD</th>
															<th>YWD</th>
															<th>PD</th>
															<th>YC</th>
															<th>Others</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot id="troledivisiondistrictstatsfoot">
														<tr>
															<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- District No of Participants Stats -->
							@endif
							<!-- By Status -->
							@if ($gakkaishq == 't')
								<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">RHQ By Status By Division Total</h5>
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
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
											<div class="widget-main">
												<table id="tstatusdivisionrhqstats" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Status</th>
															<th>MD</th>
															<th>WD</th>
															<th>YMD</th>
															<th>YWD</th>
															<th>PD</th>
															<th>YC</th>
															<th>Others</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot id="tstatusdivisionrhqstatsfoot">
														<tr>
															<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- RHQ Status Stats -->
							@endif
							@if ($gakkairegion == 't' or $gakkaishq == 't')
								<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Zone By Status By Division Total</h5>
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
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
											<div class="widget-main">
												<table id="tstatusdivisionzonestats" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Status</th>
															<th>Zone</th>
															<th>MD</th>
															<th>WD</th>
															<th>YMD</th>
															<th>YWD</th>
															<th>PD</th>
															<th>YC</th>
															<th>Others</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot id="tstatusdivisionzonestatsfoot">
														<tr>
															<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Zone Status Stats -->
							@endif
							@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
								<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Chapter By Status By Division Total</h5>
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
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
											<div class="widget-main">
												<table id="tstatusdivisionchapterstats" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Status</th>
															<th>Zone</th>
															<th>Chapter</th>
															<th>MD</th>
															<th>WD</th>
															<th>YMD</th>
															<th>YWD</th>
															<th>PD</th>
															<th>YC</th>
															<th>Others</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot id="tstatusdivisionchapterstatsfoot">
														<tr>
															<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Chapter Status Stats -->
							@endif
							@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaichapter == 't')
								<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">District By Status By Division Total</h5>
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
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
											<div class="widget-main">
												<table id="tstatusdivisiondistrictstats" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Status</th>
															<th>Zone</th>
															<th>Chapter</th>
															<th>District</th>
															<th>MD</th>
															<th>WD</th>
															<th>YMD</th>
															<th>YWD</th>
															<th>PD</th>
															<th>YC</th>
															<th>Others</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot id="troledivisiondistrictstatsfoot">
														<tr>
															<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- District Status Stats -->
							@endif
							@if ($rsvpeventtype == true)
								@if ($gakkaishq == 't')
									<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
										<div class="widget-box widget-color-purple">
											<div class="widget-header">
												<h5 class="widget-title">Region By Session</h5>
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
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
												<div class="widget-main">
													<table id="trsvpshowrhqstats" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>RHQ</th>
																<th>Session</th>
																<th>Processing</th>
																<th>Accepted</th>
																<th>Total</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
														<tfoot id="trsvpshowrhqstatsfoot">
															<tr>
																<th>Total</th><th></th><th></th><th></th><th></th>
															</tr>
														</tfoot>
													</table>
												</div>
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
											</div>
										</div>
									</div> <!-- RHQ RSVP By Show Stats -->
								@endif
								@if ($gakkairegion == 't' or $gakkaishq == 't')
									<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
										<div class="widget-box widget-color-purple">
											<div class="widget-header">
												<h5 class="widget-title">Zone By Session</h5>
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
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
												<div class="widget-main">
													<table id="trsvpshowzonestats" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>RHQ</th>
																<th>Zone</th>
																<th>Session</th>
																<th>Processing</th>
																<th>Accepted</th>
																<th>Total</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
														<tfoot id="trsvpshowzonestatsfoot">
															<tr>
																<th>Total</th><th></th><th></th><th></th><th></th><th></th>
															</tr>
														</tfoot>
													</table>
												</div>
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Zone RSVP By Show Stats -->
								@endif
								@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
									<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
										<div class="widget-box widget-color-purple">
											<div class="widget-header">
												<h5 class="widget-title">Chapter By Session</h5>
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
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
												<div class="widget-main">
													<table id="trsvpshowchapterstats" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>RHQ</th>
																<th>Zone</th>
																<th>Chapter</th>
																<th>Session</th>
																<th>Processing</th>
																<th>Accepted</th>
																<th>Total</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
														<tfoot id="trsvpshowchapterstatsfoot">
															<tr>
																<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th>
															</tr>
														</tfoot>
													</table>
												</div>
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
											</div>
										</div>
									</div> <!-- Chapter RSVP By Show Stats -->
								@endif
								@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaichapter == 't')
									<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
										<div class="widget-box widget-color-purple">
											<div class="widget-header">
												<h5 class="widget-title">District By Session</h5>
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
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
												<div class="widget-main">
													<table id="trsvpshowdistrictstats" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>RHQ</th>
																<th>Zone</th>
																<th>Chapter</th>
																<th>District</th>
																<th>Session</th>
																<th>Processing</th>
																<th>Accepted</th>
																<th>Total</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
														<tfoot id="trsvpshowdistrictstatsfoot">
															<tr>
																<th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
															</tr>
														</tfoot>
													</table>
												</div>
												<div class="widget-toolbox padding-8 clearfix">
													<div class="col-xs-12">
													</div>
												</div>
											</div>
										</div>
									</div> <!-- District RSVP By Show Stats -->
								@endif
							@endif
							@if ($sessionsizelimit == 1)
								<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
									<div class="widget-box widget-color-purple">
										<div class="widget-header">
											<h5 class="widget-title">Session Total</h5>
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
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
											<div class="widget-main">
												<table id="tsessiontotalstats" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Session</th>
															<th>Capacity</th>
															<th>Registered</th>
															<th>Available</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot id="tsessiontotalstatsfoot">
														<tr>
															<th>Total</th><th></th><th></th><th></th>
														</tr>
													</tfoot>
												</table>
											</div>
											<div class="widget-toolbox padding-8 clearfix">
												<div class="col-xs-12">
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Session Total Stats -->
							@endif
						</div>
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

				$.fn.datepicker.defaults.format = "yyyy-mm-dd";
				$('#eDateofBirth').datepicker({
					currentText: "Now",
					dateFormat: "yyyy-mm-dd",
					gotoCurrent: true
				});
				$('#dateofbirthtxt').datepicker({
					currentText: "Now",
					dateFormat: "yyyy-mm-dd",
					gotoCurrent: true
				});

				@if ($special == 0)
					var oDistrictTable = $('#tdistrict').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
				        displayLength: 10, // Default No of Records per page on 1st load
				        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        pagingType: "first_last_numbers",
				        responsive: true,
				        stateSave: true, // Remember paging & filters
				        autoWidth: false,
				        scrollCollapse: true,
				        deferRender: true,
				        processing: false,
				        serverSide: false,
				        searching: true,
						order: [[0, "desc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [7, "asc"], [8, "asc"], [1, "asc"]],
				        ajax: 'getEventParticipant/{{ $rid }}',
				        columnDefs: [
							@if ($readonly == 0)
								{ responsivePriority: 1, targets: 0 },
								{ responsivePriority: 2, targets: 1 },
								{ responsivePriority: 3, targets: 11 },
								{ responsivePriority: 4, targets: 4 },
								{ responsivePriority: 5, targets: 3 },
								{ responsivePriority: 6, targets: 7 },
							@else
								{ responsivePriority: 1, targets: 0 },
								{ responsivePriority: 2, targets: 1 },
								{ responsivePriority: 3, targets: 4 },
								{ responsivePriority: 4, targets: 3 },
								{ responsivePriority: 5, targets: 7 },
								{ responsivePriority: 6, targets: 8 },
							@endif
				        	{
						    	targets: [ 0 ], data: "created_at", width: "170px", searchable: "true",
						    	render: function ( data, type, full ){
						    		return moment(data).format("YYYY-MM-DD HH:mm:ss");
							    }
					    	},
			            	{ targets: [ 1 ], data: "name", searchable: true },
			            	{ targets: [ 2 ], data: "chinesename", searchable: true },
			            	{ targets: [ 3 ], data: "rhq", searchable: true },
			            	{ targets: [ 4 ], data: "zone", searchable: true },
			            	{ targets: [ 5 ], data: "chapter", searchable: true },
			            	{ targets: [ 6 ], data: "district", searchable: true },
					    	{ targets: [ 7 ], data: "division", searchable: true },
					    	{ targets: [ 8 ], data: "position", searchable: true },
							{ targets: [ 9 ], data: "role", searchable: true },
					    	{
						    	targets: [ 10 ], data: "status",
						    	render: function ( data, type, full ){
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
				    		}@if ($readonly == 0),
					    	{
						    	targets: [ 11 ], data: "uniquecode",
						    	render: function ( data, type, full ){
									return '@if ($gakkaidistrict == 't' or $gakkaichapter == 't' or $gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')<button type="submit" onClick=attendrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-thumbs-up bigger-120"></i></button> <button type="submit" onClick=absentrow("'+ data +'") class="btn btn-xs btn-warning"><i class="fa fa-thumbs-down bigger-120"></i></button> @if ($editonly == 1)<button type="submit" onClick=editrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> @endif <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>@endif'
							    }
					    	}@endif 
							@if ($youthsummit == 1),
								@if ($readonly == 0)
									{ targets: [ 12 ], data: "role", searchable: true },
									{ targets: [ 13 ], data: "groupcode", searchable: true },
									{ targets: [ 14 ], data: "costume3", searchable: true }
								@else
									{ targets: [ 11 ], data: "role", searchable: true },
									{ targets: [ 12 ], data: "groupcode", searchable: true },
									{ targets: [ 13 ], data: "costume3", searchable: true }
								@endif
							@endif
							@if ($sessionselect == true),
								@if ($readonly == 0)
									@if ($youthsummit == 1)
										{ targets: [ 15 ], data: "session", searchable: true }
									@else
										{ targets: [ 12 ], data: "session", searchable: true }
									@endif
								@else
									@if ($youthsummit == 1)
										{ targets: [ 14 ], data: "session", searchable: true }
									@else
										{ targets: [ 11 ], data: "session", searchable: true }
									@endif
								@endif
							@endif
							@if ($nationalityselect == true),
								@if ($readonly == 0)
									@if ($youthsummit == 1)
										@if ($sessionselect == true)
											{ targets: [ 16 ], data: "countryofbirth", searchable: true }
										@else
											{ targets: [ 13 ], data: "countryofbirth", searchable: true }
										@endif
									@else
										@if ($sessionselect == true)
											{ targets: [ 13 ], data: "countryofbirth", searchable: true }
										@else
											{ targets: [ 13 ], data: "countryofbirth", searchable: true }
										@endif
									@endif
								@else
									@if ($youthsummit == 1)
										@if ($sessionselect == true)
											{ targets: [ 16 ], data: "countryofbirth", searchable: true }
										@else
											{ targets: [ 14 ], data: "countryofbirth", searchable: true }
										@endif
									@else
										@if ($sessionselect == true)
											{ targets: [ 12 ], data: "countryofbirth", searchable: true }
										@else
											{ targets: [ 11 ], data: "countryofbirth", searchable: true }
										@endif
									@endif
								@endif
							@endif
							@if ($languageselect == true),
								@if ($readonly == 0)
									@if ($youthsummit == 1)
										@if ($sessionselect == true)
											@if ($nationalityselect == true)
												{ targets: [ 17 ], data: "language", searchable: true }
											@else
												{ targets: [ 16 ], data: "language", searchable: true }
											@endif
										@else
											@if ($nationalityselect == true)
												{ targets: [ 16 ], data: "language", searchable: true }
											@else
												{ targets: [ 15 ], data: "language", searchable: true }
											@endif
										@endif
									@else
										@if ($sessionselect == true)
											@if ($nationalityselect == true)
												{ targets: [ 14 ], data: "language", searchable: true }
											@else
												{ targets: [ 13 ], data: "language", searchable: true }
											@endif
										@else
											@if ($nationalityselect == true)
												{ targets: [ 13 ], data: "language", searchable: true }
											@else
												{ targets: [ 12 ], data: "language", searchable: true }
											@endif
										@endif
									@endif
								@else
									@if ($youthsummit == 1)
										@if ($sessionselect == true)
											@if ($nationalityselect == true)
												{ targets: [ 16 ], data: "language", searchable: true }
											@else
												{ targets: [ 15 ], data: "language", searchable: true }
											@endif
										@else
											@if ($nationalityselect == true)
												{ targets: [ 1 ], data: "language", searchable: true }
											@else
												{ targets: [ 14 ], data: "language", searchable: true }
											@endif
										@endif
									@else
										@if ($sessionselect == true)
											@if ($nationalityselect == true)
												{ targets: [ 13 ], data: "language", searchable: true }
											@else
												{ targets: [ 12 ], data: "language", searchable: true }
											@endif
										@else
											@if ($nationalityselect == true)
												{ targets: [ 12 ], data: "language", searchable: true }
											@else
												{ targets: [ 11 ], data: "language", searchable: true }
											@endif
										@endif
									@endif
								@endif
							@endif
					    ]
				    });

					@if ($viewattendance == 1)
						@if ($gakkaishq == 't')
							var oshqeventtrainingTable = $('#tshqeventtraining').DataTable({
								dom: 'Bflrtip',
								buttons: [ 'copy', 'excel', 'pdf' ],
								displayLength: 10, // Default No of Records per page on 1st load
								lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
								pagingType: "first_last_numbers",
								responsive: true,
								stateSave: true, // Remember paging & filters
								autoWidth: false,
								scrollCollapse: true,
								deferRender: true,
								processing: false,
								serverSide: false,
								searching: true,
								order: [[1, "asc"], [2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [0, "asc"]],
								ajax: 'getSHQEventTrainingStats/{{ $rid }}',
								columnDefs: [
									{ responsivePriority: 1, targets: 0 },
									{ responsivePriority: 2, targets: 3 },
									{ responsivePriority: 3, targets: -1 },
									{ responsivePriority: 4, targets: -2 },
									{ responsivePriority: 5, targets: -3 },
									{ responsivePriority: 6, targets: -4 },
									{ responsivePriority: 7, targets: -5 },
									{ targets: [ 0 ], data: "name", searchable: true },
									{ targets: [ 1 ], data: "rhq", searchable: true },
									{ targets: [ 2 ], data: "zone", searchable: true },
									{ targets: [ 3 ], data: "chapter", searchable: true },
									{ targets: [ 4 ], data: "district", searchable: true },
									{ targets: [ 5 ], data: "division", searchable: true },
									{ targets: [ 6 ], data: "position", searchable: true },
									{ targets: [ 7 ], data: "trg1", searchable: true },
									{ targets: [ 8 ], data: "trg2", searchable: true },
									{ targets: [ 9 ], data: "trg3", searchable: true },
									{ targets: [ 10 ], data: "trg4", searchable: true },
									{ targets: [ 11 ], data: "trg5", searchable: true },
									{ targets: [ 12 ], data: "trg6", searchable: true },
									{ targets: [ 13 ], data: "trg7", searchable: true },
									{ targets: [ 14 ], data: "trg8", searchable: true },
									{ targets: [ 15 ], data: "trg9", searchable: true },
									{ targets: [ 16 ], data: "trg10", searchable: true },
									{ targets: [ 17 ], data: "grandtotal", searchable: true }
								]
							});
						@endif
						@if ($gakkairegion == 't')
							var orhqeventtrainingTable = $('#trhqeventtraining').DataTable({
								dom: 'Bflrtip',
								buttons: [ 'copy', 'excel', 'pdf' ],
								displayLength: 10, // Default No of Records per page on 1st load
								lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
								pagingType: "first_last_numbers",
								responsive: true,
								stateSave: true, // Remember paging & filters
								autoWidth: false,
								scrollCollapse: true,
								deferRender: true,
								processing: false,
								serverSide: false,
								searching: true,
								order: [[1, "asc"], [2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [0, "asc"]],
								ajax: 'getRHQEventTrainingStats/{{ $rid }}',
								columnDefs: [
									{ responsivePriority: 1, targets: 0 },
									{ responsivePriority: 2, targets: 3 },
									{ responsivePriority: 3, targets: -1 },
									{ responsivePriority: 4, targets: -2 },
									{ responsivePriority: 5, targets: -3 },
									{ responsivePriority: 6, targets: -4 },
									{ responsivePriority: 7, targets: -5 },
									{ targets: [ 0 ], data: "name", searchable: true },
									{ targets: [ 1 ], data: "rhq", searchable: true },
									{ targets: [ 2 ], data: "zone", searchable: true },
									{ targets: [ 3 ], data: "chapter", searchable: true },
									{ targets: [ 4 ], data: "district", searchable: true },
									{ targets: [ 5 ], data: "division", searchable: true },
									{ targets: [ 6 ], data: "position", searchable: true },
									{ targets: [ 7 ], data: "trg1", searchable: true },
									{ targets: [ 8 ], data: "trg2", searchable: true },
									{ targets: [ 9 ], data: "trg3", searchable: true },
									{ targets: [ 10 ], data: "trg4", searchable: true },
									{ targets: [ 11 ], data: "trg5", searchable: true },
									{ targets: [ 12 ], data: "trg6", searchable: true },
									{ targets: [ 13 ], data: "trg7", searchable: true },
									{ targets: [ 14 ], data: "trg8", searchable: true },
									{ targets: [ 15 ], data: "trg9", searchable: true },
									{ targets: [ 16 ], data: "trg10", searchable: true },
									{ targets: [ 17 ], data: "grandtotal", searchable: true }
								]
							});
						@endif
						@if ($gakkaizone == 't')
							var ozoneeventtrainingTable = $('#tzoneeventtraining').DataTable({
								dom: 'Bflrtip',
								buttons: [ 'copy', 'excel', 'pdf' ],
								displayLength: 10, // Default No of Records per page on 1st load
								lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
								pagingType: "first_last_numbers",
								responsive: true,
								stateSave: true, // Remember paging & filters
								autoWidth: false,
								scrollCollapse: true,
								deferRender: true,
								processing: false,
								serverSide: false,
								searching: true,
								order: [[1, "asc"], [2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [0, "asc"]],
								ajax: 'getZoneEventTrainingStats/{{ $rid }}',
								columnDefs: [
									{ responsivePriority: 1, targets: 0 },
									{ responsivePriority: 2, targets: 3 },
									{ responsivePriority: 3, targets: -1 },
									{ responsivePriority: 4, targets: -2 },
									{ responsivePriority: 5, targets: -3 },
									{ responsivePriority: 6, targets: -4 },
									{ responsivePriority: 7, targets: -5 },
									{ targets: [ 0 ], data: "name", searchable: true },
									{ targets: [ 1 ], data: "rhq", searchable: true },
									{ targets: [ 2 ], data: "zone", searchable: true },
									{ targets: [ 3 ], data: "chapter", searchable: true },
									{ targets: [ 4 ], data: "district", searchable: true },
									{ targets: [ 5 ], data: "division", searchable: true },
									{ targets: [ 6 ], data: "position", searchable: true },
									{ targets: [ 7 ], data: "trg1", searchable: true },
									{ targets: [ 8 ], data: "trg2", searchable: true },
									{ targets: [ 9 ], data: "trg3", searchable: true },
									{ targets: [ 10 ], data: "trg4", searchable: true },
									{ targets: [ 11 ], data: "trg5", searchable: true },
									{ targets: [ 12 ], data: "trg6", searchable: true },
									{ targets: [ 13 ], data: "trg7", searchable: true },
									{ targets: [ 14 ], data: "trg8", searchable: true },
									{ targets: [ 15 ], data: "trg9", searchable: true },
									{ targets: [ 16 ], data: "trg10", searchable: true },
									{ targets: [ 17 ], data: "grandtotal", searchable: true }
								]
							});
						@endif
						@if ($gakkaichapter == 't')
							var ochaptereventtrainingTable = $('#tchaptereventtraining').DataTable({
								dom: 'Bflrtip',
								buttons: [ 'copy', 'excel', 'pdf' ],
								displayLength: 10, // Default No of Records per page on 1st load
								lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
								pagingType: "first_last_numbers",
								responsive: true,
								stateSave: true, // Remember paging & filters
								autoWidth: false,
								scrollCollapse: true,
								deferRender: true,
								processing: false,
								serverSide: false,
								searching: true,
								order: [[1, "asc"], [2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [0, "asc"]],
								ajax: 'getChapterEventTrainingStats/{{ $rid }}',
								columnDefs: [
									{ responsivePriority: 1, targets: 0 },
									{ responsivePriority: 2, targets: 3 },
									{ responsivePriority: 3, targets: -1 },
									{ responsivePriority: 4, targets: -2 },
									{ responsivePriority: 5, targets: -3 },
									{ responsivePriority: 6, targets: -4 },
									{ responsivePriority: 7, targets: -5 },
									{ targets: [ 0 ], data: "name", searchable: true },
									{ targets: [ 1 ], data: "rhq", searchable: true },
									{ targets: [ 2 ], data: "zone", searchable: true },
									{ targets: [ 3 ], data: "chapter", searchable: true },
									{ targets: [ 4 ], data: "district", searchable: true },
									{ targets: [ 5 ], data: "division", searchable: true },
									{ targets: [ 6 ], data: "position", searchable: true },
									{ targets: [ 7 ], data: "trg1", searchable: true },
									{ targets: [ 8 ], data: "trg2", searchable: true },
									{ targets: [ 9 ], data: "trg3", searchable: true },
									{ targets: [ 10 ], data: "trg4", searchable: true },
									{ targets: [ 11 ], data: "trg5", searchable: true },
									{ targets: [ 12 ], data: "trg6", searchable: true },
									{ targets: [ 13 ], data: "trg7", searchable: true },
									{ targets: [ 14 ], data: "trg8", searchable: true },
									{ targets: [ 15 ], data: "trg9", searchable: true },
									{ targets: [ 16 ], data: "trg10", searchable: true },
									{ targets: [ 17 ], data: "grandtotal", searchable: true }
								]
							});
						@endif
						@if ($gakkaidistrict == 't')
							var odistricteventtrainingTable = $('#tdistricteventtraining').DataTable({
								dom: 'Bflrtip',
								buttons: [ 'copy', 'excel', 'pdf' ],
								displayLength: 10, // Default No of Records per page on 1st load
								lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
								pagingType: "first_last_numbers",
								responsive: true,
								stateSave: true, // Remember paging & filters
								autoWidth: false,
								scrollCollapse: true,
								deferRender: true,
								processing: false,
								serverSide: false,
								searching: true,
								order: [[1, "asc"], [2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [0, "asc"]],
								ajax: 'getDistrictEventTrainingStats/{{ $rid }}',
								columnDefs: [
									{ responsivePriority: 1, targets: 0 },
									{ responsivePriority: 2, targets: 3 },
									{ responsivePriority: 3, targets: -1 },
									{ responsivePriority: 4, targets: -2 },
									{ responsivePriority: 5, targets: -3 },
									{ responsivePriority: 6, targets: -4 },
									{ responsivePriority: 7, targets: -5 },
									{ targets: [ 0 ], data: "name", searchable: true },
									{ targets: [ 1 ], data: "rhq", searchable: true },
									{ targets: [ 2 ], data: "zone", searchable: true },
									{ targets: [ 3 ], data: "chapter", searchable: true },
									{ targets: [ 4 ], data: "district", searchable: true },
									{ targets: [ 5 ], data: "division", searchable: true },
									{ targets: [ 6 ], data: "position", searchable: true },
									{ targets: [ 7 ], data: "trg1", searchable: true },
									{ targets: [ 8 ], data: "trg2", searchable: true },
									{ targets: [ 9 ], data: "trg3", searchable: true },
									{ targets: [ 10 ], data: "trg4", searchable: true },
									{ targets: [ 11 ], data: "trg5", searchable: true },
									{ targets: [ 12 ], data: "trg6", searchable: true },
									{ targets: [ 13 ], data: "trg7", searchable: true },
									{ targets: [ 14 ], data: "trg8", searchable: true },
									{ targets: [ 15 ], data: "trg9", searchable: true },
									{ targets: [ 16 ], data: "trg10", searchable: true },
									{ targets: [ 17 ], data: "grandtotal", searchable: true }
								]
							});
						@endif
					@endif
			    @else
			    	var oDistrictTable = $('#tspecial').DataTable({
						dom: 'Bfrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
				        displayLength: 10, // Default No of Records per page on 1st load
				        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        pagingType: "first_last_numbers",
				        responsive: true,
				        stateSave: true, // Remember paging & filters
				        autoWidth: false,
				        scrollCollapse: true,
				        processing: false,
				        serverSide: false,
				        searching: true,
				        deferRender: true,
				        order: [[2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [7, "asc"], [0, "asc"]],
				        ajax: 'getEventParticipant/{{ $rid }}',
				        columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: -1 },
							{ responsivePriority: 3, targets: -2 },
							{ responsivePriority: 4, targets: -3 },
							{ responsivePriority: 5, targets: -4 },
				        	{ targets: [ 0 ], data: "name", searchable: true },
			            	{ targets: [ 1 ], data: "chinesename", searchable: true },
			            	{ targets: [ 2 ], data: "rhq", searchable: true },
			            	{ targets: [ 3 ], data: "zone", searchable: true },
			            	{ targets: [ 4 ], data: "chapter", searchable: true },
			            	{ targets: [ 5 ], data: "district", searchable: true },
					    	{ targets: [ 6 ], data: "division", searchable: true },
					    	{ targets: [ 7 ], data: "position", searchable: true },
					    	{
						    	targets: [ 8 ], data: "check1",
						    	render: function ( data, type, full ){
								    if (data === 0){
								    	return '<button type="submit" onClick=check1yesrow("'+ data +'") class="btn btn-xs btn-danger">No</button>';
								    }
								  	else if (data === 1){
								    	return '<button type="submit" onClick=check1norow("'+ data +'") class="btn btn-xs btn-success">Yes</button>';
								    }
					    		}
				    		},
					    	{
						    	targets: [ 9 ], data: "check3",
						    	render: function ( data, type, full ){
								    if (data === 0){
								    	return '<button type="submit" onClick=check3yesrow("'+ data +'") class="btn btn-xs btn-danger">No</i></button>';
								    }
								  	else if (data === 1){
								    	return '<button type="submit" onClick=check3norow("'+ data +'") class="btn btn-xs btn-success">Yes</button>';
								    }
					    		}
				    		},
					    	{
						    	targets: [ 10 ], data: "uniquecode",
						    	render: function ( data, type, full ){
						    		return '<button type="submit" onClick=editrow("'+ data +'") class="btn btn-xs btn-info">Homevisit</button>'
							    }
					    	}
					    ]
				    });

				    var oRhqStatsTable = $('#tspecialrhqstats').DataTable({
				        displayLength: 10, // Default No of Records per page on 1st load
				        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        pagingType: "numbers",
				        responsive: false,
				        stateSave: true, // Remember paging & filters
				        autoWidth: false,
				        scrollCollapse: true,
				        processing: false,
				        serverSide: false,
				        deferRender: true,
				        searching: false,
				        order: [[0, "asc"]],
				        ajax: 'getSpecialRHQStats/{{ $rid }}',
				        columnDefs: [
				        	{ targets: [ 0 ], data: "rhq", searchable: true },
			            	{ targets: [ 1 ], data: "Tried", searchable: true },
			            	{ targets: [ 2 ], data: "Attending", searchable: true }
					    ]
				    });

				    var oZoneStatsTable = $('#tspecialzonestats').DataTable({
				        displayLength: 10, // Default No of Records per page on 1st load
				        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        pagingType: "numbers",
				        responsive: false,
				        stateSave: true, // Remember paging & filters
				        autoWidth: false,
				        scrollCollapse: true,
				        processing: false,
				        serverSide: false,
				        deferRender: true,
				        searching: true,
				        order: [[0, "asc"]],
				        ajax: 'getSpecialZoneStats/{{ $rid }}',
				        columnDefs: [
				        	{ targets: [ 0 ], data: "rhq", searchable: true },
				        	{ targets: [ 1 ], data: "zone", searchable: true },
			            	{ targets: [ 2 ], data: "Tried", searchable: true },
			            	{ targets: [ 3 ], data: "Attending", searchable: true }
					    ]
				    });

				    var oChapterStatsTable = $('#tspecialchapterstats').DataTable({
				        displayLength: 10, // Default No of Records per page on 1st load
				        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        pagingType: "first_last_numbers",
				        responsive: false,
				        stateSave: true, // Remember paging & filters
				        autoWidth: false,
				        scrollCollapse: true,
				        processing: false,
				        serverSide: false,
				        deferRender: true,
				        searching: true,
				        order: [[0, "asc"]],
				        ajax: 'getSpecialChapterStats/{{ $rid }}',
				        columnDefs: [
				        	{ targets: [ 0 ], data: "rhq", searchable: true },
				        	{ targets: [ 1 ], data: "zone", searchable: true },
				        	{ targets: [ 2 ], data: "chapter", searchable: true },
			            	{ targets: [ 3 ], data: "Tried", searchable: true },
			            	{ targets: [ 4 ], data: "Attending", searchable: true }
					    ]
				    });

				    var oDistrictStatsTable = $('#tspecialdistrictstats').DataTable({
				        displayLength: 10, // Default No of Records per page on 1st load
				        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        pagingType: "first_last_numbers",
				        responsive: false,
				        stateSave: true, // Remember paging & filters
				        autoWidth: false,
				        scrollCollapse: true,
				        processing: false,
				        serverSide: false,
				        deferRender: true,
				        searching: true,
				        order: [[0, "asc"]],
				        ajax: 'getSpecialDistrictStats/{{ $rid }}',
				        columnDefs: [
				        	{ targets: [ 0 ], data: "chapter", searchable: true },
				        	{ targets: [ 1 ], data: "district", searchable: true },
			            	{ targets: [ 2 ], data: "Tried", searchable: true },
			            	{ targets: [ 3 ], data: "Attending", searchable: true }
					    ]
				    });
			    @endif

				@if ($gakkaishq == 't')
					var oroledivisionrhqstats = $('#troledivisionrhqstats').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						deferRender: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[0, "asc"]],
						ajax: 'getRoleDivisionRHQStats/{{ $rid }}',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: -1 },
							{ responsivePriority: 4, targets: 2 },
							{ responsivePriority: 5, targets: 3 },
							{ responsivePriority: 6, targets: 4 },
							{ responsivePriority: 7, targets: 5 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "MD", searchable: true },
							{ targets: [ 2 ], data: "WD", searchable: true },
							{ targets: [ 3 ], data: "YMD", searchable: true },
							{ targets: [ 4 ], data: "YWD", searchable: true },
							{ targets: [ 5 ], data: "PD", searchable: true },
							{ targets: [ 6 ], data: "YC", searchable: true },
							{ targets: [ 7 ], data: "Others", searchable: true },
							{ targets: [ 8 ], data: "Total", searchable: true }
						],
						footerCallback: function (row, data, start, end, display) {
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
		                    $('#troledivisionrhqstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
					});

					var ostatusdivisionrhqstats = $('#tstatusdivisionrhqstats').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						deferRender: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[0, "asc"]],
						ajax: 'getStatusDivisionRHQStats/{{ $rid }}',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: -1 },
							{ responsivePriority: 4, targets: 2 },
							{ responsivePriority: 5, targets: 3 },
							{ responsivePriority: 6, targets: 4 },
							{ responsivePriority: 7, targets: 5 },
							{ targets: [ 0 ], data: "status", searchable: true },
							{ targets: [ 1 ], data: "MD", searchable: true },
							{ targets: [ 2 ], data: "WD", searchable: true },
							{ targets: [ 3 ], data: "YMD", searchable: true },
							{ targets: [ 4 ], data: "YWD", searchable: true },
							{ targets: [ 5 ], data: "PD", searchable: true },
							{ targets: [ 6 ], data: "YC", searchable: true },
							{ targets: [ 7 ], data: "Others", searchable: true },
							{ targets: [ 8 ], data: "Total", searchable: true }
						],
						footerCallback: function (row, data, start, end, display) {
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
		                    $('#tstatusdivisionrhqstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
					});
				@endif

				@if ($gakkairegion == 't' or $gakkaishq == 't')
					var oroledivisionzonestats = $('#troledivisionzonestats').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						deferRender: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[0, "asc"], [1, "asc"]],
						ajax: 'getRoleDivisionZoneStats/{{ $rid }}',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: -1 },
							{ responsivePriority: 4, targets: 2 },
							{ responsivePriority: 5, targets: 3 },
							{ responsivePriority: 6, targets: 4 },
							{ responsivePriority: 7, targets: 5 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "zone", searchable: true },
							{ targets: [ 2 ], data: "MD", searchable: true },
							{ targets: [ 3 ], data: "WD", searchable: true },
							{ targets: [ 4 ], data: "YMD", searchable: true },
							{ targets: [ 5 ], data: "YWD", searchable: true },
							{ targets: [ 6 ], data: "PD", searchable: true },
							{ targets: [ 7 ], data: "YC", searchable: true },
							{ targets: [ 8 ], data: "Others", searchable: true },
							{ targets: [ 9 ], data: "Total", searchable: true }
						],
						footerCallback: function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#troledivisionzonestatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
					});

					var ostatusdivisionzonestats = $('#tstatusdivisionzonestats').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						deferRender: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[0, "asc"], [1, "asc"]],
						ajax: 'getStatusDivisionZoneStats/{{ $rid }}',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: -1 },
							{ responsivePriority: 4, targets: 2 },
							{ responsivePriority: 5, targets: 3 },
							{ responsivePriority: 6, targets: 4 },
							{ responsivePriority: 7, targets: 5 },
							{ targets: [ 0 ], data: "status", searchable: true },
							{ targets: [ 1 ], data: "zone", searchable: true },
							{ targets: [ 2 ], data: "MD", searchable: true },
							{ targets: [ 3 ], data: "WD", searchable: true },
							{ targets: [ 4 ], data: "YMD", searchable: true },
							{ targets: [ 5 ], data: "YWD", searchable: true },
							{ targets: [ 6 ], data: "PD", searchable: true },
							{ targets: [ 7 ], data: "YC", searchable: true },
							{ targets: [ 8 ], data: "Others", searchable: true },
							{ targets: [ 9 ], data: "Total", searchable: true }
						],
						footerCallback: function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tstatusdivisionzonestatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
					});
				@endif

				@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
					var oroledivisionchapterstats = $('#troledivisionchapterstats').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						deferRender: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[0, "asc"], [1, "asc"], [2, "asc"]],
						ajax: 'getRoleDivisionChapterStats/{{ $rid }}',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: -1 },
							{ responsivePriority: 4, targets: 2 },
							{ responsivePriority: 5, targets: 3 },
							{ responsivePriority: 6, targets: 4 },
							{ responsivePriority: 7, targets: 5 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "zone", searchable: true },
							{ targets: [ 2 ], data: "chapter", searchable: true },
							{ targets: [ 3 ], data: "MD", searchable: true },
							{ targets: [ 4 ], data: "WD", searchable: true },
							{ targets: [ 5 ], data: "YMD", searchable: true },
							{ targets: [ 6 ], data: "YWD", searchable: true },
							{ targets: [ 7 ], data: "PD", searchable: true },
							{ targets: [ 8 ], data: "YC", searchable: true },
							{ targets: [ 9 ], data: "Others", searchable: true },
							{ targets: [ 10 ], data: "Total", searchable: true }
						],
						footerCallback: function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#troledivisionchapterstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
					});

					var ostatusdivisionchapterstats = $('#tstatusdivisionchapterstats').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						deferRender: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[0, "asc"], [1, "asc"], [2, "asc"]],
						ajax: 'getStatusDivisionChapterStats/{{ $rid }}',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: -1 },
							{ responsivePriority: 4, targets: 2 },
							{ responsivePriority: 5, targets: 3 },
							{ responsivePriority: 6, targets: 4 },
							{ responsivePriority: 7, targets: 5 },
							{ targets: [ 0 ], data: "status", searchable: true },
							{ targets: [ 1 ], data: "zone", searchable: true },
							{ targets: [ 2 ], data: "chapter", searchable: true },
							{ targets: [ 3 ], data: "MD", searchable: true },
							{ targets: [ 4 ], data: "WD", searchable: true },
							{ targets: [ 5 ], data: "YMD", searchable: true },
							{ targets: [ 6 ], data: "YWD", searchable: true },
							{ targets: [ 7 ], data: "PD", searchable: true },
							{ targets: [ 8 ], data: "YC", searchable: true },
							{ targets: [ 9 ], data: "Others", searchable: true },
							{ targets: [ 10 ], data: "Total", searchable: true }
						],
						footerCallback: function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tstatusdivisionchapterstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
					});
				@endif

				@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaichapter == 't')
					var oroledivisiondistrictstats = $('#troledivisiondistrictstats').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						deferRender: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[0, "asc"], [1, "asc"], [2, "asc"], [3, "asc"]],
						ajax: 'getRoleDivisionDistrictStats/{{ $rid }}',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: -1 },
							{ responsivePriority: 4, targets: 2 },
							{ responsivePriority: 5, targets: 3 },
							{ responsivePriority: 6, targets: 4 },
							{ responsivePriority: 7, targets: 5 },
							{ targets: [ 0 ], data: "rhq", searchable: true },
							{ targets: [ 1 ], data: "zone", searchable: true },
							{ targets: [ 2 ], data: "chapter", searchable: true },
							{ targets: [ 3 ], data: "district", searchable: true },
							{ targets: [ 4 ], data: "MD", searchable: true },
							{ targets: [ 5 ], data: "WD", searchable: true },
							{ targets: [ 6 ], data: "YMD", searchable: true },
							{ targets: [ 7 ], data: "YWD", searchable: true },
							{ targets: [ 8 ], data: "PD", searchable: true },
							{ targets: [ 9 ], data: "YC", searchable: true },
							{ targets: [ 10 ], data: "Others", searchable: true },
							{ targets: [ 11 ], data: "Total", searchable: true }
						],
						footerCallback: function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#troledivisiondistrictstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
					});

					var ostatusdivisiondistrictstats = $('#tstatusdivisiondistrictstats').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						deferRender: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[0, "asc"], [1, "asc"], [2, "asc"], [3, "asc"]],
						ajax: 'getStatusDivisionDistrictStats/{{ $rid }}',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ responsivePriority: 2, targets: 1 },
							{ responsivePriority: 3, targets: -1 },
							{ responsivePriority: 4, targets: 2 },
							{ responsivePriority: 5, targets: 3 },
							{ responsivePriority: 6, targets: 4 },
							{ responsivePriority: 7, targets: 5 },
							{ targets: [ 0 ], data: "status", searchable: true },
							{ targets: [ 1 ], data: "zone", searchable: true },
							{ targets: [ 2 ], data: "chapter", searchable: true },
							{ targets: [ 3 ], data: "district", searchable: true },
							{ targets: [ 4 ], data: "MD", searchable: true },
							{ targets: [ 5 ], data: "WD", searchable: true },
							{ targets: [ 6 ], data: "YMD", searchable: true },
							{ targets: [ 7 ], data: "YWD", searchable: true },
							{ targets: [ 8 ], data: "PD", searchable: true },
							{ targets: [ 9 ], data: "YC", searchable: true },
							{ targets: [ 10 ], data: "Others", searchable: true },
							{ targets: [ 11 ], data: "Total", searchable: true }
						],
						footerCallback: function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tstatusdivisiondistrictstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
					});
				@endif

				@if ($rsvpeventtype == true)
					@if ($gakkaishq == 't')
						var orsvpshowrhqstats = $('#trsvpshowrhqstats').DataTable({
							dom: 'Bflrtip',
							buttons: [ 'copy', 'excel', 'pdf' ],
							displayLength: 10, // Default No of Records per page on 1st load
							lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
							pagingType: "first_last_numbers",
							responsive: true,
							stateSave: true, // Remember paging & filters
							autoWidth: false,
							scrollCollapse: true,
							deferRender: true,
							processing: false,
							serverSide: false,
							searching: true,
							order: [[0, "asc"], [1, "asc"]],
							ajax: 'getRSVPShowRHQStats/{{ $rid }}',
							columnDefs: [
								{ responsivePriority: 1, targets: -1 },
								{ responsivePriority: 2, targets: 0 },
								{ responsivePriority: 3, targets: 1 },
								{ targets: [ 0 ], data: "rhq", searchable: true },
								{ targets: [ 1 ], data: "show", searchable: true },
								{ targets: [ 2 ], data: "Processing", searchable: true },
								{ targets: [ 3 ], data: "Accepted", searchable: true },
								{ targets: [ 4 ], data: "total", searchable: true }
							],
							footerCallback: function (row, data, start, end, display) {
							var api = this.api(), data

							// Remove the formatting to get integer data for summation
							var intVal = function ( i ) {
								return typeof i === 'string' ?
									i.replace(/[\$,]/g, '')*1 :
									typeof i === 'number' ?
										i : 0;
							};
							columns = [2, 3, 4]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trsvpshowrhqstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
						});
					@endif

					@if ($gakkairegion == 't' or $gakkaishq == 't')
						var orsvpshowzonestats = $('#trsvpshowzonestats').DataTable({
							dom: 'Bflrtip',
							buttons: [ 'copy', 'excel', 'pdf' ],
							displayLength: 10, // Default No of Records per page on 1st load
							lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
							pagingType: "first_last_numbers",
							responsive: true,
							stateSave: true, // Remember paging & filters
							autoWidth: false,
							scrollCollapse: true,
							deferRender: true,
							processing: false,
							serverSide: false,
							searching: true,
							order: [[0, "asc"], [1, "asc"], [2, "asc"]],
							ajax: 'getRSVPShowZoneStats/{{ $rid }}',
							columnDefs: [
								{ responsivePriority: 1, targets: -1 },
								{ responsivePriority: 2, targets: 0 },
								{ responsivePriority: 3, targets: 1 },
								{ responsivePriority: 4, targets: -2 },
								{ responsivePriority: 5, targets: -3 },
								{ targets: [ 0 ], data: "rhq", searchable: true },
								{ targets: [ 1 ], data: "zone", searchable: true },
								{ targets: [ 2 ], data: "show", searchable: true },
								{ targets: [ 3 ], data: "Processing", searchable: true },
								{ targets: [ 4 ], data: "Accepted", searchable: true },
								{ targets: [ 5 ], data: "total", searchable: true }
							],
							footerCallback: function (row, data, start, end, display) {
							var api = this.api(), data

							// Remove the formatting to get integer data for summation
							var intVal = function ( i ) {
								return typeof i === 'string' ?
									i.replace(/[\$,]/g, '')*1 :
									typeof i === 'number' ?
										i : 0;
							};
							columns = [3, 4, 5]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trsvpshowzonestatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
						});
					@endif

					@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
						var orsvpshowchapterstats = $('#trsvpshowchapterstats').DataTable({
							dom: 'Bflrtip',
							buttons: [ 'copy', 'excel', 'pdf' ],
							displayLength: 10, // Default No of Records per page on 1st load
							lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
							pagingType: "first_last_numbers",
							responsive: true,
							stateSave: true, // Remember paging & filters
							autoWidth: false,
							scrollCollapse: true,
							deferRender: true,
							processing: false,
							serverSide: false,
							searching: true,
							order: [[0, "asc"], [1, "asc"], [2, "asc"], [3, "asc"]],
							ajax: 'getRSVPShowChapterStats/{{ $rid }}',
							columnDefs: [
								{ responsivePriority: 1, targets: -1 },
								{ responsivePriority: 2, targets: 0 },
								{ responsivePriority: 3, targets: -2 },
								{ responsivePriority: 4, targets: -3 },
								{ responsivePriority: 5, targets: 2 },
								{ responsivePriority: 6, targets: 3 },
								{ targets: [ 0 ], data: "rhq", searchable: true },
								{ targets: [ 1 ], data: "zone", searchable: true },
								{ targets: [ 2 ], data: "chapter", searchable: true },
								{ targets: [ 3 ], data: "show", searchable: true },
								{ targets: [ 4 ], data: "Processing", searchable: true },
								{ targets: [ 5 ], data: "Accepted", searchable: true },
								{ targets: [ 6 ], data: "total", searchable: true }
							],
							footerCallback: function (row, data, start, end, display) {
							var api = this.api(), data

							// Remove the formatting to get integer data for summation
							var intVal = function ( i ) {
								return typeof i === 'string' ?
									i.replace(/[\$,]/g, '')*1 :
									typeof i === 'number' ?
										i : 0;
							};
							columns = [4, 5, 6]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trsvpshowchapterstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
						});
					@endif

					@if ($gakkaizone == 't' or $gakkairegion == 't' or $gakkaichapter == 't')
						var orsvpshowdistrictstats = $('#trsvpshowdistrictstats').DataTable({
							dom: 'Bflrtip',
							buttons: [ 'copy', 'excel', 'pdf' ],
							displayLength: 10, // Default No of Records per page on 1st load
							lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
							pagingType: "first_last_numbers",
							responsive: true,
							stateSave: true, // Remember paging & filters
							autoWidth: false,
							scrollCollapse: true,
							deferRender: true,
							processing: false,
							serverSide: false,
							searching: true,
							order: [[0, "asc"], [1, "asc"], [2, "asc"], [3, "asc"], [4, "asc"]],
							ajax: 'getRSVPShowDistrictStats/{{ $rid }}',
							columnDefs: [
								{ responsivePriority: 1, targets: -1 },
								{ responsivePriority: 2, targets: 0 },
								{ responsivePriority: 3, targets: -2 },
								{ responsivePriority: 4, targets: -3 },
								{ responsivePriority: 5, targets: 4 },
								{ responsivePriority: 6, targets: 2 },
								{ responsivePriority: 7, targets: 3 },
								{ targets: [ 0 ], data: "rhq", searchable: true },
								{ targets: [ 1 ], data: "zone", searchable: true },
								{ targets: [ 2 ], data: "chapter", searchable: true },
								{ targets: [ 3 ], data: "district", searchable: true },
								{ targets: [ 4 ], data: "show", searchable: true },
								{ targets: [ 5 ], data: "Processing", searchable: true },
								{ targets: [ 6 ], data: "Accepted", searchable: true },
								{ targets: [ 7 ], data: "total", searchable: true }
							],
							footerCallback: function (row, data, start, end, display) {
							var api = this.api(), data

							// Remove the formatting to get integer data for summation
							var intVal = function ( i ) {
								return typeof i === 'string' ?
									i.replace(/[\$,]/g, '')*1 :
									typeof i === 'number' ?
										i : 0;
							};
							columns = [5, 6, 7]; // Add columns here

							for (var i = 0; i < columns.length; i++) {
								$('#trsvpshowdistrictstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
							}
						}
						});
					@endif
				@endif

				@if ($sessionsizelimit == 1)
					var otsessiontotalstats = $('#tsessiontotalstats').DataTable({
						dom: 'Bflrtip',
						buttons: [ 'copy', 'excel', 'pdf' ],
						displayLength: 10, // Default No of Records per page on 1st load
						lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
						pagingType: "first_last_numbers",
						responsive: true,
						stateSave: true, // Remember paging & filters
						autoWidth: false,
						scrollCollapse: true,
						deferRender: true,
						processing: false,
						serverSide: false,
						searching: true,
						order: [[0, "asc"]],
						ajax: 'getSessionTotalStats/{{ $rid }}',
						columnDefs: [
							{ responsivePriority: 1, targets: 0 },
							{ targets: [ 0 ], data: "value", searchable: true },
							{ targets: [ 1 ], data: "sizelimit", searchable: true },
							{ targets: [ 2 ], data: "total", searchable: true },
							{ targets: [ 3 ], data: "reminder", searchable: true }
						],
						footerCallback: function (row, data, start, end, display) {
						var api = this.api(), data

						// Remove the formatting to get integer data for summation
						var intVal = function ( i ) {
							return typeof i === 'string' ?
								i.replace(/[\$,]/g, '')*1 :
								typeof i === 'number' ?
									i : 0;
						};
						columns = [2, 3]; // Add columns here

						for (var i = 0; i < columns.length; i++) {
							$('#tsessiontotalstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
						}
					}
					});
				@endif
				
				@if ($gakkaidistrict == 't' or $gakkaichapter == 't' or $gakkaizone == 't' or $gakkairegion == 't' or $gakkaishq == 't')
					@if ($eventtype == FALSE)
						@if ($readonly == 0)
							@if ($youthsummittickets == 0)
								var oMembership = $('#tmembership').DataTable({
									dom: 'Bflrtip',
									buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
									paging: true,
									responsive: false,
									processing: false,
									stateSave: true, // Remember paging & filters
									autoWidth: false,
									scrollCollapse: true,
									@if ($gakkaishq == 't')
										serverSide: true,
									@else
										serverSide: false,
									@endif
									deferRender: true,
									searching: true,
									order: [[2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [0, "asc"]],
									@if ($gakkaishq == 't')
										"ajax": $.fn.dataTable.pipeline({
											url: 'getMembershipSHQ/{{ $rid }}',
											pages: 5 // number of pages to cache
										}),
									@else
										ajax: 'getMembership/{{ $rid }}',
									@endif
									columnDefs: [
										{ targets: [ 0 ], data: "name", searchable: true },
										{ targets: [ 1 ], data: "chinesename", searchable: true },
										{ targets: [ 2 ], data: "chapter", searchable: true },
										{ targets: [ 3 ], data: "district", searchable: true },
										{ targets: [ 4 ], data: "division", searchable: true },
										{ targets: [ 5 ], data: "position", searchable: true },
										{
											targets: [ 6 ], data: "uniquecode",
											render: function ( data, type, full ){
												return '<button type="submit" onClick=insertrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-thumbs-up bigger-120"></i></button>'
											}
										}
									]
								});
							@else
								var oYSParticipants = $('#tysparticipants').DataTable({
									paging: true,
									responsive: true,
									processing: false,
									stateSave: true, // Remember paging & filters
									autoWidth: false,
									scrollCollapse: true,
									serverSide: false,
									deferRender: true,
									searching: true,
									order: [[2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [0, "asc"]],
									ajax: 'getYSParticipants/{{ $rid }}',
									columnDefs: [
										{ responsivePriority: 1, targets: 0 },
										{ responsivePriority: 2, targets: -1 },
										{ responsivePriority: 3, targets: 3 },
										{ responsivePriority: 4, targets: 5 },
										{ responsivePriority: 5, targets: 2 },
										{ responsivePriority: 6, targets: 6 },
										{ targets: [ 0 ], data: "name", searchable: true },
										{ targets: [ 1 ], data: "chinesename", searchable: true },
										{ targets: [ 2 ], data: "zone", searchable: true },
										{ targets: [ 3 ], data: "chapter", searchable: true },
										{ targets: [ 4 ], data: "district", searchable: true },
										{ targets: [ 5 ], data: "division", searchable: true },
										{ targets: [ 6 ], data: "position", searchable: true },
										{
											targets: [ 7 ], data: "uniquecode",
											render: function ( data, type, full ){
												return '<button type="submit" onClick=ysparticipantsrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-thumbs-up bigger-120"></i></button>'
											}
										}
									]
								});

								var oYSYonsha = $('#tysyonsha').DataTable({
									paging: true,
									responsive: true,
									processing: false,
									stateSave: true, // Remember paging & filters
									autoWidth: false,
									scrollCollapse: true,
									serverSide: false,
									deferRender: true,
									searching: true,
									order: [[2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [0, "asc"]],
									ajax: 'getYSYonsha/{{ $rid }}',
									columnDefs: [
										{ responsivePriority: 1, targets: 0 },
										{ responsivePriority: 2, targets: -1 },
										{ responsivePriority: 3, targets: 3 },
										{ responsivePriority: 4, targets: 5 },
										{ responsivePriority: 5, targets: 2 },
										{ responsivePriority: 6, targets: 6 },
										{ targets: [ 0 ], data: "name", searchable: true },
										{ targets: [ 1 ], data: "chinesename", searchable: true },
										{ targets: [ 2 ], data: "zone", searchable: true },
										{ targets: [ 3 ], data: "chapter", searchable: true },
										{ targets: [ 4 ], data: "district", searchable: true },
										{ targets: [ 5 ], data: "division", searchable: true },
										{ targets: [ 6 ], data: "position", searchable: true },
										{
											targets: [ 7 ], data: "uniquecode",
											render: function ( data, type, full ){
												return '<button type="submit" onClick=ysyonsharow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-thumbs-up bigger-120"></i></button>'
											}
										}
									]
								});

								var oYSYonsha = $('#tysyouth').DataTable({
									paging: true,
									responsive: true,
									processing: false,
									stateSave: true, // Remember paging & filters
									autoWidth: false,
									scrollCollapse: true,
									serverSide: false,
									deferRender: true,
									searching: true,
									order: [[2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [0, "asc"]],
									ajax: 'getYSYouth/{{ $rid }}',
									columnDefs: [
										{ responsivePriority: 1, targets: 0 },
										{ responsivePriority: 2, targets: -1 },
										{ responsivePriority: 3, targets: 3 },
										{ responsivePriority: 4, targets: 5 },
										{ responsivePriority: 5, targets: 2 },
										{ responsivePriority: 6, targets: 6 },
										{ targets: [ 0 ], data: "name", searchable: true },
										{ targets: [ 1 ], data: "chinesename", searchable: true },
										{ targets: [ 2 ], data: "zone", searchable: true },
										{ targets: [ 3 ], data: "chapter", searchable: true },
										{ targets: [ 4 ], data: "district", searchable: true },
										{ targets: [ 5 ], data: "division", searchable: true },
										{ targets: [ 6 ], data: "position", searchable: true },
										{
											targets: [ 7 ], data: "uniquecode",
											render: function ( data, type, full ){
												return '<button type="submit" onClick=ysyouthrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-thumbs-up bigger-120"></i></button>'
											}
										}
									]
								});
							@endif
						@endif
				    @else
						@if ($readonly == 0)
							var oMembership = $('#tpremad').DataTable({
								dom: 'Bflrtip',
								buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
								paging: true,
								responsive: false,
								stateSave: true, // Remember paging & filters
								autoWidth: false,
								scrollCollapse: true,
								processing: false,
								deferRender: true,
								serverSide: false,
								searching: true,
								order: [[2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [0, "asc"]],
								ajax: 'getMADMembership/{{ $rid }}',
								columnDefs: [
									{ targets: [ 0 ], data: "name", searchable: true },
									{ targets: [ 1 ], data: "chinesename", searchable: true },
									{ targets: [ 2 ], data: "chapter", searchable: true },
									{ targets: [ 3 ], data: "district", searchable: true },
									{ targets: [ 4 ], data: "division", searchable: true },
									{ targets: [ 5 ], data: "position", searchable: true },
									{
										targets: [ 6 ], data: "uniquecode",
										render: function ( data, type, full ){
											return '<button type="submit" onClick=insertrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-thumbs-up bigger-120"></i></button>'
										}
									}
								]
							});
						@endif
				    @endif
				@endif // tmembership

				$('#esession').change(function(){
	        		$('#eRegisteredSession').val($('#esession').val());
	        	});

				$('#cbrhq').change(function(){
	        		$.ajax({
	        			url: '../BOEPortalEvent/getZone/' + $('#cbrhq').val(),
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
	        			url: '../BOEPortalEvent/getChapter/' + $('#cbzone').val(),
	        			type: 'get',
	        			dataType: 'html',
	        			statusCode: { 
	        				200:function(data){
	        					$('#chapterdiv').html(data);
	        				}
	        			}
	        		});
	        	});

				@if ($youthsummittickets == 1)
					$('#yspcbrhq').change(function(){
						$.ajax({
							url: '../BOEPortalEvent/getZoneysp/' + $('#yspcbrhq').val(),
							type: 'get',
							dataType: 'html',
							statusCode: { 
								200:function(data){
									$('#yspzonediv').html(data);
									$('#yspcbchapter').val('');
								}
							}
						});
					});

					$("body").delegate('#yspcbzone','change',function(){
						$.ajax({
							url: '../BOEPortalEvent/getChapterysp/' + $('#yspcbzone').val(),
							type: 'get',
							dataType: 'html',
							statusCode: { 
								200:function(data){
									$('#yspchapterdiv').html(data);
								}
							}
						});
					});

					$('#ysycbrhq').change(function(){
						$.ajax({
							url: '../BOEPortalEvent/getZoneysy/' + $('#ysycbrhq').val(),
							type: 'get',
							dataType: 'html',
							statusCode: { 
								200:function(data){
									$('#ysyzonediv').html(data);
									$('#ysycbchapter').val('');
								}
							}
						});
					});

					$("body").delegate('#ysycbzone','change',function(){
						$.ajax({
							url: '../BOEPortalEvent/getChapterysy/' + $('#ysycbzone').val(),
							type: 'get',
							dataType: 'html',
							statusCode: { 
								200:function(data){
									$('#ysychapterdiv').html(data);
								}
							}
						});
					});	

					$('#ysacbrhq').change(function(){
						$.ajax({
							url: '../BOEPortalEvent/getZoneysa/' + $('#ysacbrhq').val(),
							type: 'get',
							dataType: 'html',
							statusCode: { 
								200:function(data){
									$('#ysazonediv').html(data);
									$('#ysacbchapter').val('');
								}
							}
						});
					});

					$("body").delegate('#ysacbzone','change',function(){
						$.ajax({
							url: '../BOEPortalEvent/getChapterysa/' + $('#ysacbzone').val(),
							type: 'get',
							dataType: 'html',
							statusCode: { 
								200:function(data){
									$('#ysachapterdiv').html(data);
								}
							}
						});
					});				
				@endif
			});

			$('#resourcedelete').click(function(e){
				noty({
					layout: 'center', type: 'confirm', text: 'Do you want to delete record? Once delete, this record will not be able to retrieve in this discussion meeting',
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
						        url: 'deleteAttendee/' + $("#euniquecode").val(),
						        type: 'POST',
						        data: { uniquecode: $("#euniquecode").val() },
						        dataType: 'json',
						        statusCode: { 
						        	200:function(){
						        		var oDistrictTable = $('#tdistrict').DataTable();
					        			oDistrictTable.ajax.reload(null, false);

					    				$("#ename").val(''); $("#edivision").val(''); $("#ecname").val(''); $("#emobile").val('');
					        			$("#eintroducer").val(''); $("#eremarks").val('');

						        		$("#btnresourceedit").modal('hide');

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

		    $('#resourceaddothers').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					name: { required: true, minlength: 3 },
					cbrhq: { required: true },
					cbzone: { required: true },
					cbchapter: { required: true },
					position: { required: true },
					division: { required: true },
					country: { required: true },
					session: { required: true },
					language: { required: true }
				},
				messages: { },
				invalidHandler: function (event, validator) { ('.alert-danger', $('.resourceaddothers')).show(); },
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

			$('#resourceaddothers').submit(function(e){
				if(!$('#resourceaddothers').valid()) return false;
				else
				{
					$.ajax({
				        url: 'postEventParticipantOthers/{{ $rid }}',
				        type: 'POST',
				        data: { name: $("#name").val(), cname: $("#cname").val(), mobile: $("#mobile").val(), position: $("#position").val(), division: $("#division").val(), rhq: $("#cbrhq").val(), zone: $("#cbzone").val(), chapter: $("#cbchapter").val(), district: $("#district").val(), id: "{{ $rid }}", introducer: $("#introducer").val(), language: $("#language").val(), country: $("#country").val(), session: $("#session").val(), dateofbirthtxt: $("#dateofbirthtxt").val(), remarks: $("#remarks").val(), uniquecode: $("#uniquecode").val()},
				        dataType: 'json',
				        statusCode: { 
				        	200:function(){
				        		var oDistrictTable = $('#tdistrict').DataTable();
		    					oDistrictTable.ajax.reload(null, false);

			    				$("#name").val(''); $("#position").val(''); $("#division").val(''); $("#cname").val(''); $("#mobile").val(''); $("#session").val('');
			        			$("#introducer").val(''); $("#remarks").val(''); $("#language").val('Chinese'); $("#country").val('Singapore'); $("#dateofbirthtxt").val('')

				        		$("#btnresourceaddothers").modal('hide');
		            			noty({
									layout: 'topRight', type: 'success', text: 'Record Created!!',
									animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
										},
									timeout: 4000
								});
				        	},
				        	400:function(data){ 
				        		var txtMessage;
				        		if (data.responseJSON.info == "Duplicate") 
				        			{ txtMessage = 'Record already existed!'; }
				        		else if (data.responseJSON.info == "Failed")
				        			{ txtMessage = 'Please check your entry!'; }
								else if (data.responseJSON.info == "Full Capacity")
				        			{ txtMessage = 'The session is Full!  Please select another session'; }
								else if (data.responseJSON.ErrType == "Unknown")
				        			{ txtMessage = 'Unknown Error! Please check your entry'; }
				        		else { txtMessage = 'Please check your entry!!'; }
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
				}
			    e.preventDefault();
		    });
		    
			@if ($special == 1)
			    $('#resourceupdate').submit(function(e){
			    	noty({
						layout: 'topRight', type: 'warning', text: 'Updating Record ...',
						animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
						timeout: 4000
					});
					$.ajax({
				        url: 'putEventAddInfo/' + $("#euniquecode").val(),
				        type: 'POST',
				        data: { uniquecode: $("#euniquecode").val(), costume6: $("#eCostume6").val(), costume7: $("#eCostume7").val(), costume8: $("#eCostume8").val(), costume9: $("#eCostume9").val(), session: $("#esession").val() },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(){
				        		var oTable = $('#tspecial').DataTable();
								oTable.ajax.reload(null, false);
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
			@else
				$('#resourceupdate').submit(function(e){
			    	noty({
						layout: 'topRight', type: 'warning', text: 'Updating Record ...',
						animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
						timeout: 4000
					});
					$.ajax({
				        url: 'putEventAddInfo/' + $("#euniquecode").val(),
				        type: 'POST',
				        data: { uniquecode: $("#euniquecode").val(), costume6: $("#eCostume6").val(), costume7: $("#eCostume7").val(), name: $("#eName").val(), costume9: $("#eCostume9").val(), country: $("#ecountry").val(), language: $("#elanguage").val(), session: $("#eRegisteredSession").val(), dateofbirth: $("#eDateofBirth").val() },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(){
				        		var oTable = $('#tdistrict').DataTable();
								oTable.ajax.reload(null, false);
		            			noty({
									layout: 'topRight', type: 'success', text: 'Record Updated!!',
									animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
										},
									timeout: 4000
								});

								$("#eName").val(''); $("#eRegisteredSession").val('');
								$("#resourceedit").modal('hide');
				        	},
				        	400:function(data){ 
				        		var txtMessage = 'Please check your entry!!';
				        		if (data.responseJSON.ErrType == "NoAccess") 
			        				{ txtMessage = 'You do not have access to Update!'; }
								else if (data.responseJSON.info == "Full Capacity")
				        			{ txtMessage = 'The session is Full!  Please select another session'; }
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
			@endif

			@if ($youthsummittickets == 1)
				$('#resourceaddyouthsummitparticipant').submit(function(e){
					if(!$('#resourceaddyouthsummitparticipant').valid()) return false;
					else
					{
						$.ajax({
							url: 'postEventYouthSummitParticipantsTickets/{{ $rid }}',
							type: 'POST',
							data: { uniquecode: $("#yspuniquecode").val(), name: $("#yspname").val(), cname: $("#yspcname").val(), position: $("#yspposition").val(), division: $("#yspdivision").val(), rhq: $("#yspcbrhq").val(), zone: $("#yspcbzone").val(), chapter: $("#yspcbchapter").val(), district: $("#yspdistrict").val(), id: "{{ $rid }}", introducer: $("#yspintroducer").val(), remarks: $("#yspremarks").val(), costume9: $("#yspcostume9").val()},
							dataType: 'json',
							statusCode: { 
								200:function(){
									var oDistrictTable = $('#tdistrict').DataTable();
									oDistrictTable.ajax.reload(null, false);

									$("#yspname").val(''); $("#yspposition").val(''); $("#yspdivision").val(''); $("#yspcname").val('');
									$("#yspintroducer").val(''); $("#yspremarks").val('');

									$("#btnresourceaddyouthsummitparticipants").modal('hide');
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
									else if (data.responseJSON.ErrType == "More2")
										{ txtMessage = 'This member had applied more than 2 tickets!'; }
									else { txtMessage = 'Please check your entry!'; }
									noty({
										layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
											},
										timeout: 4000
									});
								}
							}
						});
					}
					e.preventDefault();
				});

				$('#resourceaddyouthsummityonsha').submit(function(e){
					if(!$('#resourceaddyouthsummityonsha').valid()) return false;
					else
					{
						$.ajax({
							url: 'postEventYouthSummitYonshaTickets/{{ $rid }}',
							type: 'POST',
							data: { uniquecode: $("#ysyuniquecode").val(), name: $("#ysyname").val(), cname: $("#ysycname").val(), position: $("#ysyposition").val(), division: $("#ysydivision").val(), rhq: $("#ysycbrhq").val(), zone: $("#ysycbzone").val(), chapter: $("#ysycbchapter").val(), district: $("#ysydistrict").val(), id: "{{ $rid }}", introducer: $("#ysyintroducer").val(), remarks: $("#ysyremarks").val(), costume9: $("#ysycostume9").val()},
							dataType: 'json',
							statusCode: { 
								200:function(){
									var oDistrictTable = $('#tdistrict').DataTable();
									oDistrictTable.ajax.reload(null, false);

									$("#ysyname").val(''); $("#ysyposition").val(''); $("#ysydivision").val(''); $("#ysycname").val('');
									$("#ysyintroducer").val(''); $("#ysyremarks").val('');

									$("#btnresourceaddyouthsummityonsha").modal('hide');
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
									else if (data.responseJSON.ErrType == "More2")
										{ txtMessage = 'This member had applied more than 2 tickets!'; }
									else { txtMessage = 'Please check your entry!'; }
									noty({
										layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
											},
										timeout: 4000
									});
								}
							}
						});
					}
					e.preventDefault();
				});

				$('#resourceaddyouthsummityouth').submit(function(e){
					if(!$('#resourceaddyouthsummityouth').valid()) return false;
					else
					{
						$.ajax({
							url: 'postEventYouthSummitYouthTickets/{{ $rid }}',
							type: 'POST',
							data: { uniquecode: $("#ysauniquecode").val(), name: $("#ysaname").val(), cname: $("#ysacname").val(), position: $("#ysaposition").val(), division: $("#ysadivision").val(), rhq: $("#ysacbrhq").val(), zone: $("#ysacbzone").val(), chapter: $("#ysacbchapter").val(), district: $("#ysadistrict").val(), id: "{{ $rid }}", introducer: $("#ysaintroducer").val(), remarks: $("#ysaremarks").val(), costume9: $("#ysacostume9").val()},
							dataType: 'json',
							statusCode: { 
								200:function(){
									var oDistrictTable = $('#tdistrict').DataTable();
									oDistrictTable.ajax.reload(null, false);

									$("#ysaname").val(''); $("#ysaposition").val(''); $("#ysadivision").val(''); $("#ysacname").val('');
									$("#ysaintroducer").val(''); $("#ysaremarks").val('');

									$("#btnresourceaddyouthsummityouth").modal('hide');
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
									noty({
										layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
											},
										timeout: 4000
									});
								}
							}
						});
					}
					e.preventDefault();
				});

				$('#resourceinvite').click(function(e){
					$("#ysaintroducer").val($("#ysaname").val());
					$("#ysaname").val("");
					$("#ysaposition").val("NF");
					$("#ysadivision").val("");
					$("#ysacname").val("");
				});
			@endif
		});

	    function reloaddt(submit){ 
	    	var oDistrictTable = $('#tdistrict').DataTable();
		    oDistrictTable.ajax.reload(null, false);
		    var oMembership = $('#tmembership').DataTable();
			oMembership.ajax.reload(null, false);
	    }

	    function insertrow(submit){ 
			@if ($madeventtype == true and $moredetailselect == 0)
				var RowID = "";
		        var oTable = $('#tpremad').DataTable();
				$("#tpremad tbody tr").click(function () {
					var position = oTable.row(this).index();
					RowID = oTable.row(position).data();
					$("#euniquecode").val(RowID.uniquecode);
					$.ajax({
				        url: 'getMemberInfo/' + $("#euniquecode").val(),
				        type: 'POST',
				        data: { uniquecode: $("#euniquecode").val() },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(data){
				        		$("#name").val(data.name); $("#chinesename").val(data.chinesename);
				        		$("#mobile").val(data.mobile); $("#cbrhq").val(data.rhq); $("#cbzone").val(data.zone);
								$("#cbchapter").val(data.chapter); $("#district").val(data.district); 
								$("#division").val(data.division); $("#position").val(data.position);
								$("#ecountry").val(data.nationality); $("#elanguage").val(data.language);
								$("#session").val(data.session); $("#dateofbirthtxt").val(moment(data.dateofbirth).format("DD-MMM"));
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
				        		noty({
									layout: 'topRight', type: 'error', text: txtMessage,
									animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
										},
									timeout: 4000
								});
				        	}
				        }
				    });
					$("#btnresourcemdadd").modal('hide');
					$("#btnresourceaddothers").modal('show');
	            });
			@elseif ($studyeventtype == false and $moredetailselect == 0)
				$.ajax({
					url: 'postEventParticipant/' + submit,
					type: 'POST',
					data: { uniquecode: submit, eventuniquecode: "{{ $rid }}" },
					dataType: 'json',
					statusCode: { 
						200:function(data){
							var oDistrictTable = $('#tdistrict').DataTable();
							oDistrictTable.ajax.reload(null, false);

							noty({
								layout: 'topRight', type: 'success', text: 'Record Created!! - ' + data.name,
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
							{ txtMessage = 'Member had already registered in this event.'; }
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
			@else
				var RowID = "";
		        var oTable = $('#tmembership').DataTable();
				$("#tmembership tbody tr").click(function () {
					var position = oTable.row(this).index();
	                RowID = oTable.row(position).data();
	                $("#uniquecode").val(RowID.uniquecode);
	                $.ajax({
				        url: 'getMemberInfo/' + $("#uniquecode").val(),
				        type: 'POST',
				        data: { uniquecode: $("#uniquecode").val() },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(data){
				        		$("#name").val(data.name); $("#chinesename").val(data.chinesename);
				        		$("#mobile").val(data.mobile); $("#cbrhq").val(data.rhq); $("#cbzone").val(data.zone);
								$("#cbchapter").val(data.chapter); $("#district").val(data.district); 
								$("#division").val(data.division); $("#position").val(data.position);
								$("#ecountry").val(data.nationality); $("#elanguage").val(data.language);
								$("#session").val(data.session); $("#dateofbirthtxt").val(moment(data.dateofbirth).format("DD-MMM"));
								$("#uniquecode").val(data.uniquecode);
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
				        		noty({
									layout: 'topRight', type: 'error', text: txtMessage,
									animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
										},
									timeout: 4000
								});
				        	}
				        }
				    });
					$("#btnresourceadd").modal('hide');
					$("#btnresourceaddothers").modal('show');
	            });
			@endif
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
					        data: { deletevalue: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oDistrictTable = $('#tdistrict').DataTable();
		        					oDistrictTable.ajax.reload(null, false);
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

	    function absentrow(submit){ 
			$.ajax({
		        url: 'putAbsent/' + submit,
		        type: 'POST',
		        data: { absent: submit },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oDistrictTable = $('#tdistrict').DataTable();
		        		oDistrictTable.ajax.reload(null, false);
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		if (data.responseJSON.ErrType == "NoAccess") 
	        			{ txtMessage = 'You do not have access to Update!'; }
	        			else if (data.responseJSON.ErrType == "Over") 
	        			{ txtMessage = 'Event had already over!'; }
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
		        url: 'putAttend/' + submit,
		        type: 'POST',
		        data: { attended: submit },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oDistrictTable = $('#tdistrict').DataTable();
		        		oDistrictTable.ajax.reload(null, false);
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		if (data.responseJSON.ErrType == "NoAccess") 
	        			{ txtMessage = 'You do not have access to Update!'; }
	        			else if (data.responseJSON.ErrType == "Over") 
	        			{ txtMessage = 'Event had already over!'; }
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

		@if ($editonly == 1)
			function editrow(submit){ 
				@if ($special == 1)
					var RowID = "";
					var oTable = $('#tspecial').DataTable();
					$("#tspecial tbody tr").click(function () {
						var position = oTable.row(this).index();
						RowID = oTable.row(position).data();
						$("#euniquecode").val(RowID.uniquecode);
						$.ajax({
							url: 'getEventAddInfo/' + $("#euniquecode").val(),
							type: 'POST',
							data: { uniquecode: $("#euniquecode").val() },
							dataType: 'json',
							statusCode: { 
								200:function(data){
									$("#eCostume6").val(data.costume6); $("#eCostume7").val(data.costume7);
									$("#eCostume8").val(data.costume8); $("#eCostume9").val(data.costume9);
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
						$("#resourceedit").modal('show');
					});
				@else
					var RowID = "";
					var oTable = $('#tdistrict').DataTable();
					$("#tdistrict tbody tr").click(function () {
						var position = oTable.row(this).index();
						RowID = oTable.row(position).data();
						$("#euniquecode").val(RowID.uniquecode);
						$.ajax({
							url: 'getEventAddInfo/' + $("#euniquecode").val(),
							type: 'POST',
							data: { uniquecode: $("#euniquecode").val() },
							dataType: 'json',
							statusCode: { 
								200:function(data){
									$("#eCostume6").val(data.costume6); $("#eCostume7").val(data.costume7);
									$("#eName").val(data.name); $("#eCostume9").val(data.costume9);
									$("#ecountry").val(data.countryofbirth); $("#elanguage").val(data.language);
									$("#esession").val(data.session); $("#eDateofBirth").val(data.dateofbirth);
									$("#eRegisteredSession").val(data.session);
									$("#eDateofBirth").datepicker('setDate', data.dateofbirth);
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
						$("#resourceedit").modal('show');
					});

				@endif
			}
		@endif

	    @if ($special == 1)
	    	function check1yesrow(submit){
	    		var RowID = "";
		        var oTable = $('#tspecial').DataTable();
		        $("#tspecial tbody tr").click(function () {
	                var position = oTable.row(this).index();
	                RowID = oTable.row(position).data();
	                $uc = RowID.uniquecode

	                $.ajax({
				        url: 'postEventSpecialCheck1Yes/' + $uc,
				        type: 'POST',
				        data: { uniquecode: $uc, eventuniquecode: $uc },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(data){
				        		var oDistrictTable = $('#tspecial').DataTable();
				        		$('#tspecial tbody').on( 'click', 'td', function () {
						    		var cell = oDistrictTable.cell(this, 8);
					    			cell.data(1).draw();
								});
				        		// oDistrictTable.ajax.reload(null, false);
				        	},
				        	400:function(data){ 
				        		var txtMessage = 'Please check your entry!!';
				        		if (data.responseJSON.ErrType == "NoAccess") 
			        			{ txtMessage = 'You do not have access to Update!'; }
			        			else if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Member had already registered in this event.'; }
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
	            });
		    }

		    function check1norow(submit){
	    		var RowID = "";
		        var oTable = $('#tspecial').DataTable();
		        $("#tspecial tbody tr").click(function () {
	                var position = oTable.row(this).index();
	                RowID = oTable.row(position).data();
	                $uc = RowID.uniquecode

	                $.ajax({
				        url: 'postEventSpecialCheck1No/' + $uc,
				        type: 'POST',
				        data: { uniquecode: $uc, eventuniquecode: $uc },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(data){
				        		var oDistrictTable = $('#tspecial').DataTable();
				        		$('#tspecial tbody').on( 'click', 'td', function () {
						    		var cell = oDistrictTable.cell(this, 8);
					    			cell.data(0).draw();
								});
				        	},
				        	400:function(data){ 
				        		var txtMessage = 'Please check your entry!!';
				        		if (data.responseJSON.ErrType == "NoAccess") 
			        			{ txtMessage = 'You do not have access to Update!'; }
			        			else if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Member had already registered in this event.'; }
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
	            });
		    }

		    function check2yesrow(submit){
	    		var RowID = "";
		        var oTable = $('#tspecial').DataTable();
		        $("#tspecial tbody tr").click(function () {
	                var position = oTable.row(this).index();
	                RowID = oTable.row(position).data();
	                $uc = RowID.uniquecode

	                $.ajax({
				        url: 'postEventSpecialCheck2Yes/' + $uc,
				        type: 'POST',
				        data: { uniquecode: $uc, eventuniquecode: $uc },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(data){
				        		var oDistrictTable = $('#tspecial').DataTable();
				        		oDistrictTable.ajax.reload(null, false);
				        	},
				        	400:function(data){ 
				        		var txtMessage = 'Please check your entry!!';
				        		if (data.responseJSON.ErrType == "NoAccess") 
			        			{ txtMessage = 'You do not have access to Update!'; }
			        			else if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Member had already registered in this event.'; }
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
	            });
		    }

		    function check2norow(submit){
	    		var RowID = "";
		        var oTable = $('#tspecial').DataTable();
		        $("#tspecial tbody tr").click(function () {
	                var position = oTable.row(this).index();
	                RowID = oTable.row(position).data();
	                $uc = RowID.uniquecode

	                $.ajax({
				        url: 'postEventSpecialCheck2No/' + $uc,
				        type: 'POST',
				        data: { uniquecode: $uc, eventuniquecode: $uc },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(data){
				        		var oDistrictTable = $('#tspecial').DataTable();
				        		oDistrictTable.ajax.reload(null, false);
				        	},
				        	400:function(data){ 
				        		var txtMessage = 'Please check your entry!!';
				        		if (data.responseJSON.ErrType == "NoAccess") 
			        			{ txtMessage = 'You do not have access to Update!'; }
			        			else if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Member had already registered in this event.'; }
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
	            });
		    }

		    function check3yesrow(submit){
	    		var RowID = "";
		        var oTable = $('#tspecial').DataTable();
		        $("#tspecial tbody tr").click(function () {
	                var position = oTable.row(this).index();
	                RowID = oTable.row(position).data();
	                $uc = RowID.uniquecode

	                $.ajax({
				        url: 'postEventSpecialCheck3Yes/' + $uc,
				        type: 'POST',
				        data: { uniquecode: $uc, eventuniquecode: $uc },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(data){
				        		var oDistrictTable = $('#tspecial').DataTable();
				        		$('#tspecial tbody').on( 'click', 'td', function () {
						    		var cell = oDistrictTable.cell(this, 9);
					    			cell.data(1).draw();
								});
				        	},
				        	400:function(data){ 
				        		var txtMessage = 'Please check your entry!!';
				        		if (data.responseJSON.ErrType == "NoAccess") 
			        			{ txtMessage = 'You do not have access to Update!'; }
			        			else if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Member had already registered in this event.'; }
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
	            });
		    }

		    function check3norow(submit){
	    		var RowID = "";
		        var oTable = $('#tspecial').DataTable();
		        $("#tspecial tbody tr").click(function () {
	                var position = oTable.row(this).index();
	                RowID = oTable.row(position).data();
	                $uc = RowID.uniquecode

	                $.ajax({
				        url: 'postEventSpecialCheck3No/' + $uc,
				        type: 'POST',
				        data: { uniquecode: $uc, eventuniquecode: $uc },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(data){
				        		var oDistrictTable = $('#tspecial').DataTable();
				        		$('#tspecial tbody').on( 'click', 'td', function () {
						    		var cell = oDistrictTable.cell(this, 9);
					    			cell.data(0).draw();
								});
				        	},
				        	400:function(data){ 
				        		var txtMessage = 'Please check your entry!!';
				        		if (data.responseJSON.ErrType == "NoAccess") 
			        			{ txtMessage = 'You do not have access to Update!'; }
			        			else if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Member had already registered in this event.'; }
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
	            });
		    }
		@endif

		@if($youthsummittickets == 1)
			function ysparticipantsrow(submit){
				$.ajax({
					url: 'getYouthSummitParticipantInfo/' + submit,
					type: 'GET',
					data: {},
					dataType: 'json',
					statusCode: { 
						200:function(data){
							$("#yspintroducer").val(data.name); $("#yspuniquecode").val(data.uniquecode); $("#yspposition").val('NF');
							$("#yspcbrhq").val(data.rhq); $("#yspcbzone").val(data.zone); 
							$("#yspcbchapter").val(data.chapter); $("#yspdistrict").val(data.district);
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
				$("#btnyouthsummit").modal('hide');
				$("#btnresourceaddyouthsummitparticipants").modal('show');
			}

			function ysyonsharow(submit){
				$.ajax({
					url: 'getYouthSummitYonshaInfo/' + submit,
					type: 'GET',
					data: {},
					dataType: 'json',
					statusCode: { 
						200:function(data){
							$("#ysyintroducer").val(data.name); $("#ysyuniquecode").val(data.uniquecode); $("#ysyposition").val('NF');
							$("#ysycbrhq").val(data.rhq); $("#ysycbzone").val(data.zone); 
							$("#ysycbchapter").val(data.chapter); $("#ysydistrict").val(data.district);
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
				$("#btnyouthsummityonsha").modal('hide');
				$("#btnresourceaddyouthsummityonsha").modal('show');
			}

			function ysyouthrow(submit){
				$.ajax({
					url: 'getYouthSummitYouthInfo/' + submit,
					type: 'GET',
					data: {},
					dataType: 'json',
					statusCode: { 
						200:function(data){
							$("#ysaname").val(data.name); $("#ysauniquecode").val(data.uniquecode); $("#ysaposition").val(data.position);
							$("#ysacbrhq").val(data.rhq); $("#ysacbzone").val(data.zone); $("#ysaintroducer").val(data.introducer); 
							$("#ysacbchapter").val(data.chapter); $("#ysadistrict").val(data.district); $("#ysadivision").val(data.division);
							$("#ysacname").val(data.chinesename);
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
				$("#btnyouthsummityouth").modal('hide');
				$("#btnresourceaddyouthsummityouth").modal('show');
			}

			$('#resourceaddyouthsummitparticipant').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					yspname: { required: true, minlength: 3 },
					yspposition: { required: true },
					yspcostume9: { required: true },
					yspdivision: { required: true }
				},
				messages: { },
				invalidHandler: function (event, validator) { ('.alert-danger', $('.resourceaddyouthsummitparticipant')).show(); },
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

			$('#resourceaddyouthsummityonsha').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					ysyname: { required: true, minlength: 3 },
					ysyposition: { required: true },
					ysycostume9: { required: true },
					ysydivision: { required: true }
				},
				messages: { },
				invalidHandler: function (event, validator) { ('.alert-danger', $('.resourceaddyouthsummityonsha')).show(); },
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

			$('#resourceaddyouthsummityouth').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					ysaname: { required: true, minlength: 3 },
					ysaposition: { required: true },
					ysacostume9: { required: true },
					ysadivision: { required: true }
				},
				messages: { },
				invalidHandler: function (event, validator) { ('.alert-danger', $('.resourceaddyouthsummityouth')).show(); },
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
		@endif
	</script>
@stop