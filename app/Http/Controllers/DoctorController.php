<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;


use App\Doctor;
use Session;

class DoctorController extends Controller {

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
		return view('doctors.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$acc_head = User::lists('name', 'designation');

		$this->validate($request, [
			'doctor_id' => 'required|unique:doctors',
			'name' => 'required|regex:/^[a-z A-Z,.\'-]+$/i',
			'email'=> 'required|email|unique:doctors',
			'specialty'=>'required',
			'nic'=> 'required|unique:doctors|regex:/^[0-9]{9}[vVxX]$/',
			'address'=> 'required',
			'phone'=> 'required|unique:doctors|regex:/^[0]{1}[7]{1}[0127658]{1}[0-9]{7}$/',
			'password'=>'required|min:6|confirmed',


		]);

		$input = $request->all();

		//Doctor::create($input);
//if($input['password']==$input['password_confirmation'])
		DB::table('doctors')->insert(
			['doctor_id'=>$input['doctor_id'],'name' => $input['name'], 'email' => $input['email'],'specialty' => $input['specialty'],'nic' => $input['nic'],'address' => $input['address'],'phone' => $input['phone']]
		);

		DB::table('users')->insert(
			['user_id'=>$input['doctor_id'],'name' => $input['name'], 'user_type' => "Doctor",'email' => $input['email'],'password'=>bcrypt($input['password'])]
		);

		Session::flash('flash_message', 'Doctor Added Successfully!');

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

	public static function generateDoctorID()
	{
		$new_idea_id = "";
		$results = DB::table('doctors')->get();
		$doctor_ids = array();

		foreach ($results as $result) {
			$doctor_ids[] = $result->doctor_id;
		}

		if (sizeof($doctor_ids) > 0) {
			rsort($doctor_ids);
			$doctor_id_suffix = substr($doctor_ids[0], strpos($doctor_ids[0], "C") + 1);
			$new_doctor_id = "DOC". (intval($doctor_id_suffix) + 1);
		} else {
			$new_doctor_id = "DOC1";
		}

		return $new_doctor_id;

	}

}
