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

    <div class="panel panel-aqua " style="width: 100%">
        <div class="panel-heading" >
            <h1 class="text-center" style="color: #0a470d"> {{ $patient->name }} <a class="fa fa-pencil-square-o" style="position: absolute;right:200px" href="#" data-toggle="modal" data-target="#edit_patient"></a></h1> 
        </div>

        <div class="panel-body">

            <table class="col-lg-offset-5" style="width:50%;color: #000;font-size: 16px" >

                <tr>

                    <td style="color: #f4f4f4;">hhhh </td>

                </tr>

                <tr>

                    <td ><b>NIC :</b>{{ $patient->nic }} </td>

                </tr>
                
                <tr>

                    <td style="color: #f4f4f4;">hhhh </td>

                </tr>
                
                <tr>

                    <td ><b>Date Of Birth :</b>{{ $patient->dob }} </td>

                </tr>
                
                <tr>

                    <td style="color: #f4f4f4;">hhhh </td>

                </tr>

                <tr >

                    <td ><b>Address : </b>{{ $patient->address }} </td>

                </tr>
                <tr>

                    <td style="color: #f4f4f4;">hhhh </td>

                </tr>

                <tr >

                    <td> 
                        <b>Phone: </b>{{ $patient->phone }}
                    </td>

                </tr>
                <tr>

                    <td style="color: #f4f4f4;">hhhh </td>

                </tr>

                <tr >

                    <td > 
                        <b>Email: </b>{{ $patient->email }}

                    </td>


                </tr>
                <tr>

                    <td style="color: #f4f4f4;">hhhh </td>

                </tr>
                <tr >

                    <td > 
                        <b>Gender: </b>
                        <?php
                        if ($patient->sex == 'F') {
                            echo 'Female';
                        } else {
                            echo 'Male';
                        }
                        ?>

                    </td>


                </tr>
                <tr>

                    <td style="color: #f4f4f4;">hhhh </td>

                </tr>



            </table>


            <div id="edit_patient" class="modal fade" role="dialog">
                    <div class="modal-dialog" >
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#66a67c">
                                <!-- Modal button to close form-->
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="color: white"><b>Edit Patient</b></h4>
                            </div>
                            <div class="modal-body col-md-offset-1">
                                <section class="content">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <!-- Update patient-->
                                            {!! Form::model($patient, ['method' => 'PATCH','route' => ['patients.update', $patient->id   ], 'data-toggle' => 'validator']) !!}

                                            <div class="form-group">

                                                <?php
                                                    $member_id=\Auth::user()->user_id;
                                                ?>
                                                    <input type="hidden" class="form-control" readonly="true" name="member_id" id="member_id" value="<?php echo $member_id; ?>">

                                            </div>

                                            <div class="form-group">
                                                <b>Name</b>
                                                <input class="form-control" name="name" id="name" type="text" value='{{ $patient->name }}' style="width: 50%;" />

                                            </div>


                                            <div class="form-group">
                                                <b>National ID </b>
                                                <input class="form-control" name="nic" id="nic" type="text" value='{{ $patient->nic }}' style="width: 50%;" />
                                            </div>

                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                               <div class='input-group date' style="width: 50%;">
                                                    <input type='text' class="form-control datepick" value='{{ $patient->dob }}' id="dob" name="dob"  />

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                    <b>Gender </b>
                                                    <div class="form-group">
                                                        <label for="sex_male">Male</label>
                                                        <input class="radio-inline" name="sex"  id="sex_male" type="radio" <?php if($patient->sex=='M') {?>checked="true" <?php } ?> value="M"  />
                                                        <label for="sex_female">Female</label>
                                                        <input class="radio-inline" name="sex"  id="sex_female" type="radio" <?php if($patient->sex=='F') {?>checked="true" <?php } ?> value="F"  />
                                                    </div>

                                            </div>


                                            <div class="form-group">

                                                <div class="form-group">
                                                    <b> Address </b>
                                                    <textarea class="form-control" name="address" id="address"  placeholder=""
                                                              style="width: 50%;height:15%;" >{{ $patient->address }}</textarea>
                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <div class="form-group">
                                                    <b>Email </b>
                                                    <input class="form-control" name="email" value='{{ $patient->email }}' id="email" type="text" placeholder="" style="width: 50%;" />
                                                </div>

                                            </div>
                                            <div class="form-group">

                                                <div class="form-group">
                                                    <b>Phone </b>
                                                    <input class="form-control" name="phone"  id="phone" type="text"value='{{ $patient->phone }}' style="width: 50%;" />
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                                {!! Form::close() !!}
                                            </div>

                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
            </div>


        </div>
    </div>
    <br>
    <h2 class="text-center">Booking Details</h2>
    <br>

    <?php
    if (!empty($appointments)) {
        ?>
        <table class="table table-striped table-bordered scrollable_div">
            <thead style="background-color: #3c8dbc">
                <tr style="font-weight: 900 ;color: #eff7ff">
                    <td>Doctor</td>
                    <td>Appointment Date</td>
                    <td>Schedule</td>
                    <td>Appointment Number</td>
                    <td>Room</td>
                    <td>Status</td>
                    <td>Payment Status</td>
                </tr>
            </thead>
            <tbody>

                @foreach($appointments as $appointment)
                <tr>

                    <td>{{ $appointment->name }}</td>
                    <td><?php
                        $shift_start = $appointment->shift_start;
                        $datetimearray = explode(" ", $shift_start);
                        echo $datetimearray[0];
                        ?>
                    </td>

                    <td>
                        <?php
                        $shift_start = $appointment->shift_start;
                        $datetimearray1 = explode(" ", $shift_start);
                        $shift_end = $appointment->shift_end;
                        $datetimearray2 = explode(" ", $shift_end);
                        ?> 
                        <span  class='label label-info' ><?php echo $datetimearray1[1] . '-' . $datetimearray2[1]; ?> </span>
                    </td>

                    <td>
                        {{ $appointment->number }}
                    </td>
                    <td>
                        {{ $appointment->room_name }}
                    </td>
                    <td>
                        <?php
                        if ($appointment->status == "Initial") {
                            ?>
                            <span  class='label label-danger' >
                                <?php
                            } else {
                                ?>
                                <span  class='label label-success' >
                                <?php } ?>
                                {{ $appointment->status }}
                            </span>
                    </td>
                    <td> 
                        
                            <?php 
                            $payments=DB::table('channelingpayments')
                                    ->join('bookings', 'channelingpayments.booking_id', '=', 'bookings.booking_id')
                                    ->select('channelingpayments.payment_status')
                                    ->where('channelingpayments.booking_id','=',$appointment->booking_id) 
                                    ->get();
                            if(empty($payments)) { ?>
                                <span  class='label label-warning' >
                                    <?php echo 'Not Payed'; ?>
                                </span> 
                                <span style="color: white" >
                                    space
                                </span>
                                 <a class="label label-info" href="{{route('channeling_payments.create', ['schedule_id' => $appointment->schedule_id,'patient_id'=>$appointment->patient_id])}}">
                                   Pay Now
                                 </a>
                                  
                          <?php  }else
                          {
                              
                              ?>
                              <span  class='label label-success' >
                                <?php
                                    foreach ($payments as $payment){
                                        echo $payment->payment_status;
                                    }
                                 ?>
                              </span> 
                         <?php }?>
                             
                            
                    </td>
                    
                </tr>
                @endforeach

            </tbody>

        </table>
    <?php } else { ?>
        <h3 class="text-center" style="color: #C40D0D;">No Bookings Yet! </h3>


    <?php } ?>

</div>


</div>
<br><br><br><br>
@endsection
