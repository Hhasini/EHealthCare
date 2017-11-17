@extends('app')


<?php

$visit_id = $_GET['visit_id'];
$pSchId = $_GET['pscId'];

?>

@section('content')

    <div class="container">
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
            <?php

            $patient =\App\DoctorVisit::find($visit_id);
            $patientList = \App\Patient::find($patient->patient_id);
            ?>

            <div class="col-sm-12">
                <a class="btn btn-small btn-success pull-right" href="{{ URL::to('patient_schedules/viewCompletedCheckups') }}"> </i> go back</a>
            </div>

            <div class="col-sm-12">
                <legend>{{$patientList->name}}</legend>
            </div>
            <br><br><br><br>


            <div class="panel panel-aqua">
                <div class="panel-heading">
                    <h3 class="panel-title">FASTING BLOOD SUGAR TEST</h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'fasting_blood_counts.store']) !!}


                    <br>


                    <input type="hidden" class="form-control" id="visit_id" name="visit_id" value="<?php echo $visit_id ?>" required>


                    <input class="form-control" name="patientSchId" type="hidden" value="<?php echo $pSchId ?>"
                           style="width: 50%;" />

                    <br>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Date</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control" id="enterDate" name="enterDate" style="width: 445px;">

                        </div>
                    </div>



                    <br>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Fasting Blood Sugar Amount</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" id="fbs" name="fbs" placeholder="mg" step="0.01" required>

                        </div>
                    </div>

                    <br>

                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-6">
                            {!! Form::submit('Add Test Results', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}





                </div>
            </div>



    </div>

@endsection

@section('page_script2')
    <script type="text/javascript">
        var today = new Date().toISOString().slice(0, 10);
        $('#enterDate').attr('min', today);


    </script>
@endsection