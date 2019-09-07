<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>SSASoft - Student Division Event Registration</title>

		<meta name="description" content="SSASoft.">
		<meta name="author" content="Chan Kuan Leang">
		<meta name="keyword" content="SSA, Office Automation, Singapore Soka Association, Soka, Soka Gakkai, SGI">
		
		<!-- start: Mobile Specific -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- basic styles -->

		<!-- bootstrap & fontawesome -->
		<link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet">
		<link href="{{{ asset('assets/css/font-awesome.min.css') }}}" rel="stylesheet" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="{{{ asset('assets/css/ace-fonts.css') }}}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{{ asset('assets/css/ace.min.css') }}}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="{{{ asset('assets/css/ace-rtl.min.css') }}}" />
		<link rel="stylesheet" href="{{{ asset('assets/css/ace-skins.min.css') }}}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{{ asset('assets/css/dataTables.responsive.css') }}}" />
		<link rel="stylesheet" href="{{{ asset('assets/css/chosen.css') }}}" />
		<link rel="stylesheet" href="{{{ asset('assets/css/animate.css') }}}" />
		<!--[if lt IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
		<!--ace settings handler-->
		<script type="text/javascript" src="{{{ asset('assets/js/ace-extra.min.js') }}}"></script>
	</head>

	<body class="no-skin">
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Student Division - Event Registration
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>

					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="#">Student Division Event Registration</a>
						</li>
						<li class="active">New</li>
					</ul><!-- .breadcrumb -->

					<div class="nav-search" id="nav-search">
						<form class="form-search">
							<span class="input-icon">
							</span>
						</form>
					</div><!-- #nav-search -->
				</div>

				<div class="page-content">
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header widget-header-blue widget-header-flat">
										<h4 class="widget-title lighter">Student Division Event Registration Wizard</h4>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<!-- #section:plugins/fuelux.wizard -->
											<div id="fuelux-wizard" data-target="#step-container">
												<!-- #section:plugins/fuelux.wizard.steps -->
												<ul class="wizard-steps">
													<li data-target="#step1" class="active">
														<span class="step">1</span>
														<span class="title">Event</span>
													</li>
													<li data-target="#step2">
														<span class="step">2</span>
														<span class="title">Attendee Information</span>
													</li>
												</ul>
												<!-- /section:plugins/fuelux.wizard.steps -->
											</div>
											<hr />
											<!-- #section:plugins/fuelux.wizard.container -->
											<div class="step-content pos-rel" id="step-container">
												<div class="step-pane active" id="step1">
													<div class="widget-box transparent">
														<div class="widget-body">
															<div class="widget-main no-padding">
																<center><h1>30 June 2019</h1></center>
																<center><h1>Youth For Peace Symposium</h1></center>
																<center><h3>1pm to 4pm</h3></center>
																<center><h6><font color="red">Exhibition and registration starts at 1pm.</h6></font></center>
																<center><h6><font color="red">Panel sharing starts at 2pm.</h6></font></center>
																<center><h3>Singapore Soka Association Headquarters</h3></center>
																<center><h3>Ikeda Culture Auditorium</h3></center>
																<center><h3>Attire: Smart Casual</h3></center>
															</div>
														</div>
													</div>
												</div>
												<div class="step-pane" id="step2">
													<div class="widget-box transparent">
														<div class="widget-body">
															<div class="widget-main no-padding">
																<div class="col-xs-12 col-sm-8 widget-container-span ui-sortable">
																	<div class="widget-box widget-color-green">
																		<div class="widget-header widget-header-small">
																			<h6 class="widget-title">
																				<i class="icon-sort"></i>
																				Attendee Information
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
																				{{ Form::open(array('action' => 'EventMemRegistrationController@postAddMemberSD', 'id' => 'resourceintroducerinfo', 'class' => 'form-horizontal')) }}
																					<br />
																					<div class="form-group">
																						{{ Form::label('imembername', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('imembername', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'imembername'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group" hidden>
																						{{ Form::label('nricsearchintroducer', 'NRIC (SSA Member):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('nricsearchintroducer', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nricsearchintroducer'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('imobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('imobile', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'imobile'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						{{ Form::label('email', 'Email:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('email', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'email'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						{{ Form::label('division', 'Gender:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::select('division', array('' => '', 'YM' => 'Male', 'YW' => 'Female'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'division'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						{{ Form::label('groupcontact', 'Institution:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::select('groupcontact', $groupcontact_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'groupcontact'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						{{ Form::label('introducername', 'Inviter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('introducername', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'introducername'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('introducermobile', 'Inviter Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('introducermobile', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'introducermobile'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group">
																						{{ Form::label('subem', 'Subscribe future events/materials:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::checkbox('subem', 1, true, array('id' => 'subem'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group" hidden>
																						{{ Form::label('inricsearch', 'NRIC (If Any):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('inricsearch', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'inricsearch'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group" hidden>
																						{{ Form::label('eventid', 'Event ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('eventid', $eventuniquecode, array('class' => 'col-xs-12 col-sm-9', 'id' => 'eventid', 'readonly' => 'true'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group" hidden>
																						{{ Form::label('memberid', 'Member ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('memberid', '', array('class' => 'col-xs-12 col-sm-9'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group" hidden>
																						{{ Form::label('membername', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('membername', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'membername'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group" hidden>
																						{{ Form::label('rhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::select('rhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'rhq'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group" hidden>
																						{{ Form::label('zone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::select('zone', $zone_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'zone'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group" hidden>
																						{{ Form::label('chapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::select('chapter', $chapter_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'chapter'));}}
																							</div>
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="form-group" hidden>
																						{{ Form::label('district', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('district', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'district'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group" hidden>
																						{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::select('position', $memposition_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'position'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group" hidden>
																						{{ Form::label('mobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('mobile', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'mobile'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group" hidden>
																						{{ Form::label('tel', 'Tel (Home):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-8">
																							<div class="clearfix">
																								{{ Form::text('tel', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'tel'));}}
																							</div>
																						</div>
																					</div>
																					<div class="form-group" hidden>
																						{{ Form::label('introdcermemberid', 'Member ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																						<div class="col-xs-12 col-sm-9">
																							<div class="clearfix">
																								{{ Form::text('introdcermemberid', '0', array('class' => 'col-xs-12 col-sm-9'));}}
																							</div>
																						</div>
																					</div>
																				{{ Form::close() }}
																			</div>
																		</div>
																	</div>
																</div> <!-- Introducer Information -->
																<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
																	<div class="widget-box transparent">
																		<div class="widget-body">
																			<div class="widget-main no-padding">
																				<br /><br />
																				<div align="justify">
																					 I consent to disclose the above-stated information to Singapore Soka Association to facilitate my participation in this event; and I agree to the organizing committee’s use of this information for the purpose of the event’s management and operation.
																					<br />
																					<span class="lighter blue">我同意给予新加坡创价学会以上资料，以利便我参与此活动; 同时我也同意筹委会使用这些资料作为活动的运作管理之用。</span>
																				</div>
																				<div class="widget-box transparent">
																					<div class="widget-body">
																						<div class="widget-main no-padding">
																							{{ Form::open(array('id' => 'termsagree', 'class' => 'form-horizontal')) }}
																								<div class="alert alert-block alert-info">
																									<div class="form-group">
																										<div class="col-xs-12 col-md-offset-1 col-sm-1">
																											<div class="clearfix">
																												{{ Form::checkbox('iagree', '', '', array('id' => 'iagree'));}}
																											</div>
																										</div>
																										{{ Form::label('iagree', 'I agree to the above conditions', array('class' => 'control-label col-xs-12 col-sm-8')); }}
																									</div>
																								</div>
																							{{ Form::close() }}
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div> <!-- Terms and Conditions -->
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- /section:plugins/fuelux.wizard.container -->
											<br/>
											<br/>
											<br/>
											<br/>
											<br/>
											<br/>
											<br/>
											<br/>
											<br/>
											<br/>
											<br/>
											<br/>
											<br/>
											<hr />
											<div class="wizard-actions">
												<!-- #section:plugins/fuelux.wizard.buttons -->
												<button class="btn btn-prev">
													<i class="ace-icon fa fa-arrow-left"></i>
													Prev
												</button>
												<button class="btn btn-success btn-next" data-last="Finish">
													Next
													<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
												</button>
												<!-- /section:plugins/fuelux.wizard.buttons -->
											</div>
											<!-- /section:plugins/fuelux.wizard -->
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div>
							</div> <!-- Register Member -->
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->
			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">SSASoft</span>
							Singapore Soka Association &copy; 2013-2018
						</span>
					</div>
					<!-- /section:basics/footer -->
				</div>
			</div>
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{{{ asset('assets/js/bootstrap.min.js') }}}"></script>

		<!-- page specific plugin scripts -->
		<script type="text/javascript" src="{{{ asset('assets/js/fuelux/fuelux.wizard.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/additional-methods.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/select2.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/bootbox.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/moment.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/noty/packaged/jquery.noty.packaged.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.dataTables.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.dataTables.bootstrap.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/dataTables.responsive.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.dataTables.pipeline.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.dataTables.rowGrouping.js') }}}"></script>
		<!-- ace scripts -->

		<script type="text/javascript" src="{{{ asset('assets/js/ace-elements.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/ace.min.js') }}}"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$(document).ready(function () {
				//documentation : http://docs.jquery.com/Plugins/Validation/validate
			
				$.mask.definitions['~']='[+-]';
			
				jQuery.validator.addMethod("phone", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");

				jQuery.validator.addMethod("mobile", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");

				$('#resourceintroducerinfo').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						imembername: {
							required: true,
							minlength: 3
						},
						imobile: {
							required: true
						},
						division: {
							required: true
						}
					},
			
					messages: {
						
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $('.resourceintroducerinfo')).show();
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
				
				$('#nricsearchintroducer').focusout(function(){
					// noty({
					// 	layout: 'topRight', type: 'warning', text: 'Searching Database ...',
					// 	animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					// 	timeout: 4000
					// });
					$.ajax({
				        url: 'eventregistration/postNricSearch/' + $("#eventid").val(),
				        type: 'POST',
				        data: { nricsearch: $("#nricsearchintroducer").val(), eventid: $("#eventid").val() },
				        dataType: 'json',
				        statusCode: { 
				        	200:function(data){
				        		var now = moment(data).format("DD-MM-YYYY");
				        		$("#position").val('NF');
				        		$("#rhq").val(data.rhq);
				        		$("#zone").val(data.zone);
				        		$("#chapter").val(data.chapter);
				        		$("#district").val(data.district);
				        		$("#division").val(data.division);
				        		$("#imembername").val(data.name);
										$("#imobile").val(data.mobile);
										$("#mobile").val($("#imobile").val());
										$("#email").val(data.email);
										$("#memberid").val(data.uniquecode);
				        	},
				        	400:function(data){ 
				        		var txtMessage = 'Please check your entry!!';
				        		if (data.responseJSON.ErrType == "NoAccess") 
			        			{ txtMessage = 'You do not have access to Update!'; }
			        			else if (data.responseJSON.ErrType == "Does Not Exist")
				        		{
				        			txtMessage = 'Please enter Invitee Information.';
				        		}
				        		else { txtMessage = 'Please check your entry!'; }
				        	}
				        }
				    });
				});
			})

			$('#nricsearchintroducer').keyup(function(){
			    this.value = this.value.toUpperCase();
			});
			
			jQuery(function($) {

				var $validation = false;
				$('#fuelux-wizard')
				.ace_wizard({
					//step: 2 //optional argument. wizard will jump to step "2" at first
				})
				.on('change' , function(e, info){
					var wizard = $('#fuelux-wizard').data('wizard')
					if(info.step == 1) 
					{
						wizard.currentStep = 1;
						wizard.setState();
					}
					else if (info.step == 2)
					{
						if(!$('#resourcenricesearchintroducer').valid())
						{
							noty({
								layout: 'topRight', type: 'warning', text: 'Please agree on the clause to proceed!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
								timeout: 4000
							});
							return false;
						} 
					}
				})
				.on('finished', function(e) {
					var wizard = $('#fuelux-wizard').data('wizard');

					if ($("#iagree").is(':checked')) { $("#iagree").val('1'); } else {$("#iagree").val('0'); }
			    	if ($("#iagree").val() == '1')
					{
						if(!$('#resourceintroducerinfo').valid())
						{
							noty({
								layout: 'topRight', type: 'error', text: 'Please fill the fields!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
								timeout: 4000
							});
						}
						else
						{
							if ($("#subem").is(':checked')) { $("#subem").val('1'); } else {$("#subem").val('0'); }
							$.ajax({
						        url: 'eventregistration/postAddMemberSD/' + $("#eventid").val(),
						        type: 'POST',
						        data: { membername: $("#imembername").val(), eventid: $("#eventid").val(), memberid: $("#memberid").val(), introducername: $("#introducername").val(), introducermobile: $("#introducermobile").val(), introducermemberid: $("#introducermemberid").val(), nric: $("#nric").val(), division: $("#division").val(), position: $("#position").val(), rhq: $("#rhq").val(), zone: $("#zone").val(), chapter: $("#chapter").val(), district: $("#district").val(), tel: $("#tel").val(), mobile: $("#imobile").val(), email: $("#email").val(), groupcontact: $("#groupcontact").val(), subem: $("#subem").val()},
						        dataType: 'json',
						        statusCode: { 
						        	200:function(){
						        		$("#membername").val("");
												$("#imembername").val("");
												$("#introducername").val("");
						        		$("#mobile").val("");
						        		$("#email").val("");
						        		$("#imobile").val("");
												$("#introducermobile").val("");
						        		$("#division").val("");
						        		$("#memberid").val("");
						        		$("#groupcontact").val("");
						        		$("#nricsearchintroducer").val("");

						        		noty({
													layout: 'center', type: 'success', text: 'Thank you very much for your Registration!',
													animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
												},
											closeWith: ['click']
										});
						        	},
						        	400:function(data){ 
						        		$("#membername").val("");
												$("#imembername").val("");
												$("#introducername").val("");
						        		$("#mobile").val("");
						        		$("#email").val("");
						        		$("#imobile").val("");
												$("#introducermobile").val("");
						        		$("#division").val("");
						        		$("#memberid").val("");
						        		$("#groupcontact").val("");
						        		$("#nricsearchintroducer").val("");

						        		wizard.currentStep = 2;
										wizard.setState();

						        		var txtMessage;
						        		if (data.responseJSON.ErrType == "Duplicate") 
						        			{ txtMessage = 'Record already existed!';  }
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
						}
					}
					else
					{
						noty({
							layout: 'topRight', type: 'error', text: 'Please agree on the clause to proceed!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
							timeout: 4000
						});

						wizard.currentStep = 2;
						wizard.setState();
						return false;
					}
				}).on('stepclick', function(e){
					//e.preventDefault();//this will prevent clicking and selecting steps
				});
			
				//jump to a step
				$('#step-jump').on('click', function() {
					var wizard = $('#fuelux-wizard').data('wizard')
					wizard.currentStep = 1;
					wizard.setState();
				})
			})
		</script>
	</body>
</html>