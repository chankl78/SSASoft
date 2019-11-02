<?php
class Event20194ObjectsController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'event/20194objects');
		Session::put('current_resource', 'EVEN');
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$view = View::make('event/eventfourobjects2019');
		$view->title = '2019 4 Objectives';
		$view->with('REEVGKA', $REEVGKA);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$default = zz20194objects::get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 28, 0, ' - 2019 4 Objectives [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postStatistic()
	{
		DB::table('zz_2019_4objects')->truncate();
		
		DB::statement('INSERT INTO zz_2019_4objects (rhq, zone, chapter, district)
			SELECT rhqabbv, zoneabbv, chapabbv, district FROM Members_z_OrgChart WHERE id NOT IN (1,2)
			ORDER BY rhq, zone, chapter, district');
		DB::statement('UPDATE zz_2019_4objects zz LEFT JOIN (
			SELECT aa.rhq, aa.zone, aa.chapter, aa.district, MAX(aa.attendancetotal) as "Highest", cd.value as "Target"
			FROM Attendance_m_Attendance aa LEFT JOIN Campaign_m_Detail cd on aa.rhq = cd.rhq and aa.zone = cd.zone and aa.chapter = cd.chapter and aa.district = cd.district
			WHERE aa.attendancetype = "Discussion Meeting" and YEAR(aa.attendancedate) = 2019 and aa.district NOT IN ("-") and cd.campaignid = 8
			GROUP BY aa.rhq, aa.zone, aa.chapter, aa.district
			ORDER BY aa.rhq, aa.zone, aa.chapter, aa.district) aa on zz.rhq = aa.rhq and zz.zone = aa.zone and zz.chapter = aa.chapter and zz.district = aa.district
			SET zz.dmtarget = aa.Target, zz.dmactual = aa.Highest;');
		DB::statement('UPDATE zz_2019_4objects zz LEFT JOIN (
			SELECT cd.rhq, cd.zone, cd.chapter, cd.district, cd.value as "Target", SUM(er.actual) as "Actual"
			FROM Campaign_m_Detail cd LEFT JOIN (SELECT id, rhq, zone, chapter, district, 1 as "actual" FROM Event_m_Registration WHERE eventid = 240 and status IN ("Accepted", "Processing") and deleted_at IS NULL) er on cd.rhq = er.rhq and cd.zone = er.zone and cd.chapter = er.chapter and cd.district = er.district
			WHERE cd.campaignid = 9
			GROUP BY cd.rhq, cd.zone, cd.chapter, cd.district
			ORDER BY cd.rhq, cd.zone, cd.chapter, cd.district) aa on zz.rhq = aa.rhq and zz.zone = aa.zone and zz.chapter = aa.chapter and zz.district = aa.district
			SET zz.setarget = aa.Target, zz.seactual = IF(aa.Actual IS NOT NULL, aa.Actual, 0);');
		DB::statement('UPDATE zz_2019_4objects zz LEFT JOIN (
			SELECT cd.rhq, cd.zone, cd.chapter, cd.district, cd.value as "Target", SUM(er.belactual) as "BelActual", SUM(er.memactual) as "MemActual", SUM(er.nfactual) as "NFActual", SUM(er.boebelsigned) as "boebelsigned", SUM(er.mmsbelsigned) as "mmsbelsigned", SUM(er.mmsmemsigned) as "mmsmemsigned" FROM Campaign_m_Detail cd LEFT JOIN (SELECT id, rhq, zone, chapter, district, CASE WHEN position IN ("BEL") Then 1 ELSE 0 END as "belactual", believersigned as "boebelsigned", belsigned as "mmsbelsigned", CASE WHEN position IN ("MEM") Then 1 ELSE 0 END as "memactual", memsigned as "mmsmemsigned", CASE WHEN position IN ("NF") Then 1 ELSE 0 END as "nfactual"  FROM Members_m_SSA WHERE YEAR(created_at) = 2019 and position IN ("BEL", "MEM", "NF") and deleted_at IS NULL) er on cd.rhq = er.rhq and cd.zone = er.zone and cd.chapter = er.chapter and cd.district = er.district
			WHERE cd.campaignid = 6
			GROUP BY cd.rhq, cd.zone, cd.chapter, cd.district
			ORDER BY cd.rhq, cd.zone, cd.chapter, cd.district) aa on zz.rhq = aa.rhq and zz.zone = aa.zone and zz.chapter = aa.chapter and zz.district = aa.district
			SET zz.boetarget = aa.Target, zz.boeactual = IF(aa.BelActual IS NOT NULL, aa.BelActual, 0) + IF(aa.MemActual IS NOT NULL, aa.MemActual, 0);');
		DB::statement('UPDATE zz_2019_4objects zz LEFT JOIN (
			SELECT cd.rhq, cd.zone, cd.chapter, cd.district, cd.value as "Target", SUM(er.actual) as "Actual"
			FROM Campaign_m_Detail cd LEFT JOIN (SELECT id, rhq, zone, chapter, district, 1 as "actual" FROM Event_m_Registration WHERE eventid = 236 and status = "Accepted" and deleted_at IS NULL) er on cd.rhq = er.rhq and cd.zone = er.zone and cd.chapter = er.chapter and cd.district = er.district
			WHERE cd.campaignid = 7
			GROUP BY cd.rhq, cd.zone, cd.chapter, cd.district
			ORDER BY cd.rhq, cd.zone, cd.chapter, cd.district) aa on zz.rhq = aa.rhq and zz.zone = aa.zone and zz.chapter = aa.chapter and zz.district = aa.district
			SET zz.ystarget = aa.Target, zz.ysactual = IF(aa.Actual IS NOT NULL, aa.Actual, 0);');

		DB::statement('UPDATE zz_2019_4objects zz SET dm = IF(dmtarget <= dmactual and dmtarget <> 0, 1, 0);');
		DB::statement('UPDATE zz_2019_4objects zz SET studyexam = IF(setarget <= seactual and setarget <> 0, 1, 0);');
		DB::statement('UPDATE zz_2019_4objects zz SET boe = IF(boetarget <= boeactual and boetarget <> 0, 1, 0);');
		DB::statement('UPDATE zz_2019_4objects zz SET ys = IF(ystarget <= ysactual and ystarget <> 0, 1, 0);');
		DB::statement('UPDATE zz_2019_4objects zz 
		SET 4goal = IF((dm + studyexam + boe + ys) = 4, "4GOALS", NULL), 3goal = IF((dm + studyexam + boe + ys) = 3, "3GOALS", NULL),
		2goal = IF((dm + studyexam + boe + ys) = 2, "2GOALS", NULL), 1goal = IF((dm + studyexam + boe + ys) = 1, "1GOAL", NULL),
		0goal = IF((dm + studyexam + boe + ys) = 0, "NO GOAL", NULL);');

		return Response::json(array('info' => 'Success'), 200);

		// if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV04', 'update') == 't')
		// {
		// 	try
		// 	{
		// 		$eventdetail = EventmRegistration::where('eventid', EventmEvent::getid($id))->get(array('id'))->toarray();

		// 		foreach($eventdetail as $eventdetail)
		// 		{
		// 			$post = EventmRegistration::find($eventdetail['id']);
		// 			$post->uniquecode = uniqid('', TRUE);
		// 			$post->save();
		// 		}

		// 		return Response::json(array('info' => 'Success'), 200);
		// 	}
		// 	catch(\Exception $e)
		// 	{
		// 		LogsfLogs::postLogs('Update', 28, 0, ' - Event - Update Unique Code - ' . $e, NULL, NULL, 'Failed');
		// 		return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		// 	}
		// }
		// else
		// {
		// 	LogsfLogs::postLogs('Update', 28, 0, ' - Event - Update Unique Code - No Access Rights', NULL, NULL, 'Failed');
		// 	return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		// }
	}
}