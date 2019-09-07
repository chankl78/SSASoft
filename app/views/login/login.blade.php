<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>{{ $title }}</title>
		<meta name="description" content="SSASoft.">
		<meta name="author" content="Chan Kuan Leang">
		<meta name="keyword" content="SSA, Office Automation, Singapore Soka Association, Soka, Soka Gakkai, SGI">

		<link rel="shortcut icon" href="{{{ asset('assets/img/favicon.ico') }}}">
		
		<!-- start: Mobile Specific -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- end: Mobile Specific -->

		<!-- bootstrap & fontawesome -->
		<link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet">
		<link href="{{{ asset('assets/css/font-awesome.min.css') }}}" rel="stylesheet" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{{ asset('assets/css/ace-part2.min.css') }}}" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>
		<!-- text fonts -->
		<link rel="stylesheet" href="{{{ asset('assets/css/ace-fonts.css') }}}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{{ asset('assets/css/ace.min.css') }}}" />
		<link rel="stylesheet" href="{{{ asset('assets/css/ace-rtl.min.css') }}}" />
		<!--[if lt IE 9]>
		  <link rel="stylesheet" href="{{{ asset('assets/css/ace-ie.min.css') }}}" />
		<![endif]-->
	</head>
	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				@if (Cache::has('alerts_message_Success_admininstall'))
					<div class="alert alert-block alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="icon-remove"></i>
						</button>
						<p>
							<strong>
								<i class="icon-ok"></i>
								Well done!
							</strong>
							{{ $alert_message }}
						</p>
					</div>
				@endif
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="fa fa-leaf green"></i>
									<span class="blue">SSASoft</span>
								</h1>
								<h4 class="white">&copy; Singapore Soka Association</h4>
							</div>

							<div class="space-6"></div>
							@if (Cache::has('alerts_message_Failed_Registered') || Cache::has('alerts_message_Failed_Login'))
								<div class="alert alert-block alert-danger">
									<button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove"></i>
									</button>
									<p>
										<strong>
											<i class="icon-exclamation"></i>
										</strong>
										{{ $alert_message }}
									</p>
								</div>
							@endif
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-coffee green"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>

											{{ Form::open(array('action' => 'LoginController@postLogin', 'id' => 'login')) }}
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															{{ Form::text('username', '', array('class' => 'form-control', 'placeholder'=>'Username'));}}
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															{{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Password'));}}
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															{{ Form::checkbox('rememberme', '1', true, array('class' => 'ace')); }}
															<span class="lbl"> Remember Me</span>
														</label>
														{{ Form::button('<i class="ace-icon fa fa-key"></i> Login', array('type' => 'submit', 'class' => 'width-35 pull-right btn btn-sm btn-primary')) }}
													</div>
													<div class="space-4"></div>
												</fieldset>
											{{ Form::close(); }}
										</div><!-- /widget-main -->
										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													I forgot my password
												</a>
											</div>
											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													I want to register
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /login-box -->
								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your email and to receive instructions
											</p>

											{{ Form::open(array('action' => 'RemindersController@postRemind', 'id' => 'retrieve')) }}
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															{{ Form::email('email', '', array('class' => 'form-control', 'placeholder'=>'Email')); }}
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>
													<div class="clearfix">
														{{ Form::button('<i class="ce-icon fa fa-lightbulb-o"></i> Send Me!', array('type' => 'submit', 'class' => 'width-35 pull-right btn btn-sm btn-danger')) }}
													</div>
												</fieldset>
											{{ Form::close() }}
										</div><!-- /widget-main -->
										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Back to login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /forgot-box -->
								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												New User Registration
											</h4>
											<div class="space-6"></div>
											<p> Enter your details to begin: </p>
											{{ Form::open(array('action' => 'LoginController@postRegister', 'id' => 'register')) }}
												<fieldset>
													<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::text('gname', '', array('class' => 'form-control', 'placeholder'=>'Name', 'id' => 'gname'));}}
																<i class="ace-icon fa fa-user-md"></i>
															</span>
														</label>
													</div>
													<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::text('gusername', '', array('class' => 'form-control', 'placeholder' => 'Username', 'id' => 'gusername'));}}
																<i class="ace-icon fa fa-user"></i>
															</span>
														</label>
													</div>
													<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::password('gpassword', array('class' => 'form-control', 'placeholder' => 'Password', 'id' => 'gpassword'));}}
																<i class="ace-icon fa fa-lock"></i>
															</span>
														</label>
													</div>
													<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::password('gpassword2', array('class' => 'form-control', 'placeholder' => 'Repeat Password', 'id' => 'gpassword2'));}}
																<i class="ace-icon fa fa-retweet"></i>
															</span>
														</label>
													</div>
													<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::text('gemail', '', array('class' => 'form-control', 'placeholder' => 'Email', 'id' => 'gemail'));}}
																<i class="ace-icon fa fa-envelope"></i>
															</span>
														</label>
													</div>
													<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::text('gphone', '', array('class' => 'form-control', 'placeholder' => 'Telephone', 'id' => 'gphone'));}}
																<i class="ace-icon fa fa-phone"></i>
															</span>
														</label>
													</div>
													<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::text('gmobile', '', array('class' => 'form-control', 'placeholder' => 'Mobile', 'id' => 'gmobile'));}}
																<i class="ace-icon fa fa-mobile-phone"></i>
															</span>
														</label>
													</div>
													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															Reset
														</button>
														{{ Form::button('Register <i class="icon-arrow-right icon-on-right"></i>', array('type' => 'submit', 'class' => 'width-65 pull-right btn btn-sm btn-success')) }}
													</div>
												</fieldset>
											{{ Form::close() }}
										</div>
										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Back to login
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /signup-box -->
							</div><!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->

		<!-- basic scripts -->
		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<script src="{{{ asset('assets/js/bootstrap.min.js') }}}"></script>

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='{{{ asset('assets/js/jquery.mobile.custom.min.js') }}}'>"+"<"+"/script>");
		</script>
		<!-- page specific plugin scripts -->
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/additional-methods.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>
		
		<!-- ace scripts -->
		<script type="text/javascript" src="{{{ asset('assets/js/ace-elements.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/ace.min.js') }}}"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$(document).ready(function () {
				//documentation : http://docs.jquery.com/Plugins/Validation/validate
			
				$.mask.definitions['~']='[+-]';
				$('#gphone').mask('9999 9999');
				$('#gmobile').mask('9999 9999');
			
				jQuery.validator.addMethod("gphone", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");

				jQuery.validator.addMethod("gmobile", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");
				
			})
		</script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#register').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						gemail: {
							required: true,
							email:true
						},
						gpassword: {
							required: true,
							minlength: 6
						},
						gpassword2: {
							required: true,
							minlength: 6,
							equalTo: "#gpassword"
						},
						gusername: {
							required: true,
							minlength: 6
						},
						gname: {
							required: true
						},
						gmobile: {
							required: true
						}
					},
			
					messages: {
						gemail: {
							required: "Please provide a valid email.",
							email: "Please provide a valid email."
						},
						gpassword: {
							required: "Please specify a password.",
							minlength: "Minimum length for password is 6 alpha-numeric characters."
						},
						gusername: {
							required: "Please provide a username.",
							minlength: "Minimum length for username is 6 alpha-numeric characters."
						}
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $('.login-form')).show();
					},
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
						$(e).remove();
					}
				});
			});
		</script>
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
		</script>
	</body>
</html>