<?php namespace App\Http\Controllers;

use App\EC_DocRates;
use App\Http\Requests;
use Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class EC_DocRateController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	try{
	$rates = EC_DocRates::all();
	}

	catch (Exception $ex) {
		Log::error($ex->getMessage());
		}

			return view('EC_DOC_RATES.index', array('rate' => $rates));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('EC_DOC_RATES.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		try {

		$this->validate($request, [

			'doc_id' => 'required',
			'rate' => 'required',

		]);

		$input = $request->all();

		EC_DocRates::create($input);


		Log::debug("EC_DocRateController:store - Add New Payment Details : " . implode(',', array_slice($input, 1)));

		Session::flash('flash_message', 'Payment Details successfully Added!');
	}

	catch (Exception $ex) {
		Log::error($ex->getMessage());
	}
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
	public function edit($rid)
	{
		try {
			$rates = EC_DocRates::find($rid);
		}

		 catch (Exception $ex) {
			Log::error($ex->getMessage());
		}

		return view('EC_DOC_RATES.edit', array('rate' => $rates));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($rid, Request $request)
	{
	try{
		$rate = EC_DocRates::find($rid);

		$this->validate($request, [
			'doc_id' => 'required',
			'rate' => 'required'

		]);

		$input = $request->all();

		$rate->fill($input)->save();

		Session::flash('flash_message', 'Schedule successfully Updated!');

	} catch (Exception $ex) {
		Log::error($ex->getMessage());
	}
		return redirect()->back();

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($rid)
	{
		try {
			$rate =EC_DocRates::findOrFail($rid);

			$rate->delete();


			Log::info("EC_DocRateController:destroy - Deleted Schedule : " . $rid);

			Session::flash('flash_message', 'Payment Record successfully deleted!');

		} catch (Exception $ex) {
			Log::error($ex->getMessage());
		}

		return redirect()->route('EC_DOC_RATES.index');

	}

}
