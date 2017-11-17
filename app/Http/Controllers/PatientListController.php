<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Patient;
use App\DoctorVisit;

class PatientListController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('patientlist.index');
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
		$patient = Patient::find($id);

		return view('patientlist.show', array('patient' => $patient));
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

	public function viewVisit($id)
	{
		$visit = DoctorVisit::find($id);


		return view('patientlist.viewVisit', array('visit' => $visit));

	}

	public function viewAllVisits($id)
	{
		$patient = Patient::find($id);


		return view('patientlist.viewAllVisits', array('patient' => $patient));

	}

	public function printCard($id){


		$patient = Patient::find($id);



		$today = date("Y-m-d");
		$fileName = 'DiagnosisCard' . $id . '-' . $today . '.pdf';

		$paper_orientation = 'landscape';
		$customPaper = array(0,0,2000,2000);

			$pdf = \App::make('dompdf');
			$pdf->setPaper($customPaper,$paper_orientation)->setPaper('a4', 'landscape')->setWarnings(false)
				->loadView('patientlist.viewAllVisits',array('patient' => $patient));
			//return $pdf->download($fileName);
			return $pdf->stream($fileName);}


}
