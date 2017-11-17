@extends('app')

<?php
use Illuminate\Support\Facades\DB as DB;
        use App\RecommendCheckup;
        use App\DoctorVisit;
$results = DB::table('patient_Schedules')->where('status','=','pending')->get();
?>

@section('content')



    <div class="container" >
        <div class="row">

            <div class="box box-default" style="min-height: 1000px;">
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


                <br>


                    <div class="box box-default">
                        <div class="box-header with-border">

                <table  class="table table-striped table-bordered" >

                    <thead style="background-color: #27a5b4">
                    <tr style="font-weight: 900 ;color: #eff7ff">
                        <td>Patient Name</td>
                        <td>Time Slot</td>
                        <td>Date</td>
                        <td>Test</td>
                        <td>Show/Edit/Delete</td>
                    </tr>
                    </thead>
                    @foreach($results as $key => $result)
                        <tbody>
                        <tr>
                            <?php

                            $recommendCheckups = RecommendCheckup::find($result->bookingID);
                            $patient = DoctorVisit::find($recommendCheckups->visit_id);
                            $patientList = \App\Patient::find($patient->patient_id);


                            $rcLists = DB::table('checkup_shedules')->where('id', '=',$result->scheduleId)->get();
                            foreach ($rcLists as $rcList) {
                                $rid= $rcList->resourceId;
                                $tid = $rcList->timeSlot;
                                $date = $rcList->date;
                            }
                            $resources = DB::table('resources')->where('id', '=',$rid)->get();
                            foreach ($resources as $resource) {
                                $labName= $resource->name;

                            }
                            $timeSlots = DB::table('time_slots')->where('id', '=',$tid)->get();
                            foreach ($timeSlots as $timeSlot) {
                                $time= $timeSlot->start . "-" . $timeSlot->end;

                            }

                            $cpLists = DB::table('medical_checkups')->where('checkup_id', '=',$recommendCheckups->checkup_id)->get();
                            foreach ($cpLists as $cpList) {
                                $cName= $cpList->checkup_name;

                            }

                            ?>

                            <td width="20%">{{$patientList->name}}</td>

                            <td width="10%">{{$time}}</td>

                            <td width="10%">
                                {{$date}}
                            </td>

                                <td width="20%">
                                    {{$cName}}
                                </td>

                            <td width="30%">
                                {!! Form::model( $result, [ 'method' => 'DELETE', 'route' =>
                                        ['patient_shedules.destroy',$result->id], 'id' => 'schedule-del-frm-'.$result->id ]) !!}

                                <a class="btn btn-small btn-info"
                                   href="{{ URL::to('patient_shedules/' . $result->id . '/edit') }}"><i class='glyphicon glyphicon-edit'> </i></a>

                                <a class="btn btn-small btn-info" style="background-color: #005384"
                                   href="{{ URL::to('patient_shedules/' . $result->id ) }}"><i class='glyphicon glyphicon-eye-open'> </i></a>

                                <a class="btn btn-small btn-aqua" style="background-color: #005384"
                                   href="{{ URL::to('/checkup_payments/create?id='.$result->id) }}">Make Payment</a>

                                <a name="{{$result->id}}" title="" data-original-title="" class="conf btn btn-large btn-danger" data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i></a>

                                {!! Form::close() !!}
                            </td>

                        </tr>
                        </tbody>
                    @endforeach
                </table>

                            </div></div>

            </div></div>

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
                    $(selector).submit();
                }
            });
        });
    </script>


@endsection