<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Http\Request;
use App\Booking;
use App\Channelingpayment;
use Session;

class BookingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        return view('booking.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {


        $this->validate($request, [
            'patient_id' => 'required',
            'schedule_id' => 'required',
            'number' => 'required',
            'status'=>'required'
        ]);
        
        $schedule_id=$request->input('schedule_id');
        $patient_id=$request->input('patient_id');
        
        $booking_check=DB::table('bookings')
                        ->where('schedule_id','=', $schedule_id)
                        ->where('patient_id','=', $patient_id)
                        ->get();
        
        if(!empty($booking_check)){
            Session::flash('flash_error', 'You have already made this Booking!');
             return redirect()->back();
            
        }
               
        else{
             $input = $request->all();  
            Booking::create($input);

            DB::table('e_schedules')
                ->where('schedule_id','=', $schedule_id)
                ->update(['max_bookings' => DB::raw('max_bookings-1')]);

            Session::flash('flash_message', 'Your Booking is successful Make your Payment here!');
        }


//        $user_id = \Auth::user()->user_id;
//        $patients = DB::table('patients')
//                ->select('name', 'address', 'email', 'phone', 'id')
//                ->where('member_id', '=', $user_id)
//                ->get();


        return view('channeling_payments.create',array('schedule_id' => $schedule_id,'patient_id'=>$patient_id));
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

    public static function generatePatientNumber() {
        $new_idea_id = "";
        $results = DB::table('bookings')
                ->select('booking_id')
                ->get();
        $member_ids = array();
        

        foreach ($results as $result) {
            $member_ids[] = $result->booking_id ;
        }

        if (sizeof($member_ids) > 0) {
            rsort($member_ids);
            $member_id_suffix = substr($member_ids[0], strpos($member_ids[0], "R") + 1);
            $new_member_id = "PTR" . (intval($member_id_suffix) + 1);
        } else {
            $new_member_id = "PTR1";
        }

        return $new_member_id;
    }
    
    public function payment(Request $request) {
        $booking = Booking::find($request->booking_id);
        return view('booking.index', array('booking' => $booking));
    }

    public function paymentInfo(Request $request) {
        if ($request->tx) {
            if ($payment = Channelingpayment::where('transaction_id', $request->tx)->first()) {
                $payment_id = $payment->id;
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
