<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>SSASOFT - Soka Volunteer's Group Registration </title>

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
							SSASOFT - Soka Volunteer's Group Registration
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
							<a href="#">Soka Volunteer's Group Registration</a>
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
							<div class="col-xs-12 col-sm-7 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header widget-header-blue widget-header-flat">
										<h4 class="widget-title lighter">Registration Wizard</h4>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<!-- #section:plugins/fuelux.wizard -->
											<div id="fuelux-wizard" data-target="#step-container">
												<!-- #section:plugins/fuelux.wizard.steps -->
												<ul class="wizard-steps">
													<li data-target="#step1" class="active">
														<span class="step">1</span>
														<span class="title">Register</span>
													</li>
													<li data-target="#step2">
														<span class="step">2</span>
														<span class="title">Emergency Contact</span>
													</li>

													<li data-target="#step3">
														<span class="step">3</span>
														<span class="title">Guardian Consent</span>
													</li>

													<li data-target="#step4">
														<span class="step">4</span>
														<span class="title">Confirmation</span>
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
																{{ Form::open(array('id' => 'eventselection', 'class' => 'form-horizontal')) }}
																	<div class="form-group">
																		{{ Form::label('eventselected', 'Select Event:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				{{ Form::select('sevent', $event_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'sevent'));}}
																			</div>
																		</div>
																	</div>
																{{ Form::close() }}
															</div>
														</div>
													</div>
												</div>
												<div class="step-pane" id="step2">
													<div class="widget-box transparent">
														<div class="widget-body">
															<div class="widget-main no-padding">
																{{ Form::open(array('action' => 'EventMemRegistrationController@postNricSearch', 'id' => 'resourcenricesearch', 'class' => 'form-horizontal')) }}
																	<br />
																	<div class="form-group">
																		{{ Form::label('eventselected', 'Event Selected:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				{{ Form::text('eventselected', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'eventselected', 'readonly' => 'true'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		{{ Form::label('nricsearch', 'Search (NRIC):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				{{ Form::text('nricsearch', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'nricsearch'));}}
																			</div>
																		</div>
																	</div>
																	<div class="form-group" hidden>
																		{{ Form::label('eventid', 'Event ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				{{ Form::text('eventid', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'eventid', 'readonly' => 'true'));}}
																			</div>
																		</div>
																	</div>
																{{ Form::close() }}
															</div>
														</div>
													</div>
												</div>
												<div class="step-pane" id="step3">
													<div class="center">
														<h3 class="blue lighter">Introducer Information</h3>
														<p class="red lighter">Should you are not a New Friend, please update your latest particulars with SSA.</p>
														<div class="widget-box transparent">
														<div class="widget-body">
															<div class="widget-main no-padding">
																{{ Form::open(array('action' => 'EventMemRegistrationController@postNricSearch', 'id' => 'resourcenricesearchintroducer', 'class' => 'form-horizontal')) }}
																	<br />
																	<div class="form-group">
																		{{ Form::label('nricsearchintroducer', 'Search Introducer (NRIC):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				{{ Form::text('nricsearchintroducer', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'nricsearchintroducer'));}}
																			</div>
																		</div>
																	</div>
																{{ Form::close() }}
															</div>
														</div>
													</div>
													</div>
												</div>
												<div class="step-pane" id="step4">
													<div class="center">
														<h3 class="green">Confirmation</h3>
														{{ Form::open(array('action' => 'EventMemRegistrationController@postAddMember', 'id' => 'resourceaddmember', 'class' => 'form-horizontal')) }}
															<fieldset>
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
																			{{ Form::select('position', $memposition_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'position'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('tel', 'Tel (Home):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::text('tel', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'tel'));}}
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
																	{{ Form::label('email', 'Email:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::text('email', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'email'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('division', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('division', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'division'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('rhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('rhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'rhq'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('zone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('zone', $zone_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'zone'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('chapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::select('chapter', $chapter_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'chapter'));}}
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
																	{{ Form::label('introducername', 'Introducer Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::text('introducername', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'introducername'));}}
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	{{ Form::label('introducermobile', 'Introducer Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
																	<div class="col-xs-12 col-sm-8">
																		<div class="clearfix">
																			{{ Form::text('introducermobile', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'introducermobile'));}}
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
															</fieldset>
														{{ Form::close() }}
													</div>
												</div>
											</div>

											<!-- /section:plugins/fuelux.wizard.container -->
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
							<div class="col-xs-12 col-md-offset-1 col-sm-4 widget-container-span ui-sortable">
								<div class="widget-box transparent">
									<div class="widget-body">
										<div class="widget-main no-padding">
											<h4 class="text-info">
												I have read and fully understood the conditions stated below: 
												<br />
												我已阅读并充分理解以下说明:
											</h4>
											<ol>
												<li>
													 In the event of an accident or emergency, I permit the organizing committee to seek treatment for myself and I shall bear all medical expenses and related costs.
													<br />
													<span class="lighter blue">发生意外或紧急状况时, 我允许筹委会为我安排治疗, 并由我承担一切医药及相关费用。</span>
												</li>
												<li>
													I will not hold the Association liable in the event of any injury sustained as a result of my participation.
													<br />
													<span class="lighter blue">如果在参加期间受伤,我将不会向学会追究责任。</span>
												</li>
												<li>
													I understand that my application will be subject to a selection process by the organizing committee.
													<br />
													<span class="lighter blue">我了解筹委会将会进行挑选并决定我能否参加。</span>
												</li>
												<li>
													I will abide by the organizing committee’s decision to withdraw my participation should I infringe on any of the rules and regulations of the organization including conduct and discipline.
													<br />
													 <span class="lighter blue">若有违反组织的任何条规，包括品行与纪律方面，我会遵循筹委会取消参加资格的决定。</span>
												</li>
												<li>
													 I consent to disclose the above-stated information to Singapore Soka Association to facilitate my participation in this event; and I agree to the organizing committee’s use of this information for the purpose of the event’s management and operation.
													<br />
													<span class="lighter blue">我同意给予新加坡创价学会以上资料，以利便我参与此活动; 同时我也同意筹委会使用这些资料作为活动的运作管理之用。</span>
												</li>
												<li>
													I understand that photographs and videos of this event, including my participation, will be taken for the purpose of reporting in the official organ papers and website, and for historical archives.
													<br />
													<span class="lighter blue">
													我明白这项活动，包括我参与时的照片和录影，将会被作为学会刊物和网站，以及学会档案之用。</span>
												</li>
											</ol>
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
							Singapore Soka Association &copy; 2013-2017
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

				$('#sevent').change(function() {
				  	$('#eventid').val($('#sevent').val());
				  	$('#eventselected').val($("#sevent option:selected").text());

				  	var wizard = $('#fuelux-wizard').data('wizard')
				  	wizard.currentStep = 2;
					wizard.setState();
				});

				$('#resourcenricesearch').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						nricsearch: {
							required: true,
							minlength: 8
						}
					},
			
					messages: {
						
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $('.resourcenricesearch')).show();
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

				$('#resourcenricesearchintroducer').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						nricsearchintroducer: {
							required: true,
							minlength: 8
						}
					},
			
					messages: {
						
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $('.resourcenricesearch')).show();
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

				$('#eventselection').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						sevent: {
							required: true
						}
					},
			
					messages: {
						
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $('.resourcenricesearch')).show();
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

				$('#resourceaddmember').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						membername: {
							required: true,
							minlength: 3
						},
						position: {
							required: true
						},
						division: {
							required: true
						},
						tel: {
							required: true
						},
						mobile: {
							required: true
						},
						email: {
							required: true,
							email:true
						}
					},
			
					messages: {
						
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $('.resourcenricesearch')).show();
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
				
				$('#termsagree').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						iagree: {
							required: true
						}
					},
			
					messages: {
						
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $('.resourcenricesearch')).show();
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

			})

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
						if(!$('#eventselection').valid()) return false;
						else
						{
							wizard.currentStep = 2;
							wizard.setState();						}
					}
					else if (info.step == 2)
					{
						if(!$('#resourcenricesearch').valid()) return false;
						{
							noty({
								layout: 'topRight', type: 'warning', text: 'Finding ...',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
								timeout: 4000
							});
							$.ajax({
						        url: 'eventregistration/postNricSearch/' + $("#eventid").val(),
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
						        		$("#tel").val(data.tel);
						        		$("#mobile").val(data.mobile);
						        		$("#email").val(data.email);
						        		$("#nricsearch").val("");
						        		
						        		wizard.currentStep = 4;
										wizard.setState();
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
						        			{ txtMessage = 'NRIC does not Exist!  Please enter Introducer Information.'; }
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
					else if (info.step == 3)
					{
						if(!$('#resourcenricesearchintroducer').valid()) return false;
						{
							noty({
								layout: 'topRight', type: 'warning', text: 'Finding ...',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
								timeout: 4000
							});
							$.ajax({
						        url: 'eventregistration/postNricSearch/' + $("#eventid").val(),
						        type: 'POST',
						        data: { nricsearch: $("#nricsearchintroducer").val(), eventid: $("#eventid").val() },
						        dataType: 'json',
						        statusCode: { 
						        	200:function(data){
						        		var now = moment(data).format("DD-MM-YYYY");
						        		$("#nric").val($("#nricsearch").val());
						        		$("#position").val('NF');
						        		$("#rhq").val(data.rhq);
						        		$("#zone").val(data.zone);
						        		$("#chapter").val(data.chapter);
						        		$("#district").val(data.district);
						        		$("#introducername").val(data.name);
										$("#introducermobile").val(data.mobile);
						        		
						        		wizard.currentStep = 4;
										wizard.setState();
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
						        			{ txtMessage = 'NRIC does not Exist!  Please enter Introducer Information.'; }
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
				})
				.on('finished', function(e) {
					if ($("#iagree").is(':checked')) { $("#iagree").val('1'); } else {$("#iagree").val('0'); }
					var wizard = $('#fuelux-wizard').data('wizard')
					
					if(!$('#resourceaddmember').valid()) return false;
					else if ($("#iagree").val() == '0')
					{
						noty({
							layout: 'topRight', type: 'error', text: 'Please agree on the conditions',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
					}
					else
					{
						noty({
							layout: 'topRight', type: 'warning', text: 'Adding Record ...',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
							timeout: 4000
						});
						$.ajax({
					        url: 'eventregistration/postAddMember/' + $("#eventid").val(),
					        type: 'POST',
					        data: { membername: $("#membername").val(), eventid: $("#eventid").val(), memberid: $("#memberid").val(), introducername: $("#introducername").val(), introducermobile: $("#introducermobile").val(), nric: $("#nric").val(), division: $("#division").val(), position: $("#position").val(), rhq: $("#rhq").val(), zone: $("#zone").val(), chapter: $("#chapter").val(), district: $("#district").val(), tel: $("#tel").val(), mobile: $("#mobile").val(), email: $("#email").val()},
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		wizard.currentStep = 1;
									wizard.setState();

									$("#membername").val("");
					        		$("#nric").val("");
					        		$("#tel").val("");
					        		$("#mobile").val("");
					        		$("#email").val("");
					        		$("#division").val("");
					        		$("#position").val("");
					        		$("#rhq").val("");
					        		$("#zone").val("");
					        		$("#chapter").val("");
					        		$("#district").val("");
					        		$("#memberid").val("");
					        		$("#nricsearch").val("");
					        		$("#nricsearchIntroducer").val("");
					        		$('#eventid').val("");
					  				$('#eventselected').val("");
					  				$('#sevent').val("");
					  				$("#introducername").val("");
									$("#introducermobile").val("");

			            			noty({
										layout: 'topRight', type: 'success', text: 'We have registrated your interest!!',
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
											},
										timeout: 4000
									}); 

									bootbox.dialog({
										message: "Thank you! We have registrated your interest!!  Please wait for further notice for our 1st meetup!", 
										buttons: {
											"success" : {
												"label" : "OK",
												"className" : "btn-sm btn-primary"
											}
										}
									});
					        	},
					        	400:function(data){ 

					        		wizard.currentStep = 1;
									wizard.setState();

									$("#membername").val("");
					        		$("#nric").val("");
					        		$("#tel").val("");
					        		$("#mobile").val("");
					        		$("#email").val("");
					        		$("#division").val("");
					        		$("#position").val("");
					        		$("#rhq").val("");
					        		$("#zone").val("");
					        		$("#chapter").val("");
					        		$("#district").val("");
					        		$("#memberid").val("");
					        		$("#nricsearch").val("");
					        		$("#nricsearchIntroducer").val("");
					        		$('#eventid').val("");
					  				$('#eventselected').val("");
					  				$('#sevent').val("");
					  				$("#introducername").val("");
									$("#introducermobile").val("");

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

									bootbox.dialog({
										message: "You have already registered in our Event " + $('#eventselected').val(), 
										buttons: {
											"danger" : {
												"label" : "Cancel",
												"className" : "btn-sm btn-danger"
											}
										}
									});
					        	}
					        }
					    });
					}
				}).on('stepclick', function(e){
					//e.preventDefault();//this will prevent clicking and selecting steps
				});
			
				//jump to a step
				$('#step-jump').on('click', function() {
					var wizard = $('#fuelux-wizard').data('wizard')
					wizard.currentStep = 3;
					wizard.setState();
				})	
			})
		</script>
	</body>
</html>