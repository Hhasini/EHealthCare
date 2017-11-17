<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Medicine;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$medicines = Medicine::all();

		return view('medicines.index', array('medicines' => $medicines));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('medicines.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'medicine_name' => 'required',
			'description' =>  'required',
			'manufacturer' => 'required',
			'price' =>  'required',


		]);

		$input = $request->all();

		Medicine::create($input);

		Session::flash('flash_message', 'Medicine Added successfully!');

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
		$medicine = Medicine::find($id);

		return view('medicines.show', array('medicine' => $medicine));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$medicine = Medicine::find($id);

		return view('medicines.edit', array('medicine' => $medicine));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$medicine = Medicine::find($id);

		$this->validate($request, [
			'medicine_name'=>'required',
			'description' => 'required',
			'manufacturer' => 'required',
			'price' => 'required',


		]);

		$input = $request->all();

		$medicine->fill($input)->save();

		Session::flash('flash_message', 'Medicine details successfully Updated!');

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
		DB::table('medicines')->where('medicine_id',$id)->delete();

		Session::flash('flash_message', 'Medicine Deleted Successfully!');

		return redirect()->back();
	}

}
