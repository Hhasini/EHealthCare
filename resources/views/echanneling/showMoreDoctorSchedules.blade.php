@extends('app')




@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="row margin-vert-30">
             <div class="panel panel-aqua col-md-offset-2" style="width: 70%">
                    <div class="panel-heading" ><h3 style="color: white">Channel Doctor</h3></div>

                    <div class="panel-body">

                        <table style="width:600px;">
                            <?php
                            $count=1;
                            foreach($doctors as $doctor){
                                if($count>=1){?>
                                    <tr>
                                        <td><img src="{{ asset('/assets/img/doctors/default_pro_pic.png')}}" class="img-circle" alt="User Image" width="75px" height="75px"> </td>
                                        <td> 

                                            <h3>{{$doctor->name}} </h3>
                                            <br>
                                            {{$doctor->specialty}}
                                            <br>
                                            {{$doctor->email}}

                                        </td>
                                    </tr>
                           <?php 
                                }
                                $count--;
                            }?>
                            
                        </table>
                    </div>
             </div>
            <table class="table table-striped table-bordered scrollable_div">
                <thead style="background-color: #3c8dbc">
                    <tr style="font-weight: 900 ;color: #eff7ff">

                        <td>Appointment Date</td>
                        <td>Status</td>
                        <td>Time(24 hr)</td>
                        <td>Click Here To Make The Appointment</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                     foreach($doctors as $doctor){ ?>
                    <tr>
                        
                            <td>
                              <?php 
                                $shift_start=$doctor->shift_start;
                                $datetimearray=explode(" ", $shift_start);
                                echo $datetimearray[0]; 
                              ?>
                            </td>
                            <td>Available</td>
                            <td>
                                <?php 
                                    $shift_start=$doctor->shift_start.'hr-';
                                    $datetimearray=explode(" ", $shift_start);
                                    echo $datetimearray[1];


                                    $shift_end=$doctor->shift_end.'hr';
                                    $datetimearray=explode(" ", $shift_end);
                                    echo $datetimearray[1];
                            ?>
                            </td>
                            <td>
                                <center>
                                    {!! Form::open(array( 'route' => ['patients.index',$doctor->schedule_id], 'method' => 'get')) !!}
                                        <input type='hidden' value='{{ $doctor->schedule_id  }}' name="schedule_id"/>
                                    {!! Form::submit('Channel', ['class' => 'btn btn-warning ']) !!}

                                    {!! Form::close() !!}
                                </center>
                            </td>
                    </tr>

                <?php      } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
