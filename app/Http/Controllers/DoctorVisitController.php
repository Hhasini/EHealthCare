<?php namespace App\Http\Controllers;

use App\DoctorVisit;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

use Session;

class DoctorVisitController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$bookings = Booking::all();

		return view('doctorvisits.index', array('bookings' => $bookings));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$booking = Booking::find($id);

		return view('doctorvisits.show', array('booking' => $booking));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$booking = Booking::find($id);

		return view('doctorvisits.edit', array('booking' => $booking));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
        $patient_id=null;
		$day=null;

		$result =DB::table('bookings')->where('booking_id',$id)->get();
		foreach($result as $key => $booking){
			$patient_id=$booking->patient_id;
			$schedule_id=$booking->schedule_id;

			$res =DB::table('e_schedules')->where('schedule_id',$schedule_id)->get();
			foreach($res as $key => $schedule){
				$day=$schedule->shift_start;


			}

		}


		$this->validate($request, [
			'booking_id' => 'required|unique:doctor_visits',
			'patient_id' => 'required',
			'doctor_id' =>  'required',
			'visit_date' =>  'required',
			'family_history' => 'required',
			'diagnosis_notes' => 'required',
			'prescription' => 'required',


		]);

		$input = $request->all();

		DoctorVisit::create($input);

		Session::flash('flash_message', 'Diagnosis details added successfully!');

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
		DB::table('bookings')->where('booking_id', '=', $id)->update([
			'status' => 'Finished'
		]);

		Session::flash('flash_message', 'Diagnosis Finished Successfully!');

		return redirect()->back();


	}

	public static function getPatientName($id)
	{
		$result =DB::table('patients')->where('id',$id)->get();
        $patient_name="";
		foreach($result as $key => $patient){
			$patient_name=$patient->name;

		}

		return $patient_name;

	}

	public static function getChannelingSlot($id)
	{
		$result =DB::table('e_schedules')->where('schedule_id',$id)->get();
		$slot="";
		foreach($result as $key => $schedule){
			$slot=$schedule->shift_start;

		}

		return $slot;

	}

	public static function isVisit($id)
	{
		$result =DB::table('doctor_visits')->where('booking_id',$id)->get();
		$isvisit=false;
		$visit_id=null;
		foreach($result as $key => $res){
			$visit_id=$res->id;

		}
		if($visit_id!==null)
		{
			$isvisit=true;
		}

		return $isvisit;

	}

	public static function hasPrevious($id)
	{
		$result =DB::table('doctor_visits')->where('patient_id',$id)->get();
		$prev=false;
		$visit_id=null;
		foreach($result as $key => $res){
			$visit_id=$res->id;

		}
		if($visit_id!==null)
		{
			$prev=true;
		}

		return $prev;

	}

	public static function hasCheckup($id)
	{
		$result =DB::table('recommend_checkups')->where('visit_id',$id)->get();
		$isCheckup=false;
		$chkup_id=null;
		foreach($result as $key => $res){
			$chkup_id=$res->checkup_id;

		}
		if($chkup_id!==null)
		{
			$isCheckup=true;
		}

		return $isCheckup;

	}

	public static function isInitial($id)
	{
		$result =DB::table('bookings')->where('booking_id',$id)->get();
		$isInitial=false;
		$status=null;
		foreach($result as $key => $res){
			$status=$res->status;

		}
		if($status=='Initial')
		{
			$isInitial=true;
		}

		return $isInitial;

	}

	public function printPres($id){


		$today = date("Y-m-d");
		$fileName = 'Prescription - ' . $id . '-' . $today . '.pdf';



		$pdf = \App::make('dompdf');
		$pdf->setPaper('a4', 'landscape')->setWarnings(false)
			->loadView('doctorvisits.prescription');
		//return $pdf->download($fileName);
		return $pdf->stream($fileName);
	}

	public static function getPrescription($text)
	{
		$myArray = explode(',', $text);
		return $myArray;
	}

}
