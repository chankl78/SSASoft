<ul class="nav nav-list">
	@if (Session::get('current_page') == 'Dashboard')<li class="active"> @else <li> @endif
	  	<a href="{{{ URL::action('DashboardController@getIndex') }}}">
			<i class="menu-icon fa fa-dashboard"></i><span class="menu-text"> Dashboard</span>
	  	</a>
	</li>
	@if ($RGCNFI == 't')
		<li class="">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-edit"></i> <span class="menu-text">Configuration</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				<li>
					<a href="{{{ URL::action('DashboardController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Company
					</a>
				</li>
				<li>
					<a href="{{{ URL::action('DashboardController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> License
					</a>
				</li>
				<li>
					<a href="{{{ URL::action('DashboardController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Default Code
					</a>
				</li>
				<li>
					<a href="{{{ URL::action('DashboardController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Resource Group
					</a>
				</li>
			</ul>
		</li>
	@endif
	@if ($RGACRI == 't')
		<li>
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-gears"></i><span class="menu-text"> Setup</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				<li>
					<a href="{{{ URL::action('DashboardController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Company
					</a>
				</li>
				<li>
					<a href="{{{ URL::action('DashboardController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Branches
					</a>
				</li>
			</ul>
		</li>
	@endif
	@if ($RGACRI == 't')
		@if (Session::get('current_resource') == 'ACRI')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-key"></i><span class="menu-text"> Access Rights</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if (Session::get('current_page') == 'accessrights/userlisting' )<li class="active"> @else <li> @endif
					<a href="{{{ URL::action('AccessRightsController@getIndex') }}}">
						<i class="menu-icon fa fa-double-angle-right"></i> Users
					</a>
				</li>
				@if (Session::get('current_page') == 'accessrights/roles' )<li class="active">
				@elseif(Session::get('current_page') == 'accessrights/accesstypes')<li class="active"> 
				@elseif(Session::get('current_page') == 'accessrights/status')<li class="active"> 
				@else <li> @endif
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-double-angle-right"></i> Default Setup
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<ul class="submenu" style="display: none;">
						@if (Session::get('current_page') == 'accessrights/accesstypes')<li class="active"> @else <li> @endif
							<a href="{{{ URL::action('AccessRightsController@getAccessTypesIndex') }}}">
								<i class="menu-icon fa fa-key"></i> Access Types
							</a>
						</li>
						@if (Session::get('current_page') == 'accessrights/roles')<li class="active"> @else <li> @endif
							<a href="{{{ URL::action('AccessRightsController@getRolesIndex') }}}">
								<i class="menu-icon fa fa-key"></i> Roles
							</a>
						</li>
						@if (Session::get('current_page') == 'accessrights/status')<li class="active"> @else <li> @endif
							<a href="{{{ URL::action('AccessRightsController@getStatusIndex') }}}">
								<i class="menu-icon fa fa-key"></i>
								Status
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</li>
	@endif
	@if ($RGCMTA == 't')
		@if (Session::get('current_resource') == 'CMTA')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-folder-open"></i><span class="menu-text"> Common Setup</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($RECT01 == 't')
					@if (Session::get('current_page') == 'common/staff' )<li class="active"> @else <li> @endif
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Staff
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							@if (Session::get('current_page') == 'common/staff' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('StaffController@getIndex') }}}">
									<i class="menu-icon fa fa-user"></i> Staff
								</a>
							</li>
							@if (Session::get('current_page') == 'common/staffdepartment' )<li class="active"> @else <li> @endif
								<a href="#"><i class="menu-icon fa fa-user"></i> Department</a>
							</li>
							@if (Session::get('current_page') == 'common/staffposition' )<li class="active"> @else <li> @endif
								<a href="#"><i class="menu-icon fa fa-user"></i> Staff Position</a>
							</li>
							@if (Session::get('current_page') == 'common/stafftype' )<li class="active"> @else <li> @endif
								<a href="#"> <i class="menu-icon fa fa-user"></i> Type </a>
							</li>
							@if (Session::get('current_page') == 'common/staffstatus' )<li class="active"> @else <li> @endif
								<a href="#">
									<i class="menu-icon fa fa-user"></i>
									Staff Status
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($RECT01 == 't')
					@if (Session::get('current_page') == 'common/commonvalue' )<li class="active"> @else <li> @endif
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Common Value
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-folder-open"></i> Status
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</li>
	@endif
	@if ($RGVEHI == 't')
		@if (Session::get('current_resource') == 'VEHI')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-truck"></i><span class="menu-text"> Vehicle</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($REVE05 == 't')
					@if (Session::get('current_page') == 'vehicle/bookvehicle' )<li class="active">@else <li> @endif
						<a href="{{{ URL::action('VehicleController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Book Vehicle
						</a>
					</li>
					@if (Session::get('current_page') == 'vehicle/vehiclebookinglisting' )<li class="active">@else <li> @endif
						<a href="{{{ URL::action('VehicleBookingListingController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Booking Listing
						</a>
					</li>
				@endif
				@if ($REVE01 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Administrator Panel
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-truck"></i> Access Rights
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($REVE03 == 't')
					@if (Session::get('current_page') == 'vehicle/vehiclelisting' )<li class="active">@else <li> @endif
						<a href="{{{ URL::action('VehicleListingController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Vehicle
						</a>
					</li>
				@endif
				@if ($REVE02 == 't')
					@if (Session::get('current_page') == 'vehicle/bookingstatus' )<li class="active">
					@elseif(Session::get('current_page') == 'vehicle/maintenancetype')<li class="active">
					@else <li> @endif
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Default Setup
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							@if (Session::get('current_page') == 'vehicle/maintenancetype' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('VehicleController@getMaintenanceTypeIndex') }}}">
				     					<i class="menu-icon fa fa-truck"></i> Maintainence Type
								</a>
							</li>
							@if (Session::get('current_page') == 'vehicle/vehiclebookingstatus' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('VehicleBookingStatusController@getIndex') }}}">
									<i class="menu-icon fa fa-truck"></i> Booking Status
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</li>
	@endif
	@if ($RGLOGS == 't')
		<li>
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-book"></i><span class="menu-text"> Logs</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($RELO01 == 't')
					<li>
						<a href="{{{ URL::action('DashboardController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Logs
						</a>
					</li>
				@endif
				@if ($RELO03 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Reports
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-book"></i> Report 1
								</a>
							</li>
							<li>
								<a href="#">
									<i class="menu-icon fa fa-book"></i> Report 2
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($RELO02 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Default Setup
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-book"></i> Log Types
								</a>
							</li>
							<li>
								<a href="#">
									<i class="menu-icon fa fa-book"></i> Status
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</li>
	@endif
	@if ($RGEVEN == 't')
		@if (Session::get('current_resource') == 'EVEN')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-bookmark"></i><span class="menu-text"> Events</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($REEV03 == 't')
					@if (Session::get('current_page') == 'event/event' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('EventController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Events
						</a>
					</li>
				@endif
				@if ($REEV10 == 't')
					@if (Session::get('current_page') == 'event/ssamadkenshu' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('EventSSAMADKenshuController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> SSA Mentor and Disciple Training Course
						</a>
					</li>
					@if (Session::get('current_page') == 'event/prekenshu' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('EventPreKenshuController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Pre Kenshu Attendees
						</a>
					</li>
					@if (Session::get('current_page') == 'event/prekenshueligible' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('EventPreKenshuEligibleController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Pre Kenshu Eligible List
						</a>
					</li>
					@if (Session::get('current_page') == 'event/studyexam' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('EventStudyExamController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Study Exam (Passed)
						</a>
					</li>
					@if (Session::get('current_page') == 'event/20194objects' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('Event20194ObjectsController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> 2019 4 Objectives
						</a>
					</li>
					@if (Session::get('current_page') == 'event/subscription' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('EventSubscriptionController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> New Friend Subscription
						</a>
					</li>
				@endif
				@if ($REEV01 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Administrator Panel
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-bookmark"></i> Access Rights
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($REEV02 == 't')
					@if (Session::get('current_page') == 'event/zregistrationstatus' )<li class="active">
					@elseif(Session::get('current_page') == 'event/zeventtype')<li class="active"> 
					@elseif(Session::get('current_page') == 'event/zrole')<li class="active"> 
					@else <li> @endif
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Default Setup
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							@if (Session::get('current_page') == 'event/zeventtype' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('EventzEventTypeController@getIndex') }}}">
									<i class="menu-icon fa fa-bookmark"></i> Event Type
								</a>
							</li>
							@if (Session::get('current_page') == 'event/zregistrationstatus' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('EventzRegistrationStatusController@getIndex') }}}">
									<i class="menu-icon fa fa-bookmark"></i> Registration Status
								</a>
							</li>
							@if (Session::get('current_page') == 'event/zrole' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('EventzRoleController@getIndex') }}}">
									<i class="menu-icon fa fa-bookmark"></i> Roles
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</li>
	@endif
	@if ($RGGRPS == 't')
		@if (Session::get('current_resource') == 'GRPS')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-group"></i><span class="menu-text"> Groups</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($REGP03 == 't')
					@if (Session::get('current_page') == 'group/group' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('GroupController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Groups
						</a>
					</li>
				@endif
				@if ($REGP05 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Reports
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-group"></i> Registration Form (Culture Group)
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($REGP01 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Administrator Panel
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-group"></i> Access Rights
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($REGP02 == 't')
					@if (Session::get('current_page') == 'group/zgrouptype' )<li class="active">
					@elseif(Session::get('current_page') == 'group/zmemberstatus')<li class="active"> 
					@elseif(Session::get('current_page') == 'group/zstatus')<li class="active"> 
					@else <li> @endif
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Default Setup
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							@if (Session::get('current_page') == 'group/zgrouptype' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('GroupzGroupTypeController@getIndex') }}}">
									<i class="menu-icon fa fa-group"></i> Group Type
								</a>
							</li>
							@if (Session::get('current_page') == 'group/zmemberstatus' )<li class="active"> @else <li> @endif<li>
								<a href="{{{ URL::action('GroupzMemberStatusController@getIndex') }}}">
									<i class="menu-icon fa fa-group"></i> Member Status
								</a>
							</li>
							@if (Session::get('current_page') == 'group/zstatus' )<li class="active"> @else <li> @endif<li>
								<a href="{{{ URL::action('GroupzStatusController@getIndex') }}}">
									<i class="menu-icon fa fa-group"></i> Group Status
								</a>
							</li>
							@if (Session::get('current_page') == 'group/zdivisiontype' )<li class="active"> @else <li> @endif<li>
								<a href="{{{ URL::action('GroupzDivisionTypeController@getIndex') }}}">
									<i class="menu-icon fa fa-group"></i> Division Type
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</li>
	@endif
	@if ($RGCAMP == 't')
		@if (Session::get('current_resource') == 'CAMP')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-meetup"></i><span class="menu-text"> Campaigns</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($RECP03 == 't')
					@if (Session::get('current_page') == 'campaign/campaign' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('CampaignController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Campaigns
						</a>
					</li>
				@endif
				@if ($RECP01 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Administrator Panel
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-bookmark"></i> Access Rights
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($RECP02 == 't')
					@if (Session::get('current_page') == 'campaign/zstatus' )<li class="active">
					@elseif(Session::get('current_page') == 'campaign/zleveltype')<li class="active"> 
					@elseif(Session::get('current_page') == 'campaign/zdivisiontype')<li class="active">
					@elseif(Session::get('current_page') == 'campaign/zcampaigntype')<li class="active"> 
					@else <li> @endif
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Default Setup
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							@if (Session::get('current_page') == 'campaign/zcampaigntype' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('CampaignzCampaignTypeController@getIndex') }}}">
									<i class="menu-icon fa fa-meetup"></i> Campaign Type
								</a>
							</li>
							@if (Session::get('current_page') == 'campaign/zdivisiontype' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('CampaignzDivisionTypeController@getIndex') }}}">
									<i class="menu-icon fa fa-meetup"></i> Division Type
								</a>
							</li>
							@if (Session::get('current_page') == 'campaign/zleveltype' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('CampaignzLevelTypeController@getIndex') }}}">
									<i class="menu-icon fa fa-meetup"></i> Level Type
								</a>
							</li>
							@if (Session::get('current_page') == 'campaign/zstatus' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('CampaignzStatusController@getIndex') }}}">
									<i class="menu-icon fa fa-meetup"></i> Status
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</li>
	@endif
	@if ($RGCERT == 't')
		@if (Session::get('current_resource') == 'CERT')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-gift"></i><span class="menu-text"> Gifts</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($RECE03 == 't')
					@if (Session::get('current_page') == 'award/award' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('AwardController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Gifts
						</a>
					</li>
				@endif
				@if ($RECE01 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Administrator Panel
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-gift"></i> Access Rights
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($RECE02 == 't')
					@if (Session::get('current_page') == 'certificate/ztype' )<li class="active">
					@else <li> @endif
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Default Setup
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							@if (Session::get('current_page') == 'group/ztype' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('AwardzTypeController@getIndex') }}}">
									<i class="menu-icon fa fa-gift"></i> Type
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</li>
	@endif
	@if ($RGATTE == 't')
		@if (Session::get('current_resource') == 'ATTE')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-star"></i><span class="menu-text"> Attendance</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($REAT03 == 't')
					@if (Session::get('current_page') == 'attendance/attendance' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('AttendanceController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Attendance
						</a>
					</li>
					@if (Session::get('current_page') == 'attendance/dmstatistic' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('AttendanceDMStatisticController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> DM Statistic
						</a>
					</li>
				@endif
				@if ($REAT01 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Administrator Panel
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-star"></i> Access Rights
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($REAT02 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> 
							Default Setup
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-star"></i> Attendance Type
								</a>
							</li>
							<li>
								<a href="#">
									<i class="menu-icon fa fa-star"></i> Status
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</li>
	@endif
	@if ($RGSSAM == 't')
		@if (Session::get('current_resource') == 'SSAM')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-asterisk"></i><span class="menu-text"> Members</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($REME03 == 't')
					@if (Session::get('current_page') == 'member/listing' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('MemberController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Members
						</a>
					</li>
					@if (Session::get('current_page') == 'member/statistic' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('MemberStatisticController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Members Statistic
						</a>
					</li>
					@if (Session::get('current_page') == 'member/funeralmdchapterandabovelisting' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('MemberController@getFuneralServicesIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Funeral Services
						</a>
					</li>
				@endif
				@if ($REME06 == 't')
					<li>
						<a href="{{{ URL::action('DashboardController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Request
						</a>
					</li>
				@endif
				@if ($REME05 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Reports
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-asterisk"></i> Report 1
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($REME01 == 't')
					@if (Session::get('current_page') == 'member/admin/convert' )<li class="active">
					@elseif(Session::get('current_page') == 'event/member/admin')<li class="active"> 
					@else <li> @endif
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Administrator Panel
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-asterisk"></i> Access Rights
								</a>
							</li>
							@if (Session::get('current_page') == 'member/admin/convert' )<li class="active"> @else <li> @endif
								<a href="{{{ URL::action('MemberController@getConvert') }}}">
									<i class="menu-icon fa fa-asterisk"></i> Conversion
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if ($REME02 == 't')
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-double-angle-right"></i> Default Setup
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu" style="display: none;">
							<li>
								<a href="#">
									<i class="menu-icon fa fa-asterisk"></i> Status
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</li>
	@endif
	@if ($RGCRMA == 't')
		@if (Session::get('current_resource') == 'CRMA')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-exclamation-circle"></i><span class="menu-text"> Crisis Management</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($RECR03 == 't')
					@if (Session::get('current_page') == 'crisis/crisis' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('CrisisManagementController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Crisis Management Listing
						</a>
					</li>
				@endif
			</ul>
		</li>
	@endif
	@if ($RGPUSU == 't')
		@if (Session::get('current_resource') == 'PUSU')<li class="active open"> @else <li> @endif
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-exclamation-circle"></i><span class="menu-text"> Publication Sub</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<ul class="submenu">
				@if ($RECR03 == 't')
					@if (Session::get('current_page') == 'pubsub/pubsubstatistic' )<li class="active"> @else <li> @endif
						<a href="{{{ URL::action('PubSubStatisticController@getIndex') }}}">
							<i class="menu-icon fa fa-double-angle-right"></i> Publication Sub Stats
						</a>
					</li>
				@endif
			</ul>
		</li>
	@endif
</ul><!--/.nav-list-->