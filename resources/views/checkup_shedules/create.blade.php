@extends('app')

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
<?php

$labs = DB::table('resources')->get();



?>
@section('content')

    <div class="container">
          <br><br>
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


                <!-- Form Name -->
            <br>
            <br>
            <div class="box box-default" style="min-height: 400px;">
                <div class="box-header with-border text-center">



                    <a class="btn btn-small btn-success pull-right" href="{{ URL::to('/checkup_shedules') }}"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> go back</a>

                    <br><br>

                    <div class="panel panel-aqua">
                        <div class="panel-heading">
                            <h3 class="panel-title">Resource Scheduling</h3>
                        </div>
                        <div class="panel-body" style="background-color: #f3ffe6">


                        {!! Form::open(['route' => 'checkup_shedules.store']) !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Select lab</label>
                            <div class="col-md-6">
                                <select class="form-control select2 select2-hidden-accessible" id="resourceId"
                                        name="resourceId"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option value='0' disabled selected >-- Select Laboratory --</option >
                                    <?php
                                    foreach ($labs as $lab) {
                                        $lab_id = $lab->id;
                                        $lab_name = $lab->name;
                                        echo "<option value = '$lab_id' >$lab_name</option >";
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <br><br><br>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Select Time</label>
                            <div class="col-md-6">
                                <select id="timeSlot" class="form-control select2 select2-hidden-accessible"
                                        name="timeSlot"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    {{--<option>Select Time</option>
                                    <option value="1">Doctor 01</option>
                                    <option>Doctor 02</option>--}}

                                </select>
                            </div>
                        </div>

                        <br><br>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <div class='input-group date' id='start_date_picker'>
                                    {{--<input type='text' class="form-control" name="date" required/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>--}}

                                    <input type="date" class="form-control" id="date" name="date" style="width: 478px;">
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <div class="form-group">
                            <label class="col-md-4 control-label">No of Patients</label>
                            <div class="col-md-6">
                                <input class="form-control" name="count" type="number" placeholder="" value=""
                                       style="width: 478px;" required/>
                            </div>
                        </div>


                        <input class="form-control" name="status" type="hidden" placeholder="" value="pending"
                               style="width: 50%;"/>


                        <br><br>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                {!! Form::submit('Create Schedule', ['class' => 'btn btn-success']) !!}
                            </div>

                        </div>

                        {!! Form::close() !!}


                        <br><br>
                   </div></div>

                </div>

            </div>

            <br><br><br><br><br><br><br><br><br>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="info-modal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content panel-warning">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sorry</h4>
                </div>
                <div class="modal-body">
                    <p>No Available Time Slots Found for this Laboratory on Selected Date</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>





@endsection

@section('page_script1')
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>


@endsection

@section('page_script2')
    <script type="text/javascript">
        var today = new Date().toISOString().slice(0, 10);
        $('#date').attr('min', today);


        $('#resourceId').on('change',function(e){
            /*$.ajaxSetup({
             header:$('meta[name="_token"]').attr('content')
             })
             e.preventDefault(e);*/
            // alert( this.value );
            var resourceId = $('#resourceId').val();

            $.ajax({
                type:"GET",
                url:'timeList/' + resourceId,
                success: function(response){
                    var sel = $('#timeSlot');
                    sel.empty();
                    sel.append(response);

                    if(response==""){
                        $('#info-modal').modal('show');
                    }


                },
                error: function(error){
                    $('#data-view').html(error);
                }
            })
        });
    </script>
@endsection