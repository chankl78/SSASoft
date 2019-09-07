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
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Registration <small><i class="ace-icon fa fa-angle-double-right"></i>Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@foreach ($result as $result)
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="fa fa-sort"></i>
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
														{{ Form::text('id', $rid, array('class' => 'col-xs-12 col-sm-9', 'id' => 'id'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('userid', 'UserID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::text('userid', Auth::user()->id, array('class' => 'col-xs-12 col-sm-9', 'id' => 'userid'));}}
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
														<i class="icon-phone"></i>
													</span>
													@if($result->tel == 'NIL')
														{{ Form::text('tel', '', array('class' => 'col-xs-12 col-sm-8'));}}
													@else
														{{ Form::text('tel', $result->tel, array('class' => 'col-xs-12 col-sm-8'));}}
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
														<i class="icon-phone"></i>
													</span>
													@if($result->mobile == 'NIL')
														{{ Form::text('mobile', '', array('class' => 'col-xs-12 col-sm-8'));}}
													@else
														{{ Form::text('mobile', $result->mobile, array('class' => 'col-xs-12 col-sm-8'));}}
													@endif
												</div>
											</div>
										</div>
										<div class="hr hr-dotted"></div>
										<div class="form-group">
											{{ Form::label('bloodgroup', 'Blood Group:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('bloodgroup', $result->bloodgroup, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('nationality', 'Nationality:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('nationality', $result->nationality, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('countryofbirth', 'Country of Birth:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('countryofbirth', $result->countryofbirth, array('class' => 'col-xs-12 col-sm-9'));}}
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
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Personal Address / SSA Organisation Information
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
														{{ Form::text('postalcode', '', array('class' => 'col-xs-12 col-sm-9'));}}
													@else
														{{ Form::text('postalcode', $result->postalcode, array('class' => 'col-xs-12 col-sm-9'));}}
													@endif
												</div>
											</div>
										</div>
										<div class="hr hr-dotted"></div>
										<div class="form-group">
											{{ Form::label('region', 'Region:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('region', $result->rhq, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('zone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('zone', $result->zone, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('chapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('chapter', $result->chapter, array('class' => 'col-xs-12 col-sm-9'));}}
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
													{{ Form::text('division', $result->division, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('position', $result->position, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('role', 'Role:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('role', $role_options, $result->role, array('class' => 'col-xs-12 col-sm-9', 'id' => 'role'));}}
												</div>
											</div>
										</div>
										<br />
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box">
							<div class="widget-header widget-header-small header-color-blue">
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
													{{ Form::text('address' ,$result->emergencyrelationship, array('class' => 'col-xs-12 col-sm-9'));}}
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
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box">
							<div class="widget-header widget-header-small header-color-blue">
								<h6 class="widget-title">
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
													{{ Form::textarea('drugallergy', $result->drugallergy, array('class' => 'col-xs-12 col-sm-9'));}}
												</div>
											</div>
										</div>
										<br />
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
						<div class="widget-box transparent">
							<div class="well well-lg">
								{{ Form::open(array('action' => 'EventRegistrationController@PostRegistration', 'id' => 'fRegPost', 'class' => 'form-horizontal')) }}
									<fieldset>
											<div align='center'>
											{{ Form::button('<i class="fa fa-arrow-right icon-on-right"></i> Register', array('type' => 'Search', 'class' => 'btn btn-yellow btn-lg' )); }}
										</div>
									</fieldset>
								{{ Form::close() }}
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
						<div class="widget-box transparent">
							<div class="well well-lg">
								{{ Form::open(array('action' => 'EventRegistrationController@PostRegPrint', 'id' => 'fPrint', 'class' => 'form-horizontal')) }}
									<fieldset>
											<div align='center'>
											{{ Form::button('<i class="fa fa-arrow-right icon-on-right"></i> Print', array('type' => 'Search', 'class' => 'btn btn-info btn-lg' )); }}
										</div>
									</fieldset>
								{{ Form::close() }}
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
						<div class="widget-box transparent">
							<div class="well well-lg">
								<center>
									<a href="{{ URL::action('EventRegistrationSearchController@getIndex') }}" role="button" class="btn btn-danger btn-lg"><i class="fa fa-arrow-right icon-on-right"></i> New Search</a>
								</center>
							</div>
						</div>
					</div>
				@endforeach
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript">
		$('#fRegPost').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: $('#id').val(),
		        type: 'POST',
		        data: { id: $('#id').val(), role: $('#role').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Registered!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
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
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });
		
		$('#fPrint').submit(function(e) {
			noty({
				layout: 'topRight', type: 'warning', text: 'Generating Print Format ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			//var url = '{{URL::to('Event/Registration/Print/')}}' + "/" + {{$rid}};
			var url = '/stimulsoft/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=EventRegistrationHC.mrt&param1=' + $('#userid').val() + '&param2=' + {{ $rid }};
			window.open(url, '_blank');
			$.ajax({
		        url: 'RegPrint/' + {{ $rid }},
		        type: 'POST',
		        data: { id: $('#id').val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Print!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
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
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
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