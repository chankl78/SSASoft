<ul class="nav nav-list">
	@if (Session::get('lp_current_page') == 'Dashboard')<li class="active"> @else <li> @endif
	  	<a href="{{{ URL::action('LeadersPortalDashboardController@getIndex') }}}">
			<i class="menu-icon fa fa-dashboard"></i><span class="menu-text"> Dashboard</span>
	  	</a>
	</li>
	@if ($gakkaishq == 't')
		@if (Session::get('lp_current_page') == 'LeadersPortal')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-bookmark"></i><span class="menu-text"> SHQ</span>
			</a>
			<ul class="submenu">
				@if (Session::get('lp_current_resource') == 'LeadersPortal/DiscussionMeeting' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalDiscussionMeetingListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Discussion Meeting Attendance
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Event' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalEventListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Event Registration
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Campaign' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalCampaignListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Campaign
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/FD' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalFDController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Youth (13 to 17 Years old)
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/DMStats' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalDMStatsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Discussion Meeting Statistic
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/SSAMADKenshu' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalSSAMADKenshuController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> SSA Mentor and Disciple Training Course (Attended)
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/20194objects' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortal20194ObjectsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> 2019 4 Objectives
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/NewFriend' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalNewFriendsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> New Friends List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Believer' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalBelieversController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Believers List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Member' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalMembersController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Membership List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Leader' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalLeadersController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders List
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Appointment
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Transfer
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Graduation
					</a>
				</li>
			</ul>
		</li> <!-- SHQ -->
	@endif
	@if ($gakkairegion == 't')
		@if (Session::get('lp_current_page') == 'LeadersPortal')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-bookmark"></i><span class="menu-text"> Region</span>
			</a>
			<ul class="submenu">
				@if (Session::get('lp_current_resource') == 'LeadersPortal/DiscussionMeeting' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalDiscussionMeetingListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Discussion Meeting Attendance
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Event' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalEventListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Event Registration
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Campaign' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalCampaignListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Campaign
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/FD' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalFDController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Youth (13 to 17 Years old)
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/DMStats' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalDMStatsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Discussion Meeting Statistic
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/SSAMADKenshu' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalSSAMADKenshuController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> SSA Mentor and Disciple Training Course (Attended)
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/20194objects' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortal20194ObjectsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> 2019 4 Objectives
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/NewFriend' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalNewFriendsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> New Friends List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Believer' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalBelieversController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Believers List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Member' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalMembersController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Membership List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Leader' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalLeadersController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders List
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Appointment
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Transfer
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Graduation
					</a>
				</li>
			</ul>
		</li> <!-- Region -->
	@endif
	@if ($gakkaizone == 't')
		@if (Session::get('lp_current_page') == 'LeadersPortal')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-eye"></i><span class="menu-text"> Zone</span>
			</a>
			<ul class="submenu">
				@if (Session::get('lp_current_resource') == 'LeadersPortal/DiscussionMeeting' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalDiscussionMeetingListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Discussion Meeting Attendance
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Event' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalEventListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Event Registration
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Campaign' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalCampaignListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Campaign
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/FD' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalFDController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Youth (13 to 17 Years old)
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/DMStats' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalDMStatsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Discussion Meeting Statistic
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/SSAMADKenshu' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalSSAMADKenshuController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> SSA Mentor and Disciple Training Course (Attended)
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/20194objects' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortal20194ObjectsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> 2019 4 Objectives
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/NewFriend' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalNewFriendsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> New Friends List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Believer' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalBelieversController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Believers List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Member' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalMembersController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Membership List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Leader' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalLeadersController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders List
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Appointment
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Transfer
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Graduation
					</a>
				</li>
			</ul>
		</li> <!-- Zone -->
	@endif
	@if ($gakkaichapter == 't')
		@if (Session::get('lp_current_page') == 'LeadersPortal')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-thumb-tack"></i><span class="menu-text"> Chapter</span>
			</a>
			<ul class="submenu">
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Statistic
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/DiscussionMeeting' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalDiscussionMeetingListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Discussion Meeting Attendance
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Event' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalEventListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Event Registration
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Campaign' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalCampaignListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Campaign
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/FD' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalFDController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Youth (13 to 17 Years old)
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/DMStats' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalDMStatsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Discussion Meeting Statistic
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/SSAMADKenshu' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalSSAMADKenshuController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> SSA Mentor and Disciple Training Course (Attended)
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/20194objects' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortal20194ObjectsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> 2019 4 Objectives
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/NewFriend' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalNewFriendsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> New Friends List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Believer' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalBelieversController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Believers List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Member' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalMembersController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Membership List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Leader' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalLeadersController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders List
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Appointment
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Transfer
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Leaders Graduation
					</a>
				</li>
			</ul>
		</li> <!-- Chapter -->
	@endif
	@if ($gakkaidistrict == 't')
		@if (Session::get('lp_current_page') == 'LeadersPortal')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-thumb-tack"></i><span class="menu-text"> District</span>
			</a>
			<ul class="submenu">
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Statistic
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/DiscussionMeeting' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalDiscussionMeetingListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Discussion Meeting Attendance
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Event' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalEventListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Event Registration
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Campaign' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalCampaignListingController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Campaign
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/FD' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalFDController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Youth (13 to 17 Years old)
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/DMStats' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalDMStatsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Discussion Meeting Statistic
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/SSAMADKenshu' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalSSAMADKenshuController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> SSA Mentor and Disciple Training Course (Attended)
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/20194objects' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortal20194ObjectsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> 2019 4 Objectives
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/NewFriend' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalNewFriendsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> New Friends List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Believer' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalBelieversController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Believers List
					</a>
				</li>
				@if (Session::get('lp_current_resource') == 'LeadersPortal/Member' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('LeadersPortalMembersController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Membership List
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Event Registration
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Members Transfer
					</a>
				</li>
				<li hidden>
					<a href="#">
						<i class="menu-icon fa fa-double-angle-right"></i> Members Update
					</a>
				</li>
			</ul>
		</li> <!-- District -->
	@endif
</ul><!--/.nav-list-->