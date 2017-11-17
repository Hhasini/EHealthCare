<?php namespace App\Http\Controllers;

use App\FullBloodCount;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DoctorVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\PatientSchedule;
use Illuminate\Support\Facades\DB;

class FullBloodCountController extends Controller {

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
		return view('full_blood_counts.create');
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
			'wbc' => 'required',
			'rbc' => 'required',
			'hgb' => 'required',
			'platelet' => 'required',
			'neut' => 'required',
			'lymph' => 'required',
			'mono' => 'required',
			'eos' => 'required',
			'baso' => 'required',


		]);
		$input = $request->all();
		$patientscheduleId= $input['patientSchId'];
		FullBloodCount::create($input);



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
			$result = FullBloodCount::findOrFail($id);


			$result->delete();

			DB::table('full_blood_counts')->where('id'
				, '=', $id)->delete();

			Session::flash('flash_message', 'Schedule successfully deleted!');

		} catch (Exception $ex) {

		}

		return redirect()->back();
	}

	public function getFullBloodReport($id){

		$results = FullBloodCount::find($id);

		$patient = DoctorVisit::find($results->visit_id);
		$patientList = \App\Patient::find($patient->patient_id);

		$today = date("Y-m-d");
		$fileName = 'invoice' . $id . '-' . $today . '.pdf';
		if($results!=null){
			$data = ["enterDate" => $results->enterDate, "wbc" => $results->wbc, "rbc" => $results->rbc, "hgb" => $results->hgb, "platelet" => $results->platelet,"neut" => $results->neut,"lymph" => $results->lymph,"mono" => $results->mono,"eos" => $results->eos,"baso" => $results->baso,"pid" => $patientList->name,"pNic" => $patientList->nic,"pSex" => $patientList->sex, "today" => $today];
			$pdf = \App::make('dompdf');
			$pdf->loadView('checkup_reports.full_blood_report', $data);
			//return $pdf->download($fileName);
			return $pdf->stream($fileName);
		}else{
			return 0;
		}
	}

}
