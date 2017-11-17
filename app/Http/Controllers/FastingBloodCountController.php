<?php namespace App\Http\Controllers;

use App\FastingBloodCount;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\DoctorVisit;
use Illuminate\Support\Facades\DB;
class FastingBloodCountController extends Controller {

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
		//
		return view('fasting_blood_counts.create');
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

			'enterDate' => 'required',
			'fbs' => 'required',
		]);

		$input = $request->all();
		$patientscheduleId= $input['patientSchId'];
		FastingBloodCount::create($input);

		DB::table('patient_schedules')
			->where('id', $patientscheduleId)
			->update(['status' => 'Completed']);

		Session::flash('flash_message', 'Successfully added results !');

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
		try {
			$result = FastingBloodCount::findOrFail($id);


			$result->delete();

			DB::table('fasting_blood_counts')->where('id'
				, '=', $id)->delete();

			Session::flash('flash_message', 'Schedule successfully deleted!');

		} catch (Exception $ex) {

		}

		return redirect()->back();
	}

	public function getFastingBloodReport($fsId){

		$results = FastingBloodCount::find($fsId);

		$patient = DoctorVisit::find($results->visit_id);
		$patientList = \App\Patient::find($patient->patient_id);

		$today = date("Y-m-d");
		$fileName = 'invoice' . $fsId . '-' . $today . '.pdf';
		if($results!=null){
			$data = ["enterDate" => $results->enterDate, "fbs" => $results->fbs,"pid" => $patientList->name,"pNic" => $patientList->nic,"pSex" => $patientList->sex, "today" => $today];
			$pdf = \App::make('dompdf');
			$pdf->loadView('checkup_reports.fasting_blood_report', $data);
			//return $pdf->download($fileName);
			return $pdf->stream($fileName);
		}else{
			return 0;
		}
	}

}
