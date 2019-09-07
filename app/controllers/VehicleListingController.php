<?php
class VehicleListingController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'vehicle/vehiclelisting');
		Session::put('current_resource', 'VEHI');
		$view = View::make('vehicle/vehiclelisting');
		$view->title = 'Vehicle - Listing';
		return $view;
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$default = VehiclemVehicle::get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 18, 0, ' - Vehicle - Vehicle Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postVehicle()
	{
		try
		{
			$value = Input::get('txtvalue');
			if(VehiclemVehicle::getFindDuplicateValue($value) == false)
			{
				$post = new VehiclemVehicle;
				$post->vehicleno = $value;
				$post->uniquecode = uniqid('', TRUE);
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 19, $post->id, ' - Vehicle - Vehicle Listing - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 19, 0, ' - Vehicle - Vehicle Listing - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 19, 0, ' - Vehicle - Vehicle Listing - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 19, 0, ' - Vehicle - Vehicle Listing - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putVehicle($id)
	{
		try
		{
			$post = VehiclemVehicle::find(vehiclemvehicle::getid($id));
			$post->vehicleno = Input::get('evalue');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 19, 0, ' - Vehicle - Update Vehicle  ' + Input::get('evalueid') + Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 19, Input::get('evalueid'), ' - Vehicle - Update Vehicle - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function deleteVehicle($id)
	{
		try
		{
			$post = VehiclemVehicle::find(vehiclemvehicle::getid($id));
			$post->Delete();

			LogsfLogs::postLogs('Delete', 19, $id, ' - Vehicle - Vehicle - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 19, $id, ' - Vehicle - Delete Vehicle - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}