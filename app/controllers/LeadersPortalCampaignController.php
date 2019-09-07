<?php
class LeadersPortalCampaignController extends BaseController
{
	public function getIndex($id)
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/Campaign');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$campaignname = CampaignmCampaign::getdescription($id);
		$campaigntype = CampaignmCampaign::getcampaigntype($id);
		$campaignlevel = CampaignmCampaign::getcampaignlevel($id);
		$readonly = CampaignmCampaign::getreadonly($id);
		$campaignvaluetotal = CampaignmDetail::getCampaignValueTotal(CampaignmCampaign::getid($id), Session::get('gakkaiuserpositionlevel'));
		$campaignvaluenotsubmmited = CampaignmDetail::getCampaignValueNotSubmmited(CampaignmCampaign::getid($id), Session::get('gakkaiuserpositionlevel'));
		$query = CampaignmCampaign::Role()->where('uniquecode', $id)->get();
		$view = View::make('leaderportal/campaign');
		$view->title = 'BOE Portal - ' . $campaignname;
		return $view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict)->with('campaignname', $campaignname)->with('campaigntype', $campaigntype)->with('campaignlevel', $campaignlevel)
			->with('campaignvaluetotal', $campaignvaluetotal)->with('campaignvaluenotsubmmited', $campaignvaluenotsubmmited)->with('rid', $id)->with('result', $query)
			->with('readonly', $readonly);
	}

	public function getModuleDetail($id) // Server-Side Datatable
	{
		try
		{
			$result = CampaignmDetail::where('campaignid', CampaignmCampaign::getid($id))->Role()->get(array('name', 'division','rhq','zone','chapter','district', 'position', 'value', 'remarks', 'uniquecode', 'created_at'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Campaign Detail Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postEditModuleDetail($id)
	{
		try
		{
			$post = CampaignmDetail::find(CampaignmDetail::getid(Input::get('uniquecode')));
			$post->value = Input::get('value');
			$post->remarks = Input::get('remarks');

			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Campaign - ' . Input::get('uniquecode') , NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Campaign - ' . Input::get('uniquecode') , NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}