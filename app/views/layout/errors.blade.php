<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Errors</title>

		<meta name="description" content="Singapore Soka Association Office Automation.">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="Chan Kuan Leang">
		
		<meta name="keyword" content="SSA, Office Automation, Singapore Soka Association, Soka, Soka Gakkai, SGI">

		<!-- start: Mobile Specific -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

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
		<link rel="stylesheet" href="{{{ asset('assets/css/dataTables.responsive.css') }}}" />
		<link rel="stylesheet" href="{{{ asset('assets/css/chosen.css') }}}" />
		<link rel="stylesheet" href="{{{ asset('assets/css/animate.css') }}}" />
		@yield('jsheader')
		<!--[if lt IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
		<!--ace settings handler-->
		<script type="text/javascript" src="{{{ asset('assets/js/ace-extra.min.js') }}}"></script>
	</head>
	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small><i class="fa fa-leaf"></i> Singapore Soka Association</small>
					</a>
					<!-- /section:basics/navbar.layout.brand -->
					<!-- #section:basics/navbar.toggle -->
					<!-- /section:basics/navbar.toggle -->
				</div>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								
							</a>
						</li>
						<!-- /section:basics/navbar.user_menu -->
					</ul><!--/.ace-nav-->
				</div><!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
			<div class="sidebar responsive" id="sidebar">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div><!--/#sidebar-->
			<div class="main-content" id="main-content">
				<!-- #section:basics/content.breadcrumbs -->
				@yield('content')
				<div class="footer">
					<div class="footer-inner">
						<!-- #section:basics/footer -->
						<div class="footer-content">
							<span class="bigger-120">
								<span class="blue bolder">SSASoft</span>
								Singapore Soka Association &copy; 2013 - 2017
							</span>
						</div>
						<!-- /section:basics/footer -->
					</div>
				</div>
				<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
					<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
				</a>
			</div><!-- #main-content -->
		</div><!--/.main-container-->
		@include('layout/javascript')

		<!--inline scripts related to individual page-->
		@yield('js')
	</body>
</html>
