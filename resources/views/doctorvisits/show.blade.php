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


    </style>

@endsection



@section('content')

    <div class="container">




        <br>

        <div class="col-md-12" style="background-color:  #eaffdf">
            <br>
            <a class="btn btn-small btn-info" href="{{ route('doctorvisits.index') }}">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>back</a>
            <br> <br>

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


            <h1 style="color: #0a470d">Booking {{$booking->booking_id}}</h1>
            <br>
            <div class="box box-default">
                <div class="box-header with-border">
                    <?php

                    $pname=\App\Http\Controllers\DoctorVisitController::getPatientName($booking->patient_id);
                    $slot=\App\Http\Controllers\DoctorVisitController::getChannelingSlot($booking->schedule_id);
                    $isvisit=\App\Http\Controllers\DoctorVisitController::isVisit($booking->booking_id);
                        $isinitial=\App\Http\Controllers\DoctorVisitController::isInitial($booking->booking_id);
                        $prev=\App\Http\Controllers\DoctorVisitController::hasPrevious($booking->patient_id);




                    ?>

                        <div>
                            <table class="table table-striped " style="width: 50%">
                                <tr style="background-color: #ffffff">
                                    <td style="width: 40%">
                                        <b>Booking ID      </b>
                                    </td>
                                    <td>
                                        <b>{{$booking->booking_id}}</b>
                                    </td>
                                </tr>
                                <tr style="background-color: #00e6ac">
                                    <td style="width: 40%">
                                        <b>Patient ID      </b>
                                    </td>
                                    <td>
                                        <b>{{$booking->patient_id}}</b>
                                    </td>
                                </tr>
                                <tr style="background-color: #ffffff">
                                    <td style="width: 40%">
                                        <b>Patient Name      </b>
                                    </td>
                                    <td>
                                        <b>{{$pname}}</b>
                                    </td>
                                </tr>
                                <tr style="background-color: #00e6ac">
                                    <td style="width: 40%">
                                        <b>Channaling Slot      </b>
                                    </td>
                                    <td>
                                        <b>{{$slot}}</b>
                                    </td>
                                </tr>
                            </table>
                        </div>


                       <table><tr>
                               <td>
                                   @if($isvisit===false)
                                       <a class="btn btn-small btn-info" href="{{ URL::to('doctorvisits/' . $booking->booking_id . '/edit') }}">Add Diagnosis Details</a>

                                   @endif

                               </td>
                               <td style="padding-left: 10px">
                                   @if($isinitial===true && $prev===true)
                                   <a  class="btn btn-small btn-success pull-right" href="{{ URL::to('patientlist/' . $booking->patient_id) }}">View Medical History</a>
                                   @endif

                               </td>
                           </tr></table>
                        <br>



                    <?php
                        use App\Http\Controllers\RecommendCheckupController;
                        use Illuminate\Support\Facades\DB as DB;

                    $visit_id=null;
                    $booking_id=$booking->booking_id;

                    $result=DB::table('doctor_visits')->where('booking_id',$booking_id)->get();

                    foreach($result as $key => $visit)
                    {
                        $visit_id=$visit->id;
                    }

                    ?>

                        @if($isvisit===true)

                            <?php


                            $res =DB::table('doctor_visits')->where('id',$visit_id)->get();
                            foreach($res as $key => $visit){
                                $fam_his=$visit->family_history;
                                $diag_not=$visit->diagnosis_notes;
                                $pres=$visit->prescription;

                            }
                            $hasChkup=\App\Http\Controllers\DoctorVisitController::hasCheckup($visit_id);

                            ?>

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





                                                $recommendations = DB::table('recommend_checkups')->where('visit_id',$visit_id)->get();


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

                             @if($isinitial===true)
                            <a class="btn btn-small btn-info"  href="{{ URL::to('diagnosisupdates/' . $visit_id . '/edit') }} ">Update Diagnosis Details</a>

                                <a class="btn btn-small btn-info"  href="{{ URL::to('recommendcheckups/' . $visit_id . '/edit') }}">Recommend Medical Checkups</a>
                                    <a class="btn btn-small " style="background-color: #1b1cff;color: white"  href="{{ url('doctorvisits/prescription/'.$visit_id) }}">Print Prescription</a>

                               <br><br> <div><form class="delete" action="{{ route('doctorvisits.destroy', $booking->booking_id) }}" method="POST" id="FoodList-del-frm">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                    <a title="" data-original-title="" class="btn btn-large btn-danger" style="margin-right: 10%"
                                       data-toggle="confirmation"> Finish Diagnosis </a>
                                </form></div>

                               @endif

                        @endif



                        <br> <br> <br>
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
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable( {
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                                .appendTo( $(column.footer()).empty() )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                    );

                                    column
                                            .search( val ? '^'+val+'$' : '', true, false )
                                            .draw();
                                } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            } );
        } );
    </script>

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


{{--@section('page_script2')
        <!--script type="text/javascript"
        src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"
        src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script-->

<link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    });
</script>
@endsection--}}

