@extends('app')
<?php

$labs = DB::table('resources')->get();



?>
@section('content')

    <div class="container">

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
                <a class="btn btn-small btn-success pull-right" href="{{ URL::to('patient_schedules/viewScheduledCheckups') }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> go back</a>

            <br><br><br>

            <div class="panel panel-aqua">
                <div class="panel-heading">
                    <h3 class="panel-title">Medical Checkup Re Scheduling</h3>
                </div>
                <div class="panel-body">
                    {!! Form::model( $schedule, [ 'method' => 'PATCH', 'route' => ['patient_shedules.update',$schedule->id]  ]) !!}




                    <div class="form-group">
                        <label class="col-md-4 control-label">Date</label>
                        <div class="col-md-6">
                            <div class='input-group date' id='start_date_picker'>
                                <input type="date" class="form-control" id="date" name="date" style="width: 445px;" required>
                            </div>
                        </div>
                    </div>

                    <br><br><br>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Select lab</label>
                        <div class="col-md-6">
                            <select id='resourceId' class="form-control select2 select2-hidden-accessible" name="resourceId"
                                    tabindex="-1"
                                    aria-hidden="true" required>
                                <option value='0' disabled selected >-- Select Laboratory --</option >
                                <?php
                                 $patientSchedule = \App\PatientSchedule::find($schedule->id);
                                 $checkupSchedules = \App\CheckupShedule::find($patientSchedule->scheduleId);
                                 $resources = \App\Resource::find($checkupSchedules->resourceId);


                                foreach ($labs as $lab) {
                                    $lab_id = $lab->id;
                                    $lab_name = $lab->name;
                                    echo "<option value = '$lab_id' >$lab_name</option >";
                                }
                                ?>

                            </select>
                        </div>
                    </div>





                    <input class="form-control" name="bookingID" type="hidden" placeholder="" value="<?php echo $schedule->bookingID ?>"
                           style="width: 50%;" />
                    <br><br>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Available Time Slots</label>
                        <div class="col-md-6">
                            <select id="scheduleId" class="form-control select2 select2-hidden-accessible" name="scheduleId"
                                    tabindex="-1"
                                    aria-hidden="true" required>
                            </select>

                        </div>
                    </div>

                    <br><br>



                    <input class="form-control" name="status" type="hidden" placeholder="" value="pending"
                           style="width: 50%;" />

                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-6">
                            {!! Form::submit('Edit Schedule', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}





                </div>
            </div>



    </div>

    <!-- Modal -->
    <div class="modal fade" id="info-modal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content panel-warning">
                <div class="modal-header"  style="background-color: #cb9c8d;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #0c0c0c">Sorry</h4>
                </div>
                <div class="modal-body">
                    <p>No Available Time Slots Found for this Laboratory on Selected Date</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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

            var resourceId = $('#resourceId').val();
            var date = $('#date').val();
            //alert( resourceId );

            $.ajax({
                type:"GET",
                url: '/patient_shedules/list/' + resourceId + "/" + date,
                success: function(response){
                    var sel = $('#scheduleId');
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