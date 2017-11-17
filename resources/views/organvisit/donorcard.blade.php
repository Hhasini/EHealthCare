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
<div id="content">
    <div class="container">
        <div class="row margin-vert-30">
            <div class="headline">
                <!-- Login Box -->
                <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                    <div class="animatebox animate flip">
                    <form class="login-page">
                        <div class="login-header margin-bottom-30">
                            
                            <h2 style="color:red;"><b>CONGRADULATION WON A DONOR CARD</b> </h2>
                        </div>
                        <label> Nic Number</label>
                        <?php
                       
                        echo($nic);
                        ?></br>
                         <label>Number Of donation times</label>
                            <?php
                        
                        echo($count);
                        
                        ?></br>
<!--                        <?php
                        //echo "now";
                        //echo($mytime);
                        ?></br>-->
                        

                        <hr>
                        <h4 style="color:red;">You Can't Do Blood Donation</h4>
                        <p>
                          
                    </form></div>
                </div>
                <!-- End Login Box -->

            </div></div></div></div>



@endsection

