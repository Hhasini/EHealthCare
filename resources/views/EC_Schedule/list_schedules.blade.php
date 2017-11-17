@extends('app')

<?php

use Illuminate\Support\Facades\DB;
$doctors = DB::table('doctors')->get();
$rooms = DB::table('ec_rooms')->get();

?>
@section('content')


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

                            <a href="{{ url('/EC_Schedule/create') }}" style="color: white">
                                ADD E-CHANNELING SCHEDULES
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

                            <a href="{{ url('/EC_Schedule') }}" style="color: white">
                                VIEW DAILY CALENDER
                            </a>
                        </li>

                    </ul>
                </figure>
            </div>


        </div>










        <br>

        <div class="col-md-9">



        <div class="row">
        <br>
        <a class="btn btn-small btn-success pull-right" href="{{ URL::to('EC_Schedule/') }}"> </i> go back</a>


        <div class="col-md-10">
            <h1>LIST E-CHANNELLING SCHEDULES</h1>
            <br>

            <!-- Nav tabs --><div class="card">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All Schedules</a></li>
                    <li role="presentation"><a href="#future" aria-controls="future" role="tab" data-toggle="tab">Future Schedules</a></li>
                    <li role="presentation"><a href="#past" aria-controls="past" role="tab" data-toggle="tab">Past Schedules</a></li>
                    <li role="presentation"><a href="#CanceledSchedules" aria-controls="past" role="tab" data-toggle="tab">Canceled Schedules</a></li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="all">


                        <table class="table table-striped " id="myTable" >
                            <thead style="background-color: #27a5b4">
                            <tr style="font-weight: 900 ;color: #eff7ff">

                                <td>Doctor</td>
                                <td>Room</td>
                                <td>Shift Starts At</td>
                                <td>Shift Ends At</td>

                            </tr>
                            </thead>
                            <tbody>
                                <tr>


                                    @foreach( $schedules as $key =>  $schedule)

                                        <?php
                                        $name = DB::table('doctors')->where('doctor_id',$schedule->doc_id)->get();


                                            foreach($name as $d){


                                                echo "<td>";
                                                echo $d->name;
                                                echo "</td>";

                                            }
                                        $room = DB::table('ec_rooms')->where('room_id',$schedule->room)->get();

                                            foreach($room as $r){


                                            echo "<td>";
                                            echo $r->room_name;
                                            echo "</td>";

                                        }


                                        ?>
                                    <td>{{  $schedule->shift_start }}</td>
                                    <td>{{  $schedule->shift_end }}</td>

                                </tr>
                                    @endforeach
                            </tbody>
                        </table>





                    </div>

                    <div role="tabpanel" class="tab-pane" id="future">



                        <table class="table table-striped " id="myTable" >
                            <thead style="background-color: #738668">
                            <tr style="font-weight: 900 ;color: #eff7ff">

                                <td>Doctor</td>
                                <td>Room</td>
                                <td>Shift Starts At</td>
                                <td>Shift Ends At</td>
								<td> Edit Schedules</td>
                                <td>Delete Schedules </td>
                                <td> </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>


                                @foreach( $future as $key =>  $future_s)

                                    <?php
                                    $name = DB::table('doctors')->where('doctor_id',$future_s->doc_id)->get();


                                    foreach($name as $d){


                                        echo "<td>";
                                        echo $d->name;
                                        echo "</td>";

                                    }
                                    $room = DB::table('ec_rooms')->where('room_id',$future_s->room)->get();

                                    foreach($room as $r){


                                        echo "<td>";
                                        echo $r->room_name;
                                        echo "</td>";

                                    }


                                    ?>
                                    <td>{{  $future_s->shift_start }}</td>
                                    <td>{{  $future_s->shift_end }}</td>
									
									<td>

                                        <a class="btn btn-small btn-info"
                                           href="{{ URL::to('EC_Schedule/' . $future_s->schedule_id . '/edit') }}">
                                            <i class='glyphicon glyphicon-edit'> </i>  </a>
                                    </td>
                                    <td>
                                        {!! Form::model( $future_s, [ 'method' => 'DELETE', 'route' =>
                                         ['EC_Schedule.destroy',$future_s->schedule_id], 'id' => 'EC_Schedule-del-frm' ]) !!}


                                        <div class="form-group">

                                            <div class="form-group">
                                              <input class="form-control" name="reason_to_cancel" type="text" placeholder=" Reason to Cancel"
                                                                             />
                                            </div>
                                        </div>



                                    </td>

                                    <td>

                                        <a title="" data-original-title="" class="btn btn-large btn-danger"
                                           data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i> </a>

                                        {!! Form::close() !!}

                                    </td>


                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>



                    <div role="tabpanel" class="tab-pane" id="past">

                        <table class="table table-striped " id="myTable" >
                            <thead style="background-color: #738668">
                            <tr style="font-weight: 900 ;color: #eff7ff">

                                <td>Doctor</td>
                                <td>Room</td>
                                <td>Shift Starts At</td>
                                <td>Shift Ends At</td>
								
                            </tr>
                            </thead>
                            <tbody>
                            <tr>


                                @foreach( $past as $key =>  $past_s)

                                    <?php
                                    $name = DB::table('doctors')->where('doctor_id',$past_s->doc_id)->get();


                                    foreach($name as $d){


                                        echo "<td>";
                                        echo $d->name;
                                        echo "</td>";

                                    }
                                    $room = DB::table('ec_rooms')->where('room_id',$past_s->room)->get();

                                    foreach($room as $r){


                                        echo "<td>";
                                        echo $r->room_name;
                                        echo "</td>";

                                    }


                                    ?>
                                    <td>{{  $past_s->shift_start }}</td>
                                    <td>{{  $past_s->shift_end }}</td>

									
                            </tr>
                            @endforeach
                            </tbody>
                        </table>



                    </div>



                    <div role="tabpanel" class="tab-pane" id="CanceledSchedules">

                        <table class="table table-striped " id="myTable" >
                            <thead style="background-color: #738668">
                            <tr style="font-weight: 900 ;color: #eff7ff">

                                <td>Schedule ID</td>
                                <td>Reason To Cancel</td>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @foreach( $cancelSchedules as $key =>  $cancel)



                                    <td>{{  $cancel->schedule_id }}</td>
                                    <td>{{  $cancel->reason_to_cancel }}</td>


                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>








                </div>
            </div>
        </div>
    </div>




    <br><br><br>

        </div>

    </div>

</div>


@endsection

@section('page_script2')

    <script src="{{ URL::asset('bootstrap/js/bootstrap-confirmation.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap-tooltip.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {


            $('[data-toggle="confirmation"]').confirmation({
                btnOkLabel: "Yes", btnCancelLabel: "No",
                onConfirm: function (event) {
                    $('#EC_Schedule-del-frm').submit();
                }
            });
        });
    </script>
@endsection