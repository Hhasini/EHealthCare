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
<link href="{{asset('assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">



<!-- Header CSS -->
<div id="content">
    <div class="container">
        <div class="row margin-vert-30">
            <div class="col-md-12 margin-top-10 animate flip">

                <form class="form-horizontal">
                    <div class="signup-header">
                        <h1>Organ Donor Visits Details</h1>
                        <?php
                        echo($blood);
                        ?></br>
                        @foreach ($blood as $or)
                        <?php
                        echo($or);
                        ?></br>
                        @endforeach


                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr class="bg-info">

                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr style="display: none;">
                                    <td></td>



                                </tr>




                                <tr> 


                                    <td> <?php
                                        echo($blood);
                                        ?></td>





                                </tr>


                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




@endsection