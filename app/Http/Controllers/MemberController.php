<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB as DB;

use Illuminate\Http\Request;
use App\Member;
use Session;

class MemberController extends Controller {

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
		return view('members.create');
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
			'member_id' => 'required|unique:members',
			'name' => 'required|regex:/^[a-z A-Z,.\'-]+$/i',
			'email'=> 'required|email|unique:members',
			'nic'=> 'required|unique:members|regex:/^[0-9]{9}[vVxX]$/',
			'address'=> 'required',
			'phone'=> 'required|unique:members|regex:/^[0]{1}[7]{1}[0127658]{1}[0-9]{7}$/',
			'password'=>'required|min:6|confirmed',


		]);

		$input = $request->all();

		//Member::create($input);
//if($input['password']==$input['password_confirmation'])
		DB::table('members')->insert(
			['member_id'=>$input['member_id'],'name' => $input['name'], 'email' => $input['email'],'nic' => $input['nic'],'address' => $input['address'],'phone' => $input['phone']]
		);

		DB::table('users')->insert(
			['user_id'=>$input['member_id'],'name' => $input['name'], 'user_type' => "Member",'email' => $input['email'],'password'=>bcrypt($input['password'])]
		);

		Session::flash('flash_message', 'You have successfully registered!');

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

	public static function generateMemberID()
	{
		$new_idea_id = "";
		$results = DB::table('members')->get();
		$member_ids = array();

		foreach ($results as $result) {
			$member_ids[] = $result->member_id;
		}

		if (sizeof($member_ids) > 0) {
			rsort($member_ids);
			$member_id_suffix = substr($member_ids[0], strpos($member_ids[0], "R") + 1);
			$new_member_id = "MBR". (intval($member_id_suffix) + 1);
		} else {
			$new_member_id = "MBR1";
		}

		return $new_member_id;

	}

}
