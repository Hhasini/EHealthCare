<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MedicineCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class MedicineCartController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return view('medicinecarts.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('medicinecarts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$this->validate($request, [
			'medicine_id' => 'required|unique:medicine_carts',
			'amount' =>  'required|regex:/^[1-9]+[0-9]*$/',


		]);

		$med_id = $request->input('medicine_id');
		$amt= $request->input('amount');

		$meds=DB::table('medicines')->where('medicine_id',$med_id)->get();
		foreach($meds as $key=>$med)
		{
			$pric=$med->price;
		}

		$med_price=$this->calcMedicinePrice($pric,$amt);

		DB::table('medicine_carts')->insert(
			['medicine_id'=>$med_id,'amount' => $amt, 'price' => $med_price]
		);

		Session::flash('flash_message', 'Medicine Added to Cart Successfully!');

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
	public function update($id,Request $request)
	{

		$pric=null;
		$med_id=null;

		$this->validate($request, [
			'amount'=>'required|regex:/^[1-9]+[0-9]*$/',

		]);

		$amt= $request->input('amount');

		$cart=DB::table('medicine_carts')->where('id',$id)->get();
		foreach($cart as $key=>$c)
		{
			$med_id=$c->medicine_id;
		}

		$meds=DB::table('medicines')->where('medicine_id',$med_id)->get();
		foreach($meds as $key=>$med)
		{
			$pric=$med->price;
		}

		$med_price=$this->calcMedicinePrice($pric,$amt);



		DB::table('medicine_carts')
			->where('id', $id)
			->update(['amount' =>$amt,'price' => $med_price]);

		Session::flash('flash_message', 'Amount Changed Successfully!');

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
		DB::table('medicine_carts')->where('id',$id)->delete();

		Session::flash('flash_message', 'Item Deleted Successfully!');

		return redirect()->back();
	}

	public static function calcMedicinePrice($unit_price,$amt)
    {   $price=null;
		$price=$unit_price*$amt;
	    return $price;
    }

	public static function changeAmount($unit_price,$amt)
	{   $price=null;
		$price=$unit_price*$amt;
		return $price;
	}

	public static function EmptyCart()
	{  DB::table('medicine_carts')
		->delete();
		return view('medicinecarts.index');
	}

	public static function calcTotal()
	{   $tot=0;
		$cart=DB::table('medicine_carts')->get();
		foreach($cart as $key=>$c)
		{
			$tot=$tot+$c->price;
		}
		 return $tot;
	}

	public static function calcTotalPurchase($id)
	{   $tot=0;
		$cart=DB::table('purchase_medicines')->where('payment_id',$id)->get();
		foreach($cart as $key=>$c)
		{
			$tot=$tot+$c->price;
		}
		return $tot;
	}

	public function storeDetails(Request $request)
	{
		$this->validate($request, [
			'pname' => 'required',
			'sold' =>  'required',
			'doctor' =>  'required',
			'amount' =>  'required|regex:/^\d*(\.\d{2})?$/',


		]);

		$pname = $request->input('pname');
		$sold= $request->input('sold');
		$doc = $request->input('doctor');
		$amt= $request->input('amount');

		DB::table('pharmacy_payments')->insert(
			['patient_name'=>$pname,'sold_to' => $sold, 'doctor_name' => $doc,
				'amount' => $amt, 'payment_date' => date('Y-m-d H:i:s')]
		);

		$pays=DB::table('pharmacy_payments')
			->get();

		$pay_id=null;
		foreach($pays as $pay)
		{
			$pay_id=$pay->id;
		}



		$carts=DB::table('medicine_carts')->get();
		foreach($carts as $key=>$cart)
		{
			$med_id=$cart->medicine_id;
			$med_amt=$cart->amount;
			$med_price=$cart->price;

			DB::table('purchase_medicines')->insert(
				['payment_id'=>$pay_id,'medicine_id'=>$med_id,'amount' => $med_amt, 'price' => $med_price]
			);
		}

		DB::table('medicine_carts')
			->delete();

		Session::flash('flash_message', 'Payment Added Successfully!');

		return redirect()->back();

	}

	public function printInvoice($id){


		$today = date("Y-m-d");
		$fileName = 'Invoice - Payment -P' . $id . '-' . $today . '.pdf';



		$pdf = \App::make('dompdf');
		$pdf->setPaper('a4', 'landscape')->setWarnings(false)
			->loadView('medicinecarts.pharmacyInvoice');
		//return $pdf->download($fileName);
		return $pdf->stream($fileName);}




}
