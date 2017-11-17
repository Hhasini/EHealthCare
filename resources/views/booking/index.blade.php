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
    
    @if(Session::has('flash_error'))
    <div class="alert alert-danger">
        {{ Session::get('flash_error') }}
    </div>
    @endif

    @if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
    @endif
    <?php

    use Illuminate\Support\Facades\DB as DB;
    use App\Http\Controllers\BookingController;
    use App\Booking;
    ?>


    <br><br> <br>

    <div class="col-md-6 col-md-offset-2" >

        <div class="box box-default">
            <div class="box-header with-border">
                <!-- route to store method in controller to store data-->


                <br>
                <div class="panel panel-aqua col-md-offset-3" style="width: 90%">
                    <div class="panel-heading" ><h3 style="color: white">Channel Details</h3></div>

                    <div class="panel-body">

                        <table style="width:600px;">

                            <?php
                            $schedule_id = Input::get('schedule_id');
                            $patient_id = Input::get('patient_id');


                            $bookings = DB::table('doctors')->join('e_schedules', 'doctors.doctor_id', '=', 'e_schedules.doc_id')
                                    ->select('doctors.name', 'e_schedules.schedule_id', 'doctors.email', 'doctors.specialty', 'e_schedules.shift_start', 'e_schedules.shift_end')
                                    ->where('e_schedules.schedule_id', '=', $schedule_id)
                                    ->get();
                            ?>
                            @foreach($bookings as $key => $booking)
                            <tr>

                                <td>
                                    <b>Doctor Name: {{ $booking->name }}</b>
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    <b>Specialization:</b> {{ $booking->specialty }}
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    <b> From:</b> {{ $booking->shift_start }}(24hr)
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <b>To:</b> {{ $booking->shift_end }}(24hr)
                                </td>

                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <br>
                <div class="panel panel-info" style="width: 140%">
                    <div class="panel-heading" ><h3 style="color: #0a470d">Patient Details</h3></div>

                    <div class="panel-body">
                        <table style="width:600px;">
                            <?php
                            $patients = DB::table('patients')
                                    ->select('name', 'address', 'email', 'phone', 'sex', 'nic')
                                    ->where('id', '=', $patient_id)
                                    ->get();
                            ?>
                            @foreach($patients as $key => $patient)
                            <tr>

                                <td>
                                    <b>Patient Name: {{ $patient->name }}</b>
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    <b>Address:</b> {{ $patient->address }}
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <b>Phone:</b> {{ $patient->phone }}
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <b>Email:</b> {{ $patient->email }}
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <b> NIC:</b> {{ $patient->nic }}
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <b> Gender:</b> <?php
                            if ($patient->sex == 'F') {
                                echo 'Female';
                            } elseif ($patient->sex == 'M') {
                                echo 'Male';
                            }
                            ?>
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <br

                                </td>

                            </tr>
                            <tr>

                                <td>
                                    <?php 
                                    $bookings = DB::table('bookings')
                                            ->where('schedule_id', '=', $schedule_id)
                                            ->where('patient_id', '=', $patient_id)
                                            ->get();

                                    $max_bookings = DB::table('e_schedules')
                                            ->where('schedule_id', '=', $schedule_id)
                                            ->where('max_bookings', '>', 0)
                                            ->get();
                                    if (empty($bookings) && !empty($max_bookings)) {
                                    ?>
                                    <input type="checkbox" checked="false" onclick="create_booking()" name="create_booking" id="create_booking" >
                                    <b style="color: #0033cc">I accept the terms and conditions </b>
                                    <!--                                    <div class="form-group">
                                                                            <label for="status_yes">Yes</label>
                                                                            <input class="radio-inline" name="status"  id="status_yes" type="radio" checked="true" value="Yes"  />
                                                                            <label for="status_no">No</label>
                                                                            <input class="radio-inline" name="status"  id="status_no" type="radio" value="No"  />
                                                                        </div>-->
                                    <?php
                                    $status = Input::get('status');
                                    $schedule_id = Input::get('schedule_id');
                                    $patient_id = Input::get('patient_id');

                                    $number = BookingController::generatePatientNumber();
?>                                  
                                    {!! Form::open(['route' => 'booking.store']) !!}
                                    <br>
                                    <label class="col-md-4 control-label">Your Appointment Number</label>

                                    <input type="text" style="width:20%" class="form-control" readonly="true" name="number" id="number" value="<?php echo $number ?>">

    <!--                                        <input  name="status_text" id="status_text" type="text" value="<?php echo $status ?>" />-->
                                    <input class="form-control" name="patient_id"  id="patient_id" type="hidden" value="<?php echo $patient_id ?>"/>

                                    <input class="form-control" name="schedule_id"  id="schedule_id" type="hidden" value="<?php echo $schedule_id ?>" />
                                    <input class="form-control" name="status"  id="status" type="hidden" value="Initial" />
                                    <br>
                                    <br>
                                    <input type="submit" value="Submit" class="btn btn-success" name="booking_button" id="booking_button" onclick="payment()">
                                    <br>
                                        
                                    {!! Form::close() !!}
                                    
                                    <?php
                                        }elseif(!empty($bookings))
                                        { ?>
                                            <h3 class="text-center" style="color: #C40D0D;">You have already made this Booking! </h3>
                                         <?php   
                                        }elseif(empty($max_bookings)){ ?>
                                            <h3 class="text-center" style="color: #C40D0D;">Sorry Bookings for this schedule is over! </h3>
                                        <?php    
                                        }
                                    ?>
                                   
                                </td>

                            </tr>
                            @endforeach
                        </table>
                        <br>
                    </div>


                </div>

            </div>


        </div>
        <br><br><br><br>
        @endsection

        @section('page_script2')
<!--         <SCRIPT>document.frmTransaction.submit();</SCRIPT> -->

        <script type="text/javascript">

            function create_booking() {

                if ($("#create_booking").is(":checked")) {
                    $('#booking_button').prop('disabled', false);

                } else {
                    $('#booking_button').prop('disabled', 'disabled');
                }
            }

            function payment() {
                 $('#payment_button').prop('disabled', false);
            }

        </script>

        @endsection
