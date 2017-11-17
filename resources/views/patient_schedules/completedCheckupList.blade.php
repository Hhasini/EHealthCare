@extends('app')

@section('page_styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>




    <style>
        .text-width {
            width: 50%;
        }
    </style>

@endsection

<?php
use Illuminate\Support\Facades\DB as DB;
        use App\RecommendCheckup;
        use App\DoctorVisit;

$recommendCheckups =  DB::table('recommend_checkups')->where('checkup_id','=',1)->orWhere('checkup_id','=',2)->get();

$results = [];
foreach ($recommendCheckups as $recommendCheckup) {

    $recId = $recommendCheckup->id;
    $sub_results = DB::table('patient_Schedules')->where('status','=','Paid')->where('bookingID','=',$recId)->get();

    // Use dd method for debugging results
    // dd($sub_results);

    if($sub_results != null){
        foreach ($sub_results as $sub_result){
            array_push($results, $sub_result);
        }
    }

}

?>



@section('content')



    <div class="container" >


            <div class="box box-default" style="min-height: 1000px; padding: 5px;">
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

                <br/><br/><br/>

                <table  class="table table-striped table-bordered" id="myTable">

                    <thead style="background-color: #27a5b4">
                    <tr style="font-weight: 900 ;color: #eff7ff">
                        <td></td>
                        <td>Patient Name</td>
                        <td>Test</td>
                        <td>Date</td>
                        <td>Add Test Results</td>
                    </tr>
                    </thead>
                    @foreach($results as $key => $result)
                        <tbody>
                        <tr>
                            <?php
                            $recommendCheckups = RecommendCheckup::find($result->bookingID);
                            $patient = DoctorVisit::find($recommendCheckups->visit_id);
                            $patientList = \App\Patient::find($patient->patient_id);

                            $cpLists = DB::table('medical_checkups')->where('checkup_id', '=',$recommendCheckups->checkup_id)->get();
                            foreach ($cpLists as $cpList) {
                                $cName= $cpList->checkup_name;
                            }


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

                            ?>
                                <td width="10%"><a href="#" class="pull-left">
                                        <img src="{{ asset('/assets/img/theteam/image12.png') }}" width="35px">
                                    </a></td>

                            <td width="20%">{{$patientList->name}}</td>

                            <td width="20%">{{$cName}}</td>

                            <td width="20%">
                                {{$date}}
                            </td>

                            <td width="30%">
                                {{--<a class="btn btn-small btn-info"
                                   href="{{ URL::to('patient_shedules/' . $result->id . '/edit') }}"><i class='glyphicon glyphicon-edit'> </i></a>

                                <a class="btn btn-small btn-info" style="background-color: #005384"
                                   href="{{ URL::to('patient_shedules/' . $result->id ) }}"><i class='glyphicon glyphicon-eye-open'> </i></a>--}}
                                @if($recommendCheckups->checkup_id == 1)
                                    <a class="btn btn-small btn-aqua" style="background-color: #005384"
                                       href="{{ url('/full_blood_counts/create?visit_id='.$recommendCheckups->visit_id.'&pscId='.$result->id) }}">Add Test Results</a>
                                @endif
                                @if($recommendCheckups->checkup_id == 2)
                                    <a class="btn btn-small btn-aqua" style="background-color: #005384"
                                       href="{{ url('/fasting_blood_counts/create?visit_id='.$recommendCheckups->visit_id.'&pscId='.$result->id) }}">Add Test Results</a>
                                @endif


                                {{--<a name="{{$result->id}}" title="" data-original-title="" class="conf btn btn-large btn-danger" data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i></a>--}}


                            </td>

                        </tr>
                        </tbody>
                    @endforeach
                </table>

            </div>

    </div>
@endsection

@section('page_script2')

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
@endsection