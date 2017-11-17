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
<div class="row">
    <div class="col-md-10 col-md-offset-1">



        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row margin-vert-30">
            <!-- Side Column -->
            <div class="col-md-3 ">
                <!-- About -->
                <div class="panel panel-primary invert col-md-offset-2">
                    <div class="panel-heading" style="background-color:  #66a67c">
                        <h3 class="panel-title">About</h3>
                    </div>
                    <div class="panel-body" >
                        We are No.1 website offering you the top best channeling service in Sri Lanka that allows you to channel your doctor from anywhere, anytime within seconds.
                    </div>
                </div>
 

            </div>
            <!-- End Side Column -->
            <!-- Main Column -->
            <div class="col-md-9">
                <!-- Main Content -->
                <div class="tab-content  col-lg-11  col-md-offset-0">
                    @if(!\Auth::check())
                    <div class="tab-pane fade in active " >
                        <h2>E-Channeling </h2>
                        <center>
                            <img alt="echanneling" src="{{ asset('/assets/img/services/echanneling_banner.jpg') }}">
                        </center>

                        <br>
                        <p>Our E-Channeling service allows you to channel your doctor from a few easy steps from your home,workplace or anywhere where now you no longer needs to pay a visit to the hospital for channeling your doctor and waiting in the queue till your chance. </p>

                        <!-- End Main Content -->
                        <p>Please  <a style="color: #00cc00" href="{{ url('/auth/login') }}">login </a>to view your channeling history. Not registered yet? <a  style="color:#0033ff" href="{{ url('/members/create') }}">Register </a> here.</p>
                    </div>
                    @elseif(\Auth::check() && \Auth::user()->user_type=="Member")


                    <div class="tab-pane fade in active "  id="searchdoc-a">
                        <div class="tabs alternative" >
                            <ul class="nav nav-tabs" >
                                <li class="active" >
                                    <a href="#private-a" data-toggle="tab">Channeling</a>
                                </li>
                                <li  >
                                    <a href="#private-b" data-toggle="tab">Patients</a>
                                </li>

                            </ul>
                            
                            <div class="tab-content " style="background-color: #66a67c">
                                 <div class="tab-pane fade in" id="private-b" >
                                    <div class="col-md-offset-1" >
                                        
                                        <h2>Patients</h2>
                                        <div class="row">
                                            <a class="btn btn-danger col-md-offset-8" href="{{ URL::to('patients/create') }}">Add New Patient</a>

                                            <div>
                                        <br>

                                        <table style="width:600px;">
                                            <?php 
                                                $user_id=\Auth::user()->user_id;
                                                $patients = DB::table('patients')
                                                ->select('name', 'address', 'email','phone','id','nic','dob','sex')
                                                ->where('member_id','=',$user_id)
                                                ->get();?>
                                            
                                             @foreach($patients as $key => $patient)
                                             
                                             <tr style="background-color:#66a67c">
                                                    <td style="color: #66a67c"> dd</td>
                                                    <td style="color: #66a67c">dd</td>
                                                    <td></td>
                                            </tr>
                                             
                                            <tr style="background-color: gainsboro">
                                                    <td style="color: gainsboro"> dd</td>
                                                    <td style="color: gainsboro">dd</td>
                                                    <td></td>
                                            </tr>
                                             <tr style="background-color: gainsboro;">
                                                    <td style="width:100px;"></td>
                                                    <td>
                                                        <img src="{{ asset('/assets/img/doctors/default_pro_pic.png')}}" class="img-circle" alt="User Image" width="40px" height="40px"><a  style="color: #3f729b" href="{{ URL::to('patients/' . $patient->id) }}"><b>{{ $patient->name }}</b></a>  
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                
                                                <tr style="background-color: gainsboro">
                                                    <td style="width:100px;"></td>
                                                    <td> 
                                                        <b>Phone: </b>{{ $patient->phone }}
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                
                                                <tr style="background-color: gainsboro">
                                                    <td style="width:100px;"></td>
                                                    <td> 
                                                        <b>Email: </b>{{ $patient->email }}

                                                    </td>  
                                                               
                                                         
                                                    
                                                </tr>
                                                <tr style="background-color: gainsboro">
                                                    <td style="width:100px;">
                                                     
                                        
                                                        {!! Form::model($patient,['method'=>'DELETE','route'=>
                                                        ['patients.destroy',$patient->id], 'id' => 'patient-del-frm'.$patient->id]) !!}
                                                         <a name="{{$patient->id}}"style="position: absolute;right: 100px; "  title="" data-original-title="" class="conf btn btn-large btn-danger" data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i></a>
                    
                                                        {!! Form::close() !!}
                                                        
                                                    </td>
                                                    
                                                    <td></td>
                                                    
                                                    
                                                </tr>
                                                <tr style="background-color: gainsboro">
                                                    <td style="color: gainsboro"> dd</td>
                                                    <td style="color: gainsboro">dd</td>
                                                    <td style="color: gainsboro"></td>
                                                </tr>
                                                <tr style="background-color: gainsboro">
                                                    <td style="color: gainsboro"> dd</td>
                                                    <td style="color: gainsboro">dd</td>
                                                    <td style="color: gainsboro"></td>
                                                </tr>
                                                


                                            @endforeach

                                        </table>
                                         <br>
                                    </div>
                                </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in active" id="private-a" >
                                    <div class="col-md-offset-1" >
                                        {!! Form::open(array('action' => 'EchannelingController@search_doctors', 'method' => 'get')) !!}
                                        <h2>Search Doctor</h2>
                                        <br>
                                        <div class="row col-md-offset-1">
                                            <label>Doctor Name</label>
                                            <input style="width: 85%" class="form-control " id="name" name="name" placeholder="Doctor's Name" type="text" required="true"/>

                                        </div>
                                        <div class="row col-md-offset-1">
                                            <label>Speciality</label>
                                            <select style="width: 85%" class="form-control "  id="specialty" name="specialty" type="text">
                                                <option value="" >Select Speciality </option>
                                                <?php foreach($specialisations as $specialisation){ ?>
                                                
                                                <option value="<?php echo $specialisation->specialty ?>"><?php echo $specialisation->specialty ?> </option>
                                                <?php } ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-offset-1">
                                            <label>Date</label>
                                           <div class='input-group date' style="width: 87%;">
                                                <input type='text' class="form-control datepick" id="date" name="date"  />
<!--                                                <div class="help-block with-errors"></div>-->
<!--                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>-->
                                          </div>
                                        </div>
                                        
                                        <br>
                                        <div class="row col-md-offset-1">
                                            {!! Form::submit('Search', ['class' => 'btn btn-info col-md-offset-9']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>

                                
                                <?php
                                $name = Input::get('name');
                                $specialty = Input::get('specialty');
                                $date = Input::get('date');

                                if($date!=NULL || $date!=""){
                                        $doctors = DB::table('doctors')->join('e_schedules', 'doctors.doctor_id', '=', 'e_schedules.doc_id')
                                                ->select('doctors.name','doctors.doctor_id', 'doctors.email', 'doctors.specialty', 'e_schedules.shift_start', 'e_schedules.shift_end', 'e_schedules.schedule_id')
                                                ->where('e_schedules.max_bookings', '>',0)
                                                ->where('doctors.name', 'LIKE', '%' . $name . '%')
                                                ->where(DB::raw('DATE(e_schedules.shift_start)'), '=', $date)
                                                ->where('doctors.specialty', 'LIKE', '%' . $specialty . '%')
                                                ->groupby( 'doctors.doctor_id')
                                                ->get();
                                       
                                }
                                else { 
                                    $doctors = DB::table('doctors')->join('e_schedules', 'doctors.doctor_id', '=', 'e_schedules.doc_id')
                                        ->select('doctors.name','doctors.doctor_id' ,'doctors.email', 'doctors.specialty', 'e_schedules.shift_start', 'e_schedules.shift_end', 'e_schedules.schedule_id')
                                        ->where('e_schedules.max_bookings', '>',0)
                                        ->where('doctors.name', 'LIKE', '%' . $name . '%')
                                        ->where('doctors.specialty', 'LIKE', '%' . $specialty . '%')
                                        ->groupby( 'doctors.doctor_id')
                                        ->get();
                                   
                                   
                                    
                                }
                                
                                
                                        
                                

                                
                                    ?>

                                    <div class="row">

                                        <div class="col-md-offset-1" >
                                            <br>
                                            <h2>Search Result</h2>

                                            <table style="width:600px;">
                                               
                                             <?php
                                             if (empty($doctors)) {
                                             ?>
                                              <tr>
                                                    
                                                  <td class="text-center" style="color: #C40D0D"> <h3>No results Found! </h3></td>
                                                   
                                             </tr>
                                                
                                             <?php } 
                                             if (($name != "" || $name != NULL) && !empty($doctors)) {
                                              ?>
                                                @foreach($doctors as $key => $doctor)
                                                <tr>
                                                    <td style="background-color: #66a67c;color: #66a67c"> dd</td>
                                                    <td style="background-color: #66a67c;color: #66a67c">dd</td>
                                                </tr>
                                                <tr style="background-color: gainsboro">
                                                    <td style="color: gainsboro"> dd</td>
                                                    <td style="color: gainsboro">{{ $doctor->schedule_id }}</td>
                                                    <td style="color: gainsboro"> dd</td>
                                                    <td style="color: gainsboro"> dd</td>
                                                    <td style="color: gainsboro"> dd</td>
                                                </tr>
                                                
                                                <tr style="background-color: gainsboro;">
                                                    <td style="color: gainsboro"> dd</td>
                                                    <td>
                                                            <img src="{{ asset('/assets/img/doctors/default_pro_pic.png')}}" class="img-circle" alt="User Image" width="40px" height="40px"> 
                                                    </td>
                                                    <td>
                                                        <b style="color: #3f729b">{{ $doctor->name }}</b>  
                                                        <br>
                                                        {{ $doctor->specialty }}
                                                        <br>
                                                         <b>Email:</b>{{ $doctor->email }}
                                                    </td>
                                                
                                                <?php
                                                $schedules=DB::table('doctors')
                                                            ->join('e_schedules', 'doctors.doctor_id', '=', 'e_schedules.doc_id')
                                                            ->select('e_schedules.shift_start','e_schedules.schedule_id', 'e_schedules.shift_end')
                                                            ->where('doctors.doctor_id', '=', $doctor->doctor_id)
                                                            ->groupby('e_schedules.schedule_id')
                                                            ->get();
                                                
                                                $count1=DB::table('doctors')
                                                            ->join('e_schedules', 'doctors.doctor_id', '=', 'e_schedules.doc_id')
                                                            ->select('e_schedules.shift_start','e_schedules.schedule_id', 'e_schedules.shift_end')
                                                            ->where('doctors.doctor_id', '=', $doctor->doctor_id)
                                                            ->groupby('e_schedules.schedule_id')
                                                            ->count();
                                                
                                                $count=0;
                                                
                                                
                                                   
                                                    foreach($schedules as $schedule){
                                                         if($count<$count1 && $count<3 ){
                                                             if ($date != "" || $date != NULL) { ?>

                                                            
                                                                <td> 
                                                                    <b style="color: #2d3413"><?php echo $date ?></b>
                                                                    <br>
                                                                    Available
                                                                    <br>
                                                        
                                                            <?php } else{ ?>
                                                        
                                                         
                                                                  <td> 
                                                                      <b style="color: #2d3413">
                                                                          <?php 

                                                                          $shift_start=$schedule->shift_start;
                                                                          $datetimearray=explode(" ", $shift_start);
                                                                          echo $datetimearray[0]; 
                                                                          ?></b>
                                                                          <br>Available
                                                                          <br>
                                                                 
                                                                  
                                                                 <?php }?>
                                                
                                      
                                                         <?php 
                                                        $shift_start=$schedule->shift_start.'hr-';
                                                        $datetimearray=explode(" ", $shift_start);
                                                        echo $datetimearray[1];
                                                     
                                                     
                                                        $shift_end=$schedule->shift_end.'hr';
                                                        $datetimearray=explode(" ", $shift_end);
                                                        echo $datetimearray[1];
                                                                ?> 
                                               
                                                        <br>
                                                        {!! Form::open(array( 'route' => ['patients.index',$doctor->schedule_id], 'method' => 'get')) !!}
                                                        <input type='hidden' value='{{ $schedule->schedule_id  }}' name="schedule_id"/>
                                                        {!! Form::submit('Channel', ['class' => 'btn btn-warning ']) !!}

                                                        {!! Form::close() !!}
                                                      
                                                    </td>
                                                   
                                                    
                                                         <?php $count++;
                                                        
                                                         } ?>
                                                        
                                                   
                                                   
                                                        
                                                    <?php 
                                                        
                                                           
                                                 } ?>
                                                     <td>
                                                         <a class="btn btn-small " style="background-color: #333;color: white;" href="{{ URL::to('echanneling/showMoreDoctorSchedules/'.$doctor->doctor_id.'/'.$date) }}"> Show More</a>
                                                    </td>
                                                </tr>



                                                <tr style="background-color: gainsboro;">
                                                    <td style="color: gainsboro;">dd</td>
                                                    <td style="color: gainsboro">dd</td>
                                                    <td style="color: gainsboro"> dd</td>
                                                   <td style="color: gainsboro"> dd</td>
                                                   <td style="color: gainsboro"> dd</td>
                                                </tr>


                                                @endforeach
                                                <?php } ?>
                                            </table>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Column -->
</div>

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
<script src="{{ URL::asset('bootstrap/js/bootstrap-confirmation.js') }}"></script>
<script src="{{ URL::asset('bootstrap/js/bootstrap-tooltip.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var delId = "";

        $('.conf').on('click', function (event) {
            delId = event.target.name;
        });
        $('[data-toggle="confirmation"]').confirmation({
            btnOkLabel: "Yes", btnCancelLabel: "No",
            onConfirm: function (event) {
                var selector = '#patient-del-frm'+delId;
                $(selector).submit();
            }
        });
    });
</script>

@endsection



