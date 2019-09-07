<?php
class InstallAdminController extends BaseController {
	public $restful = true;

	public function getIndex()
	{
		$view = View::make('install/installadmin');
		$view->title = 'Installation of New Software';
		return $view;
	}

	public function postSetup()
	{
		
        $post = new AccessmUsers;

		$post->username = Input::get('username');
		$post->password = Hash::make(Input::get('password'));
		$post->name = Input::get('name');
		$post->tel = Input::get('phone');
		$post->mobile = Input::get('mobile');
		$post->email = Input::get('email');
		$post->firstlogin = 0;
		$post->roleid = 'Software Administrator';
		$post->uniquecode = date('YmdHis');

		$post->save();

		// Find the userid
		$q= $post->id;

		$ar = new AccessmAccessRights;

		$ar->userid = $q;
		$ar->resourcegroup = 'SOFA';
		$ar->resourcecode = 'SOFA';
		$ar->accesstypeid = 0; // it means master rights for all resources
		$ar->startdate = '0000-00-00';
		$ar->starttime = '00:00:00';
		$ar->enddate = '0000-00-00';
		$ar->endtime = '00:00:00';
		$ar->create = 1;
		$ar->read = 1;
		$ar->update = 1;
		$ar->delete = 1;
		$ar->void = 1;
		$ar->unvoid = 1;
		$ar->print = 1;
		$ar->uniquecode = date('YmdHis');

		$ar->save();

		if($post->save())
		{
			if (Cache::has('alerts_message_Success_admininstall'))
			{
			    Cache::put('alerts_message_Success_admininstall', 'true', 1);
			}
			else
			{
				Cache::add('alerts_message_Success_admininstall', 'true', 1);
			}
			Cache::put('alerts_message', 'Successfully install database & software administrator', 1);
			return Redirect::action('LoginController@getIndex');
		}
		else
		{
			if (Cache::has('alerts_message_Failed_admininstall'))
			{
			    Cache::put('alerts_message', 'true', 1);
			}
			else
			{
				Cache::add('alerts_message_Failed', 'true', 1);
			}
			Cache::put('alerts_message', 'Successfully install database & software administrator', 1);
			return Redirect::action('InstallAdminController@getIndex');
		}
		
	}
}