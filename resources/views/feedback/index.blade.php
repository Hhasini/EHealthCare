@extends('app')


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

<br><br>

                            <div class="col-md-8" style="background-color: #dcf3ce">

                                <br>

                                <h1 style="color: #0a470d">Top Feedbacks</h1>

                                <br>
                                <br>

                                <div class="col-md-11">

                                    <div class="col-md-5 ">

                                        <div class="row">

                                            <div class="form-group" >


                                                @foreach($feedback as $key => $fed)

                                                    <label style="color: #09988d;font-size: 140% ; width:650px">{{$fed->feedback}}</label>
                                                    <p style="font-size: 78%"><b>user - {{$fed->name}}</b></p>

                                                @endforeach

                                            </div>

<br>

                                            <a class="btn btn-small btn-success pull-right glyphicon-envelope"
                                               href="#" data-toggle="modal"
                                               data-target="#feedback">  Give feedback</a>




                                            <br>

                                <br>
                            </div>

                        </div>
                        <br>
                    </div>
                </div>
            <br>








<br>









<br><br>
                        <div id="feedback" class="modal fade" role="dialog">
                            <div class="modal-dialog" >
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#0fb754">
                                        <!-- Modal buuton to close form-->
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" style="color: white"><b>Give Feedback</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <section class="content">
                                            <div class="box box-default">
                                                <div class="box-header with-border">
                                                    <!-- route to store method in controller to store data-->


                                                    <br>

                                                    {!! Form::open(['route' => 'feedback.store']) !!}


                                                    <div class="form-group">

                                                        <div class="form-group">
                                                            <b> Name</b><input class="form-control" name="name" type="text" placeholder="enter your name"
                                                                               style="width: 50%;" />
                                                        </div>

                                                    </div>






                                                    <div class="form-group">

                                                        <div class="form-group">
                                                            <b> Feedback</b><input class="form-control" name="feedback" type="textArea" placeholder="enter your feedback"
                                                                                   style="width: 50%;" />
                                                        </div>

                                                    </div>



                                                    {!! Form::submit('Send Feedback', ['class' => 'btn btn-success']) !!}

                                                    {!! Form::close() !!}

                                                    <br>


                                                </div>
                                            </div>

                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div><!-- /.box-body -->
<br><br>
@endsection