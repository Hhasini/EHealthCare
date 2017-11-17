@extends('app')


<?php
$doctors = DB::table('doctors')->where('doctor_id','!=',$booking->doc_id)->get();
$rooms = DB::table('ec_rooms')->where('room_id','!=',$booking->room)->get();
?>


@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
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
        <div class="box box-default">

            <div class="box-header with-border">

                <hr>

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

                <div class="box box-default" style="padding: 20px 50px 0px 20px ;">




                        <div class="col-md-12" style="background-color:  #eaffdf">

                            <br>
                            <a class="btn btn-small btn-success pull-right" href="{{ URL::to('EC_Schedule/') }}"> </i> go back</a>


                            <h1 style="color: #0a470d">Edit Schedule {{ $booking->schedule_id }}</h1>

                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <!-- route to store method in controller to store data-->


                                    <br>

                                    {!! Form::model( $booking, [ 'method' => 'PATCH', 'route' => ['EC_Schedule.update',$booking->schedule_id]  ]) !!}


                                            <!--get doctor id when selecting doctor name-->
                                    <div class="form-group">
                                        <b> Doctor Name</b><select class="form-control select2 select2-hidden-accessible" name="doc_id"
                                                                   style="width: 50%;"
                                                                   tabindex="-1"
                                                                   aria-hidden="true" >




                                            <?php
                                            $doc_n = DB::table('doctors')->where('doctor_id',$booking->doc_id)->get();

                                            foreach ($doc_n as $doc) {
                                                $doc_id = $doc->doctor_id;
                                                $doc_name = $doc->name;
                                                echo "<option value = '$doc_id' >$doc_name</option >";
                                            }


                                            foreach ($doctors as $doctor) {
                                                $doc_id = $doctor->doctor_id;
                                                $doc_name = $doctor->name;
                                                echo "<option value = '$doc_id' >$doc_name</option >";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!--get room id when selecting room name-->
                                    <div class="form-group">
                                        <b>Room Name </b><select class="form-control select2 select2-hidden-accessible" name="room"
                                                                 style="width: 50%;"
                                                                 tabindex="-1"
                                                                 aria-hidden="true">
                                            <?php
                                            $room_n = DB::table('ec_rooms')->where('room_id',$booking->room)->get();

                                            foreach ($room_n as $room) {
                                                $room_id = $room->room_id;
                                                $room_name = $room->room_name;
                                                echo "<option value = '$room_id' >$room_name</option >";
                                            }

                                            foreach ($rooms as $room) {
                                                $room_id = $room->room_id;
                                                $room_name = $room->room_name;
                                                echo "<option value = '$room_id' >$room_name</option >";
                                            }
                                            ?>
                                        </select>
                                    </div>







                                <div class="form-group">
                                    <div class="control-label">Shift Starts At </div>
                                    <div class='input-group date' id='start_date_picker' style='width:50%;'>
                                        <input type='text' class="form-control" value="{{$booking->shift_start}} " name="shift_start" required/>
                                        <div class="help-block with-errors"></div>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                                    </div>
                                </div>

                                    <div class="form-group">
                                        <div class="control-label">Shift Ends At</div>
                                        <div class='input-group date' id='end_date_picker' style='width:50%;'>
                                            <input type='text' class="form-control" value="{{$booking->shift_end}}" name="shift_end" required/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>




                                    <div class="form-group">

                                        <div class="form-group">
                                            <b>Maximum Booking </b><input class="form-control" name="max_bookings" value="{{$booking->max_bookings}}"type="text"
                                                                          style="width: 50%;" />
                                        </div>

                                    </div>




                                    {!! Form::submit('Edit Schedule', ['class' => 'btn btn-success']) !!}

                                    {!! Form::close() !!}

                                    <br>


                                </div>
                            </div>


                        </div>




                </div>

            </div>
        </div>
    </div>

    <br>
    <br>

@endsection




@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript">


        $(function () {
            var dateNow = new Date();
            $('#start_date_picker').datetimepicker({
                useCurrent: false,
                viewMode: 'years',
                format: 'YYYY-MM-DD H:M:s',
                //defaultDate: moment(dateNow),
                minDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6]
            });
            $('#end_date_picker').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                viewMode: 'years',
                format: 'YYYY-MM-DD H:M:s',
                minDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6]
            });
            $("#start_date_picker").on("dp.change", function (e) {
                $('#end_date_picker').data("DateTimePicker").minDate(e.date);
            });
            $("#end_date_picker").on("dp.change", function (e) {
                $('#start_date_picker').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>


@endsection


