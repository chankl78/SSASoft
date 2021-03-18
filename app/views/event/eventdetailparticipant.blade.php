@extends('layout.master')

@section('content')
	@foreach ($result as $result)
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
				<li class="active">{{$result->name}}</li>
			</ul><!--.breadcrumb-->
		</div><!--#breadcrumbs-->
		<div class="page-content" id="page-content">
			<div class="page-header">
				<h1>Event <small><i class="ace-icon fa fa-angle-double-right"></i> Participant Detail</small></h1>
			</div><!--/.page-header-->
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS HERE -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Participant Information
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div hidden>
											<div class="form-group">
												{{ Form::label('id', 'ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::text('id', $rid, array('class' => 'col-xs-12 col-sm-9'));}}
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('name', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('name', $result->name, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('chinesename', 'Chinese Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('chinesename' , $result->chinesename, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('nric', 'NRIC:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('nric', $result->nric, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('dateofbirth', 'DOB:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('dateofbirth', $result->dateofbirth, array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('email', 'Email:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													@if($result->email == 'NIL')
														{{ Form::email('email', '', array('class' => 'col-xs-12 col-sm-9'));}}
													@else
														{{ Form::email('email', $result->email, array('class' => 'col-xs-12 col-sm-9'));}}
													@endif
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('tel', 'Tel (Home):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-phone"></i>
													</span>
													@if($result->tel == 'NIL')
														{{ Form::text('tel', '', array('class' => 'col-xs-12 col-sm-9'));}}
													@else
														{{ Form::text('tel', $result->tel, array('class' => 'col-xs-12 col-sm-9'));}}
													@endif
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('mobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-mobile"></i>
													</span>
													@if($result->mobile == 'NIL')
														{{ Form::text('mobile', '', array('class' => 'col-xs-12 col-sm-9'));}}
													@else
														{{ Form::text('mobile', $result->mobile, array('class' => 'col-xs-12 col-sm-9'));}}
													@endif
												</div>
											</div>
										</div>
										<div class="hr hr-dotted"></div>
										<div class="form-group">
											{{ Form::label('bloodgroup', 'Blood Group:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('bloodgroup', $result->bloodgroup, array('class' => 'col-xs-12 col-sm-9', 'id' => 'bloodgroup'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('nationality', 'Nationality:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
														{{ Form::select('nationality', $country_options, $result->nationality, array('class' => 'col-xs-12 col-sm-9', 'id' => 'nationality'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('countryofbirth', 'Country of Birth:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
														{{ Form::select('countryofbirth', $country_options, $result->countryofbirth, array('class' => 'col-xs-12 col-sm-9', 'id' => 'countryofbirth'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('race', 'Race:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('race', $result->race, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('occupation', 'Occupation:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('occupation', $result->occupation, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('language', 'Language:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('language', $language_options, $result->language, array('class' => 'col-xs-12 col-sm-9', 'id' => 'language'));}}
												</div>
											</div>
										</div>
										<div class="hr hr-dotted"></div>
										<div class="form-group">
											{{ Form::label('session', 'Session:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('session', $session_options, $result->session, array('class' => 'col-xs-12 col-sm-9', 'id' => 'session'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Participant Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue collapsed">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Personal Address
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('buildingname', 'Building Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													@if($result->buildingname == 'NIL')
														{{ Form::text('buildingname', '', array('class' => 'col-xs-12 col-sm-9'));}}
													@else
														{{ Form::text('buildingname', $result->buildingname, array('class' => 'col-xs-12 col-sm-9'));}}
													@endif
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('address', 'Address:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													@if($result->address == 'NIL')
														{{ Form::text('address' , '', array('class' => 'col-xs-12 col-sm-9'));}}
													@else
														{{ Form::text('address' ,$result->address, array('class' => 'col-xs-12 col-sm-9'));}}
													@endif
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('unitno', 'Unit No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													@if($result->unitno == 'NIL')
														{{ Form::text('unitno', '', array('class' => 'col-xs-12 col-sm-9'));}}
													@else
														{{ Form::text('unitno', $result->unitno, array('class' => 'col-xs-12 col-sm-9'));}}
													@endif
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('postalcode', 'Postal Code:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													@if($result->postalcode == 'NIL')
														{{ Form::text('postalcode', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'postalcode'));}}
													@else
														{{ Form::text('postalcode', $result->postalcode, array('class' => 'col-xs-12 col-sm-9', 'id' => 'postalcode'));}}
													@endif
												</div>
											</div>
										</div>
										<br />
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Personal Address Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									SSA Organisation Information
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('region', 'Region:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('cbrhq', $rhq_options, $result->rhq, array('class' => 'col-xs-12 col-sm-9', 'id' => 'cbrhq'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('zone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix" id="zonediv">
													{{ Form::select('cbzone', $zone_options, $result->zone, array('class' => 'col-xs-12 col-sm-9', 'id' => 'cbzone'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('chapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix" id="chapterdiv">
													{{ Form::select('cbchapter', $chapter_options, $result->chapter, array('class' => 'col-xs-12 col-sm-9', 'id' => 'cbchapter'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('district', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('district', $result->district, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('division', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('division', $division_options, $result->division, array('class' => 'col-xs-12 col-sm-9', 'id' => 'division'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('position', $memposition_options, $result->position, array('class' => 'col-xs-12 col-sm-9', 'id' => 'position'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('discussionmeetingday', 'Dis. Mtg Day:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('discussionmeetingday', array('' => '', 'Sun' => 'Sunday', 'Mon' => 'Monday', 'Tue' => 'Tuesday', 'Wed' => 'Wednesday', 'Thu' => 'Thursday', 'Fri' => 'Friday', 'Sat' => 'Saturday'), $result->discussionmeetingday, array('class' => 'col-xs-12 col-sm-9', 'id' => 'discussionmeetingday'));}}
												</div>
											</div>
										</div>

										<br />
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Organisation Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable" @if ($REEVGKA == 't') '' @else hidden @endif>
						<div class="widget-box widget-color-blue collapsed">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Subscription Information For New Friends
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
									<br />
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<div class="form-group">
											{{ Form::label('eventforward', 'Event From:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('eventforward', $event_options, $result->eventidforward , array('class' => 'col-xs-12 col-sm-9', 'id' => 'eventforward'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('subscriptionref', 'Ref Code:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('subscriptionref', $result->subscriptionref, array('class' => 'col-xs-12 col-sm-9', 'id' => 'subscriptionref'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('pdpa', 'PDPA:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('pdpa', 'false', $result->pdpa, array('id' => 'pdpa'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('subscriptionst', 'Subscribe ST:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('subscriptionst', 'false', $result->subscriptionst, array('id' => 'subscriptionst'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
										{{ Form::label('ststartmonth', 'Start Month:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('ststartmonth', array('' => '', '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'ststartmonth'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('ststartdate', 'ST Start Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('ststartdate', $result->ststartdate, array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD', 'id' => 'ststartdate'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
										{{ Form::label('stnoofmonth', 'No of Month:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('stnoofmonth', array('' => '', '1' => '1', '2' => '2', '3' => '3', '6' => '6', '12' => '12'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'stnoofmonth'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('stenddate', 'ST End Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('stenddate', $result->stenddate, array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD', 'id' => 'stenddate'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('subscriptioncl', 'Subscribe CL:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('subscriptioncl', 'false', $result->subscriptioncl, array('id' => 'subscriptioncl'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
										{{ Form::label('clstartmonth', 'Start Month:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('clstartmonth', array('' => '', '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'clstartmonth'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('clstartdate', 'CL Start Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('clstartdate', $result->clstartdate, array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD', 'id' => 'clstartdate'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
										{{ Form::label('clnoofmonth', 'No of Month:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('clnoofmonth', array('' => '', '1' => '1', '2' => '2', '3' => '3', '6' => '6', '12' => '12'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'clnoofmonth'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('clenddate', 'CL End Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('clenddate', $result->clenddate, array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD', 'id' => 'clenddate'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Subscription Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable" @if ($REEVGKA == 't') '' @else hidden @endif>
						<div class="widget-box widget-color-blue collapsed">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Gohonzon Conferment Information
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
									<br />
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<div class="form-group">
											{{ Form::label('gohonzonapplicationrecddate', 'Form Recd Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('gohonzonapplicationrecddate', date('m/d/Y',strtotime($result->gohonzonapplicationrecddate)), array('class' => 'col-xs-12 col-sm-9 date-picker', 'id' => 'gohonzonapplicationrecddate'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('gohonzontype', 'Gohonzon Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('gohonzontype', $gohonzontype_options, $result->gohonzontype, array('class' => 'col-xs-12 col-sm-9', 'id' => 'gohonzontype'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
										{{ Form::label('gohonzonrecdmonth', 'Received Month:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('gohonzonrecdmonth', array('' => '', '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'), $result->gohonzonrecdmonth, array('class' => 'col-xs-12 col-sm-9', 'id' => 'gohonzonrecdmonth'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('gohonzonrecdyear', 'Received Year:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('gohonzonrecdyear', $result->gohonzonrecdyear, array('class' => 'col-xs-12 col-sm-9', 'id' => 'gohonzonrecdyear'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('gohonzonstatus', 'Status:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('gohonzonstatus', $gohonzonstatus_options, $result->gohonzonstatus, array('class' => 'col-xs-12 col-sm-9', 'id' => 'gohonzonstatus'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('gohonzonremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::textarea('gohonzonremarks', $result->gohonzonremarks, array('class' => 'col-xs-12 col-sm-9', 'id' => 'gohonzonremarks'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Gohonzon Conferment Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-red">
							<div class="widget-header widget-header-small header-color-red">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Registration Detail
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('role', 'Role:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('role', $role_options, $result->role, array('class' => 'col-xs-12 col-sm-9', 'id' => 'role'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('eeventitem', 'Item:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('eeventitem', $eventitem_options, $result->eventitem, array('class' => 'col-xs-12 col-sm-9', 'id' => 'eeventitem'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('ssagroup', 'SSA Group:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('essagroup', $ssagroup_options, $result->ssagroup, array('class' => 'col-xs-12 col-sm-9', 'id' => 'essagroup'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('ssagroupcontact', 'Contact Group:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('essagroupcontact', array('' => '', 'ASD' => 'ASD', 'ITACSD' => 'ITACSD', 'ITESD' => 'ITESD', 'NPSD' => 'NPSD', 'NTUSD' => 'NTUSD', 'NUSSD' => 'NUSSD', 'NYPSD' => 'NYPSD', 'RPSD' => 'RPSD', 'SIMSD' => 'SIMSD', 'SMUSD' => 'SMUSD', 'SPSD' => 'SPSD', 'TPSD' => 'TPSD', 'UnknownSD' => 'UnknownSD', 'Primary 6' => 'Primary 6', 'Secondary 1' => 'Secondary 1', 'Secondary 2' => 'Secondary 2', 'Secondary 3' => 'Secondary 3', 'Secondary 4' => 'Secondary 4', 'Secondary 5' => 'Secondary 5'), $result->ssagroupcontact, array('class' => 'col-xs-12 col-sm-9', 'id' => 'essagroupcontact'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('essagroupalllist', 'SSA Group All:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('essagroupalllist', $result->ssagroupalllist, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('auditioncode', 'Audition Code:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('auditioncode', $result->auditioncode, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('groupcode', 'Group Code:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													<span class="col-xs-12 col-sm-4">
														{{ Form::text('groupcodeprefix', $result->groupcodeprefix, array('class' => 'col-xs-12 col-sm-9', 'placeholder'=>'Prefix', 'id' => 'groupcodeprefix'));}}
													</span>
													<span  class="col-xs-12 col-sm-7">
														{{ Form::text('groupcode', $result->groupcode, array('class' => 'col-xs-12 col-sm-9', 'placeholder'=>'Group Code'));}}
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('cardno', 'Card No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('cardno', $result->cardno, array('class' => 'col-xs-12 col-sm-9', 'id' => 'cardno'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Registration Detail Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-red">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Emergency Contact Information
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('emergencyname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('emergencyname', $result->emergencyname, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('emergencyrelationship', 'Relationship:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('emergencyrelationship' ,$result->emergencyrelationship, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('emergencytel', 'Tel:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													@if($result->emergencytel == 'NIL')
														{{ Form::text('emergencytel', '', array('class' => 'col-xs-12 col-sm-9'));}}
													@else
														{{ Form::text('emergencytel', $result->emergencytel, array('class' => 'col-xs-12 col-sm-9'));}}
													@endif
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('emergencymobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													@if($result->emergencymobile == 'NIL')
														{{ Form::text('emergencymobile', '', array('class' => 'col-xs-12 col-sm-9'));}}
													@else
														{{ Form::text('emergencymobile', $result->emergencymobile, array('class' => 'col-xs-12 col-sm-9'));}}
													@endif
												</div>
											</div>
										</div>
										<br />
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Emergency Contact Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Training Committment & Travelling Information
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('commitwedsat', 'Commit Training:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('commitwedsat', 'false', $result->commitwedsat, array('id' => 'commitwedsat'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('travelperiod', 'Travel Period (If Any):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('travelperiod', $result->travelperiod, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('danceexperience', 'Dance Experience:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('danceexperience', 'false', $result->danceexperience, array('id' => 'danceexperience'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('dancetype', 'Dance Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::textarea('dancetype', $result->dancetype, array('class' => 'col-xs-12 col-sm-9', 'rows' => '2'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Training & Committment & Dance Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Introducer Information
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('introducername', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('introducername', $result->introducer, array('class' => 'col-xs-12 col-sm-9', 'id' => 'introducername'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('introducermobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													@if($result->introducermobile == 'NIL')
														{{ Form::text('introducermobile', '', array('class' => 'col-xs-12 col-sm-9'));}}
													@else
														{{ Form::text('introducermobile', $result->introducermobile, array('class' => 'col-xs-12 col-sm-9'));}}
													@endif
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Introducer Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Injury Information
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('medicalhistory', 'Medical History:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::textarea('medicalallergy', $result->medicalhistory, array('class' => 'col-xs-12 col-sm-9', 'rows' => '2', 'id' => 'medicalhistory'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('hypertension', 'Hypertension:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('hypertension', $result->hypertension, $result->hypertension, array('id' => 'hypertension'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('heartdisease', 'Heart Disease:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('heartdisease', $result->heartdisease, $result->heartdisease, array('id' => 'heartdisease'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('longtermmedication', 'Long Term Medication:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('longtermmedication', $result->longtermmedication, $result->longtermmedication, array('id' => 'longtermmedication'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('asthmahistory', 'Asthma History:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('asthmahistory', $result->asthmahistory, $result->asthmahistory, array('id' => 'asthmahistory'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('goodhealth', 'Good Health:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('goodhealth', $result->goodhealth, $result->goodhealth, array('id' => 'goodhealth'));}}
												</div>
											</div>
										</div>
										<hr>
										<div class="form-group">
											{{ Form::label('pregnant', 'Pregnant:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('pregnant', $result->pregnant, $result->pregnant, array('id' => 'pregnant'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('conceivenextsixmonths', 'Planning Conveive?:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::checkbox('conceivenextsixmonths', $result->conceivenextsixmonths, $result->conceivenextsixmonths, array('id' => 'conceivenextsixmonths'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('menstrual', 'Menstrual Period:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('menstrual', $result->menstrual, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Injury Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Health Screening
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('BPReading1', 'BP Reading 1:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('BPReading1', $result->BPReading1, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('BPReading2', 'BP Reading 2:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('BPReading2', $result->BPReading2, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('BPReading3', 'BP Reading 3:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('BPReading3', $result->BPReading3, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('medicalstatus', 'Medical Status:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('medicalstatus', array('Not Measure' => 'Not Measure', 'Passed' => 'Passed', 'Failed' => 'Failed', 'Pending' => 'Pending'), $result->medicalstatus, array('class' => 'col-xs-12 col-sm-9', 'id' => 'medicalstatus'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('medicalremarks', 'Medical Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::textarea('medicalremarks', $result->medicalremarks, array('class' => 'col-xs-12 col-sm-9', 'rows' => '2', 'id' => 'medicalremarks'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('medicalofficer', 'Medical Officer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('medicalofficer', $result->medicalofficer, array('class' => 'col-xs-12 col-sm-9', 'rows' => '2'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
									<br />
								</div>
							</div>
						</div>
					</div> <!-- Health Screening Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Drug Allegry Information
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('drugallergy', 'Drug Allegry:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::textarea('drugallergy', $result->drugallergy, array('class' => 'col-xs-12 col-sm-9', 'rows' => '2'));}}
												</div>
											</div>
										</div>
										<br />
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Drug Allegry Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Vaccine Information
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('vaccinewillingtake', 'Willing to Take Vaccine:', array('class' => 'control-label col-xs-12 col-sm-5 no-padding-right')); }}
											<div class="col-xs-12 col-sm-7">
												<div class="clearfix">
													{{ Form::checkbox('vaccinewillingtake', $result->vaccinewillingtake, $result->vaccinewillingtake, array('id' => 'vaccinewillingtake'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('vaccinetaken', 'Taken Vaccine?:', array('class' => 'control-label col-xs-12 col-sm-5 no-padding-right')); }}
											<div class="col-xs-12 col-sm-7">
												<div class="clearfix">
													{{ Form::checkbox('vaccinetaken', $result->vaccinetaken, $result->vaccinetaken, array('id' => 'vaccinetaken'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('vaccineschedule', 'Vaccine Status:', array('class' => 'control-label col-xs-12 col-sm-5 no-padding-right')); }}
											<div class="col-xs-12 col-sm-7">
												<div class="clearfix">
													{{ Form::text('vaccineschedule', $result->vaccineschedule, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('vaccineotherpast', 'Taken Other Vaccinations in 2 weeks:', array('class' => 'control-label col-xs-12 col-sm-5 no-padding-right')); }}
											<div class="col-xs-12 col-sm-7">
												<div class="clearfix">
													{{ Form::checkbox('vaccineotherpast', $result->vaccineotherpast, $result->vaccineotherpast, array('id' => 'vaccineotherpast'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('vaccineotherdate', 'Last Vaccine Date (yyyy-mm-dd):', array('class' => 'control-label col-xs-12 col-sm-5 no-padding-right')); }}
											<div class="col-xs-12 col-sm-7">
												<div class="clearfix">
													{{ Form::text('vaccineotherdate', $result->vaccineotherdate, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('vaccineseverlyimmunocompromised', 'Severly Immuno Compromised:', array('class' => 'control-label col-xs-12 col-sm-5 no-padding-right')); }}
											<div class="col-xs-12 col-sm-7">
												<div class="clearfix">
													{{ Form::checkbox('vaccineseverlyimmunocompromised', $result->vaccineseverlyimmunocompromised, $result->vaccineseverlyimmunocompromised, array('id' => 'asthmahistory'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('vaccinehistoryofanaphylaxissevereallergise', 'Anaphylaxis Severe Allergise:', array('class' => 'control-label col-xs-12 col-sm-5 no-padding-right')); }}
											<div class="col-xs-12 col-sm-7">
												<div class="clearfix">
													{{ Form::checkbox('vaccinehistoryofanaphylaxissevereallergise', $result->vaccinehistoryofanaphylaxissevereallergise, $result->vaccinehistoryofanaphylaxissevereallergise, array('id' => 'vaccinehistoryofanaphylaxissevereallergise'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('vaccineconsent', 'Vaccine Consent:', array('class' => 'control-label col-xs-12 col-sm-5 no-padding-right')); }}
											<div class="col-xs-12 col-sm-7">
												<div class="clearfix">
													{{ Form::checkbox('vaccineconsent', $result->vaccineconsent, $result->vaccineconsent, array('id' => 'vaccineconsent'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Vaccine Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-green">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Audition
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('auditionstatus', 'Audition Status:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('auditionstatus', array('Not Audit' => 'Not Audit', 'Passed' => 'Passed', 'Failed' => 'Failed', 'Pending' => 'Pending'), $result->auditionstatus, array('class' => 'col-xs-12 col-sm-9', 'id' => 'auditionstatus'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('auditionremarks', 'Audition Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::textarea('auditionremarks', $result->auditionremarks, array('class' => 'col-xs-12 col-sm-9', 'rows' => '2', 'id' => 'auditionremarks'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('trainer', 'Trainer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('trainer', $result->trainer, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Audition Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-dark">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Costume Measurement
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('costume1', 'Cap:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('costume1', $result->costume1, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('costume2', 'Top:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('costume2', array('' => '', 'B - XXS' => 'B - XXS', 'B - XS' => 'B - XS', 'B - S' => 'B - S', 'B - M' => 'B - M', 'B - L' => 'B - L', 'B - XL' => 'B - XL', 'B - XXL' => 'B - XXL', 'B - XXXL' => 'B - XXXL', 'G - XXS' => 'G - XXS', 'G - XS' => 'G - XS', 'G - S' => 'G - S', 'G - M' => 'G - M', 'G - L' => 'G - L', 'G - XL' => 'G - XL', 'G - XXL' => 'G - XXL', 'G - XXXL' => 'G - XXXL'), $result->costume2, array('class' => 'col-xs-12 col-sm-9', 'id' => 'costume2'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('shoes', 'Shoes:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('shoes', array('' => '', '35' => '35', '36' => '36', '37' => '37', '38' => '38', '39' => '39', '40' => '40', '41' => '41', '42' => '42', '43' => '43', '44' => '44', '45' => '45', '46' => '46'), $result->shoes, array('class' => 'col-xs-12 col-sm-9', 'id' => 'shoes'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('costume4', 'Pants (Waist):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('costume4', array('' => '', 'B - XXS' => 'B - XXS', 'B - XS' => 'B - XS', 'B - S' => 'B - S', 'B - M' => 'B - M', 'B - L' => 'B - L', 'B - XL' => 'B - XL', 'B - XXL' => 'B - XXL', 'B - XXXL' => 'B - XXXL', 'G - XXS' => 'G - XXS', 'G - XS' => 'G - XS', 'G - S' => 'G - S', 'G - M' => 'G - M', 'G - L' => 'G - L', 'G - XL' => 'G - XL', 'G - XXL' => 'G - XXL', 'G - XXXL' => 'G - XXXL'), $result->costume4, array('class' => 'col-xs-12 col-sm-9', 'id' => 'costume4'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('costume5', 'MTM:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('costume5', $result->costume5, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('costume3', 'T-Shirt (Non Performer):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('costume3', array('' => '', '5XS' => '5XS', '4XS' => '4XS', 'XXXS' => 'XXXS', 'XXS' => 'XXS', 'XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', 'XXL' => 'XXL', 'XXXL' => 'XXXL'), $result->costume3, array('class' => 'col-xs-12 col-sm-9', 'id' => 'costume3'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('height', 'Height (cm):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('height', $result->height, array('class' => 'col-xs-12 col-sm-9', 'id' => 'height'));}}
												</div>
											</div>
										</div>
										<div hidden>
											{{ Form::label('costume7', '7:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('costume7', $result->costume7, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
											{{ Form::label('costume8', '8:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('costume8', $result->costume8, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Costume Measurement Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-red">
							<div class="widget-header widget-header-small header-color-red">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Registration Status
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('status', 'Status:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('status', $status_options, $result->status, array('class' => 'col-xs-12 col-sm-9', 'id' => 'status'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Registration Status Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Official Remarks
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('signature', 'Participant Signature:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('signature', $result->signature, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('signaturesigned', 'Signature Date/Time:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('signaturesigned', $result->signaturesigned, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<hr>
										<div class="form-group">
											{{ Form::label('otherremarks', 'Official Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::textarea('otherremarks', $result->otherremarks, array('class' => 'col-xs-12 col-sm-9', 'rows' => '2', 'id' => 'otherremarks'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('committeemember', 'Committee Member:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('committeemember', $result->committeemember, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Official Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable" @if ($REEVGKA == 't') '' @else hidden @endif>
						<div class="widget-box widget-color-red collapsed">
							<div class="widget-header widget-header-small header-color-red">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									System Status
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
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('eventid', 'Event ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('eventid', $result->eventid, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('created_at', 'Created At:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('created_at', $result->created_at, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('updated_at', 'Updated At:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('updated_at', $result->updated_at, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('memberid', 'MemberID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('memberid', $result->memberid, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('personid', 'PersonID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('personid', $result->personid, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('uniquecode', 'Uniquecode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('uniquecode', $result->uniquecode, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- System Status Information -->
					<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Event / Group History
								</h6>
								<div class="widget-toolbar no-border">
									<ul class="nav nav-tabs" id="tabmemberinfo">
										<li class="active">
											<a data-toggle="tab" href="#mevents">Events</a>
										</li>
										<li>
											<a data-toggle="tab" href="#mgroups">Groups</a>
										</li>
										<li>
											<a data-toggle="tab" href="#mmedical">Med</a>
										</li>
										<li>
											<a data-toggle="tab" href="#mallergy">Allgery</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main padding-12 no-padding-left no-padding-right">
									<div class="tab-content padding-4">
										<div id="mevents" class="tab-pane in active">
											<div class="scrollable" data-size="100">
												<table id="tmemberevent" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th class="hidden-480">Date</th>
															<th class="hidden-480">Type</th>
															<th class="hidden-480">Event</th>
															<th class="hidden-480">Role</th>
															<th class="hidden-480">Status</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
										<div id="mgroups" class="tab-pane">
											<div class="scrollable" data-size="100">
												<table id="tgroup" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th class="hidden-480">Group</th>
															<th class="hidden-480">Joined</th>
															<th class="hidden-480">Position</th>
															<th class="hidden-480">Status</th>
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
															<th class="hidden-480">Date</th>
															<th class="hidden-480">Event</th>
															<th class="hidden-480">History</th>
															<th class="hidden-480">Remarks</th>
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
															<th class="hidden-480">Date</th>
															<th class="hidden-480">Event</th>
															<th class="hidden-480">Allergy</th>
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
					</div> <!-- Participation Information -->
					<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box transparent">
							<div class="widget-main no-padding">
								<div class="well well-lg">
									{{ Form::open(array('action' => 'EventDetailParticipantController@putParticipantDetail', 'id' => 'fSave', 'class' => 'form-horizontal')) }}
										<fieldset>
											<div align='center'>
												<a href="{{ URL::action('EventDetailController@getIndex', $eventuniquecode) }}" role="button" class="btn btn-lg" data-toggle="modal"><i class="icon-arrow-left"></i>Back to Listing</a>
												{{ Form::button('<i class="icon-ok icon-on-right"></i> Save', array('type' => 'Search', 'class' => 'btn btn-info btn-lg' )); }}
											</div>
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Save Button -->
					<!-- PAGE CONTENT ENDS HERE -->
				</div><!-- /.col -->
			</div><!--/row-->
		</div><!--/#page-content-->
	@endforeach
@stop
@section('js')
	<script type="text/javascript">
		$('#fSave').submit(function(e) {
			if ($("#hypertension").is(':checked')) { $("#hypertension").val('1'); } else {$("#hypertension").val('0'); }
			if ($("#heartdisease").is(':checked')) { $("#heartdisease").val('1'); } else {$("#heartdisease").val('0'); }
			if ($("#longtermmedication").is(':checked')) { $("#longtermmedication").val('1'); } else {$("#longtermmedication").val('0'); }
			if ($("#asthmahistory").is(':checked')) { $("#asthmahistory").val('1'); } else {$("#asthmahistory").val('0'); }
			if ($("#goodhealth").is(':checked')) { $("#goodhealth").val('1'); } else {$("#goodhealth").val('0'); }
			if ($("#commitwedsat").is(':checked')) { $("#commitwedsat").val('1'); } else {$("#commitwedsat").val('0'); }
			if ($("#subscriptionst").is(':checked')) { $("#subscriptionst").val('1'); } else {$("#subscriptionst").val('0'); }
			if ($("#subscriptioncl").is(':checked')) { $("#subscriptioncl").val('1'); } else {$("#subscriptioncl").val('0'); }
			if ($("#pdpa").is(':checked')) { $("#pdpa").val('1'); } else {$("#pdpa").val('0'); }
			if ($("#danceexperience").is(':checked')) { $("#danceexperience").val('1'); } else {$("#danceexperience").val('0'); }
			if ($("#pregnant").is(':checked')) { $("#pregnant").val('1'); } else {$("#pregnant").val('0'); }
			if ($("#conceivenextsixmonths").is(':checked')) { $("#conceivenextsixmonths").val('1'); } else {$("#conceivenextsixmonths").val('0'); }
			if ($("#vaccinewillingtake").is(':checked')) { $("#vaccinewillingtake").val('1'); } else {$("#vaccinewillingtake").val('0'); }
			if ($("#vaccinetaken").is(':checked')) { $("#vaccinetaken").val('1'); } else {$("#vaccinetaken").val('0'); }
			if ($("#vaccineotherpast").is(':checked')) { $("#vaccineotherpast").val('1'); } else {$("#vaccineotherpast").val('0'); }
			if ($("#vaccineseverlyimmunocompromised").is(':checked')) { $("#vaccineseverlyimmunocompromised").val('1'); } else {$("#vaccineseverlyimmunocompromised").val('0'); }
			if ($("#vaccinehistoryofanaphylaxissevereallergise").is(':checked')) { $("#vaccinehistoryofanaphylaxissevereallergise").val('1'); } else {$("#vaccinehistoryofanaphylaxissevereallergise").val('0'); }
			if ($("#vaccineconsent").is(':checked')) { $("#vaccineconsent").val('1'); } else {$("#vaccineconsent").val('0'); }
			noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record. Please wait for a moment ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: "{{ $rid }}",
		        type: 'POST',
		        data: { id: $('#id').val(), 
		        	name: $('#name').val(), 
		        	chinesename: $('#chinesename').val(), 
		        	nric: $('#nric').val(),
		        	dateofbirth: $('#dateofbirth').val(), 
		        	email: $('#email').val(), 
		        	tel: $('#tel').val(), 
		        	mobile: $('#mobile').val(), 
		        	bloodgroup: $('#bloodgroup').val(),
		        	nationality: $('#nationality').val(),
		        	countryofbirth: $('#countryofbirth').val(),
		        	race: $('#race').val(), 
		        	occupation: $('#occupation').val(),
		        	language: $('#language').val(), 
					session: $('#session').val(), 

		        	buildingname: $('#buildingname').val(), 
		        	address: $('#address').val(), 
		        	unitno: $('#unitno').val(), 
		        	postalcode: $('#postalcode').val(), 
		        	region: $('#cbrhq').val(), 
		        	zone: $('#cbzone').val(), 
		        	chapter: $('#cbchapter').val(), 
		        	district: $('#district').val(), 
		        	position: $('#position').val(), 
		        	division: $('#division').val(),
		        	discussionmeetingday: $('#discussionmeetingday').val(),

		        	emergencyname: $('#emergencyname').val(), 
		        	emergencyrelationship: $('#emergencyrelationship').val(), 
		        	emergencytel: $('#emergencytel').val(), 
		        	emergencymobile: $('#emergencymobile').val(), 

		        	drugallergy: $('#drugallergy').val(), 

		        	medicalhistory: $('#medicalhistory').val(), 
		        	hypertension: $('#hypertension').val(), 
		        	heartdisease: $('#heartdisease').val(), 
		        	longtermmedication: $('#longtermmedication').val(), 
					asthmahistory: $('#asthmahistory').val(), 
		        	goodhealth: $('#goodhealth').val(), 

		        	menstrual: $('#menstrual').val(), 
					pregnant: $('#pregnant').val(), 
					conceivenextsixmonths: $('#conceivenextsixmonths').val(), 

					vaccinewillingtake: $('#vaccinewillingtake').val(), 
		        	vaccinetaken: $('#vaccinetaken').val(), 
		        	vaccineschedule: $('#vaccineschedule').val(), 
		        	vaccineotherpast: $('#vaccineotherpast').val(), 
					vaccineotherdate: $('#vaccineotherdate').val(), 
		        	vaccineseverlyimmunocompromised: $('#vaccineseverlyimmunocompromised').val(),
					vaccinehistoryofanaphylaxissevereallergise: $('#vaccinehistoryofanaphylaxissevereallergise').val(), 
		        	vaccineconsent: $('#vaccineconsent').val(),

		        	commitwedsat: $('#commitwedsat').val(),
		        	travelperiod: $('#travelperiod').val(), 
					danceexperience: $('#danceexperience').val(),
		        	dancetype: $('#dancetype').val(), 

		        	introducername: $('#introducername').val(), 
		        	introducermobile: $('#introducermobile').val(),
		        	subscriptionref: $('#subscriptionref').val(),
		        	pdpa: $('#pdpa').val(),
		        	subscriptionst: $('#subscriptionst').val(),
		        	ststartdate: $('#ststartdate').val(),
		        	stenddate: $('#stenddate').val(),
		        	subscriptioncl: $('#subscriptioncl').val(),
		        	clstartdate: $('#clstartdate').val(),
		        	clenddate: $('#clenddate').val(),

		        	gohonzonapplicationrecddate: $('#gohonzonapplicationrecddate').val(),
		        	gohonzontype: $('#gohonzontype').val(),
		        	gohonzonrecdmonth: $('#gohonzonrecdmonth').val(),
		        	gohonzonrecdyear: $('#gohonzonrecdyear').val(),
		        	gohonzonstatus: $('#gohonzonstatus').val(),
		        	gohonzonremarks: $('#gohonzonremarks').val(),

		        	BPReading1: $('#BPReading1').val(), 
		        	BPReading2: $('#BPReading2').val(), 
		        	BPReading3: $('#BPReading3').val(), 
		        	medicalstatus: $('#medicalstatus').val(), 
		        	medicalremarks: $('#medicalremarks').val(), 
		        	medicalofficer: $('#medicalofficer').val(), 

		        	auditionstatus: $('#auditionstatus').val(), 
		        	auditionremarks: $('#auditionremarks').val(), 
		        	trainer: $('#trainer').val(), 

		        	costume1: $('#costume1').val(), 
		        	costume2: $('#costume2').val(), 
		        	costume3: $('#costume3').val(), 
		        	costume4: $('#costume4').val(), 
		        	costume5: $('#costume5').val(), 
		        	height: $('#height').val(),
		        	costume7: $('#costume7').val(),
		        	costume8: $('#costume8').val(),
		        	costume9: $('#costume9').val(),
		        	shoes: $('#shoes').val(), 

		        	otherremarks: $('#otherremarks').val(), 
		        	committeemember: $('#committeemember').val(), 

		        	status: $('#status').val(), 
		        	role: $('#role').val(),

		        	eventid: $('#eventid').val(), 
		        	memberid: $('#memberid').val(), 
		        	personid: $('#personid').val(),
		        	auditioncode: $('#auditioncode').val(),
		        	essagroup: $('#essagroup').val(),
		        	essagroupcontact: $('#essagroupcontact').val(),
		        	essagroupalllist: $('#essagroupalllist').val(),
		        	eeventitem: $('#eeventitem').val(),
		        	cardno: $('#cardno').val(),
		        	groupcodeprefix: $('#groupcodeprefix').val(),
		        	groupcode: $('#groupcode').val()
		        },
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
		        		else if (data.responseJSON.ErrType == "GroupCodeExist")
		        			{ txtMessage = 'Group Code already Exist!  Please check your entry!'; }
		        		else if (data.responseJSON.ErrType == "NoAccess") 
		        			{ txtMessage = 'You do not have Access Rights!'; }
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
			$('#ststartmonth').change(function () {
				$("#ststartdate").val(moment().get('year') + '-' + $("#ststartmonth").val() + '-01');
				$("#ststartmonth").val('');
			});
			
			$('#stnoofmonth').change(function () {
				var addmonth = moment($("#ststartdate").val()).format("YYYY-MM-DD");
				var addmonth2 = moment(addmonth).add(parseInt($('#stnoofmonth').val()), 'month').format("YYYY-MM-DD");
				var endmonthdate =  moment(addmonth2).add(1, 'month').date(0).format("YYYY-MM-DD");
				$("#stenddate").val(moment(addmonth2).add(1, 'month').date(0).format("YYYY-MM-DD"));
				$("#stnoofmonth").val('');
			});

			$('#clstartmonth').change(function () {
				$("#clstartdate").val(moment().get('year') + '-' + $("#clstartmonth").val() + '-01');
				$("#clstartmonth").val('');
			});
			
			$('#clnoofmonth').change(function () {
				var addmonth = moment($("#clstartdate").val()).format("YYYY-MM-DD");
				var addmonth2 = moment(addmonth).add(parseInt($('#clnoofmonth').val()), 'month').format("YYYY-MM-DD");
				var endmonthdate =  moment(addmonth2).add(1, 'month').date(0).format("YYYY-MM-DD");
				$("#clenddate").val(moment(addmonth2).add(1, 'month').date(0).format("YYYY-MM-DD"));
				$("#clnoofmonth").val('');
			});

			$('#gohonzonapplicationrecddate').datepicker({
                currentText: "Now",
                dateFormat: "m-d-Y",
                gotoCurrent: true
            });

			$(function() {
				$('#cbrhq').change(function(){
	        		$.ajax({
	        			url: '../Participant/getZone/' + $('#cbrhq').val(),
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
	        			url: '../Participant/getChapter/' + $('#cbzone').val(),
	        			type: 'get',
	        			dataType: 'html',
	        			statusCode: { 
	        				200:function(data){
	        					$('#chapterdiv').html(data);
	        				}
	        			}
	        		});
	        	});

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
			            url: 'getMemberGroupInfo/' + "{{ $rid }}",
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
			    }); // Culture Group / Function Group
				
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
			            url: 'getMemberEventMedicalInfo/' + "{{ $rid }}",
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
			    }); // Culture Group / Function Group Medical Remarks
				
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
			            url: 'getMemberEventAllergyInfo/' + "{{ $rid }}",
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
			    }); // Culture Group / Function Group Allegry

				var oEventTable = $('#tmemberevent').DataTable({
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
			            url: 'getMemberEventParticipationInfo/' + "{{ $rid }}",
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
			    	{ "targets": [ 2 ], "data": "eventname", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "role", "searchable": "true" },
			    	{ 
			    		"targets": [ 4 ], "data": "status", "searchable": "true",
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
			    	}]
			    }); // Culture Group / Function Group Event participation
			});
		});
	</script>
@stop