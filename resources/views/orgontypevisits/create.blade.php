@extends('app')

@section('content')
<!-- === BEGIN CONTENT === -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<div id="content">
    <div class="container">
        <div class="row margin-vert-30">
            <div class="headline">

            </div>
            <!-- Register Box -->
            <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
               
                {!! Form::open(array('url' => 'orgontypevisits', 'method' => 'POST','class'=>'signup-page')) !!}
                <center><h2><b>ORGAN DONOR VISIT</b></h2></center>
                <div class="form-group">

                    {!! Form::text('fname',null,['class'=>'form-control','placeholder'=>'First Name','pattern'=>'[a-zA-Z]{3,}', 'title'=>'Minimum 3 letters','required']) !!}


                </div>
                <div class="form-group">
                    {!! Form::text('nic',null,['class'=>'form-control','placeholder'=>'Nic','title'=>'please enter valid nic','pattern'=>'[0-9]{9,}[vV]{1,}','title'=>'956739789v','required']) !!}
                </div>
                

                <div class="form-group">
                    {!! Form::text('age',null,['class'=>'form-control','placeholder'=>'Age','required']) !!}

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
                    {!! Form::Reset('Reset', ['class' => 'btn btn-primary','type'=>'reset','style'=>' width: 100px']) !!}
                    
                    {!! Form::submit('Visit', ['class' => 'btn btn-info','type'=>'submit','style'=>' width: 100px']) !!}
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

