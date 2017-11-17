@extends('app')

<?php

        $doctor=\Illuminate\Support\Facades\DB::table('doctors')->where('doctor_id',$event->doc_id)->get();

?>



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

                    <h2 style="color: #0a470d">Schedule No : {{ $event->schedule_id }} </h2>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <br>


            @foreach($doctor as $d)
            <h3 style="color: #0a470d"> DOCTOR {{ $d->name }}</h3>
            @endforeach

<br>




        <div class="col-lg-6">

            <p><b>Time: </b><br>
                {{ date("g:ia\, jS M Y"  , strtotime($event->shift_start)) . ' until ' . date("g:ia\, jS M Y", strtotime($event->shift_end)) }}
            </p>

            <p><b>Duration:</b> <br>
                {{ $duration }}
            </p>



            <table>

                <thead>
                <tr>

                    <td style="width: 25%"> </td>
                    <td > </td>
                    <td> </td>


                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>

                        <a class="btn btn-small btn-info"
                           href="{{ URL::to('EC_Schedule/' . $event->schedule_id . '/edit') }}">
                            <i class='glyphicon glyphicon-edit'> Edit </i></a>

                    </td>

                    <td>
                        {!! Form::model( $event, [ 'method' => 'DELETE', 'route' =>
                         ['EC_Schedule.destroy',$event->schedule_id], 'id' => 'EC_Schedule-del-frm' ]) !!}




                                <input class="form-control" name="reason_to_cancel" type="text" placeholder=" Reason to Cancel"/>






                    </td>

                    <td>
                    <a class="btn  pull-right" style="color: white" href="#"> </i> </a>
                    </td>

                    <td>

                        <a title="" data-original-title="" class="btn btn-large btn-danger"
                           data-toggle="confirmation"><i class='glyphicon glyphicon-trash'> Delete</i> </a>

                        {!! Form::close() !!}

                    </td>


                </tr>
                </tbody>

            </table>








            <br><br>

        </div>

                    </div>
                        </div>


                    </div>
            </div> <br><br></div></div>


    </div>
    <br><br>

@endsection

@section('page_script2')


    <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('input[name="time"]').daterangepicker({
                "timePicker": true,
                "timePicker24Hour": true,
                "timePickerIncrement": 15,
                "autoApply": true,
                "locale": {
                    "format": "DD/MM/YYYY HH:mm:ss",
                    "separator": " - ",
                }
            });
        });
    </script>



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