@extends('app')
@section('page_styles')
<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/jquery.datetimepicker.css') }}">
<style>
    .text-width {
        width: 50%;
    }
</style>
@endsection

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
     

    <br><br> <br>

    <div class="col-md-12" style="background-color:  #eaffdf">
        
        <h1 style="color: #0a470d">Patient Details</h1>
         <a class="btn btn-info col-md-offset-8" href="{{ URL::to('patients/') }}">View Patients</a>
        <div class="box box-default col-md-offset-4">
            <div class="box-header with-border">
                <!-- route to store method in controller to store data-->
              

                <br>
                <?php

                    $patient_id="";

                ?>
                {!! Form::open(['route' => 'patients.store']) !!}

<!--                <div class="form-group">
                    <label class="col-md-4 control-label">Patient ID</label>
                    <div class="col-md-6">
                        <input type="hidden" class="form-control" readonly="true" name="patient_id" id="patient_id" value="{{ $patient_id }}">
                    </div>
                </div>-->
                <div class="form-group">
<!--                    <label class="col-md-4 control-label">Member ID</label>-->
                    <?php
                        $member_id=\Auth::user()->user_id;
                    ?>
                        <input type="hidden" class="form-control" readonly="true" name="member_id" id="member_id" value="<?php echo $member_id; ?>">
                    
                </div>


                <div class="form-group">
                    <b>Name</b>
                    <input class="form-control" name="name" id="name" type="text" placeholder="Enter your full name" style="width: 50%;" />

                </div>

                
                <div class="form-group">
                    <b>National ID </b>
                    <input class="form-control" name="nic" id="nic" type="text"  style="width: 50%;" />
                </div>

                <div class="form-group">
                    <label>Date Of Birth</label>
                   <div class='input-group date' style="width: 50%;">
                        <input type='text' class="form-control datepick" id="dob" name="dob"  />
                                            
                    </div>
                </div>

                <div class="form-group">
                        <b>Gender </b>
                        <div class="form-group">
                            <label for="sex_male">Male</label>
                            <input class="radio-inline" name="sex"  id="sex_male" type="radio" checked="true" value="M"  />
                            <label for="sex_female">Female</label>
                            <input class="radio-inline" name="sex"  id="sex_female" type="radio" value="F"  />
                        </div>

                </div>


                <div class="form-group">

                    <div class="form-group">
                        <b> Address </b>
                        <textarea class="form-control" name="address" id="address"  placeholder=""
                                  style="width: 50%;height:15%;" ></textarea>
                    </div>

                </div>

                <div class="form-group">

                    <div class="form-group">
                        <b>Email </b>
                        <input class="form-control" name="email"  id="email" type="text" placeholder="" style="width: 50%;" />
                    </div>

                </div>
                <div class="form-group">

                    <div class="form-group">
                        <b>Phone </b>
                        <input class="form-control" name="phone"  id="phone" type="text" placeholder="" style="width: 50%;" />
                    </div>

                </div>
               

                {!! Form::submit('Submit', ['class' => 'btn btn-success col-md-offset-5']) !!}

                {!! Form::close() !!}

                <br>


            </div>
        </div>





    </div>





</div>
<br><br><br><br>
@endsection

@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datepicker/jquery.datetimepicker.js') }}"></script>
    <script type="text/javascript">

    $(document).ready(function() {
    
    $('.datepick').datetimepicker({
            format: 'Y-m-d',
            formatDate: 'Y-m-d',
            timepicker: false
        });

        var d = new Date();
//        
//        $('#selectdate').datetimepicker({
//            format: 'Y-m-d',
    //            formatDate: 'Y-m-d',
    //            timepicker: false,
    //            defaultDate: d,
    //            onSelectDate: function(date) {
    //                var date_1 = new Date(date);
    //               
    //                $('#date').val(date_1);
    //            }
    //            
    //        });


    });


    </script>

@endsection