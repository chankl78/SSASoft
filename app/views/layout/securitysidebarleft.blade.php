<ul class="nav nav-list">
	@if (Session::get('current_page') == 'Dashboard')<li class="active"> @else <li> @endif
	  	<a href="{{{ URL::action('SecurityDashboardController@getIndex') }}}">
			<i class="menu-icon fa fa-dashboard"></i><span class="menu-text"> Dashboard</span>
	  	</a>
	</li>
	<li>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-bookmark"></i><span class="menu-text"> Occurance</span>
		</a>
	</li>
	<li>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-eye"></i><span class="menu-text"> Attendance</span>
		</a>
	</li>
	<li>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-thumb-tack"></i><span class="menu-text"> Announcement</span>
		</a>
	</li>
</ul><!--/.nav-list-->