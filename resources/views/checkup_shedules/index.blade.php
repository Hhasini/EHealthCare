@extends('app')


@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datatable_search/jquery.dataTables.min.css') }}">
    <style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style>
@endsection

@section('content')
<?php
use Illuminate\Support\Facades\DB as DB;

$results = DB::table('checkup_shedules')->where('resourceId','=',1)->get();
foreach ($results as $result) {
    $rid= $result->id;
    $tid = $result->timeSlot;
}

$resources = DB::table('resources')->where('id', '=',$rid)->get();
foreach ($resources as $resource) {
    $labName= $resource->name;
}

$timeSlots = DB::table('time_slots')->where('id', '=',$tid)->get();
foreach ($timeSlots as $timeSlot) {
    $time= $timeSlot->start . "-" . $timeSlot->end;
}

$scanLabs = DB::table('checkup_shedules')->where('resourceId','=',2)->get();
$bloodLabs = DB::table('checkup_shedules')->where('resourceId','=',3)->get();

?>

    <div class="container">
        <div class="row margin-vert-30">
            <!-- Side Column -->
            <div class="col-md-3">
                <div class=" person-details margin-bottom-30">
                    <figure>
                        <img src="{{ asset('/assets/img/theteam/image4.jpg') }}" alt="image2">
                        <figcaption>

                        </figcaption>
                        <ul class="list-inline person-details-icons">
                            <li>

                                <a href="{{ url('/checkup_shedules/create') }}" style="color: white">
                                    ADD LAB SCHEDULES
                                </a>
                            </li>

                        </ul>
                    </figure>
                </div>
                <!-- End About -->
                <div class=" person-details margin-bottom-30">
                    <figure>
                        <img src="{{ asset('/assets/img/theteam/image6.png') }}" alt="image2">
                        <figcaption>

                            <span></span>
                        </figcaption>
                        <ul class="list-inline person-details-icons">
                            <li>

                                <a href="{{ url('checkup_shedules/viewLabDetails') }}" style="color: white">
                                    VIEW DAILY CALENDER
                                </a>
                            </li>

                        </ul>
                    </figure>
                </div>


            </div>

            <br>

            <div class="col-md-9">

                <div class="tabs alternative">
                    <ul class="nav nav-tabs" >

                        <li class="active">
                            <a href="#sample-2b" data-toggle="tab">XRAY LAB</a>
                        </li>
                        <li>
                            <a href="#sample-2c" data-toggle="tab">CT/MRI SCAN LAB</a>
                        </li>
                        <li>
                            <a href="#sample-2d" data-toggle="tab">BLOOD TESTING LAB</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="sample-2b">
                            <div class="row">

                                <table class="table table-hover" class="table table-striped table-bordered">
                                <thead style="background-color: #6c80b4">
                                <tr style="font-weight: 900 ;color: #eff7ff">
                                    <td></td>
                                    <td>Time Slot</td>
                                    <td>Scheduled Date</td>
                                    <td>Number Of Patients</td>
                                </tr>
                                </thead>
                            @foreach($results as $key => $result)

                                    <tbody>
                                    <tr>
                                        <td width="10%"><a href="#" class="pull-left">
                                                <img src="{{ asset('/assets/img/theteam/image7.png') }}" width="35px">
                                            </a></td></td>

                                        <?php

                                        $timeSlots = DB::table('time_slots')->where('id', '=',$result->timeSlot)->get();
                                        foreach ($timeSlots as $timeSlot) {
                                            $time= $timeSlot->start . "-" . $timeSlot->end;

                                        } ?>

                                        <td width="20%">{{ $time }}</td>

                                        <td width="20%">
                                            {{ $result->date }}
                                        </td>

                                        <td width="20%" >
                                            <span <?php echo ($result->count == 0) ? "class='label label-danger'" : "class='label label-warning'"; ?> >
                                                {{ $result->count }}</span>
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
                                <thead style="background-color: #27a5b4">
                                <tr style="font-weight: 900 ;color: #eff7ff">
                                    <td></td>
                                    <td>Time Slot</td>
                                    <td>Scheduled Date</td>
                                    <td>Number Of Patients</td>
                                </tr>
                                </thead>
                                @foreach($scanLabs as $key => $result)

                                        <tbody>
                                        <tr>
                                            <td width="10%"><a href="#" class="pull-left">
                                                    <img src="{{ asset('/assets/img/theteam/image8.png') }}" width="35px">
                                                </a></td></td>

                                            <?php

                                            $timeSlots = DB::table('time_slots')->where('id', '=',$result->timeSlot)->get();
                                            foreach ($timeSlots as $timeSlot) {
                                                $time= $timeSlot->start . "-" . $timeSlot->end;

                                            } ?>

                                            <td width="20%">{{ $time }}</td>

                                            <td width="20%">
                                                {{ $result->date }}
                                            </td>

                                            <td width="20%">
                                                <span <?php echo ($result->count == 0) ? "class='label label-danger'" : "class='label label-warning'"; ?> >
                                                {{ $result->count }}</span>
                                            </td>

                                        </tr>
                                        </tbody>

                                @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="sample-2d">
                            <table class="table table-hover" class="table table-striped table-bordered">
                            <thead style="background-color: #b48971">
                            <tr style="font-weight: 900 ;color: #eff7ff">
                                <td></td>
                                <td>Time Slot</td>
                                <td>Scheduled Date</td>
                                <td>Number Of Patients</td>
                            </tr>
                            </thead>
                            @foreach($bloodLabs as $key => $bloodLab)

                                    <tbody>
                                    <tr>

                                        <td width="10%"><a href="#" class="pull-left">
                                                <img src="{{ asset('/assets/img/theteam/image12.png') }}" width="35px">
                                            </a></td></td>

                                        <?php

                                        $timeSlots = DB::table('time_slots')->where('id', '=',$bloodLab->timeSlot)->get();
                                        foreach ($timeSlots as $timeSlot) {
                                            $time= $timeSlot->start . "-" . $timeSlot->end;

                                        } ?>

                                        <td width="20%">{{ $time }}</td>

                                        <td width="20%">
                                            {{ $bloodLab->date }}
                                        </td>

                                        <td width="20%">
                                           <span <?php echo ($bloodLab->count == 0) ? "class='label label-danger'" : "class='label label-warning'"; ?> >
                                                {{ $bloodLab->count }}</span>
                                        </td>

                                    </tr>
                                    </tbody>

                            @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <br><br><br><br>
            </div>
        </div>
    </div>
@endsection

@section('page_script1')
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jquery_sortable/sortable.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatable_search/jquery.dataTables.min.js') }}"></script>
@endsection

@section('page_script2')
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            // DataTable
            var table = $('#example').DataTable();

            // Apply the search
            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                                .search( this.value )
                                .draw();
                    }
                } );
            } );
        } );

        $('#reset_btn').click(function(){
            $('input:text').val('');
            location.reload();
        });
    </script>
@endsection
