<?php
class AwardDetailController extends BaseController
{
	public $restful = true;

	public function getIndex($id)
	{
		Session::put('current_page', 'award/award');
		Session::put('current_resource', 'CERT');
		$RECE03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CE03', 'create');
		$RECE04A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CE04', 'create');
		$RECE05R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CE05', 'read');
		$RECE01R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CE01', 'read');
		$RECE02R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CE02', 'read');
		$view = View::make('award/awarddetail');
		$query = AwardmAward::where('id', '=', AwardmAward::getid($id))->get();
		$type_options = AwardzType::Role()->lists('value', 'value');
		$view->title = 'Award Detail';
		$view->with('RECE03A', $RECE03A)->with('rid', $id)->with('result', $query)
			->with('RECE05R', $RECE05R)->with('RECE01R', $RECE01R)->with('RECE04A', $RECE04A)
			->with('RECE02R', $RECE02R)
			->with('type_options', $type_options);
		return $view;
	}

	public function getDetailListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['sEcho'];
			$iTotalRecords = AwardmDetail::Award(AwardmAward::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['iDisplayLength'];
		    $iDisplayStart = (int)$_GET['iDisplayStart'];
		    $sSearch = $_GET['sSearch'];
		    $iTotalDisplayRecords = AwardmDetail::Award(AwardmAward::getid($id))->Search('%'.$sSearch.'%')->count();
		    $default =  AwardmDetail::Award(AwardmAward::getid($id))->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy('created_at', 'DESC')->get()->toarray();

			return Response::json(array('iTotalRecords' => $iTotalRecords, 
				'iTotalDisplayRecords' => $iTotalDisplayRecords, 'sEcho' => (string)$sEcho, 
				'aaData' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 50, 0, ' - Award - Detail Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postNricSearch($id)
	{
		// Search membership
		try
		{
			$searchnric = Input::get('nricsearch');
			$searchcode = substr(Input::get('nricsearch'), 1, 3);


			$search = MembersmSSA::SearchCode($searchcode)->get(array('id', 'nric'));
			$searchfilter = $search->filter(function($search) use ($searchnric)
		    {
		        if ($search->nric == $searchnric) {
		        	Session::put('key', $search->id);
		            return $search;
		        }
		    });

		    $searchresult = MembersmSSA::findorfail(Session::get('key'), array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position'));
		    Session::forget('key');

			LogsfLogs::postLogs('Read', 50, $id, ' - Award - NRIC Search - ' . $searchcode . ' ' . $searchresult['name'], NULL, NULL, 'Success');
			return Response::json($searchresult, 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 50, $id, ' - Award - NRIC Search - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function postAddMember($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CE03', 'create') == 't')
		{
			try
			{
				$mid = MembersmSSA::getid(Input::get('memberid'));
				$member = MembersmSSA::find($mid)->toarray();
				if(AwardmDetail::getFindDuplicateValue($mid, AwardmAward::getid(Input::get('awardid'))) == false)
				{
					$post = new AwardmDetail;
					$post->name = Input::get('membername');
					$post->remarks = Input::get('remarks');
					$post->personid = $member['personid'];
					$post->memberid = $mid;
					$post->rhq = $member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->position = $member['position'];
					$post->division = $member['division'];
					$post->awardid = AwardmAward::getid(Input::get('awardid'));
					$post->uniquecode = date('YmdHis');
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 50, $post->id, ' - Award - New Member - ' . Input::get('membername'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 50, 0, ' - Award - New Member - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 50, 0, ' - Award - New Member Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 50, 0, ' - Award - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 50, 0, ' - Award - New Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function deleteMember($id)
	{
		try
		{
			$post = AwardmDetail::find(AwardmDetail::getid($id));
			$post->Delete();

			LogsfLogs::postLogs('Delete', 50, $id, ' - Award - Member - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 50, $id, ' - Award - Member - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}