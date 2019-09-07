<?php

View::composer('layout.master', function($view) 
{  	
  	if (Schema::hasTable('Configuration_m_Default'))
	{
  		$SOFT = DB::table('Configuration_m_Default')->where('key', 'SOFT')->pluck('value');
  		$view->with('coheader', $SOFT);
	}

	$user = Auth::user()->name;
	$view->with('user', $user);

	try // Check Resource Enabled
	{
		$RGCNFI = AccessfCheck::getSystemAdmin(Auth::user()->roleid, 'CNFI');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 1, 0, ' - Access Rights - ' . 'RGCNFI - ' . $e, NULL, NULL, 'Failed'); $RGCNFI = 'f'; 
	}

	try // Check Access Rights \ Company Setup Enabled
	{
		$RGACRI = AccessfCheck::getSoftwareAdmin(Auth::user()->roleid, 'ACRI');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 1, 0, ' - Access Rights - ' . 'RGACRI - ' . $e, NULL, NULL, 'Failed'); $RGACRI = 'f'; 
	}

	try // Check Common Table Enabled
	{
		$RGCMTA = AccessfCheck::getAccessAdmin(Auth::user()->roleid, 'CMTA', 'RG');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 1, 0, ' - Access Rights - ' . 'RGCMTA - ' . $e, NULL, NULL, 'Failed'); $RGCMTA = 'f'; 
	}

	try // Check Common Table - Default Tables Enabled
	{
		$RECT01 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'CT01', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RECT01 - ' . $e, NULL, NULL, 'Failed'); $RECT01 = 'f';
	}

	try // Check Common Table - Default Tables Enabled
	{
		$RECT02 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'CT02', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RECT02 - ' . $e, NULL, NULL, 'Failed'); $RECT02 = 'f';
	}

	try // Check Logs Enabled
	{
		$RGLOGS = AccessfCheck::getAccessAdmin(Auth::user()->roleid, 'LOGS', 'RG');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RGLOGS - ' . $e, NULL, NULL, 'Failed'); $RGLOGS = 'f';
	}

	try // Check Logs - Logs Enabled
	{
		$RELO01 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'LO01', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RELO01 - ' . $e, NULL, NULL, 'Failed'); $RELO01 = 'f';
	}

	try // Check Logs - Default Tables Enabled
	{
		$RELO02 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'LO02', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RELO02 - ' . $e, NULL, NULL, 'Failed'); $RELO02 = 'f';
	}

	try // Check Logs - Report Enabled
	{
		$RELO03 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'LO03', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RELO03 - ' . $e, NULL, NULL, 'Failed'); $RELO03 = 'f';
	}

	try // Check Events Enabled
	{
		$RGEVEN = AccessfCheck::getAccessAdmin(Auth::user()->roleid, 'EVEN', 'RG');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RGEVEN - ' . $e, NULL, NULL, 'Failed'); $RGEVEN = 'f'; 
	}

	try // Check Events - Events Enabled
	{
		$REEV01 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'EV01', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REEV01 - ' . $e, NULL, NULL, 'Failed'); $REEV01 = 'f';
	}

	try // Check Event - Default Tables Enabled
	{
		$REEV02 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'EV02', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REEV02 - ' . $e, NULL, NULL, 'Failed'); $REEV02 = 'f';
	}

	try // Check Event - Listing Enabled
	{
		$REEV03 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'EV03', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REEV03 - ' . $e, NULL, NULL, 'Failed'); $REEV03 = 'f';
	}

	try // Check Event - Report Enabled
	{
		$REEV05 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'EV05', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REEV05 - ' . $e, NULL, NULL, 'Failed');$REEV05 = 'f';
	}

	try // Check Event - Registration Enabled
	{
		$REEV06 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'EV06', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REEV06 - ' . $e, NULL, NULL, 'Failed');$REEV06 = 'f';
	}

	try // Check Event - Subscription Enabled
	{
		$REEV10 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'EV10', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REEV10 - ' . $e, NULL, NULL, 'Failed');$REEV10 = 'f';
	}

	try // Check Groups Enabled
	{
		$RGGRPS = AccessfCheck::getAccessAdmin(Auth::user()->roleid, 'GRPS', 'RG');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RGGRPS - ' . $e, NULL, NULL, 'Failed'); $RGGRPS = 'f'; 
	}

	try // Check Groups - Admin Enabled
	{
		$REGP01 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'GP01', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REGP01 - ' . $e, NULL, NULL, 'Failed'); $REGP01 = 'f';
	}

	try // Check Groups - Default Tables Enabled
	{
		$REGP02= AccessfCheck::getResourceAccess(Auth::user()->roleid, 'GP02', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REGP02 - ' . $e, NULL, NULL, 'Failed'); $REGP02 = 'f';
	}

	try // Check Groups - Listing Enabled
	{
		$REGP03 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'GP03', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REGP03 - ' . $e, NULL, NULL, 'Failed'); $REGP03 = 'f';
	}

	try // Check Groups - Report Enabled
	{
		$REGP05 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'GP05', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REGP05 - ' . $e, NULL, NULL, 'Failed'); $REGP05 = 'f';
	}

	try // Check Attendance Enabled
	{
		$RGATTE = AccessfCheck::getAccessAdmin(Auth::user()->roleid, 'ATTE', 'RG');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RGATTE - ' . $e, NULL, NULL, 'Failed'); $RGATTE = 'f'; 
	}

	try // Check Attendance - Admin Enabled
	{
		$REAT01 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'AT01', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REAT01 - ' . $e, NULL, NULL, 'Failed');$REAT01 = 'f';
	}

	try // Check Attendance - Default Tables Enabled
	{
		$REAT02= AccessfCheck::getResourceAccess(Auth::user()->roleid, 'AT02', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REAT02 - ' . $e, NULL, NULL, 'Failed'); $REAT02 = 'f';
	}

	try // Check Attendance - Listing Enabled
	{
		$REAT03 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'AT03', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REAT03 - ' . $e, NULL, NULL, 'Failed'); $REAT03 = 'f';
	}

	try // Check Attendance - Report Enabled
	{
		$REAT05 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'AT05', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REAT05 - ' . $e, NULL, NULL, 'Failed'); $REAT05 = 'f';
	}

	try // Check Members Enabled
	{
		$RGSSAM = AccessfCheck::getAccessAdmin(Auth::user()->roleid, 'SSAM', 'RG');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RGSSAM - ' . $e, NULL, NULL, 'Failed'); $RGSSAM = 'f'; 
	}

	try // Check Members - Admin Enabled
	{
		$REME01 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'ME01', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REME01 - ' . $e, NULL, NULL, 'Failed'); $REME01 = 'f';
	}

	try // Check Members - Default Tables Enabled
	{
		$REME02 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'ME02', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REME02 - ' . $e, NULL, NULL, 'Failed'); $REME02 = 'f';
	}

	try // Check Members - Listing Enabled
	{
		$REME03 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'ME03', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REME03 - ' . $e, NULL, NULL, 'Failed'); $REME03 = 'f';
	}

	try // Check Members - Report Enabled
	{
		$REME05 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'ME05', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REME05 - ' . $e, NULL, NULL, 'Failed'); $REME05 = 'f';
	}

	try // Check Members - Request Enabled
	{
		$REME06 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'ME06', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REME06 - ' . $e, NULL, NULL, 'Failed'); $REME06 = 'f';
	}

	try // Check Campaign Enabled
	{
		$RGCAMP = AccessfCheck::getAccessAdmin(Auth::user()->roleid, 'CAMP', 'RG');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RGCAMP - ' . $e, NULL, NULL, 'Failed'); $RGCAMP = 'f'; 
	}

	try // Check Campaign - Campaigns Enabled
	{
		$RECP01 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'CP01', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RECP01 - ' . $e, NULL, NULL, 'Failed'); $RECP01 = 'f';
	}

	try // Check Campaign - Default Tables Enabled
	{
		$RECP02 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'CP02', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RECP02 - ' . $e, NULL, NULL, 'Failed'); $RECP02 = 'f';
	}

	try // Check Campaign - Listing Enabled
	{
		$RECP03 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'CP03', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RECP03 - ' . $e, NULL, NULL, 'Failed'); $RECP03 = 'f';
	}

	try // Check Campaign - Report Enabled
	{
		$RECP05 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'CP05', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RECP05 - ' . $e, NULL, NULL, 'Failed');$RECP05 = 'f';
	}

	try // Check Vehicle Enabled
	{
		$RGVEHI = AccessfCheck::getAccessAdmin(Auth::user()->roleid, 'VEHI', 'RG');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RGVEHI - ' . $e , NULL, NULL, 'Failed'); $RGVEHI = 'f'; 
	}

	try // Check Vehicle - Admin Enabled
	{
		$REVE01 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'VE01', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REVE01 - ' . $e, NULL, NULL, 'Failed'); $REVE01 = 'f';
	}

	try // Check Vehicle - Default Tables Enabled
	{
		$REVE02 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'VE02', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REVE02 - ' . $e, NULL, NULL, 'Failed'); $REVE02 = 'f';
	}

	try // Check Vehicle - Listing Enabled
	{
		$REVE03 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'VE03', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REVE03 - ' . $e, NULL, NULL, 'Failed'); $REVE03 = 'f';
	}

	try // Check Vehicle - Booking Enabled
	{
		$REVE05 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'VE05', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REVE05 - ' . $e, NULL, NULL, 'Failed'); $REVE05 = 'f';
	}

	try // Check Vehicle - Cashcard Enabled
	{
		$REVE07 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'VE07', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REVE07 - ' . $e, NULL, NULL, 'Failed'); $REVE07 = 'f';
	}

	try // Check Vehicle - Maintenance Enabled
	{
		$REVE08 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'VE08', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REVE08 - ' . $e, NULL, NULL, 'Failed'); $REVE08 = 'f';
	}

	try // Check Vehicle - Report Enabled
	{
		$REVE09 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'VE09', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'REVE09 - ' . $e, NULL, NULL, 'Failed'); $REVE09 = 'f';
	}

	try // Check Certificate Enabled
	{
		$RGCERT = AccessfCheck::getAccessAdmin(Auth::user()->roleid, 'CERT', 'RG');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RGCERT - ' . $e, NULL, NULL, 'Failed'); $RGCERT = 'f'; 
	}

	try // Check Certificate - Admin Enabled
	{
		$RECE01 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'CE01', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RECE01 - ' . $e, NULL, NULL, 'Failed'); $RECE01 = 'f';
	}

	try // Check Certificate - Default Tables Enabled
	{
		$RECE02= AccessfCheck::getResourceAccess(Auth::user()->roleid, 'CE02', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RECE02 - ' . $e, NULL, NULL, 'Failed'); $RECE02 = 'f';
	}

	try // Check Certificate - Listing Enabled
	{
		$RECE03 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'CE03', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RECE03 - ' . $e, NULL, NULL, 'Failed'); $RECE03 = 'f';
	}

	try // Check Certificate - Report Enabled
	{
		$RECE05 = AccessfCheck::getResourceAccess(Auth::user()->roleid, 'CE05', 'RE', Auth::user()->id);
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 8, 0, ' - Access Rights - ' . 'RECE05 - ' . $e, NULL, NULL, 'Failed'); $RECE05 = 'f';
	}

	$view->with('RGCNFI', $RGCNFI)->with('RGACRI', $RGACRI);
	$view->with('RGCMTA', $RGCMTA)->with('RECT01', $RECT01)->with('RECT02', $RECT02);
	$view->with('RGLOGS', $RGLOGS); $view->with('RELO01', $RELO01); $view->with('RELO02', $RELO02); $view->with('RELO03', $RELO03);
	$view->with('RGEVEN', $RGEVEN); $view->with('REEV01', $REEV01); $view->with('REEV02', $REEV02); $view->with('REEV03', $REEV03); $view->with('REEV05', $REEV05); $view->with('REEV06', $REEV06); $view->with('REEV10', $REEV10);
	$view->with('RGGRPS', $RGGRPS); $view->with('REGP01', $REGP01); $view->with('REGP02', $REGP02); $view->with('REGP03', $REGP03); $view->with('REGP05', $REGP05);
	$view->with('RGCAMP', $RGCAMP); $view->with('RECP01', $RECP01); $view->with('RECP02', $RECP02); $view->with('RECP03', $RECP03); $view->with('RECP05', $RECP05);
	$view->with('RGVEHI', $RGVEHI); $view->with('REVE01', $REVE01); $view->with('REVE02', $REVE02); $view->with('REVE03', $REVE03); $view->with('REVE05', $REVE05); $view->with('REVE07', $REVE07); $view->with('REVE08', $REVE08); $view->with('REVE09', $REVE09);
	$view->with('RGATTE', $RGATTE); $view->with('REAT01', $REAT01); $view->with('REAT02', $REAT02); $view->with('REAT03', $REAT03); $view->with('REAT05', $REAT05);
	$view->with('RGSSAM', $RGSSAM); $view->with('REME01', $REME01); $view->with('REME02', $REME02); $view->with('REME03', $REME03); $view->with('REME05', $REME05); $view->with('REME06', $REME06);
	$view->with('RGCERT', $RGCERT); $view->with('RECE01', $RECE01); $view->with('RECE02', $RECE02); $view->with('RECE03', $RECE03); $view->with('RECE05', $RECE05);
});

View::composer('layout.securitymaster', function($view) 
{  	
  	if (Schema::hasTable('Configuration_m_Default'))
	{
  		$SOFT = DB::table('Configuration_m_Default')->where('key', 'SOFT')->pluck('value');
  		$view->with('coheader', $SOFT);
	}
});

View::composer('layout.leadersportalmaster', function($view) 
{  	
  	if (Schema::hasTable('Configuration_m_Default'))
	{
  		$SOFT = DB::table('Configuration_m_Default')->where('key', 'SOFT')->pluck('value');
  		$view->with('coheader', $SOFT);
	}

	try // Check Resource Enabled
	{
		$RGCNFI = AccessfCheck::getSystemAdmin(Auth::user()->roleid, 'CNFI');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 1, 0, ' - Access Rights - ' . 'RGCNFI - ' . $e, NULL, NULL, 'Failed'); $RGCNFI = 'f'; 
	}

	try // Check Access Rights \ Company Setup Enabled
	{
		$RGACRI = AccessfCheck::getSoftwareAdmin(Auth::user()->roleid, 'ACRI');
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 1, 0, ' - Access Rights - ' . 'RGACRI - ' . $e, NULL, NULL, 'Failed'); $RGACRI = 'f'; 
	}

	try // Check If Region Leader
	{
		$gakkairegion = AccessfCheck::getRegionUser();
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 1, 0, ' - Access Rights - ' . 'Region User - ' . $e, NULL, NULL, 'Failed'); $gakkairegion = 'f'; 
	}

	try // Check If Zone Leader
	{
		$gakkaizone = AccessfCheck::getZoneUser();
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 1, 0, ' - Access Rights - ' . 'Zone User- ' . $e, NULL, NULL, 'Failed'); $gakkaizone = 'f'; 
	}

	try // Check If Chapter Leader
	{
		$gakkaichapter = AccessfCheck::getChapterUser();
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 1, 0, ' - Access Rights - ' . 'Chapter User- ' . $e, NULL, NULL, 'Failed'); $gakkaichapter = 'f'; 
	}

	try // Check If District Leader
	{
		$gakkaidistrict = AccessfCheck::getDistrictUser();
	}
	catch(\Exception $e)
	{
		LogsfLogs::postLogs('Read', 1, 0, ' - Access Rights - ' . 'District User - ' . $e, NULL, NULL, 'Failed'); $gakkaidistrict = 'f'; 
	}

	$view->with('RGCNFI', $RGCNFI)->with('RGACRI', $RGACRI);
	$view->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)->with('gakkaidistrict', $gakkaidistrict);
});

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::action('LoginController@getIndex');
});


Route::filter('auth.basic', function()
{
	return Auth::basic('username');
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('installadmin', function()
{
	# If the Access Users table does not exist
	# or there are no users,
	# redirect to installadmin
	$redirectToInstallAdmin = false;
	if (! Schema::hasTable('Access_m_Users'))
	{
		$redirectToInstallAdmin = true;	
	}
	else
	{
		if (AccessmUsers::all()->count() < 1) {
			$redirectToInstallAdmin = true;
		}
	}
	if ($redirectToInstallAdmin) {
		return Redirect::action('InstallAdminController@getIndex');
	}
});