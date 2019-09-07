<?php
class VehicleBookingStatusController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'vehicle/vehiclebookingstatus');
		Session::put('current_resource', 'VEHI');
		$view = View::make('vehicle/vehiclebookingstatus');
		$view->title = 'Vehicle Booking Status';
		return $view;
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$default = VehiclezBookingStatus::get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 17, 0, ' - Vehicle - Vehicle Booking Status [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postStatus()
	{
		try
		{
			$value = Input::get('txtvalue');
			if(VehiclezBookingStatus::getFindDuplicateValue($value) == false)
			{
				$post = new VehiclezBookingStatus;
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 17, $post->id, ' - Vehicle - Vehicle Booking Status - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 17, 0, ' - Vehicle - Vehicle Booking Status - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 17, 0, ' - Vehicle - Vehicle Booking Status - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 17, 0, ' - Vehicle - Vehicle Booking Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putStatus($id)
	{
		try
		{
			$post = VehiclezBookingStatus::find($id);
			$post->value = Input::get('evalue');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 17, 0, ' - Vehicle - Update Vehicle Booking Status  ' + Input::get('evalueid') + Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 17, Input::get('evalueid'), ' - Vehicle - Update Vehicle Booking Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function deleteStatus($id)
	{
		try
		{
			$post = VehiclezBookingStatus::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 17, $id, ' - Vehicle - Booking Status - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 17, $id, ' - Vehicle - Delete Booking Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}