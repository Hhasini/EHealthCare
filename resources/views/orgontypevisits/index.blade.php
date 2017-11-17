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
<link href="{{asset('../assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
<!-- Google Fonts-->
<link href="http://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css">

<!-- Header CSS -->
<div id="content">
    <div class="container">
        <div class="row margin-vert-30">
            <div class="col-md-12 margin-top-10 animate flip">

                <form class="form-horizontal">
                    <div class="signup-header">
                        <center><h1><b>DEAD DONORS DETAILS</b></h1></center>




                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr class="bg-info">

                                    <th>Nic</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Part</th>

                                    <th colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="display: none;">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                @foreach ($organ as $or)



                                <tr> 


                                    <td>{{ $or->nic }}</td>
                                    <td>{{ $or->fname }}</td>
                                    <td>{{ $or->age }}</td>
                                    <td>{{ $or->part }}</td>


                                    <td><a href="{{url('orgontypevisits',$or->nic)}}" class="btn btn-primary btn-xs">Read</a></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




@endsection
@section('page_script2')

        <script src="{{asset('../assets/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('../assets/datatables/dataTables.bootstrap.js')}}"></script>
       <script type="text/javascript">
$(document).ready(function () {
    $('#datatable').dataTable();

});
</script>
<script src="{{asset('../assets/sweet-alert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('../assets/sweet-alert/sweet-alert.init.js')}}"></script>
@endsection