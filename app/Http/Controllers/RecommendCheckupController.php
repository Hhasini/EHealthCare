<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use App\DoctorVisit;
use App\Booking;
use Illuminate\Support\Facades\DB as DB;
use Session;

class RecommendCheckupController extends Controller {

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
		$visit = DoctorVisit::find($id);

		return view('recommendcheckups.edit', array('visit' => $visit));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

		$this->validate($request, [

			'checkups' => 'required|array|min:1'



		]);

		$input = $request->all();

		$checked_checkup_ids = $input['checkups'];

		DB::table('recommend_checkups')->where('visit_id', '=', $id)->delete();

		if (is_array($checked_checkup_ids)) {
			foreach ($checked_checkup_ids as $chkup_id) {
				DB::table('recommend_checkups')->insert(
					['visit_id' => $id,'checkup_id' => $chkup_id, 'status'=>'Pending']
				);
			}
		}

		unset($input['checkups']);


		Session::flash('flash_message', 'Medical Checkups recommended successfully!');

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
		DB::table('recommend_checkups')->where('visit_id', '=', $id)->delete();

		Session::flash('flash_message', 'All Checkups Deleted Successfully!');

		return redirect()->back();
	}

	public static function getVisit($id)
	{
		$visit_id=null;

		$result=DB::table('doctor_visits')->where('booking_id',$id)->get();

		foreach($result as $key => $visit)
		{
			$visit_id=$visit->id;
		}

		return $visit_id;
	}

}
