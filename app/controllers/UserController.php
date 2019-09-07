<?php
class UserController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		$view = View::make('user/user');
		$view->title = 'User Profile';
		return $view;
	}

	public function postUser()
	{
		$post = AccessmUsers::find(Auth::user()->id);
		$post->name = Input::get('name'); 
		$post->tel = Input::get('phone'); 
		$post->mobile = Input::get('mobile'); 
		$post->email = Input::get('email'); 
		$post->save();

		if($post->save())
		{
			LogsfLogs::postLogs('Update', 2, Auth::user()->id, ' - User Profile - Update Profile', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		else
		{
			LogsfLogs::postLogs('Update', 2, Auth::user()->id, ' - User Profile - Update Profile', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed'), 400);
		}
	}

	public function postPassword()
	{
		$userpassword = array(
			'password' => Input::get('newpassword'),
			'password_confirmation' => Input::get('conpassword')
		);

		$rules = array(
			'password'  => 'required|min:6|confirmed',
			'password_confirmation'  => 'required|min:6'
		);

		$validation = Validator::make($userpassword, $rules);

		if($validation->fails())
		{
	        return Response::json(array('info' => 'Failed'), 400);
	    }
	    elseif($validation->passes())
	    {
	    	$post = AccessmUsers::find(Auth::user()->id);
			$post->password = Hash::make(Input::get('newpassword'));
			$post->save();

			if($post->save())
			{
				LogsfLogs::postLogs('Update', 2, Auth::user()->id, ' - User Profile - Change Password', NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 2, Auth::user()->id, ' - User Profile - Change Password', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
	    }
	}

	public function getUserLogs()
	{
		try
		{
			$sEcho = (int)$_GET['sEcho'];
			$iTotalRecords = LogsmLogs::where('userid', '=', Auth::user()->id)->count();
	 		$iDisplayLength = (int)$_GET['iDisplayLength'];
		    $iDisplayStart = (int)$_GET['iDisplayStart'];
		    $sSearch = $_GET['sSearch'];
		    $iTotalDisplayRecords = LogsmLogs::where('userid', '=', Auth::user()->id)->count();
		    $userlogs = LogsmLogs::where('userid', '=', Auth::user()->id)
		    	->where('description', 'like', "%$sSearch%")
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy('created_at', 'DESC')->get()->toarray();
			return json_encode(array('iTotalRecords' => $iTotalRecords, 
				'iTotalDisplayRecords' => $iTotalDisplayRecords, 'sEcho' => (string)$sEcho, 
				'aaData' => $userlogs));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 2, 0, ' - User Profile - [dt] user logs - ' . $e, NULL, NULL, 'Failed');
		}
	}
}