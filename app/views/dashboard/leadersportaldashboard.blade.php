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
			<li class="active">Dashboard</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		@include('layout/leadersportalskin')
		<div class="page-header">
			<h1>Dashboard<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@if($RGACRI == 't')
					<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Recent Activities</h5>
								<div class="widget-toolbar">
									<a href="#" data-action="fullscreen" class="orange2">
										<i class="ace-icon fa fa-expand"></i>
									</a>
									<a href="#" data-action="reload">
										<i class="fa fa-refresh"></i>
									</a>

									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-up"></i>
									</a>
									<a href="#" data-action="close">
										<i class="ace-icon fa fa-times"></i>
									</a>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main no-padding">
									<table id="tUserLogs" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Date</th>
												<th>Log Type</th>
												<th>Description</th>
												<th>ip Address</th>
												<th>Session ID</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				@endif
				@if ($homevisitcampaign == 2)
					@if ($gakkaishq == 't' or $gakkairegion == 't' or $gakkaizone == 't' or $gakkaichapter == 't' or $gakkaidistrict == 't')
						<div class="col-xs-12 col-sm-12  widget-container-span ui-sortable">
							<div class="widget-box widget-color-green">
								<div class="widget-header">
									<h5 class="widget-title">Encouragement Month 2019</h5>
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
									<div class="widget-main padding-8 clearfix">
										<div class="col-xs-12 col-sm-3 widget-container-span">
											<div class="widget-box widget-color-blue">
												<div class="widget-header">
													<h5 class="widget-title">MD</h5>
												</div>
												<div class="widget-body">
													<div class="widget-main">
														<div class="well well-lg">
															<center><h1> <span id="spanhomevisitmdadd">{{$mdhomevisit}}</span> </h1></center>
														</div>
													</div>
													<div class="widget-toolbox padding-4 clearfix">
														{{ Form::open(array('action' => 'LeadersPortalDashboardController@posthomevisitmdadd', 'id' => 'fhomevisitmdadd', 'class' => 'form-horizontal')) }}
															</br>
															<div class="form-group">
																<div class="col-md-offset-4 col-xs-offset-4 col-xs-12 col-sm-12">
																	<div class="clearfix">
																		{{ Form::button('<i class="fa fa-plus fa fa-on-right"></i> Add', array('type' => 'Search', 'class' => 'btn btn-success btn-lg' )); }}
																	</div>
																</div>
															</div>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-3 widget-container-span">
											<div class="widget-box widget-color-red">
												<div class="widget-header">
													<h5 class="widget-title">WD</h5>
												</div>
												<div class="widget-body">
													<div class="widget-main">
														<div class="well well-lg">
															<center><h1> <span id="spanhomevisitwdadd">{{$wdhomevisit}}</span> </h1></center>
														</div>
													</div>
													<div class="widget-toolbox padding-4 clearfix">
														{{ Form::open(array('action' => 'LeadersPortalDashboardController@posthomevisitwdadd', 'id' => 'fhomevisitwdadd', 'class' => 'form-horizontal')) }}
															</br>
															<div class="form-group">
																<div class="col-md-offset-4 col-xs-offset-4 col-xs-12 col-sm-12">
																	<div class="clearfix">
																		{{ Form::button('<i class="fa fa-plus fa fa-on-right"></i> Add', array('type' => 'Search', 'class' => 'btn btn-success btn-lg' )); }}
																	</div>
																</div>
															</div>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-3 widget-container-span">
											<div class="widget-box widget-color-green">
												<div class="widget-header">
													<h5 class="widget-title">YMD</h5>
												</div>
												<div class="widget-body">
													<div class="widget-main">
														<div class="well well-lg">
															<center><h1> <span id="spanhomevisitymadd">{{$ymhomevisit}}</span> </h1></center>
														</div>
													</div>
													<div class="widget-toolbox padding-4 clearfix">
														{{ Form::open(array('action' => 'LeadersPortalDashboardController@posthomevisitymadd', 'id' => 'fhomevisitymadd', 'class' => 'form-horizontal')) }}
															</br>
															<div class="form-group">
																<div class="col-md-offset-4 col-xs-offset-4 col-xs-12 col-sm-12">
																	<div class="clearfix">
																		{{ Form::button('<i class="fa fa-plus fa fa-on-right"></i> Add', array('type' => 'Search', 'class' => 'btn btn-success btn-lg' )); }}
																	</div>
																</div>
															</div>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-3 widget-container-span">
											<div class="widget-box widget-color-purple">
												<div class="widget-header">
													<h5 class="widget-title">YWD</h5>
												</div>
												<div class="widget-body">
													<div class="widget-main">
														<div class="well well-lg">
															<center><h1> <span id="spanhomevisitywadd">{{$ywhomevisit}}</span> </h1></center>
														</div>
													</div>
													<div class="widget-toolbox padding-4 clearfix">
														{{ Form::open(array('action' => 'LeadersPortalDashboardController@posthomevisitywadd', 'id' => 'fhomevisitywadd', 'class' => 'form-horizontal')) }}
															</br>
															<div class="form-group">
																<div class="col-md-offset-4 col-xs-offset-4 col-xs-12 col-sm-12">
																	<div class="clearfix">
																		{{ Form::button('<i class="fa fa-plus fa fa-on-right"></i> Add', array('type' => 'Search', 'class' => 'btn btn-success btn-lg' )); }}
																	</div>
																</div>
															</div>
														{{ Form::close() }}
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="widget-toolbox padding-8 clearfix">
									</div>
								</div>
							</div>
						</div><!-- Homevisit Campaign 2019 (To remove after campaign finished) -->
					@endif
				@endif
				@if ($dialoguecampaign == 1)
					<div class="col-xs-12 col-sm-3  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Together We Dialogue (MD) </h5>
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
										<center><h1> <span id="spanboe">{{$mdhomevisit}}</span> </h1></center>
									</div>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
										<a href="#btnboeedit" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add MD </a>
									</div>
								</div>
								<div id="btnboeedit" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'LeadersPortalDashboardController@putBOEedit', 'id' => 'boeedit', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Number of Dialogue to Record</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div class="form-group">
																{{ Form::label('eboe', 'No. of Dialogue (MD):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('eboe', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eboe'));}}
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
														{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'boeedit')); }}
													</div>
												</fieldset>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- Bodhisattvas of the Earth -->
					<div class="col-xs-12 col-sm-3  widget-container-span ui-sortable">
						<div class="widget-box widget-color-orange">
							<div class="widget-header">
								<h5 class="widget-title">Together We Dialogue (WD)</h5>
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
										<center><h1> <span id="spanyouthsubmit">{{$wdhomevisit}}</span> </h1></center>
									</div>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
										<a href="#btnyouthsubmitedit" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add WD</a>
									</div>
								</div>
								<div id="btnyouthsubmitedit" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'LeadersPortalDashboardController@putYouthSubmitedit', 'id' => 'youthsubmitedit', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Number of Dialogue to Record</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div class="form-group">
																{{ Form::label('eyouthsubmit', 'No. of Dialogue (WD):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('eyouthsubmit', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eyouthsubmit'));}}
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
														{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'youthsubmitedit')); }}
													</div>
												</fieldset>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- Youth Submit -->
					<div class="col-xs-12 col-sm-3  widget-container-span ui-sortable">
						<div class="widget-box widget-color-red">
							<div class="widget-header">
								<h5 class="widget-title">Together We Dialogue (Youth)</h5>
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
										<center><h1> <span id="spandiscussionmeeting">{{$youthhomevisit}}</span> </h1></center>
									</div>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
										<a href="#btndiscussionmeetingedit" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add Youth</a>
									</div>
								</div>
								<div id="btndiscussionmeetingedit" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'LeadersPortalDashboardController@putDiscussionMeetingedit', 'id' => 'discussionmeetingedit', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Number of Dialogue to Record</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div class="form-group">
																{{ Form::label('edivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::select('edivision', array('YM' => 'YMD', 'YW' => 'YWD'), 'YM', array('class' => 'col-xs-12 col-sm-11', 'id' => 'edivision'));}}
																	</div>
																</div>
															</div>
															<div class="form-group">
																{{ Form::label('ediscussionmeeting', 'No. of Dialogue:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('ediscussionmeeting', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ediscussionmeeting'));}}
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
														{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'discussionmeetingedit')); }}
													</div>
												</fieldset>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- Discussion Meeting -->
				@endif
				<div hidden class="col-xs-12 col-sm-3  widget-container-span ui-sortable">
					<div class="widget-box widget-color-purple">
						<div class="widget-header">
							<h5 class="widget-title">Entrance Study Exam</h5>
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
									<center><h1> <span id="spanstudyexam">{{$studyexam}}</span> </h1></center>
								</div>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								<div class="col-xs-12">
									@if ($gakkaidistrict == 't')
										<a href="#btnstudyexamedit" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-edit add bigger-120"></i> Edit</a>
									@endif
								</div>
							</div>
							@if ($gakkaidistrict == 't')
								<div id="btnstudyexamedit" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'LeadersPortalDashboardController@putStudyExamedit', 'id' => 'studyexamedit', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Entrance Exam Target</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div class="form-group">
																{{ Form::label('estudyexam', 'Entrance Exam:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('estudyexam', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'estudyexam'));}}
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
														{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'studyexamedit')); }}
													</div>
												</fieldset>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div> <!-- Study Exam -->
				<div hidden class="col-xs-12 col-sm-6  widget-container-span ui-sortable">
					<div class="widget-box widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">Ever Victorious Daimoku Campagin (By Hour)</h5>
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
									<center><h1> <span id="spanmddaimokuadd">{{$mddaimoku}}</span> </h1></center>
								</div>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								<div class="col-xs-12">
									<a href="#btnemddaimokuadd" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add</a>
								</div>
							</div>
							<div id="btnemddaimokuadd" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											{{ Form::open(array('action' => 'LeadersPortalDashboardController@postMDDaimoku', 'id' => 'mddaimokuadd', 'class' => 'form-horizontal')) }}
												<fieldset>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">MD Daimoku (In Hours)</h4>
													</div>
													<div class="modal-body overflow-visible">
														<div class="row">
															<div class="form-group">
																{{ Form::label('emddaimoku', 'Daimoku (Hours):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																<div class="col-xs-12 col-sm-8">
																	<div class="clearfix">
																		{{ Form::text('emddaimoku', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'emddaimoku'));}}
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
														{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'mddaimokuadd')); }}
													</div>
												</fieldset>
											{{ Form::close() }}
										</div>
									</div>
								</div>
						</div>
					</div>
				</div><!-- MD Daimokukai -->
				<div class="col-xs-12 col-sm-12  widget-container-span ui-sortable">
					<div class="widget-box widget-color-green">
						<div class="widget-header">
							<h5 class="widget-title">We are shifting to new domain!</h5>
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
									<center>
										<h2> We will be moving to <a href="https://boeportal.sokasingapore.org" target="_blank">https://boeportal.sokasingapore.org</a> on the <b>21st March 2022</b>!</h2>
										<h3> See you there!</h3>
									</center>
								</div>
							</div>
						</div>
					</div>
				</div><!-- MD Daimokukai -->
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Event Registration Listing (Current)</h5>
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
								<table id="teventregistration" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Date</th>
											<th>Event Type</th>
											<th>Description</th>
											<th>Location</th>
											<th>Status</th>
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
				</div> <!-- Active Event Registration -->
				@if ($gakkaishq == 't')
					<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">SHQ Leadership and Membership - Statistic</h5>
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
									<table id="tshqstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Division</th>
												<th>Leaders</th>
												<th>Members</th>
												<th>Believers</th>
												<th>New Friends</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tshstatsfoot">
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
					</div> <!-- Region Statistic -->
					<div class="col-xs-12 col-sm-8  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Current Discussion Meeting Month - Statistic</h5>
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
									<table id="tregiondmstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Region</th>
												<th>Total Dist</th>
												<th>Submitted</th>
												<th>Not Submitted</th>
												<th>Attendence</th>
												<th>Ldr</th>
												<th>Men</th>
												<th>Bel</th>
												<th>NF</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tregiondmstatsfoot">
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
					</div> <!-- Current Discussion Meeting Statistic -->
					<div class="col-xs-12 col-sm-4  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Current Month Discussion Meeting (Not Submitted)</h5>
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
									<table id="tregiondmnotsubmittedstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>District</th>
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
					</div> <!-- District Discussion Meeting Not Submitted Statistic -->
				@endif
				@if ($gakkairegion == 't')
					<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Region Leadership and Membership - Statistic</h5>
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
									<table id="tregionstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Division</th>
												<th>Leaders</th>
												<th>Members</th>
												<th>Believers</th>
												<th>New Friends</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="trmstatsfoot">
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
					</div> <!-- Region Statistic -->
					<div class="col-xs-12 col-sm-8  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Current Discussion Meeting Month - Statistic</h5>
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
									<table id="tzonedmstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Zone</th>
												<th>Total Dist</th>
												<th>Submitted</th>
												<th>Not Submitted</th>
												<th>Attendence</th>
												<th>Ldr</th>
												<th>Men</th>
												<th>Bel</th>
												<th>NF</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tzonedmstatsfoot">
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
					</div> <!-- Current Discussion Meeting Statistic -->
					<div class="col-xs-12 col-sm-4  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Current Month Discussion Meeting (Not Submitted)</h5>
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
									<table id="tzonedmnotsubmittedstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>District</th>
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
					</div> <!-- District Discussion Meeting Not Submitted Statistic -->
				@endif
				@if ($gakkaizone == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Zone Leadership and Membership - Statistic</h5>
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
									<table id="tzonestats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Leaders</th>
												<th>Members</th>
												<th>Believers</th>
												<th>New Friends</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tzmstatsfoot">
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
					</div> <!-- Zone Statistic -->
					<div class="col-xs-12 col-sm-8  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Current Discussion Meeting Month - Statistic</h5>
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
									<table id="tchapterdmstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Chapter</th>
												<th>Total Dist</th>
												<th>Submitted</th>
												<th>Not Submitted</th>
												<th>Attendence</th>
												<th>Ldr</th>
												<th>Men</th>
												<th>Bel</th>
												<th>NF</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tchapterdmstatsfoot">
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
					</div> <!-- Chapter Current Discussion Meeting Statistic -->
					<div class="col-xs-12 col-sm-4  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Current Month Discussion Meeting (Not Submitted)</h5>
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
									<table id="tchapterdmnotsubmittedstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>District</th>
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
					</div> <!-- District Discussion Meeting Not Submitted Statistic -->
				@endif
				@if ($gakkaichapter == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Chapter Leadership and Membership - Statistic</h5>
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
									<table id="tchapterstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tcmstatsfoot">
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
					</div> <!-- District Statistic -->
					<div class="col-xs-12 col-sm-8  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Current Discussion Meeting Month - Statistic</h5>
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
									<table id="tdistrictdmstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>District</th>
												<th>Total Dist</th>
												<th>Submitted</th>
												<th>Not Submitted</th>
												<th>Attendence</th>
												<th>Ldr</th>
												<th>Men</th>
												<th>Bel</th>
												<th>NF</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tdistrictdmstatsfoot">
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
					</div> <!-- District Current Discussion Meeting Statistic -->
					<div class="col-xs-12 col-sm-4  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Current Month Discussion Meeting (Not Submitted)</h5>
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
									<table id="tdmnotsubmittedstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>District</th>
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
					</div> <!-- District Discussion Meeting Not Submitted Statistic -->
				@endif
				@if ($gakkaidistrict == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">District Leadership and Membership - Statistic</h5>
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
												<th>Division</th>
												<th>Leaders</th>
												<th>Members</th>
												<th>Believers</th>
												<th>New Friends</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tdmstatsfoot">
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
					</div> <!-- District Statistic -->
					<div class="col-xs-12 col-sm-4  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Current Month Discussion Meeting (Not Submitted)</h5>
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
									<table id="tindividualdmnotsubmittedstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>District</th>
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
					</div> <!-- District Discussion Meeting Not Submitted Statistic -->
				@endif
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript">
		$(function() {
			@if($RGACRI == 't')
				var oTable = $('#tUserLogs').DataTable({
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
			            url: 'Dashboard/userlogs',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	                	{
					    	"targets": [ 0 ], "data": "created_at", "width": "200px", "searchable": "true",
					    	"render": function ( data, type, full ){
					    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
						    }
				    	},
				    	{
					    	"targets": [ 1 ], "data": "logtype", "width": "100px", "searchable": "true"
				    	},
				    	{
					    	"targets": [ 2 ], "data": "description", "searchable": "true",
					    	"render": function ( data, type, full ){
					    		return data.substring(0, 200) + ' ...';
						    }
				    	},
				    	{
					    	"targets": [ 3 ], "data": "ipaddress", "searchable": "true"
				    	},
				    	{
					    	"targets": [ 4 ], "data": "session", "searchable": "true",
					    	"render": function ( data, type, full ){
					    		return data.substring(0, 10) + ' ...';
						    }
				    	},
				    	{
					    	"targets": [ 5 ], "data": "status", "searchable": "true",
					    	"render": function ( data, type, full ){
							    if (data === 'Failed'){
							    	return '<span class="label label-danger arrowed-in">'+data+'</span>';
							    }
							  	else if (data === 'Success'){
							    	return '<span class="label label-success arrowed">'+data+'</span>';
							    }
				    		}
			    		}
				    ]
			    });
			@endif
		});

		function editrow(submit){ 
			var RowID = "";
			var oEventTable = $('#teventregistration').DataTable();
			$("#teventregistration tbody tr").click(function () {
				var position = oEventTable.row(this).index();
				RowID = oEventTable.row(position).data();
				window.location.href = "BOEPortalEvent/" + submit;
			});
		}

		$('#fhomevisitmdadd').submit(function(e){
	    	$.ajax({
		        url: '/BOEPortalDashboard/posthomevisitmdadd',
		        type: 'POST',
		        data: { division: 'MD' },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
						noty({
							layout: 'topRight', type: 'info', text: 'Registering the homevisit!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
								},
							timeout: 4000
						});
		        		$("#spanhomevisitmdadd").text(data.homevisittotal);
						noty({
							layout: 'topRight', type: 'success', text: 'Thank you very much for your wonderful home visit and dialogue efforts in encouraging your members!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
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

		$('#fhomevisitwdadd').submit(function(e){
	    	$.ajax({
		        url: '/BOEPortalDashboard/posthomevisitwdadd',
		        type: 'POST',
		        data: { division: 'WD' },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
						noty({
							layout: 'topRight', type: 'info', text: 'Registering the homevisit!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
								},
							timeout: 4000
						});
		        		$("#spanhomevisitwdadd").text(data.homevisittotal);
						noty({
							layout: 'topRight', type: 'success', text: 'Thank you very much for your wonderful home visit and dialogue efforts in encouraging your members!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
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

		$('#fhomevisitymadd').submit(function(e){
	    	$.ajax({
		        url: '/BOEPortalDashboard/posthomevisitymadd',
		        type: 'POST',
		        data: { division: 'YM' },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
						noty({
							layout: 'topRight', type: 'info', text: 'Registering the homevisit!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
								},
							timeout: 4000
						});
		        		$("#spanhomevisitymadd").text(data.homevisittotal);
						noty({
							layout: 'topRight', type: 'success', text: 'Thank you very much for your wonderful home visit and dialogue efforts in encouraging your members!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
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

		$('#fhomevisitywadd').submit(function(e){
	    	$.ajax({
		        url: '/BOEPortalDashboard/posthomevisitywadd',
		        type: 'POST',
		        data: { division: 'YW' },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
						noty({
							layout: 'topRight', type: 'info', text: 'Registering the homevisit!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
								},
							timeout: 4000
						});
		        		$("#spanhomevisitywadd").text(data.homevisittotal);
						noty({
							layout: 'topRight', type: 'success', text: 'Thank you very much for your wonderful home visit and dialogue efforts in encouraging your members!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
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

				var oEventTable = $('#teventregistration').DataTable({
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
					order: [[0, "asc"]],
					ajax: 'BOEPortalDashboard/getEventListing',
					columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: -1 },
						{ responsivePriority: 3, targets: 2 },
						{
							targets: [ 0 ], data: "eventdate", width: "150px", searchable: true, visible: false,
							render: function ( data, type, full ){
								return moment(data).format("DD-MMM-YYYY");
							}
						},
						{ targets: [ 1 ], data: "eventtype", searchable: true },
						{ targets: [ 2 ], data: "description", searchable: true },
						{ targets: [ 3 ], data: "location", searchable: true },
						{ 
							targets: [ 4 ], data: "status", searchable: true,
							render: function ( data, type, full ){
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
							targets: [ 5 ], data: "uniquecode",
							render: function ( data, type, full ){
								return '<a href="#resourceedit" role="button" onClick=editrow("'+ data +'") class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> '
							}
						}]
			    });

				@if ($gakkaishq == 't')
					var oShqStats = $('#tshqstats').DataTable({
				        "displayLength": 25, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": true,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDashboard/getSHQStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "division" },
					    	{ "targets": [ 1 ], "data": "LDR" },
					    	{ "targets": [ 2 ], "data": "MEM"  },
					    	{ "targets": [ 3 ], "data": "BEL" },
					    	{ "targets": [ 4 ], "data": "NF" },
					    	{ "targets": [ 5 ], "data": "Total" }],
		            	"footerCallback": function (row, data, start, end, display) {
			                var api = this.api(), data

			                // Remove the formatting to get integer data for summation
				            var intVal = function ( i ) {
				                return typeof i === 'string' ?
				                    i.replace(/[\$,]/g, '')*1 :
				                    typeof i === 'number' ?
				                        i : 0;
				            };
			                columns = [1, 2, 3, 4, 5]; // Add columns here

			       			for (var i = 0; i < columns.length; i++) {
			                    $('#tshstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
			                }
			            }
				    }); // Region Statistic

				    var oRegionDMCurrentMonthStats = $('#tregiondmstats').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
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
				            url: 'BOEPortalDashboard/getRegionDMCurrentMonthStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "rhq" },
				        	{ "targets": [ 1 ], "data": "totalnoofdistrict" },
				        	{ "targets": [ 2 ], "data": "submitted" },
				        	{ "targets": [ 3 ], "data": "notsubmitted" },
					    	{ "targets": [ 4 ], "data": "currenttotalattendance" },
					    	{ "targets": [ 5 ], "data": "ldr"  },
					    	{ "targets": [ 6 ], "data": "mem" },
					    	{ "targets": [ 7 ], "data": "bel" },
					    	{ "targets": [ 8 ], "data": "nf" }],
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
			                    $('#tregiondmstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
			                }
			            }
				    }); // Region Current Month Discussion Meeting Statistic

				    var oRegionDMNotSubmittedStats = $('#tregiondmnotsubmittedstats').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": true,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDashboard/getRegionDMNotSubmittedStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "description" }]
				    }); // District Statistic
				@endif

				@if ($gakkairegion == 't')
					var oRegionStats = $('#tregionstats').DataTable({
				        "displayLength": 25, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": true,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDashboard/getRegionStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "division" },
					    	{ "targets": [ 1 ], "data": "LDR" },
					    	{ "targets": [ 2 ], "data": "MEM"  },
					    	{ "targets": [ 3 ], "data": "BEL" },
					    	{ "targets": [ 4 ], "data": "NF" },
					    	{ "targets": [ 5 ], "data": "Total" }],
		            	"footerCallback": function (row, data, start, end, display) {
			                var api = this.api(), data

			                // Remove the formatting to get integer data for summation
				            var intVal = function ( i ) {
				                return typeof i === 'string' ?
				                    i.replace(/[\$,]/g, '')*1 :
				                    typeof i === 'number' ?
				                        i : 0;
				            };
			                columns = [1, 2, 3, 4, 5]; // Add columns here

			       			for (var i = 0; i < columns.length; i++) {
			                    $('#trmstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
			                }
			            }
				    }); // Region Statistic

				    var oZoneDMCurrentMonthStats = $('#tzonedmstats').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
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
				            url: 'BOEPortalDashboard/getZoneDMCurrentMonthStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "zone" },
				        	{ "targets": [ 1 ], "data": "totalnoofdistrict" },
				        	{ "targets": [ 2 ], "data": "submitted" },
				        	{ "targets": [ 3 ], "data": "notsubmitted" },
					    	{ "targets": [ 4 ], "data": "currenttotalattendance" },
					    	{ "targets": [ 5 ], "data": "ldr"  },
					    	{ "targets": [ 6 ], "data": "mem" },
					    	{ "targets": [ 7 ], "data": "bel" },
					    	{ "targets": [ 8 ], "data": "nf" }],
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
			                    $('#tzonedmstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
			                }
			            }
				    }); // Region Current Month Discussion Meeting Statistic

				    var oZoneDMNotSubmittedStats = $('#tzonedmnotsubmittedstats').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": true,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDashboard/getZoneDMNotSubmittedStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "description" }]
				    }); // District Statistic
				@endif

				@if ($gakkaizone == 't')
					var oZoneStats = $('#tzonestats').DataTable({
				        "displayLength": 25, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": true,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDashboard/getZoneStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "division" },
					    	{ "targets": [ 1 ], "data": "LDR" },
					    	{ "targets": [ 2 ], "data": "MEM"  },
					    	{ "targets": [ 3 ], "data": "BEL" },
					    	{ "targets": [ 4 ], "data": "NF" },
					    	{ "targets": [ 5 ], "data": "Total" }],
		            	"initComplete": function (row, data, start, end, display) {
			                var api = this.api(), data

			                // Remove the formatting to get integer data for summation
				            var intVal = function ( i ) {
				                return typeof i === 'string' ?
				                    i.replace(/[\$,]/g, '')*1 :
				                    typeof i === 'number' ?
				                        i : 0;
				            };
			                columns = [1, 2, 3, 4, 5]; // Add columns here

			       			for (var i = 0; i < columns.length; i++) {
			                    $('#tzmstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
			                }
			            }
				    }); // Zone Statistic

				    var oChapterDMCurrentMonthStats = $('#tchapterdmstats').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
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
				            url: 'BOEPortalDashboard/getChapterDMCurrentMonthStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "chapter" },
				        	{ "targets": [ 1 ], "data": "totalnoofdistrict" },
				        	{ "targets": [ 2 ], "data": "submitted" },
				        	{ "targets": [ 3 ], "data": "notsubmitted" },
					    	{ "targets": [ 4 ], "data": "currenttotalattendance" },
					    	{ "targets": [ 5 ], "data": "ldr"  },
					    	{ "targets": [ 6 ], "data": "mem" },
					    	{ "targets": [ 7 ], "data": "bel" },
					    	{ "targets": [ 8 ], "data": "nf" }],
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
			                    $('#tchapterdmstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
			                }
			            }
				    }); // Zone Current Month Discussion Meeting Statistic

				    var oChapterDMNotSubmittedStats = $('#tchapterdmnotsubmittedstats').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": true,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDashboard/getChapterDMNotSubmittedStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "description" }]
				    }); // District Statistic
				@endif

				@if ($gakkaichapter == 't')
					var oChapterStats = $('#tchapterstats').DataTable({
				        "displayLength": 25, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": true,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDashboard/getChapterStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "division" },
					    	{ "targets": [ 1 ], "data": "LDR" },
					    	{ "targets": [ 2 ], "data": "MEM"  },
					    	{ "targets": [ 3 ], "data": "BEL" },
					    	{ "targets": [ 4 ], "data": "NF" },
					    	{ "targets": [ 5 ], "data": "Total" }],
		            	"initComplete": function (row, data, start, end, display) {
			                var api = this.api(), data

			                // Remove the formatting to get integer data for summation
				            var intVal = function ( i ) {
				                return typeof i === 'string' ?
				                    i.replace(/[\$,]/g, '')*1 :
				                    typeof i === 'number' ?
				                        i : 0;
				            };
			                columns = [1, 2, 3, 4, 5]; // Add columns here

			       			for (var i = 0; i < columns.length; i++) {
			                    $('#tcmstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
			                }
			            }
				    }); // Chapter Statistic

				    var oDistrictDMCurrentMonthStats = $('#tdistrictdmstats').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
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
				            url: 'BOEPortalDashboard/getDistrictDMCurrentMonthStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "district" },
				        	{ "targets": [ 1 ], "data": "totalnoofdistrict" },
				        	{ "targets": [ 2 ], "data": "submitted" },
				        	{ "targets": [ 3 ], "data": "notsubmitted" },
					    	{ "targets": [ 4 ], "data": "currenttotalattendance" },
					    	{ "targets": [ 5 ], "data": "ldr"  },
					    	{ "targets": [ 6 ], "data": "mem" },
					    	{ "targets": [ 7 ], "data": "bel" },
					    	{ "targets": [ 8 ], "data": "nf" }],
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
			                    $('#tdistrictdmstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
			                }
			            }
				    }); // Chapter Current Month Discussion Meeting Statistic

				    var oDMNotSubmittedStats = $('#tdmnotsubmittedstats').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": true,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDashboard/getDistrictDMNotSubmittedStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "description" }]
				    }); // District Statistic
				@endif

				@if ($gakkaidistrict == 't')
					var oDistrictStats = $('#tdistrictstats').DataTable({
				        "displayLength": 25, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": true,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDashboard/getDistrictStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "division" },
					    	{ "targets": [ 1 ], "data": "LDR" },
					    	{ "targets": [ 2 ], "data": "MEM"  },
					    	{ "targets": [ 3 ], "data": "BEL" },
					    	{ "targets": [ 4 ], "data": "NF" },
					    	{ "targets": [ 5 ], "data": "Total" }],
		            	"footerCallback": function (row, data, start, end, display) {
			                var api = this.api(), data

			                // Remove the formatting to get integer data for summation
				            var intVal = function ( i ) {
				                return typeof i === 'string' ?
				                    i.replace(/[\$,]/g, '')*1 :
				                    typeof i === 'number' ?
				                        i : 0;
				            };
			                columns = [1, 2, 3, 4, 5]; // Add columns here

			       			for (var i = 0; i < columns.length; i++) {
			                    $('#tdmstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
			                }
			            }
				    }); // District Statistic

				    var oIndividualDMNotSubmittedStats = $('#tindividualdmnotsubmittedstats').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "processing": true,
				        "info": true,
				        "paging": true,
				        "autoWidth": false,
				        "scrollCollapse": true,
				        "processing": false,
				        "filter": false,
				        "serverSide": true,
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalDashboard/getDistrictIndividualDMNotSubmittedStats',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
				        	{ "targets": [ 0 ], "data": "description" }]
				    }); // District Statistic
				@endif
			});
			
			@if ($gakkaidistrict == 't')
			    $('#studyexamedit').submit(function(e){
			    	$.ajax({
				        url: 'BOEPortalDashboard/putStudyExamedit',
				        type: 'POST',
				        data: { value: $("#estudyexam").val()},
				        dataType: 'json',
				        statusCode: { 
				        	200:function(){
				        		$("#spanstudyexam").text($("#estudyexam").val());
				        		$("#estudyexam").val(''); 
		            			$("#btnstudyexamedit").modal('hide');
				        	},
				        	400:function(data){ 
				        		var txtMessage;
				        		if (data.responseJSON.ErrType == "Duplicate") 
				        			{ txtMessage = 'Record already existed!'; }
				        		else if (data.responseJSON.ErrType == "Failed")
				        			{ txtMessage = 'Please check your entry!'; }
				        		else { txtMessage = 'Please check your entry!'; }
				        		$("#estudyexam").focus();
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
			@endif

			$('#mddaimokuadd').submit(function(e){
				$.ajax({
					url: 'BOEPortalDashboard/postMDDaimoku',
					type: 'POST',
					data: { value: $("#emddaimoku").val()},
					dataType: 'json',
					statusCode: { 
						200:function(data){
							$("#spanmddaimokuadd").text(data.mddaimokutotal);
							$("#emddaimoku").val(''); 
							$("#btnemddaimokuadd").modal('hide');
						},
						400:function(data){ 
							var txtMessage;
							if (data.responseJSON.ErrType == "Duplicate") 
								{ txtMessage = 'Record already existed!'; }
							else if (data.responseJSON.ErrType == "Failed")
								{ txtMessage = 'Please check your entry!'; }
							else { txtMessage = 'Please check your entry!'; }
							$("#emddaimoku").focus();
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

			$('#boeedit').submit(function(e){
				$.ajax({
					url: 'BOEPortalDashboard/putBOEedit',
					type: 'POST',
					data: { value: $("#eboe").val()},
					dataType: 'json',
					statusCode: { 
						200:function(data){
							$("#spanboe").text(data.campaignvalue);
							$("#eboe").val(''); 
							noty({
								layout: 'topRight', type: 'success', text: 'Thank you very much for your wonderful dialogue efforts in encouraging your members!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
									},
								timeout: 4000
							});
							
							$("#btnboeedit").modal('hide');
						},
						400:function(data){ 
							var txtMessage;
							if (data.responseJSON.ErrType == "Duplicate") 
								{ txtMessage = 'Record already existed!'; }
							else if (data.responseJSON.ErrType == "Failed")
								{ txtMessage = 'Please check your entry!'; }
							else { txtMessage = 'Please check your entry!'; }
							$("#eboe").focus();
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
			
			$('#youthsubmitedit').submit(function(e){
				$.ajax({
					url: 'BOEPortalDashboard/putYouthSubmitedit',
					type: 'POST',
					data: { value: $("#eyouthsubmit").val()},
					dataType: 'json',
					statusCode: { 
						200:function(data){
							$("#spanyouthsubmit").text(data.campaignvalue);
							$("#eyouthsubmit").val(''); 
							noty({
								layout: 'topRight', type: 'success', text: 'Thank you very much for your wonderful dialogue efforts in encouraging your members!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
									},
								timeout: 4000
							});
							$("#btnyouthsubmitedit").modal('hide');
						},
						400:function(data){ 
							var txtMessage;
							if (data.responseJSON.ErrType == "Duplicate") 
								{ txtMessage = 'Record already existed!'; }
							else if (data.responseJSON.ErrType == "Failed")
								{ txtMessage = 'Please check your entry!'; }
							else { txtMessage = 'Please check your entry!'; }
							$("#eyouthsubmit").focus();
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

			$('#discussionmeetingedit').submit(function(e){
				$.ajax({
					url: 'BOEPortalDashboard/putDiscussionMeetingedit',
					type: 'POST',
					data: { value: $("#ediscussionmeeting").val(), division: $("#edivision").val()},
					dataType: 'json',
					statusCode: { 
						200:function(data){
							$("#spandiscussionmeeting").text(data.campaignvalue);
							$("#ediscussionmeeting").val(''); $("#edivision").val('YM');
							noty({
								layout: 'topRight', type: 'success', text: 'Thank you very much for your wonderful dialogue efforts in encouraging your members!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 300 
									},
								timeout: 4000
							});
							$("#btndiscussionmeetingedit").modal('hide');
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