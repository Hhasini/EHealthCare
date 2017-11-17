<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PatientSchedule;
use App\RecommendCheckup;
use App\TimeSlot;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;





class PatientScheduleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return view('patient_schedules.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('patient_schedules.create');
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

			'bookingID' => 'required',

			'status'=>'required',


		]);


		$input = $request->all();
		$scheduleId= $input['scheduleId'];
		$bookingId= $input['bookingID'];
		PatientSchedule::create($input);

		DB::table('checkup_shedules')->where('id',$scheduleId )->decrement('count', 1);

		//$recommendChp = RecommendCheckup::find($bookingId);

		//$visit_id=$recommendChp->visit_id;

		DB::table('recommend_checkups')
			->where('id', $bookingId)
			->update(['status' => 'Done']);

		Session::flash('flash_message', 'You have successfully allocated Resource!');

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
		$schedule = PatientSchedule::find($id);
		return view('patient_schedules.show', array('schedule' => $schedule));
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
		$schedule = PatientSchedule::find($id);
		return view('patient_schedules.edit', array('schedule' => $schedule));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		//
		$schedule = PatientSchedule::find($id);

		$this->validate($request, [
			'bookingID' => 'required',

			'status'=>'required',
		]);

		$input = $request->all();
		$scheduleId= $input['scheduleId'];
		$schedule->fill($input)->save();

		DB::table('checkup_shedules')->where('id',$scheduleId )->decrement('count', 1);

		Session::flash('flash_message', 'Your Schedule successfully Updated!');

		return redirect()->back();
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
		try {
			$result = PatientSchedule::findOrFail($id);

			$patientSchedule = PatientSchedule::find($id);

			$schedule_id = $patientSchedule->scheduleId;

			DB::table('checkup_shedules')->where('id',"=",$schedule_id )->increment('count', 1);

			$result->delete();

			DB::table('patient_schedules')->where('id'
				, '=', $id)->delete();

			Session::flash('flash_message', 'Schedule successfully deleted!');

		} catch (Exception $ex) {

		}

		return redirect()->back();
	}

	public function getTimeList($id,$date)
	{
		$response = "";
		$sch_id = 0;
		$time_id = 0;
		$res_id = 0;
		$time_set = array();

		$results = DB::table('checkup_shedules')->where('resourceId','=',$id)->where('date','=',$date)->where('count','!=',0)->get();
		foreach ($results as $result) {
			$sch_id = $result->id;
			$res_id = $result->resourceId;
			$time_id = $result->timeSlot;

			$timenames = TimeSlot::where('id', $time_id)->get();

			foreach ($timenames as $timename) {
				$timeName=$timename->start."-".$timename->end;
				$response = $response . "<option value = '$sch_id' >$timeName</option >";
			}
		}

		return $response;
	}

	public function viewScheduledCheckups()
	{

		return view('patient_schedules.scheduledCheckup');
	}
	public function viewCompletedCheckups()
	{
		return view('patient_schedules.completedCheckupList');
	}

	public function viewReports(){
		return view('patient_schedules.viewCheckupReports');
	}




}
