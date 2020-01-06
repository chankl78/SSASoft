<?php

set_time_limit(0);
ignore_user_abort(true);

class EventmSSAMADKenshu extends Eloquent {

	protected $table = 'Event_m_SSAMADKenshu';

	public static function transfermmstoboe()
    {
		try
		{
			DB::table('Event_m_SSAMADKenshu')->truncate();

			// Get arrary from MMS
			$pdo = DB::connection("mysql2")->getPdo();
			$member = $pdo->query(DB::raw('SELECT pv.id, pv.uuid, pv.name, pv.hq, pv.zone, pv.chapter, pv.dist, pv.division, pv.position, tc.training_on, lan.name as "language" FROM training_participants tp LEFT JOIN training_classes tc on tp.training_class_id = tc.id LEFT JOIN person_view pv on tp.person_id = pv.id LEFT JOIN language lan on tc.language_id = lan.id WHERE tp.role IN ("trainee") and tp.attendance IN ("present");'));
			// Insert into BOE
			$i = 1;
			foreach($member as $member)
			{
				$post = new EventmSSAMADKenshu;
				$post->personid = $member['id'];
				$post->name = $member['name'];
				$post->uniquecode = uniqid('',TRUE);
				$post->rhq = $member['hq'];
				$post->zone = $member['zone'];
				$post->chapter = $member['chapter'];
				$post->district = $member['dist'];
				$post->position = $member['position'];
				if ($member['position'] == 'BEL') { $positionlevel = 'bel'; }
				elseif ($member['position'] == 'MEM') { $positionlevel = 'mem'; }
				else { $positionlevel = MemberszPosition::getPositionLevel($member['position']); }	
				$post->positionlevel = $positionlevel;
				$post->trainingdate = $member['training_on'];
				$post->language = $member['training_on'];

				$post->save();
			}

			LogsfLogs::postLogs('Update', 39, 0, ' - EventmSSAMADKenshu Model - MMS to BOE Success ', NULL, NULL, 'Success');
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Create', 39, 0, ' - EventmSSAMADKenshu Model - MMS to BOE Failed - ' . $member['id'] . ' ' . $e, NULL, NULL, 'Failed');
		}
	}
}