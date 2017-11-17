@extends('app')
<?php
use App\DoctorVisit;
use App\RecommendCheckup;
use App\PatientSchedule;
//$id = 11;
//$patient = DoctorVisit::find(11);
//$results =  DB::table('full_blood_counts')->where('visit_id', '=', 11)->get();
$results =  DB::table('full_blood_counts')->get();
//dd($res);

//$fastingResults =  DB::table('fasting_blood_counts')->where('visit_id', '=', 14)->get();
$fastingResults =  DB::table('fasting_blood_counts')->get();
?>

@section('content')
    <div class="container">
        <br>

        <div class="tabs alternative">
            <ul class="nav nav-tabs">

                <li class="active">
                    <a href="#sample-2b" data-toggle="tab">Full Blood Count Report</a>
                </li>
                <li>
                    <a href="#sample-2c" data-toggle="tab">Fasting Blood Report</a>
                </li>

            </ul>
            <div class="tab-content">

                <div class="tab-pane fade in active" id="sample-2b">
                    <div class="row">

                        <table class="table table-hover" class="table table-striped table-bordered">
                            <thead style="background-color: #c48c85">
                            <tr style="font-weight: 900 ;color: #eff7ff">
                                <td></td>
                                <td>Patient name</td>
                                <td>Date</td>
                                <td>View Test Report</td>
                            </tr>
                            </thead>
                            @foreach($results as $key => $result)
                                <?php
                                $patient = DoctorVisit::find($result->visit_id);
                                $patientSch = PatientSchedule::find($result->patientSchId);
                                $recommendCheckups = RecommendCheckup::find($patientSch->bookingID);
                                $patientList = \App\Patient::find($patient->patient_id);

                                $cpLists = DB::table('medical_checkups')->where('checkup_id', '=',$recommendCheckups->checkup_id)->get();
                                foreach ($cpLists as $cpList) {
                                    $cName= $cpList->checkup_name;
                                }

                                ?>

                                <tbody>
                                <tr>
                                    <td width="10%"><a href="#" class="pull-left">
                                            <img src="{{ asset('/assets/img/theteam/image12.png') }}" width="35px">
                                        </a></td>

                                    <td width="20%">{{$patientList->name}}</td>

                                    <td width="20%">{{$result->enterDate}}</td>

                                    <?php

                                    $payment_id = 0;
                                    $fullBloodCount = DB::table('full_blood_counts')->where('patientSchId', '=' ,$result->patientSchId )->where('visit_id','=',$result->visit_id)->get();

                                    foreach ($fullBloodCount as $fb) {
                                        $fb_id = $fb->id;


                                    }

                                    ?>

                                    <td width="20%">
                                        {!! Form::model( $result, [ 'method' => 'DELETE', 'route' =>
                                       ['full_blood_counts.destroy',$result->id], 'id' => 'schedule-del-frm-'.$result->id ]) !!}
                                        <a class="btn btn-small btn-aqua" style="background-color: #005384"
                                           href="{{ url('checkup_reports/full_blood_report/'.$result->id) }}" target="_blank">Print Report</a>

                                        <a name="{{$result->id}}" title="" data-original-title="" class="conf btn btn-large btn-danger" data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i></a>
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                                </tbody>

                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade in" id="sample-2c">
                    <div class="row">
                        <table class="table table-hover" class="table table-striped table-bordered">
                            <thead style="background-color: #c48c85">
                            <tr style="font-weight: 900 ;color: #eff7ff">
                                <td></td>
                                <td>Patient name</td>
                                <td>Date</td>
                                <td>View Test Report</td>
                            </tr>
                            </thead>
                            @foreach($fastingResults as $key => $result)

                                <?php
                                $patient = DoctorVisit::find($result->visit_id);
                                $patientSch = PatientSchedule::find($result->patientSchId);
                                $recommendCheckups = RecommendCheckup::find($patientSch->bookingID);
                                $patientList = \App\Patient::find($patient->patient_id);

                                $cpLists = DB::table('medical_checkups')->where('checkup_id', '=',$recommendCheckups->checkup_id)->get();
                                foreach ($cpLists as $cpList) {
                                    $cName= $cpList->checkup_name;
                                }


                                ?>

                                <tbody>
                                <tr>
                                    <td width="10%"><a href="#" class="pull-left">
                                            <img src="{{ asset('/assets/img/theteam/image12.png') }}" width="35px">
                                        </a></td>

                                    <td width="20%">{{$patientList->name}}</td>

                                    <td width="20%">{{$result->enterDate}}</td>

                                    <?php


                                    $fastingBloodCount = DB::table('fasting_blood_counts')->where('patientSchId', '=' ,$result->patientSchId )->where('visit_id','=',$result->visit_id)->get();
                                    //dd($fastingBloodCount);
                                    foreach ($fastingBloodCount as $fs) {
                                        $fs_id = $fs->id;
                                    }

                                    ?>

                                    <td width="20%">
                                        {!! Form::model( $result, [ 'method' => 'DELETE', 'route' =>
                                        ['fasting_blood_counts.destroy',$result->id], 'id' => 'schedule-del-frm-'.$result->id ]) !!}
                                        <a class="btn btn-small btn-aqua"
                                           href="{{ url('checkup_reports/fasting_blood_report/'.$result->id) }}" target="_blank">Print Report</a>

                                        <a name="{{$result->id}}" title="" data-original-title="" class="conf btn btn-large btn-danger" data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i></a>
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                                </tbody>

                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
<br><br><br><br><br><br>
    </div>
@endsection

@section('page_script2')
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
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
                    var selector = '#schedule-del-frm-'+delId;
                    //alert(delId);
                    $(selector).submit();
                }
            });
        });
    </script>


@endsection
