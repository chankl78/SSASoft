<?php
class GroupMemSVGRegistrationController extends BaseController {
	public $restful = true;

	public function getIndex()
	{
		$view = View::make('groupregistration/groupsvgregistration');
		$view->title = 'SVG Registration';
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$memposition_options = MemberszPosition::orderBy('code', 'ASC')->lists('name', 'code');
		$division_options = MemberszDivision::Role()->lists('name', 'code');
		$event_options = array('' => 'Please Select an Event') + EventmEvent::MemRegEvent()->orderBy('description', 'ASC')->lists('description', 'uniquecode');
		$view->with('event_options', $event_options)->with('rhq_options', $rhq_options)
			->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)
			->with('memposition_options', $memposition_options)->with('division_options', $division_options);
		return $view;
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

		    $searchresult = MembersmSSA::findorfail(Session::get('key'), array('uniquecode', 'name', 'mobile', 'tel', 'email', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position'));
		    Session::forget('key');

			LogsfLogs::postLogs('Read', 28, $id, ' - Event Mem Registration - NRIC Search - ' . $searchcode . ' ' . $searchresult['name'], NULL, NULL, 'Success');
			return Response::json($searchresult, 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 28, $id, ' - Event Mem Registration - NRIC Search - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function postAddMember($id)
	{
		try
		{
			$mid = MembersmSSA::getid(Input::get('memberid'));
			if (Input::get('memberid') == "") { $member = 0; }
			else {$member = MembersmSSA::find($mid)->toarray();}
			
			if (Input::get('memberid') == "")
			{
				$post = new EventmRegistration;
				$post->eventid = EventmEvent::getid(Input::get('eventid'));
				$post->personid = 0;
				$post->memberid = $mid;
				$post->name = Input::get('membername');
				$post->rhq = Input::get('rhq');
				$post->zone = Input::get('zone');
				$post->chapter = Input::get('chapter');
				$post->district = Input::get('district');
				$post->position = Input::get('position');
				$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
				$post->division = Input::get('division');
				$post->nric = Input::get('nric');

				if(Input::get('tel') == ''){$post->tel = 'NIL';} else {$post->tel = Input::get('tel');}
				if(Input::get('mobile') == ''){$post->mobile = 'NIL';} else {$post->mobile = Input::get('mobile');}
				if(Input::get('email') == ''){$post->email = 'NIL';} else {$post->email = Input::get('email');}

				$post->emergencytel = 'NIL';
				$post->emergencymobile = 'NIL';

				$post->address = 'NIL';
				$post->buildingname = 'NIL';
				$post->unitno = 'NIL';
				$post->postalcode = 'NIL';

				$post->introducer = Input::get('introducername');
				if(Input::get('introducermobile') == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = Input::get('introducermobile');}

				$post->role = "Performer";
				$post->ssagroup = NULL;
				$post->auditioncode = NULL;
				$post->eventitem = NULL;
				$post->status = "Interested";
				$post->uniquecode = date('YmdHis');
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 28, $post->id, ' - Event Member Registration - New Member - ' . Input::get('membername'), NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else if(EventmRegistration::getEventMemberDuplicate($mid, EventmEvent::getid($id)) == false)
			{
				$post = new EventmRegistration;
				$post->eventid = EventmEvent::getid(Input::get('eventid'));
				$post->personid = $member['personid'];
				$post->memberid = $mid;
				$post->name = $member['name'];
				$post->chinesename = $member['chinesename'];
				$post->rhq = $member['rhq'];
				$post->zone = $member['zone'];
				$post->chapter = $member['chapter'];
				$post->district = $member['district'];
				$post->position = $member['position'];
				$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
				$post->division = $member['division'];
				$post->nric = $member['nric'];
				$post->dateofbirth = $member['dateofbirth'];

				$post->tel = $member['tel'];
				$post->mobile = $member['mobile'];
				$post->email = $member['email'];

				$post->emergencyname = $member['emergencyname'];
				$post->emergencyrelationship = $member['emergencyrelationship'];
				$post->emergencytel = $member['emergencytel'];
				$post->emergencymobile = $member['emergencymobile'];

				$post->drugallergy = $member['drugallergy'];
				$post->bloodgroup = $member['bloodgroup'];
				$post->nationality = $member['nationality'];
				
				$post->race = $member['race'];
				$post->gender = $member['gender'];

				$post->countryofbirth = $member['countryofbirth'];

				$post->address = $member['address'];
				$post->buildingname = $member['buildingname'];
				$post->unitno = $member['unitno'];
				$post->postalcode = $member['postalcode'];

				$post->introducer = Input::get('introducername');
				if(Input::get('introducermobile') == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = Input::get('introducermobile');}

				$post->role = "Performer";
				$post->ssagroup = NULL;
				$post->auditioncode = NULL;
				$post->eventitem = NULL;
				$post->status = "Interested";
				$post->uniquecode = date('YmdHis');
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 28, $post->id, ' - Event Member Registration - New Member - ' . Input::get('membername'), NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}
}