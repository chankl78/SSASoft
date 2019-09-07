<?php
class EventRegistrationController extends BaseController
{
	public $restful = true;

	public function getIndex($id)
	{
		Session::put('current_page', 'event/registration');
		Session::put('current_resource', 'EVEN');
		$role_options = EventzRole::Role()->lists('value', 'value');
		$view = View::make('event/registration');
		$query = MembersmSSA::where('id', '=', $id)->get();
		$view->title = 'Registration';
		return $view->with('result', $query)->with('rid', $id)->with('role_options', $role_options);
	}

	public function PostRegPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$member = MembersmSSA::find($id)->toarray();
			$post = new PrintmPrint;
			$post->userid = Auth::user()->id;
			$post->resourceid = 30;
			$post->resourcecodeid = $id;
			$post->string1 = $member['nric'];
			$post->string2 = $member['tel'];
			$post->string3 = $member['mobile'];
			$post->string4 = $member['email'];
			$post->string5 = $member['emergencytel'];
			$post->string6 = $member['emergencymobile'];
			$post->string7 = $member['address'];
			$post->string8 = $member['buildingname'];
			$post->string9 = $member['unitno'];
			$post->string10 = $member['postalcode'];
			$post->string11 = $member['introducermobile'];
			$post->save();

			if($post->save())
			{
				LogsfLogs::postLogs('Print', 30, Auth::user()->id, ' - Event - Registration - ' . $member['name'], NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Print', 30, Auth::user()->id, ' - Event - Registration' . $member['name'], NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Post Reg Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function PostRegistration($id)
	{
		try
		{
			if (EventmRegistration::getEventMemberDuplicate('1', $id) == false)
			{
				$member = MembersmSSA::find($id)->toarray();
				$post = new EventmRegistration;
				$post->eventid = 1;
				$post->memberid = $id;
				$post->personid = $member['personid'];
				$post->name = $member['name'];
				$post->chinesename = $member['chinesename'];
				$post->rhq = $member['rhq'];
				$post->zone = $member['zone'];
				$post->chapter = $member['chapter'];
				$post->district = $member['district'];
				$post->position = $member['position'];
				$post->positionlevel = $member['positionlevel'];
				$post->division = $member['division'];
				$post->nric = $member['nric'];
				$post->dateofbirth = $member['dateofbirth'];
				$post->tel = $member['tel'];
				$post->mobile = $member['mobile'];
				$post->email = $member['email'];
				$post->drugallergy = $member['drugallergy'];
				$post->emergencyname = $member['emergencyname'];
				$post->emergencyrelationship = $member['emergencyrelationship'];
				$post->emergencytel = $member['emergencytel'];
				$post->emergencymobile = $member['emergencymobile'];
				$post->bloodgroup = $member['bloodgroup'];
				$post->nationality = $member['nationality'];
				$post->occupation = $member['occupation'];
				$post->race = $member['race'];
				$post->countryofbirth = $member['countryofbirth'];
				$post->address = $member['address'];
				$post->buildingname = $member['buildingname'];
				$post->unitno = $member['unitno'];
				$post->postalcode = $member['postalcode'];
				$post->introducermobile = $member['introducermobile'];

				$post->role = Input::get('role');
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Update', 30, Auth::user()->id, ' - Event - Registration - ' . $member['name'], NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 30, Auth::user()->id, ' - Event - Registration', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 30, Auth::user()->id, ' - Event - Registration Participant Duplicate', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 30,  Auth::user()->id, ' - Event - Register Participant - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => $id), 400);
		}
	}

	public function getRegistrationPrint($id)
	{
		$view = View::make('event/registrationprint');
		$query = MembersmSSA::where('id', '=', $id)->get();
		$view->title = 'Print Registration';
		return $view->with('result', $query)->with('rid', $id);
	}
}