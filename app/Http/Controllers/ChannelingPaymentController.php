<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB as DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\Channelingpayment;
use Session;


class ChannelingPaymentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
         
        return view('channeling_payments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    public function payment(Request $request) {
        $booking = Booking::find($request->booking_id);
        return view('booking.index',compact('booking'));
    }

    public function paymentInfo(Request $request) {
        if ($request->tx) {
            if ($payment = Channelingpayment::where('transaction_id', $request->tx)->first()) {
                $payment_id = $payment->payment_id;
            } else {
                $payment = new Channelingpayment;
                $payment->booking_id = $request->booking_id;
                $payment->transaction_id = $request->tx;
                $payment->currency_code = $request->cc;
                $payment->payment_status = $request->st;
                $payment->save();
                $payment_id = $payment->payment_id;
            }
            return 'Pyament has been done and your payment id is : ' . $payment_id;
        } else {
            return 'Payment has failed';
        }
    }

}
