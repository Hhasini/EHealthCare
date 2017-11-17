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
                <?php
                use Illuminate\Support\Facades\DB as DB;

                $pat =DB::table('doctor_visits')->where('id',$visit->id)->get();
                $pt_id=null;
                    foreach($pat as $pt)
                    {
                        $pt_id=$pt->patient_id;
                    }

                ?>
                <a class="btn btn-small btn-info" href="{{ route('patientlist.show', $pt_id) }}">
                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>back</a>

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



                $res =DB::table('doctor_visits')->where('id',$visit->id)->get();
                foreach($res as $key => $visit){
                    $fam_his=$visit->family_history;
                    $diag_not=$visit->diagnosis_notes;
                    $pres=$visit->prescription;

                }
                $hasChkup=\App\Http\Controllers\DoctorVisitController::hasCheckup($visit->id);

                ?>
                <br>

                    <h3 ><b>Visit Information of visit on {{$visit->visit_date}}</b></h3>
                    <br>
                <div class="panel panel-default" style="width: 900px">
                    <div class="panel-heading" style="background-color: #05C5D8;color: #ffffff ">Diagnosis Details</div>
                    <div class="panel-body">

                        <div> <b>Family History :</b></div>
                        <div>{{$fam_his}}</div>
                        <br>
                        <div> <b>Diagnosis Notes :</b></div>
                        <div>{{$diag_not}}</div>
                        <br>
                        <div> <b>Prescription :</b></div>
                        <div>{{$pres}}</div>




                    </div>
                </div>

                @if($hasChkup===true)


                    <div class="panel panel-default" style="width: 900px">
                        <div class="panel-heading" style="background-color: #E3B136;color: #ffffff ">Recommended Medical Checkups</div>
                        <div class="panel-body">

                            <?php





                            $recommendations = DB::table('recommend_checkups')->where('visit_id',$visit->id)->get();


                            $checkup_ids = array();
                            $checkup_names = array();
                            foreach ($recommendations as $rec) {
                                array_push($checkup_ids, $rec->checkup_id);
                            }
                            for($i=count($checkup_ids);$i>0;$i--)
                            {
                                $med = DB::table('medical_checkups')->where('checkup_id',$checkup_ids[$i-1])->get();

                                foreach ($med as $m) {
                                    array_push( $checkup_names, $m->checkup_name);
                                }
                            }


                            for($i=count($checkup_names);$i>0;$i--)
                            {
                                echo"<span class='	glyphicon glyphicon-ok'></span>".$checkup_names[$i-1]."</br>";
                            }




                            ?>


                        </div>
                    </div>
                    @endif
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




