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
			<li><a href="{{{ URL::action('EventController@getIndex') }}}">Events</a></li>
			<li><a href="{{{ URL::action('EventDetailController@getIndex', $eventuniquecode) }}}">{{$eventname}}</a></li>
			<li class="active">New Participant</li>
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
												{{ Form::text('name', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('chinesename', 'Chinese Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('chinesename' , '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('nric', 'NRIC:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('nric', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('dateofbirth', 'DOB:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('dateofbirth', '', array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('email', 'Email:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::email('email', '', array('class' => 'col-xs-12 col-sm-9'));}}
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
												{{ Form::text('tel', '', array('class' => 'col-xs-12 col-sm-9'));}}
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
												{{ Form::text('mobile', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="hr hr-dotted"></div>
									<div class="form-group">
										{{ Form::label('bloodgroup', 'Blood Group:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('bloodgroup', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'bloodgroup'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('nationality', 'Nationality:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('nationality', $country_options, 'Chinese', array('class' => 'col-xs-12 col-sm-9', 'id' => 'nationality'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('countryofbirth', 'Country of Birth:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('countryofbirth', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('race', 'Race:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('race', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('occupation', 'Occupation:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('occupation', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('language', 'Language:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('language', $language_options, 'Chinese', array('class' => 'col-xs-12 col-sm-9', 'id' => 'language'));}}
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
								<br />
								{{ Form::open(array('class' => 'form-horizontal')) }}
									<div class="form-group">
										{{ Form::label('buildingname', 'Building Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('buildingname', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('address', 'Address:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('address' , '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('unitno', 'Unit No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('unitno', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('postalcode', 'Postal Code:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('postalcode', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'postalcode'));}}
											</div>
										</div>
									</div>
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
								<br />
								{{ Form::open(array('class' => 'form-horizontal')) }}
									<div class="form-group">
										{{ Form::label('region', 'Region:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('cbrhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'cbrhq'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('zone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix" id="zonediv">
													{{ Form::select('cbzone', $zone_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'cbzone'));}}
												</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('chapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix" id="chapterdiv">
												{{ Form::select('cbchapter', $chapter_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'cbchapter'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('district', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('district', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('division', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('division', $division_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'division'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('position', $memposition_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'position'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
											{{ Form::label('discussionmeetingday', 'Dis. Mtg Day:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('discussionmeetingday', array('' => '', 'Sun' => 'Sunday', 'Mon' => 'Monday', 'Tue' => 'Tuesday', 'Wed' => 'Wednesday', 'Thu' => 'Thursday', 'Fri' => 'Friday', 'Sat' => 'Saturday'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'discussionmeetingday'));}}
												</div>
											</div>
										</div>

								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>  <!-- Organisation Information -->
				<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable" @if ($REEVGKA == 't') '' @else 'hidden' @endif>
					<div class="widget-box widget-color-blue collapsed">
						<div class="widget-header widget-header-small">
							<h6 class="widget-title">
								<i class="icon-sort"></i>
								Subscription Information For New Friend
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
										{{ Form::label('subscriptionref', 'Ref Code:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('subscriptionref', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'subscriptionref'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('pdpa', 'PDPA:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::checkbox('pdpa', 'false', '', array('id' => 'pdpa'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('subscriptionst', 'Subscribe ST:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::checkbox('subscriptionst', 'false', '', array('id' => 'subscriptionst'));}}
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
												{{ Form::text('ststartdate', '', array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD', 'id' => 'ststartdate'));}}
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
												{{ Form::text('stenddate', '', array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD', 'id' => 'stenddate'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('subscriptioncl', 'Subscribe CL:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::checkbox('subscriptioncl', 'false', '', array('id' => 'subscriptioncl'));}}
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
												{{ Form::text('clstartdate', '', array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD', 'id' => 'clstartdate'));}}
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
												{{ Form::text('clenddate', '', array('class' => 'col-xs-12 col-sm-9', 'placeholder' => 'YYYY-MM-DD', 'id' => 'clenddate'));}}
											</div>
										</div>
									</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div> <!-- Subscription Information -->
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
												{{ Form::select('role', $role_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'role'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('eeventitem', 'Item:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('eeventitem', $eventitem_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'eeventitem'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('ssagroup', 'SSA Group:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('essagroup', $ssagroup_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'essagroup'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('costume9', 'Institution:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('costume9', array('' => '', 'ASD' => 'ASD', 'ITACSD' => 'ITACSD', 'ITESD' => 'ITESD', 'NPSD' => 'NPSD', 'NTUSD' => 'NTUSD', 'NUSSD' => 'NUSSD', 'NYPSD' => 'NYPSD', 'RPSD' => 'RPSD', 'SIMSD' => 'SIMSD', 'SMUSD' => 'SMUSD', 'SPSD' => 'SPSD', 'TPSD' => 'TPSD', 'UnknownSD' => 'UnknownSD', 'Primary 6' => 'Primary 6', 'Secondary 1' => 'Secondary 1', 'Secondary 2' => 'Secondary 2', 'Secondary 3' => 'Secondary 3', 'Secondary 4' => 'Secondary 4', 'Secondary 5' => 'Secondary 5'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'costume9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('auditioncode', 'Audition Code:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('auditioncode', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('groupcode', 'Group Code:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('groupcode', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('cardno', 'Card No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('cardno', '', array('class' => 'col-xs-12 col-sm-9'));}}
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
												{{ Form::text('emergencyname', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('emergencyrelationship', 'Relationship:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('emergencyrelationship' ,'', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('emergencytel', 'Tel:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('emergencytel', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										{{ Form::label('emergencymobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('emergencymobile', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
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
										{{ Form::label('commitwedsat', 'Commit Wed & Sat:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::checkbox('commitwedsat', 'false', '', array('id' => 'commitwedsat'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('travelperiod', 'Travel Period (If Any):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('travelperiod', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<br />
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div> <!-- Training & Committment Information -->
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
												{{ Form::text('introducername', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'introducername'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('introducermobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('introducermobile', '', array('class' => 'col-xs-12 col-sm-9'));}}
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
												{{ Form::textarea('medicalallergy', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'medicalhistory'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('hypertension', 'Hypertension:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::checkbox('hypertension', 'false', '', array('id' => 'hypertension'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('heartdisease', 'Heart Disease:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::checkbox('heartdisease', 'false', '', array('id' => 'heartdisease'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('longtermmedication', 'Long Term Medication:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::checkbox('longtermmedication', 'false', '', array('id' => 'longtermmedication'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('goodhealth', 'Good Health:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::checkbox('goodhealth', 'true', array('id' => 'goodhealth'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('menstrual', 'Menstrual Period:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('menstrual', '', array('class' => 'col-xs-12 col-sm-9'));}}
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
												{{ Form::text('BPReading1', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('BPReading2', 'BP Reading 2:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('BPReading2', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('BPReading3', 'BP Reading 3:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('BPReading3', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('medicalstatus', 'Medical Status:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('medicalstatus', array('Not Measure' => 'Not Measure', 'Passed' => 'Passed', 'Failed' => 'Failed', 'Pending' => 'Pending'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'medicalstatus'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('medicalremarks', 'Medical Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::textarea('medicalremarks', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'medicalremarks'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('medicalofficer', 'Medical Officer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('medicalofficer', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<br />
								{{ Form::close() }}
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
												{{ Form::textarea('drugallergy', '', array('class' => 'col-xs-12 col-sm-9'));}}
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
												{{ Form::select('auditionstatus', array('Not Audit' => 'Not Audit', 'Passed' => 'Passed', 'Failed' => 'Failed', 'Pending' => 'Pending'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'auditionstatus'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('auditionremarks', 'Audition Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::textarea('auditionremarks', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'auditionremarks'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('trainer', 'Trainer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('trainer', '', array('class' => 'col-xs-12 col-sm-9'));}}
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
												{{ Form::text('costume1', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('costume2', 'Costume:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('costume2', array('' => '', 'XXXS' => 'XXXS', 'XXS' => 'XXS', 'XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', 'XXL' => 'XXL', 'XXXL' => 'XXXL'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'costume2'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('shoes', 'Shoes:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('shoes', array('' => '', '35' => '35', '36' => '36', '37' => '37', '38' => '38', '39' => '39', '40' => '40', '41' => '41', '42' => '42', '43' => '43', '44' => '44', '45' => '45', '46' => '46'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'shoes'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('costume4', 'Props:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('costume4', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('costume5', 'MTM:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('costume5', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('costume3', 'T-Shirt (Non Performer):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::select('costume3', array('' => '', '5XS' => '5XS', '4XS' => '4XS', 'XXXS' => 'XXXS', 'XXS' => 'XXS', 'XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', 'XXL' => 'XXL', 'XXXL' => 'XXXL'), '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'costume3'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('costume6', 'Height (cm):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('costume6', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div hidden>
										{{ Form::label('costume7', '7:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('costume7', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
										{{ Form::label('costume8', '8:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('costume8', '', array('class' => 'col-xs-12 col-sm-9'));}}
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
												{{ Form::select('status', $status_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'status'));}}
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
										{{ Form::label('otherremarks', 'Official Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::textarea('otherremarks', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'otherremarks'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('committeemember', 'Committee Member:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('committeemember', '', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div> <!-- Official Information -->
				<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable" hidden>
					<div class="widget-box widget-color-red">
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
												{{ Form::text('eventid', $rid, array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('memberid', 'MemberID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('memberid', '0', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('personid', 'PersonID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												{{ Form::text('personid', '0', array('class' => 'col-xs-12 col-sm-9'));}}
											</div>
										</div>
									</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div> <!-- System Status Information -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box transparent">
						<div class="widget-main no-padding">
							<div class="well well-lg">
								{{ Form::open(array('action' => 'EventDetailParticipantNewController@postParticipantDetail', 'id' => 'fSave', 'class' => 'form-horizontal')) }}
									<fieldset>
										<div align='center'>
											<a href="{{ URL::action('EventDetailController@getIndex', $eventuniquecode) }}" role="button" class="btn btn-lg" data-toggle="modal"><i class="icon-arrow-left"></i>Back to Listing</a>
											{{ Form::button('<i class="icon-ok icon-on-right"></i> Save', array('type' => 'Search', 'class' => 'btn btn-info btn-lg', 'id' => 'btnsave' )); }}
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
@stop
@section('js')
	<script type="text/javascript">
		$('#fSave').submit(function(e) {
			$('#btnsave', this).prop('disabled', 'disabled');
			if ($("#hypertension").is(':checked')) { $("#hypertension").val('1'); } else {$("#hypertension").val('0'); }
			if ($("#heartdisease").is(':checked')) { $("#heartdisease").val('1'); } else {$("#heartdisease").val('0'); }
			if ($("#longtermmedication").is(':checked')) { $("#longtermmedication").val('1'); } else {$("#longtermmedication").val('0'); }
			if ($("#goodhealth").is(':checked')) { $("#goodhealth").val('1'); } else {$("#goodhealth").val('0'); }
			if ($("#commitwedsat").is(':checked')) { $("#commitwedsat").val('1'); } else {$("#commitwedsat").val('0'); }
			if ($("#subscriptionst").is(':checked')) { $("#subscriptionst").val('1'); } else {$("#subscriptionst").val('0'); }
			if ($("#subscriptioncl").is(':checked')) { $("#subscriptioncl").val('1'); } else {$("#subscriptioncl").val('0'); }
			if ($("#pdpa").is(':checked')) { $("#pdpa").val('1'); } else {$("#pdpa").val('0'); }
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
		        	goodhealth: $('#goodhealth').val(), 
		        	menstrual: $('#menstrual').val(), 

		        	commitwedsat: $('#commitwedsat').val(),
		        	travelperiod: $('#travelperiod').val(), 

		        	introducername: $('#introducername').val(), 
		        	introducermobile: $('#introducermobile').val(), 
		        	subscriptionref: $('#subscriptionref').val(),
		        	subscriptionst: $('#subscriptionst').val(),
		        	ststartdate: $('#ststartdate').val(),
		        	stenddate: $('#stenddate').val(),
		        	subscriptioncl: $('#subscriptioncl').val(),
		        	clstartdate: $('#clstartdate').val(),
		        	clenddate: $('#clenddate').val(),
		        	pdpa: $('#pdpa').val(),
		        	
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
		        	costume6: $('#costume6').val(),
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
		        	eeventitem: $('#eeventitem').val(),
		        	cardno: $('#cardno').val(),
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
						window.open("{{ URL::action('EventDetailController@getIndex', $eventuniquecode) }}","_self");
		        	},
		        	400:function(data){ 
		        		var txtMessage;
		        		if (data.responseJSON.ErrType == "Duplicate") 
		        			{ txtMessage = 'Record already existed!'; }
		        		else if (data.responseJSON.ErrType == "Failed")
		        			{ txtMessage = 'Please check your entry!'; }
		        		else if (data.responseJSON.ErrType == "GroupCodeExist")
		        			{ txtMessage = 'Group Code already Exist!  Please check your entry!'; }
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

			$(function() {
				$('#cbrhq').change(function(){
	        		$.ajax({
	        			url: '../ParticipantNew/getZone/' + $('#cbrhq').val(),
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
	        			url: '../ParticipantNew/getChapter/' + $('#cbzone').val(),
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
		});
	</script>
@stop