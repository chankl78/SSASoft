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
									<span class="blue">SSA BOE Portal</span>
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

											{{ Form::open(array('action' => 'LeadersPortalLoginController@postLogin', 'id' => 'login')) }}
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															{{ Form::text('username', '', array('class' => 'form-control', 'placeholder'=>'Email', 'id' => 'username'));}}
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															{{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Password', 'id' => 'password'));}}
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
													Re-Verification
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
												Please key in the information below
											</p>

											{{ Form::open(array('action' => 'LeadersPortalLoginController@postReset', 'id' => 'retrieve')) }}
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															{{ Form::email('remail', '', array('class' => 'form-control', 'placeholder'=>'Email (All small letters)', 'id' => 'remail')); }}
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															{{ Form::select('rcbyear', $ddyears, '', array('class' => 'form-control', 'id' => 'rcbyear'));}}
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															{{ Form::password('rpassword', array('class' => 'form-control', 'placeholder' => 'Password', 'id' => 'rpassword'));}}
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															{{ Form::password('rpassword2', array('class' => 'form-control', 'placeholder' => 'Repeat Password', 'id' => 'rpassword2'));}}
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>
													<div class="clearfix">
														{{ Form::button('<i class="ce-icon fa fa-lightbulb-o"></i> Reset!', array('type' => 'submit', 'class' => 'width-35 pull-right btn btn-sm btn-danger')) }}
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
												Re-Verification
											</h4>
											<div class="space-6"></div>
											<p> Enter your email address registered with SSA: </p>
											{{ Form::open(array('action' => 'LeadersPortalLoginController@postVerification', 'id' => 'register')) }}
												<fieldset>
													<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::text('gusername', '', array('class' => 'form-control', 'placeholder' => 'Email', 'id' => 'gusername'));}}
																<i class="ace-icon fa fa-user"></i>
															</span>
														</label>
													</div>
													<div class="form-group">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::password('gpassword', array('class' => 'form-control', 'placeholder' => 'Key in your password', 'id' => 'gpassword'));}}
																<i class="ace-icon fa fa-lock"></i>
															</span>
														</label>
													</div>
													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															Reset
														</button>
														{{ Form::button('Verify <i class="icon-arrow-right icon-on-right"></i>', array('type' => 'submit', 'class' => 'width-65 pull-right btn btn-sm btn-success')) }}
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
							<div class="position-relative">
								<div class="center">
									<h6 class="white">With effect from 1 September, please verify your login through the <span class="green">Re-Verification</span> button for first-time login using this new format.</h6>
									<h6 class="white">Enhanced changes will also be made and informed subsequently.</h6>
									<h6 class="white">We seek your understanding for any inconvenience caused and thank you for the great support.</h6>
								</div>
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
		<script type="text/javascript" src="{{{ asset('assets/js/noty/packaged/jquery.noty.packaged.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/additional-methods.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>
		
		<!-- ace scripts -->
		<script type="text/javascript" src="{{{ asset('assets/js/ace-elements.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/ace.min.js') }}}"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$(document).on('click', '.toolbar a[data-target]', function(e) {
					e.preventDefault();
					var target = $(this).data('target');
					$('.widget-box.visible').removeClass('visible');//hide others
					$(target).addClass('visible');//show target
				});
			});

			$(document).ready(function () {
				$('#nric').keyup(function(){
			    this.value = this.value.toUpperCase();
				});

				$('#register').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						gpassword: {
							required: true,
							minlength: 6
						},
						gusername: {
							required: true,
							email: true
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

			$('#retrieve').submit(function(e){
	    	$.ajax({
		        url: '/boeportallogin/postReset',
		        type: 'POST',
				data: { email: $("#remail").val(), password: $("#rpassword").val(), year: $("#rcbyear").val() },
				async: true,
				timeout: 90000,
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
						noty({
							layout: 'topRight', type: 'success', text: 'Password Resetted!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
						var txtMessage;
		        		if (data.responseJSON.ErrType == "DOB") 
		        			{ txtMessage = 'Some information is wrong.  Please check the fields!';  }
		        		else if (data.responseJSON.ErrType == "Failed")
		        			{ txtMessage = 'Please check your entry!'; }
		        		else if (data.responseJSON.ErrType == "Email")
		        			{ txtMessage = 'Email does not exist!  Please check your email with gakkai department or email ssahq@ssabuddhist.org!'; }
		        		else { txtMessage = 'Please check your entry!'; }
		        		$("#search").focus();
		        		noty({
							layout: 'topRight', type: 'error', text: txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 10000
						});
		        	}
		        }
		    });
		    e.preventDefault();
	    });
		</script>
	</body>
</html>