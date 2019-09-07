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
				<small><i class="fa fa-leaf"></i> {{ $coheader }}</small>
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
						<span class="user-info">
							<small>Welcome,</small> {{ Auth::user()->name }}
						</span>

						<i class="fa fa-caret-down"></i>
					</a>

					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="{{{ URL::action('UserController@getIndex') }}}">
								<i class="fa fa-user"></i>
								Profile
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a id="hlo">
								<i class="fa fa-power-off"></i>
								Logout
							</a>
						</li>
					</ul>
				</li>
				<!-- /section:basics/navbar.user_menu -->
			</ul><!--/.ace-nav-->
		</div><!-- /section:basics/navbar.dropdown -->
	</div><!-- /.navbar-container -->
</div>