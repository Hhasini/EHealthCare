@extends('app')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('/assets/css/radio.css') }}" rel="stylesheet">
<!-- === BEGIN CONTENT === -->
<div id="content">
    <div class="container">
        <div class="row margin-vert-30">
            <div class="headline">

            </div>
            @if (session('success'))
            <div class="flash-message">
                <div class="alert alert-success">

                </div>
            </div>
            @endif

            <!-- Register Box -->
            <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                {!! Form::open(['url' => 'organs','class'=>'signup-page']) !!}
                <h2><b>Organ Donor Registration</b></h2>
                <div class="form-group">

                    {!! Form::text('fname',null,['class'=>'form-control','placeholder'=>'First Name','pattern'=>'[a-zA-Z]{3,}', 'title'=>'Minimum 3 letters','required']) !!}


                </div>
                <div class="form-group">
                    {!! Form::text('id',null,['class'=>'form-control','placeholder'=>'Nic','title'=>'please enter valid nic','pattern'=>'[0-9]{9,}[vV]{1,}','title'=>'956739789v','required']) !!}

                </div>

                <div class="form-group">
                    {!! Form::text('age',null,['class'=>'form-control','placeholder'=>'Age','required']) !!}

                </div>

                <div class="form-group">


                    <label >Select Your Gender</label> <br>
                    <input name="gender" type="radio" value="male" style="margin-right: 22"><label >Male</label>
                    <input checked="checked" name="gender" type="radio" value="female" style="margin-right: 22">FeMale


                </div>
                <div class="form-group">
                    <select id="template-contactform-service" name="bloodgroup" class="form-control " style="width: 450px;height: 30px;">
                        <option>Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>  
                </div>

                <div class="form-group">

                    <select id="template-contactform-service" name="part" class="form-control " style="width: 450px;height: 30px;">
                        <option>Organs that I wish to donate</option>
                        <option value="Corneas">Corneas</option>
                        <option value="Kidneys">Kidneys</option>
                        <option value="Heart">Heart</option>
                        <option value="Liver">Liver</option>

                    </select>  




                </div>



                <div class="form-group">
                    {!! Form::text('email',null,['class'=>'form-control','required','placeholder'=>'Email','pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$', 'title'=>'format: characters@characters.domain']) !!}

                </div>

                <div class="form-group">
                    {!! Form::text('phone',null,['class'=>'form-control','required','placeholder'=>'Phone','pattern'=>'[\+]\d{2}[\(]\d{2}[\)]\d{4}[\-]\d{3}','title'=>'Format: +99(99)9999-999)']) !!}

                </div>
                <div class="form-group">
                    {!! Form::text('address',null,['class'=>'form-control','required','placeholder'=>'Address']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label('Select Your Image') !!}
                    {!! Form::file('image', null) !!}

                </div>
                <div class="form-group">
                    {!! Form::Reset('Reset', ['class' => 'btn btn-info','type'=>'reset','style'=>' width: 100px']) !!}
                    {!! Form::submit('Save', ['class' => 'btn btn-primary','type'=>'submit','style'=>' width: 100px']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <!-- End Register Box -->
        </div>
    </div>
</div>
</div>
</div>
<!-- === END CONTENT === -->

@endsection

