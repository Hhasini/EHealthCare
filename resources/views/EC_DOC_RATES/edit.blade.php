@extends('app')


<?php
$doctors = DB::table('doctors')->where('doctor_id','!=',$rate->doc_id)->get();
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
                        <a class="btn btn-small btn-success pull-right" href="{{ URL::to('EC_DOC_RATES/') }}"> </i> go back</a>


                        <h1 style="color: #0a470d">Edit E-channeling Charges</h1>

                        <div class="box box-default">
                            <div class="box-header with-border">
                                <!-- route to store method in controller to store data-->


                                <br>

                                {!! Form::model( $rate, [ 'method' => 'PATCH', 'route' => ['EC_DOC_RATES.update',$rate->rid]  ]) !!}

                                    <div class="form-group">
                                        <?php
                                        $doc_n = DB::table('doctors')->where('doctor_id',$rate->doc_id)->get();

                                            $r=$rate->doc_id;
                                        #Doctor ID as hidden
                                        echo "<b></b><input class='form-control'
                                            name='doc_id' value='$r' style='width: 50%' type='hidden'>"
                                        ?>

                                    </div>

                                    <div class="form-group">

                                    <div class="form-group">
                                        <?php
                                        $doc_n = DB::table('doctors')->where('doctor_id',$rate->doc_id)->get();



                                        foreach($doc_n as $d){
                                            echo "<b>Doctor Name</b><input class='form-control'
                                            value='$d->name' type='text' style='width: 50%'>";

                                        }
                                        ?>

                                        </div>

                                </div>


                                <div class="form-group">

                                    <div class="form-group">
                                        <b>Payment</b><input class="form-control" name="rate" value="{{$rate->rate}}"type="text"
                                                                      style="width: 50%;" />
                                    </div>

                                </div>




                                {!! Form::submit('Edit Payment', ['class' => 'btn btn-success']) !!}

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



