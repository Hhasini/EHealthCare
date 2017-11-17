@extends('app')



@section('content')

<div class="container">
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    @if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
    @endif
    

    <br><br> <br>
    <?php
         $schedule_id = Input::get('schedule_id');
         $patient_id = Input::get('patient_id');
         $bookings = DB::table('bookings')
                     ->join('e_schedules', 'bookings.schedule_id', '=', 'e_schedules.schedule_id')
                     ->join('e_c__doc_rates', 'e_schedules.doc_id', '=', 'e_c__doc_rates.doc_id')
                     ->select('bookings.booking_id','e_c__doc_rates.rate')
                     ->where('bookings.schedule_id', '=', $schedule_id)
                     ->where('bookings.patient_id', '=', $patient_id)
                     ->get();
    ?>

    <div class="col-md-6 col-md-offset-2" >

        <div class="box box-default">
            <div class="box-header with-border">
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmTransaction" id="frmTransaction">
                    
                    <input type="hidden" name="cmd" value="_xclick"> 
                     @foreach($bookings as $key => $booking)
                    <input type="hidden" name="booking_id" value="{{$booking->booking_id}}">
                    
                    @endforeach
                    <b>E-mail</b> <input class="form-control" type="text" name="business" placeholder="Enter your email address" required="true"> 
                    <br>
                    <b>Amount to pay</b>
                    <input class="form-control" type="text" name="charge" value="$<?php echo round($booking->rate/148.01,2); ?>">
                    <input type="hidden" name="currency_code" value="USD">   
                    <input type="hidden" name="cancel_return" value="http://demo.expertphp.in/payment-cancel"> 
                    <input type="hidden" name="return" value="http://demo.expertphp.in/payment-status">
                    <br>
                    <br>
                    <input type="submit" value="Pay Now" class="btn btn-info" name="payment_button" id="payment_button" >
                </form>
         
            </div> 
        </div>
    </div>
    
  @endsection

  
