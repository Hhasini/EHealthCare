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

    @if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
    @endif
     

    <br><br> <br>

    <div class="col-md-12" style="background-color:  #66a67c">

        <h1 style="color: black">Patients</h1>

        <div class="box box-default">
            <div class="box-header with-border">
                <!-- route to store method in controller to store data-->


                <br>
                <div class="row">
                     <a class="btn btn-danger col-md-offset-8" href="{{ URL::to('patients/create') }}">Add New Patient</a>

                                    <div class="col-md-offset-2" >
                                        <br>

                                        <table style="width:650px;">
                                            
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
                                                         
                                                   
                              
                                                    
                                                     <td>
                                                          <?php 
                                                          $schedule_id = Input::get('schedule_id'); 
                                                         
                                                          ?>
                                                         {!! Form::open(array( 'route' => ['booking.index',$schedule_id,$patient->id], 'method' => 'get')) !!}
                                                         
                                                           <input type='hidden' value='<?php echo $schedule_id; ?>' name="schedule_id"/>
                                                           <input type='hidden' value='{{ $patient->id }}' name="patient_id"/>
                                                           
                                                        {!! Form::submit('Book Now', ['class' => 'btn btn-warning ']) !!}
                                                       
                                                        {!! Form::close() !!}
                                                        
                                                        
                                                     </td>  
                                                    
                                                </tr>
                                                <tr style="background-color: gainsboro">
                                                    <td style="width:100px;">
                                                     
                                        
                                                        {!! Form::model($patient,['method'=>'DELETE','route'=>
                                                        ['patients.destroy',$patient->id], 'id' => 'patient-del-frm'.$patient->id]) !!}
                                                            <a name="{{$patient->id}}"style="position: absolute;right: 260px; "  title="" data-original-title="" class="conf btn btn-large btn-danger" data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i></a>
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
