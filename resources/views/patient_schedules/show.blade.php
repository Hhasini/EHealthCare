@extends('app')



<?php
$resultList = DB::table('patient_schedules')->where('id', '=' ,$schedule->id )->get();
foreach ($resultList as $result) {
    $schedule_id = $result->scheduleId;
    $visit_id = $result->bookingID;

}
$checkupList = DB::table('medical_checkups')->get();
$addedCheckupList = DB::table('recommend_checkups')->where('id', '=' ,$visit_id )->get();
foreach ($addedCheckupList as $result) {
    $v_id= $result->visit_id;
    $cId = $result->checkup_id;

}
$cpLists = DB::table('medical_checkups')->where('checkup_id', '=',$cId)->get();
foreach ($cpLists as $cpList) {
    $cName= $cpList->checkup_name;
    $cDes = $cpList->checkup_description;
}
$dcVisitLists = DB::table('doctor_visits')->where('id', '=',$v_id)->get();
foreach ($dcVisitLists as $dcVisitList) {
    $pid= $dcVisitList->patient_id;
    $docid = $dcVisitList->doctor_id;
}
$patientLists = DB::table('patients')->where('id', '=',$pid)->get();
foreach ($patientLists as $patientList) {
    $pName= $patientList->name;
    $pEmail = $patientList->email;
    $pPhone = $patientList->phone;
}
$rcLists = DB::table('checkup_shedules')->where('id', '=',$schedule_id)->get();
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


?>
@section('content')
    <div class="container">

        <br>


        <a class="btn btn-small btn-success pull-right" href="{{ URL::to('patient_schedules/viewScheduledCheckups') }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> go back</a>
        <br><br><br>
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #00c472">
                <h3 class="panel-title">Checkup Details</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-md-6 margin-bottom-20">

                                <ul class="menu">
                                    <li>
                                        <h4 style="font-size:small">Patient Name</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">Checkup Name</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">Checkup Description</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">Venue (Laboratory)</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">Time Slot</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">Scheduled Date</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">Recommended Doctor</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">Email Address</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">Mobile Number</h4>
                                    </li>

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-6 margin-bottom-20">

                                <ul class="menu">
                                    <li>
                                        <h4 style="font-size:small">{{ $pName  }}</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">{{ $cName }}</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">{{ $cDes }}</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">{{ $labName  }}</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">{{$time}}</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">{{$date}}</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">{{$docid}}</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">{{$pEmail}}</h4>
                                    </li>
                                    <li>
                                        <h4 style="font-size:small">{{$pPhone}}</h4>
                                    </li>

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection