<?php
class LeadersPortalPastPreMADTrainingListingController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/PastPreMAD');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/pastpremadtraininglisting');
		$view->title = 'BOE Portal - Pre Mentor and Disciple Training Attendee Listing';
		$view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
		return $view;
	}

	public function getListing()
	{
		try
		{
			if (Session::get('gakkaiuserpositionlevel') == 'shq')
			{	
				$default = AttendancemPerson::BOEPreKenshu()->get(array('description', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
				return Response::json(array('data' => $default));
			}
			elseif (Session::get('gakkaiuserpositionlevel') == 'rhq')
			{	
				$default = AttendancemPerson::BOEPreKenshu()->where('Members_m_SSA.rhq', Session::get('gakkaiuserrhq'))->get(array('description', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
				return Response::json(array('data' => $default));
			}
			elseif (Session::get('gakkaiuserpositionlevel') == 'zone')
			{	
				$default = AttendancemPerson::BOEPreKenshu()->where('Members_m_SSA.zone', Session::get('gakkaiuserzone'))->get(array('description', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
				return Response::json(array('data' => $default));
			}
			elseif (Session::get('gakkaiuserpositionlevel') == 'chapter')
			{	
				$default = AttendancemPerson::BOEPreKenshu()->where('Members_m_SSA.chapter', Session::get('gakkaiuserchapter'))->get(array('description', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
				return Response::json(array('data' => $default));
			}
			elseif (Session::get('gakkaiuserpositionlevel') == 'district')
			{	
				$default = AttendancemPerson::BOEPreKenshu()->where('Members_m_SSA.chapter', Session::get('gakkaiuserchapter'))->where('Attendance_m_Person.district', Session::get('gakkaiuserdistrict'))->get(array('description', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Pre MAD Kenshu Attendee Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}