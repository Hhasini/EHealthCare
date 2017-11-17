<?php namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Doctor;
use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ESchedule;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CancelECschedules;
use DateTime;
use Illuminate\Support\Facades\Input;


class EC_ScheduleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('EC_Schedule.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('EC_Schedule.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		try {

		$this->validate($request, [

			'doc_id' => 'required',
			'room' => 'required',
			'shift_start'=>'required',
			'shift_end'=>'required',
			'max_bookings'=>'required|integer'

		]);

		$input = $request->all();

		ESchedule::create($input);


		Log::debug("EC_ScheduleController:store - Creating new Schedule : " . implode(',', array_slice($input, 1)));

		Session::flash('flash_message', 'Schedule successfully created!');
	}

	catch (Exception $ex) {
		Log::error($ex->getMessage());
	}
		return redirect()->back();

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($schedule_id)
	{
		try{

		$event = ESchedule::findOrFail($schedule_id);
		$first_date = new DateTime($event->shift_start);
		$second_date = new DateTime($event->shift_end);
		$difference = $first_date->diff($second_date);

		$data = [
			'page_title' => $event->$schedule_id,
			'event' => $event,
			'duration' => $this->format_interval($difference)
		];
	}
	catch (Exception $ex) {
		Log::error($ex->getMessage());
	}
		return view('EC_Schedule/view', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($schedule_id)
	{
      try {
		  $booking = ESchedule::find($schedule_id);
	  		}

		 catch (Exception $ex) {
			Log::error($ex->getMessage());
		}

		return view('EC_Schedule.edit', array('booking' => $booking));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($schedule_id, Request $request)
	{
		try {
			$booking = ESchedule::find($schedule_id);

			$this->validate($request, [
				'doc_id' => 'required',
				'room' => 'required',
				'shift_start' => 'required',
				'shift_end' => 'required',
				'max_bookings' => 'required|integer'
			]);

			$input = $request->all();

			$booking->fill($input)->save();

			Session::flash('flash_message', 'Schedule successfully Updated!');
		}
		catch (Exception $ex) {
			Log::error($ex->getMessage());

		}
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($schedule_id,Request $request)
	{

		try {
			/*$event = ESchedule::find($schedule_id);
			$event->delete();*/

			$this->validate($request, [

				'reason_to_cancel'=>'required',


			]);



			$input = $request->all();

			$reason_to_cancel = $input['reason_to_cancel'];

			$event = ESchedule::find($schedule_id);
			$event->delete();


			DB::table('e_schedules')->where('schedule_id', '=', $schedule_id)->delete();


			DB::table('cancel_e_cschedules')->insert(
				['schedule_id' => $schedule_id, 'reason_to_cancel' => $reason_to_cancel]
			);



			Log::info("EC_ScheduleController:destroy - Deleted Schedule : " . $schedule_id);

			Session::flash('flash_message', 'Schedule successfully deleted!');

		} catch (Exception $ex) {
			Log::error($ex->getMessage());
		}

		return view('EC_Schedule/index');

	}


	public function list_schedules()
	{

		try {
        $schedule = ESchedule::orderBy('shift_start','ASC')->get();

		$cur_date = Carbon::now();

		$future = ESchedule::where('shift_start','>=',$cur_date)->orderBy('shift_start','ASC')->get();
		$past = ESchedule::where('shift_start','<=',$cur_date)->orderBy('shift_start','ASC')->get();

			$cancelSchedules=CancelECschedules::get();

			Log::info("EC_ScheduleController:list_schedules :all schedules"  . $schedule . " future schedules : ".$future. "past schedules" .$past);

		}

		catch (Exception $ex) {
			Log::error($ex->getMessage());
		}

	    return view('EC_Schedule.list_schedules', array('schedules' => $schedule ,'future'=>$future,'past'=>$past,'cancelSchedules'=>$cancelSchedules));

	}


	public function change_date_format($date)
	{
		$time = DateTime::createFromFormat('d/m/Y H:i:s', $date);
		return $time->format('Y-m-d H:i:s');
	}

	public function change_date_format_fullcalendar($date)
	{
		$time = DateTime::createFromFormat('Y-m-d H:i:s', $date);
		return $time->format('d/m/Y H:i:s');
	}

	public function format_interval(\DateInterval $interval)
	{
		$result = "";
		if ($interval->y) { $result .= $interval->format("%y year(s) "); }
		if ($interval->m) { $result .= $interval->format("%m month(s) "); }
		if ($interval->d) { $result .= $interval->format("%d day(s) "); }
		if ($interval->h) { $result .= $interval->format("%h hour(s) "); }
		if ($interval->i) { $result .= $interval->format("%i minute(s) "); }
		if ($interval->s) { $result .= $interval->format("%s second(s) "); }

		return $result;
	}


}
