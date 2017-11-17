<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CheckupShedule;
use Illuminate\Http\Request;
use App\TimeSlot;

use App\PatientSchedule;
use App\Resource;
use Session;

class CheckupSheduleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('checkup_shedules.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('checkup_shedules.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
		$this->validate($request, [

			'status' => 'required',
			'resourceId' => 'required',
			'timeSlot'=>'required',
			'count'=>'required',

		]);

		$input = $request->all();

		CheckupShedule::create($input);

		Session::flash('flash_message', 'Schedule successfully created!');

		return redirect()->back();

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getFormattedTimeString($time_string){
		$formatted_time = "00:00:00";
		if($time_string!=null){
			$formatted_time = str_replace(".", ":", $time_string);
			$formatted_time = $formatted_time . ":00";
		}
		return $formatted_time;
	}

	public function viewLabDetails()
	{
		$events = "[";

		$patient_schedules = PatientSchedule::all();

		$count = 0;

		foreach ($patient_schedules as $patient_schedule) {

			$id = $patient_schedule->id;
			$sch_id = $patient_schedule->scheduleId;
			$booking_id	= $patient_schedule->bookingID;

			$schedule = CheckupShedule::find($sch_id);

			if($schedule!=null){
				$res_id = $schedule->resourceId;
				$time_id = $schedule->timeSlot;
				$date = $schedule->date;

				$resource = Resource::find($res_id);

				$time_slot = TimeSlot::find($time_id);

				if($resource!=null && $time_slot!=null){
					$res_name = $resource->name;
					$start_time = $time_slot->start;
					$end_time = $time_slot->end;

					if($count != 0){
						$events = $events . ",";
					}

					$events = $events . $booking_id . " - " . $res_name . "|";
					$events = $events . $date . "T" . $this->getFormattedTimeString($start_time) . "|";
					$events = $events . $date . "T" . $this->getFormattedTimeString($end_time) . "|";
					$events = $events . "/patient_shedules/" . $id;

					$count++;
				}
			}
		}

		$events = $events . "]";

		return view('checkup_shedules.laboratary_details')->with('events', $events);
	}


	/**public function viewLabDetails()
	{
		return view('checkup_shedules.laboratary_details');
	}**/
	public function paymentDetails()
	{
		return view('checkup_shedules.checkup_payment');
	}
	public function labWiseDetails()
	{
		return view('checkup_shedules.search_checkup_details');
	}

	public function getAllTimeList($id)
	{
		$response = "";


		$timenames = TimeSlot::where('rid', $id)->get();
		foreach ($timenames as $result) {
			$id = $result->id;
			$timename = $result->start . "-" . $result->end;

			$response = $response . "<option value = '$id' >$timename</option >";
		}

		return $response;
	}

}
