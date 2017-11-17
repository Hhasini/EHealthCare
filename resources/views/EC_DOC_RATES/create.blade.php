@extends('app')

<?php

$doctors = DB::table('doctors')->get();

?>

@section('page_styles')

@endsection


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

        <br><br> <br>

        <div class="col-md-12" style="background-color:  #eaffdf">
            <br>
            <a class="btn btn-small btn-success pull-right" href="{{ URL::to('EC_DOC_RATES/') }}"> </i> View All</a>


            <h1 style="color: #0a470d">Add E-Channelling Charges</h1>

            <div class="box box-default">
                <div class="box-header with-border">
                    <!-- route to store method in controller to store data-->


                    <br>

                    {!! Form::open(['route' => 'EC_DOC_RATES.store']) !!}



                            <!--get doctor id when selecting doctor name-->
                    <div class="form-group">
                        <b> Doctor Name</b><select class="form-control select2 select2-hidden-accessible" name="doc_id"
                                                   style="width: 50%;"
                                                   tabindex="-1"
                                                   aria-hidden="true">
                            <?php
                            foreach ($doctors as $doctor) {
                                $doc_id = $doctor->doctor_id;
                                $doc_name = $doctor->name;
                                echo "<option value = '$doc_id' >$doc_name</option >";
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group">

                        <div class="form-group">
                            <b>Payment Per Booking</b><input class="form-control" name="rate" type="text"
                                                          style="width: 50%;" />
                        </div>

                    </div>



                    {!! Form::submit('Save Payment Details', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}

                    <br>


                </div>
            </div>





        </div>





    </div>
    <br><br><br><br>
@endsection



@section('page_script2')

@endsection
