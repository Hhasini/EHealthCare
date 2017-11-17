<?php namespace App\Http\Controllers;

use App\CheckupPayment;
use App\DoctorVisit;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PatientSchedule;
use App\RecommendCheckup;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CheckupPaymentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('checkup_payments.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [

			'scheduleId' => 'required',
			'date'=>'date',
			'amount'=>'required',


		]);
		$input = $request->all();
		$patientscheduleId= $input['scheduleId'];
		CheckupPayment::create($input);

		$schedules = PatientSchedule::find($patientscheduleId);

		DB::table('patient_schedules')
			->where('id', $patientscheduleId)
			->update(['status' => 'Paid']);

		DB::table('checkup_shedules')->where('id',$schedules->scheduleId )->increment('count', 1);

		Session::flash('flash_message', 'Your Payment is successfully !');

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

	public function getPaymentInvoice($pid){
		$payment = CheckupPayment::find($pid);
		$patientSchedules =PatientSchedule::find($payment->scheduleId);
		$recommendCheckups = RecommendCheckup::find($patientSchedules->bookingID);
		$patient = DoctorVisit::find($recommendCheckups->visit_id);
		$patientList = \App\Patient::find($patient->patient_id);

		$cpLists = DB::table('medical_checkups')->where('checkup_id', '=',$recommendCheckups->checkup_id)->get();
		foreach ($cpLists as $cpList) {
			$cName= $cpList->checkup_name;
		}

		$today = date("Y-m-d");
		$fileName = 'invoice' . $pid . '-' . $today . '.pdf';
		if($payment!=null){
			$data = ["id" => $payment->pid, "name" => $patientList->name, "desc" => $cName, "amount" => $payment->amount, "date" => $payment->date, "today" => $today];
			$pdf = \App::make('dompdf');
			$pdf->loadView('checkup_payments.invoice', $data);
			//return $pdf->download($fileName);
			return $pdf->stream($fileName);
		}else{
			return 0;
		}
	}

	public function getFull(){

		return view('fasting_blood_counts.create');
	}

}
