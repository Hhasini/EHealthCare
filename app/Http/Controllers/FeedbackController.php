<?php namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	try{
		$feedbacks = Feedback::take(10)->get();

	} catch (Exception $ex) {
		Log::error($ex->getMessage());
	}
		return view('feedback.index', array('feedback' => $feedbacks));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{


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

				'name' => 'required',
				'feedback' => 'required'

			]);


		$input = $request->all();

        Feedback::create($input);

     	Session::flash('flash_message', 'Feedback successfully posted!');
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

}
