@extends('app')


<?php

$labs = DB::table('resources')->get();

$bookID=$_GET['bookId'];

?>

@section('content')

    <div class="container">

        <div class="box box-default">
            <div class="box-header with-border">

                <br>

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


                <a class="btn btn-small btn-success pull-right" href="{{ URL::to('patient_shedules/') }}"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> go back</a>
<br><br>
                <div class="panel panel-aqua">
                    <div class="panel-heading">
                        <h3 class="panel-title">Medical Checkup Scheduling</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'patient_shedules.store']) !!}




                        <div class="form-group">
                            <label class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <div class='input-group date' id='start_date_picker'>
                                    {{--<input id="date" type='text' class="form-control" name="date" required/>
                                             <span class="input-group-addon">
                                             <span class="glyphicon glyphicon-calendar"></span>
                                             </span>--}}

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
                                    foreach ($labs as $lab) {
                                        $lab_id = $lab->id;
                                        $lab_name = $lab->name;
                                        echo "<option value = '$lab_id' >$lab_name</option >";
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <br>

                        <input class="form-control" name="bookingID" type="hidden" placeholder="" value="<?php echo $bookID ?>"
                               style="width: 50%;" />
                        <br>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Available Time Slots</label>
                            <div class="col-md-6">
                                <select id="scheduleId" class="form-control select2 select2-hidden-accessible" name="scheduleId"
                                        tabindex="-1"
                                        aria-hidden="true"  required>
                                </select>

                            </div>
                        </div>

                        <br><br>

                        <input class="form-control" name="status" type="hidden" placeholder="" value="pending"
                               style="width: 50%;" />


                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                        {!! Form::submit('Create Schedule', ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>

                        {!! Form::close() !!}

                    </div>
                </div>
         </div>
            </div>


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

@section('page_script2')
    <script type="text/javascript">
        var today = new Date().toISOString().slice(0, 10);
        $('#date').attr('min', today);

        $('#resourceId').on('change', loadTimeSlots);
        $('#date').on('change', loadTimeSlots);

        function loadTimeSlots(){
            /*$.ajaxSetup({
             header:$('meta[name="_token"]').attr('content')
             })
             e.preventDefault(e);*/

            $('#errMsg').html( "" );

            var resourceId = $('#resourceId').val();
            var date = $('#date').val();

            if(resourceId!=null && date!=null && resourceId!="" && date!=""){
                $.ajax({
                    type:"GET",
                    url:'list/' + resourceId + "/" + date,
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
            }

        }
    </script>
@endsection