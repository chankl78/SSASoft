<?php
class LeadersPortalLoginController extends BaseController {
	public function getIndex()
	{
		$view = View::make('login/leadersportallogin');
		$view->title = 'Login - SSA BOE Portal';
		Session::put('current_page', 'Dashboard');
		Session::put('current_resource', 'USER');
		$ddyears = array('' => 'Please select your Birth Year') + MembersmSSA::DateofBirthSelect()->lists('year', 'year');
		if (Cache::has('alerts_message'))
		{
			$view->alert_message = Cache::get('alerts_message');
		}
		return $view->with('ddyears', $ddyears);
	}

	public function postLogin()
	{
		$credentials = Input::only('username', 'password'); $remember = Input::has('rememberme');
		
		try
		{
			if (Auth::attempt($credentials, $remember)) {
				if (AccessmUsers::getcheckmemberid(Input::get('username')) == false)
				{
					$member = MembersmSSA::findorfail(AccessmUsers::getusermemberid(Input::get('username')), array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'));
					Session::put('gakkaiuser',  md5(Input::get('username')));
					Session::put('gakkaiusername',  $member['name']);
					Session::put('gakkaiuserrhq',  $member['rhq']);
					Session::put('gakkaiuserzone',  $member['zone']);
					Session::put('gakkaiuserchapter',  $member['chapter']);
					Session::put('gakkaiuserdistrict',  $member['district']);
					Session::put('gakkaiuserdivision',  $member['division']);
					Session::put('gakkaiuserposition',  $member['position']);
					Session::put('gakkaiuserpositionlevel',  MemberszPosition::getPositionLevel($member['position']));
					Session::put('gakkaiuseruc',  $member['uniquecode']);
					Session::put('gakkaiuserboe',  true);

					LogsfLogs::postLogs('Login', 3, 0, ' Name: ' . $member['name'] . ' RHQ: ' . $member['rhq'] . ' Zone: ' . $member['zone'] . ' Chapter: ' . $member['chapter'] . ' District: ' . $member['district'] . ' Division: ' . $member['division'] . ' Position: ' . $member['position'] . ' - ' . MemberszPosition::getPositionLevel($member['position']) . ' - Signed In -> Dashboard', NULL, NULL, 'Success');
					return Redirect::action('LeadersPortalDashboardController@getIndex');
				}
				else
				{
					if (Cache::has('alerts_message_Failed_Login')) { Cache::put('alerts_message_Failed_Login', 'true', 1); }
					else { Cache::add('alerts_message_Failed_Login', 'true', 1); }
		
					Cache::put('alerts_message', 'Failed to Login!  Please verify your username & password!', 1);
		
					LogsfLogs::postLogs('Login', 3, 0, ' Failed to Login - ' . Input::get('username') . ' - ' . ' -> Stuck in Login', NULL, NULL, 'Failed');
					return Redirect::back()->withInput();
				}
			}
			else
			{
				if (Cache::has('alerts_message_Failed_Login')) { Cache::put('alerts_message_Failed_Login', 'true', 1); }
				else { Cache::add('alerts_message_Failed_Login', 'true', 1); }
	
				Cache::put('alerts_message', 'Failed to Login!  Please verify your username & password!', 1);
	
				LogsfLogs::postLogs('Login', 3, 0, ' Failed to Login - ' . Input::get('username') . ' - ' . ' -> Stuck in Login', NULL, NULL, 'Failed');
				return Redirect::back()->withInput();
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Login', 3, 0, ' - Leaders Portal - ' . Input::get('username') . ' - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postVerification()
	{
		$credentials = Input::only('gusername', 'gpassword'); $remember = Input::has('rememberme');
		
		if (MembersmSSA::hasemailhashboelogin(Input::get('gusername')) == FALSE)
		{
			if (Cache::has('alerts_message_Failed_Login')) { Cache::put('alerts_message_Failed_Login', 'true', 1); }
			else { Cache::add('alerts_message_Failed_Login', 'true', 1); }

			Cache::put('alerts_message', 'Failed to verify your email!  Please check your email with gakkai department or email ssahq@ssabuddhist.org!!', 1);

			LogsfLogs::postLogs('Login', 3, 0, ' BOE Portal - Failed to verify email - ' . Input::get('gusername'), NULL, NULL, 'Failed');
			return Redirect::back()->withInput();
		}
		else
		{
			$member = MembersmSSA::findorfail(MembersmSSA::getidbyemailhashboelogin(Input::get('gusername')), array('id', 'uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'));

			if (AccessmUsers::getFindDuplicateValue(Input::get('gusername')) == false)
			{
				$post = new AccessmUsers;

				$post->username = Input::get('gusername');
				$post->password = Hash::make(Input::get('gpassword'));
				$post->name = $member['name'];
				$post->memberid = $member['id'];
				$post->email = Input::get('gusername');
				$post->tel = '1234 5678';
				$post->mobile = '1234 5678';
				$post->roleid = 'User';
				$post->encryptedcode = Input::get('gpassword');
				$post->uniquecode = uniqid('',TRUE);
				$post->firstlogin = 0;
				$post->save();

				LogsfLogs::postLogs('Create', 4, $post->id, ' BOE Portal - Verify Successfully - ' . Input::get('gusername'), NULL, NULL, 'Success');

				Session::put('gakkaiuser',  md5(Input::get('username')));
				Session::put('gakkaiusername',  $member['name']);
				Session::put('gakkaiuserrhq',  $member['rhq']);
				Session::put('gakkaiuserzone',  $member['zone']);
				Session::put('gakkaiuserchapter',  $member['chapter']);
				Session::put('gakkaiuserdistrict',  $member['district']);
				Session::put('gakkaiuserdivision',  $member['division']);
				Session::put('gakkaiuserposition',  $member['position']);
				Session::put('gakkaiuserpositionlevel',  MemberszPosition::getPositionLevel($member['position']));
				Session::put('gakkaiuseruc',  $member['uniquecode']);
				Session::put('gakkaiuserboe',  true);

				Auth::login(AccessmUsers::find($post->id));
				LogsfLogs::postLogs('Login', 3, 0, ' BOE Portal - Name: ' . $member['name'] . ' RHQ: ' . $member['rhq'] . ' Zone: ' . $member['zone'] . ' Chapter: ' . $member['chapter'] . ' District: ' . $member['district'] . ' Division: ' . $member['division'] . ' Position: ' . $member['position'] . ' - ' . MemberszPosition::getPositionLevel($member['position']) . ' - Signed In -> Dashboard', NULL, NULL, 'Success');
				return Redirect::action('LeadersPortalDashboardController@getIndex');
			}
			else
			{
				Cache::put('alerts_message_Failed_Registered', 'true', 1);
				Cache::put('alerts_message', 'You had already verify or register this email.  Please click I forget my password to reset.', 1);

				LogsfLogs::postLogs('Login', 3, 0, ' BOE Portal Verify against MMS - Duplicate Username or email - ' . Input::get('gusername'), NULL, NULL, 'Failed');
				return Redirect::back()->withInput();
			}
		}
	}

	public function postReset()
	{
		// Step 1 - check if username exist
		if (AccessmUsers::getFindDuplicateValue(Input::get('email')) == true)
		{
			$memberid = AccessmUsers::getuserid(Input::get('email'));
			$memberdob = MembersmSSA::getdob(AccessmUsers::getusermemberid(Input::get('email')));
			
			if (Input::get('year') == $memberdob)
			{
				$post = AccessmUsers::find($memberid);
				LogsfLogs::postLogs('Login', 3, 0, ' - Reset Account ' . Hash::make(Input::get('password')) . ' - ' . Input::get('email'), NULL, NULL, 'Failed');
				$post->password = Hash::make(Input::get('password'));
				$post->encryptedcode = Input::get('password');

				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Login', 3, 0, ' - BOE Portal Reset Account Password Successfully ' . Input::get('email'), NULL, NULL, 'Success');
					return Redirect::action('LeadersPortalLoginController@getIndex');
				}
				else
				{
					LogsfLogs::postLogs('Login', 3, 0, ' - BOE Portal Reset Account Password Failed ' . Input::get('email'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				if (Cache::has('alerts_message_Failed_Login')) { Cache::put('alerts_message_Failed_Login', 'true', 1); }
				else { Cache::add('alerts_message_Failed_Login', 'true', 1); }

				Cache::put('alerts_message', 'Unable to verify! Please check your email with gakkai department or email ssahq@ssabuddhist.org!', 1);

				LogsfLogs::postLogs('Login', 3, 0, ' BOE Portal Reset Account [Birth Year] - Birth Year is wrong - ' . Input::get('email'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'DOB'), 400);
			}
		}
		else
		{
			if (Cache::has('alerts_message_Failed_Login')) { Cache::put('alerts_message_Failed_Login', 'true', 1); }
			else { Cache::add('alerts_message_Failed_Login', 'true', 1); }

			Cache::put('alerts_message', 'Email does not exist!  Please check your email with gakkai department or email ssahq@ssabuddhist.org!', 1);

			LogsfLogs::postLogs('Login', 3, 0, ' BOE Portal Reset Account [Email] - Email does not Exist - ' . Input::get('email'), NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Email'), 400);
		}
	}

	public function getLogout()
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();
		}
		catch(\Exception $e) { }
		
		LogsfLogs::postLogs('Logout', 4, 0, ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - Signed Out -> Back to Login', NULL, NULL, 'Success');
		Auth::logout();
		Session::flush();
		return Redirect::action('LeadersPortalLoginController@getIndex');
	}
}