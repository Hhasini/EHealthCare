@extends('app')

@section('page_styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <style>
        .text-width {
            width: 50%;
        }
        table
        {
            table-layout:fixed;
            width:50%;
        }


        td {overflow:hidden; white-space:nowrap}


    </style>

@endsection



@section('content')

    <div class="container">


        <br>

        <div class="col-md-12" style="background-color:  #eaffdf">
            <br>

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




        <?php

            use Illuminate\Support\Facades\DB as DB;


            $patient_details=DB::table('patients')
                    ->where('id',$patient->id)
                    ->get();




            ?>
            <h3><b>Patient Details</b></h3>
            @foreach($patient_details as $patient_detail)
                <div >
                    <table class="table table-striped" style="width: 70%; padding-left: 100px; background-color: #00FFBF" >
                        <tr>
                            <td width="150px"><b> Patient ID</b></td>
                            <td>{{$patient_detail->id}}</td>
                        </tr>
                        <tr>
                            <td width="150px"><b>Name</b></td>
                            <td>{{$patient_detail->name}}</td>
                        </tr>
                        <tr>
                            <td width="150px"><b>NIC</b></td>
                            <td>{{$patient_detail->nic}}</td>
                        </tr>
                        <tr>
                            <td width="150px"><b>Address</b></td>
                            <td>{{$patient_detail->address}}</td>
                        </tr>
                        <tr>
                            <td width="150px"><b>Email</b></td>
                            <td>{{$patient_detail->email}}</td>
                        </tr>
                        <tr>
                            <td width="150px"><b>Phone</b></td>
                            <td>{{$patient_detail->phone}}</td>
                        </tr>
                        <tr>
                            <td width="150px"><b>Sex</b></td>
                            <td>{{$patient_detail->sex}}</td>
                        </tr>
                    </table>
                </div>
            @endforeach

            <br>
            <h3 ><b>Previous Visits of {{$patient->name}}</b></h3>
            <br>
            <div class="box box-default">
                <div class="box-header with-border" >
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 50%">
                                <table class="table table-striped table-bordered" >




                                    <thead style="background-color:  #04B486; color: white; font-size: 110%;">

                                    <tr>

                                        <td style="width: 10%">Visit ID</td>
                                        <td style="width: 25%">Visit Date</td>


                                        <td style="width: 10%">Show</td>


                                    </tr>

                                    </thead>





                                    <tbody>



                                    <?php


                                    use App\Http\Controllers\Auth;

                                    $patients=array();
                                    $pa_id=null;
                                    $visits=array();


                                    $visits=DB::table('doctor_visits')
                                            ->whereDoctor_idAndPatient_id(\Auth::user()->user_id,$patient->id)

                                            ->orderBy('visit_date', 'desc')
                                            ->get();

                                    $first=DB::table('doctor_visits')
                                            ->whereDoctor_idAndPatient_id(\Auth::user()->user_id,$patient->id)

                                            ->orderBy('visit_date', 'desc')
                                            ->first();



                                    ?>

                                    @foreach($visits as $key=>$visit)
                                        <tr>
                                            <td>{{$visit->id}}</td>
                                            <td>{{$visit->visit_date}}</td>

                                            <td><a class="btn btn-small " style="background-color: #04B486;color: white"  href="{{ url('patientlist/viewVisit/'.$visit->id) }}">Show</a></td>

                                    @endforeach


                                    </tbody>
                                </table>

                            </td>
                            <td valign="top">
                                <div  style="padding-left: 10%; padding-top: 40px ; width: 470px"><div class="panel panel-default">
                                        <div class="panel-heading" style="background-color: #F7D358">
                                            <b>Tip</b>
                                        </div>
                                        <div class="panel-body">Last visit of this patient was on <b>{{$first->visit_date}}</b>

                                            <br>
                                            Want to view full visit report click below...
                                            <br><br>
                                            <a class="btn btn-small " style="background-color: #1b1cff;color: white"  href="{{ url('patientlist/viewAllVisits/'.$patient->id) }}">Show Medical History</a>
                                            <br><br>
                                            Want to print diagnosis card click below...
                                            <br><br>
                                            <a class="btn btn-small " style="background-color: #1b1cff;color: white"  href="{{ url('patientlist/diagnosisCard/'.$patient->id) }}">Print Diagnosis Card</a>

                                        </div>
                                    </div></div>

                            </td>
                        </tr>
                    </table>





                </div>

            </div>





        </div>





    </div>
    <br>
@endsection



@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>


    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap-confirmation.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap-tooltip.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {


            $('[data-toggle="confirmation"]').confirmation({
                btnOkLabel: "Yes", btnCancelLabel: "No",
                onConfirm: function (event) {
                    $('#FoodList-del-frm').submit();
                }
            });
        });
    </script>




@endsection




