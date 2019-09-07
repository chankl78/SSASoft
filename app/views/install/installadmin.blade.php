<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>SSASOFT - New Installation</title>

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
		<link rel="stylesheet" href="{{{ asset('assets/css/ace.min.css') }}}" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="{{{ asset('assets/css/ace-rtl.min.css') }}}" />
		<link rel="stylesheet" href="{{{ asset('assets/css/ace-skins.min.css') }}}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{{ asset('assets/css/chosen.css') }}}" />
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
							SSASOFT - New Installation
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
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="sidebar responsive" id="sidebar">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
			</div><!--/#sidebar-->

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>

					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="#">Installation</a>
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
							{{ Form::open(array('action' => 'InstallAdminController@postSetup', 'class' => 'form-horizontal', 'id' => 'installadmin')) }}
								<div class="form-group">
									{{ Form::label('username', 'Username:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											{{ Form::text('username', '', array('class' => 'col-xs-12 col-sm-6'));}}
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									{{ Form::label('password', 'Password:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											{{ Form::password('password', array('class' => 'col-xs-12 col-sm-6'));}}
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									{{ Form::label('password2', 'Confirm Password:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											{{ Form::password('password2', array('class' => 'col-xs-12 col-sm-6'));}}
										</div>
									</div>
								</div>
								<div class="hr hr-dotted"></div>
								<div class="form-group">
									{{ Form::label('name', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											{{ Form::text('name', '', array('class' => 'col-xs-12 col-sm-6'));}}
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									{{ Form::label('email', 'Email:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											{{ Form::email('email', '', array('class' => 'col-xs-12 col-sm-6'));}}
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									{{ Form::label('phone', 'Phone Number:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
									<div class="col-xs-12 col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-phone"></i>
											</span>
											{{ Form::text('phone', '', array('class' => 'col-xs-12 col-sm-3'));}}
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="form-group">
									{{ Form::label('mobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
									<div class="col-xs-12 col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-phone"></i>
											</span>
											{{ Form::text('mobile', '', array('class' => 'col-xs-12 col-sm-3'));}}
										</div>
									</div>
								</div>
								<div class="space-2"></div>
								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">
										{{ Form::submit('Submit', array('class' => 'btn btn-info'));}}
									</div>
								</div>
							{{ Form::close() }}
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
							Singapore Soka Association &copy; 2013-2014
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
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/additional-methods.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/select2.min.js') }}}"></script>
		<!-- ace scripts -->

		<script type="text/javascript" src="{{{ asset('assets/js/ace-elements.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/ace.min.js') }}}"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$(document).ready(function () {
				//documentation : http://docs.jquery.com/Plugins/Validation/validate
			
				$.mask.definitions['~']='[+-]';
				$('#phone').mask('9999 9999');
				$('#mobile').mask('9999 9999');
			
				jQuery.validator.addMethod("phone", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");

				jQuery.validator.addMethod("mobile", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");
				
			})

			$(document).ready(function () {
				$('#installadmin').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						email: {
							required: true,
							email:true
						},
						password: {
							required: true,
							minlength: 6
						},
						password2: {
							required: true,
							minlength: 5,
							equalTo: "#password"
						},
						username: {
							required: true,
							minlength: 6
						},
						name: {
							required: true
						},
						mobile: {
							required: true
						}
					},
			
					messages: {
						email: {
							required: "Please provide a valid email.",
							email: "Please provide a valid email."
						},
						password: {
							required: "Please specify a password.",
							minlength: "Minimum length for password is 6 alpha-numeric characters."
						},
						username: {
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
			});
		</script>
	</body>
</html>