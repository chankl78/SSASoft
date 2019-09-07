<?php
class LoginController extends BaseController {
	public function getIndex()
	{
		$view = View::make('login/login');
		$view->title = 'Login - SSASOFT';
		Session::put('current_page', 'Dashboard');
		Session::put('current_resource', 'USER');
		if (Cache::has('alerts_message'))
		{
			$view->alert_message = Cache::get('alerts_message');
		}
		return $view;
	}

	public function postLogin()
	{
		$credentials = Input::only('username', 'password');
		$remember = Input::has('rememberme');

		// If it is for BOE Portal, it will redirect back to BOE Login
		if (Input::get('username') == 'districtuser' or Input::get('username') == 'chapteruser' or Input::get('username') == 'zoneuser' or Input::get('username') == 'regionuser' or Input::get('username') == 'shquser')
		{
			return Redirect::action('LeadersPortalLoginController@getIndex');
		}

		if (Auth::attempt($credentials, $remember)) {
			LogsfLogs::postLogs('Login', 3, 0, ' - Signed In -> Dashboard', NULL, NULL, 'Success');
			
			return Redirect::action('DashboardController@getIndex');
 			// return Redirect::intended('/');
		}
		else
		{
			if (Cache::has('alerts_message_Failed_Login'))
			{
			    Cache::put('alerts_message_Failed_Login', 'true', 1);
			}
			else
			{
				Cache::add('alerts_message_Failed_Login', 'true', 1);
			}

			Cache::put('alerts_message', 'Failed to Login!  Please verify your username & password!', 1);

			LogsfLogs::postLogs('Login', 3, 0, 'Failed to Login - ' . Input::get('username') . ' -> Stuck in Login', NULL, NULL, 'Failed');
			return Redirect::back()->withInput();
		}
	}

	public function postRegister() 
	{ // 1) Check for same username  
		if (AccessmUsers::where('username', '=', Input::get('gusername'))->count())
		{ // Check for duplicate Username
			if (Cache::has('alerts_message_Failed_Registered'))
			{
			    Cache::put('alerts_message_Failed_Registered', 'true', 1);
			}
			else
			{
				Cache::add('alerts_message_Failed_Registered', 'true', 1);
			}

			Cache::put('alerts_message', 'Username already exist in database!', 1);

			LogsfLogs::postLogs('Login', 3, 0, 'Failed to Registered Due to Duplicate Username - ' . Input::get('gusername'), NULL, NULL, 'Failed');
			return Redirect::back()->withInput();
		}
		else
		{ // Check for duplicate email & post if passed
			// Check if email exist
			// Step 1 -> Check for max record in table
			$usermax = DB::table('Access_m_Users')->max('id');
			// Step 2 -> Compare Email
			for($i=1; $i <= $usermax; $i++)
			{
				try
				{
					$compareemail = Crypt::decrypt(DB::table('Access_m_Users')->where('id', $i)->pluck('email'));
					if ($compareemail == Input::get('gemail'))
					{
						if (Cache::has('alerts_message_Failed_Registered'))
						{
						    Cache::put('alerts_message_Failed_Registered', 'true', 1);
						}
						else
						{
							Cache::add('alerts_message_Failed_Registered', 'true', 1);
						}

						Cache::put('alerts_message', 'Email already exist in database!', 1);

						LogsfLogs::postLogs('Login', 3, 0, 'Failed to Registered Due to Duplicate Email - ' . Input::get('gemail'), NULL, NULL, 'Failed');
						return Redirect::back()->withInput();
					}
				}
				catch(\Exception $e) { }
			}
			
			$post = new AccessmUsers;

			$post->username = Input::get('gusername');
			$post->password = Hash::make(Input::get('gpassword'));
			$post->name = Input::get('gname');
			$post->tel = Input::get('gphone');
			$post->mobile = Input::get('gmobile');
			$post->email = Input::get('gemail');
			$post->roleid = 'User';
			$post->uniquecode = uniqid('',TRUE);
			$post->firstlogin = 0;
			$post->save();

			LogsfLogs::postLogs('Create', 4, $post->id, 'Registered Successfully - ' . Input::get('gusername') . ', '. Input::get('gemail'), NULL, NULL, 'Success');
		}
		// Login user after successful registration
		Auth::login(AccessmUsers::find($post->id));
		LogsfLogs::postLogs('Login', 3, 0, ' - Signed In -> Dashboard', NULL, NULL, 'Success');
		
		return Redirect::action('DashboardController@getIndex');
	}

	public function getLogout()
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();
		}
		catch(\Exception $e) { }
		
		LogsfLogs::postLogs('Logout', 4, 0, ' - Signed Out -> Back to Login', NULL, NULL, 'Success');
		Auth::logout();
		return Redirect::action('LoginController@getIndex');
	}
}