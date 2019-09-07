<?php
class VehicleBookingListingController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'vehicle/vehiclebookinglisting');
		Session::put('current_resource', 'VEHI');
		$vehicleno_options = VehiclemVehicle::Role()->lists('vehicleno', 'vehicleno');
		$view = View::make('vehicle/vehiclebookinglisting');
		$view->title = 'Vehicle Booking Listing';
		$view->with('vehicleno_options', $vehicleno_options);
		return $view;
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$default = VehiclemBooking::get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 20, 0, ' - Vehicle - Vehicle Booking Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postModule()
	{
		try {
			$datDate = DateTime::createFromFormat('d-m-Y', Input::get('moduledate'));
			$post = new EventmEvent;
			$post->eventdate = $datDate;
			$post->location = Input::get('location');
			$post->description = Input::get('description');
			$post->eventtype = Input::get('eventtype');
			$post->createby = Auth::user()->name;
			$post->uniquecode = uniqid('', TRUE);
			$post->save();

			if ($post->save()) {
				LogsfLogs::postLogs('Create', 20, $post->id, ' - Vehicle - Vehicle Booking - ' . Input::get('description'), NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			} else {
				LogsfLogs::postLogs('Create', 20, 0, ' - Vehicle -  Booking', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Duplicate'), 400);
			}
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Create', 20, 0, ' - Vehicle - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putModule($id)
	{
		try {
			$post = VehiclezBookingStatus::find($id);
			$post->value = Input::get('evalue');
			$post->save();

			if ($post->save()) {
				return Response::json(array('info' => 'Success'), 200);
			} else {
				LogsfLogs::postLogs('Update', 17, 0, ' - Vehicle - Update Vehicle Booking Status  ' + Input::get('evalueid') + Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Update', 17, Input::get('evalueid'), ' - Vehicle - Update Vehicle Booking Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function deleteModule($id)
	{
		try {
			$post = VehiclezBookingStatus::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 17, $id, ' - Vehicle - Booking Status - ' . $id, NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Delete', 17, $id, ' - Vehicle - Delete Booking Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}