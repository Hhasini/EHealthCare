@extends('app')

@section('page_styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <style>
        .text-width {
            width: 50%;
        }
    </style>

@endsection



@section('content')

    <div class="container">



        <br>

        <div class="col-md-12" style="background-color:  #eaffdf">
            <br>
            <a class="btn btn-small btn-info" href="{{ route('medicines.index') }}">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>back</a>
            <br><br>

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


            <h2 style="color: #0a470d">{{$medicine->medicine_name}}</h2>
            <br> <br>
            <div class="box box-default">
                <div class="box-header with-border">


                    <div>
                        <table class="table table-striped" style="width: 60%">

                                <tr style="background-color: #FFFFff  ">
                                    <td style="width: 30%">ID</td>
                                    <td>: {{$medicine->medicine_id}}</td>
                                </tr>
                                <tr style="background-color: #8CCCF5  ">
                                    <td>Medicine</td>
                                    <td>: {{$medicine->medicine_name}}</td>
                                </tr>
                                <tr style="background-color: #FFFFff  ">
                                    <td>Active Ingredients</td>
                                    <td>: {{$medicine->description}}</td>
                                </tr>
                                <tr style="background-color: #8CCCF5  ">
                                    <td>Manufacturer</td>
                                    <td>: {{$medicine->manufacturer}}</td>
                                </tr>
                                <tr style="background-color: #FFFFff  ">
                                    <td>Unit Price</td>
                                    <td>: {{$medicine->price}}.00</td>
                                </tr>

                        </table>

<br><br><br>




                    </div>
                </div>





            </div>





        </div></div>
    <br>
@endsection



@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript">


        $(function () {
            var dateNow = new Date();
            $('#start_date_picker').datetimepicker({
                useCurrent: false,
                viewMode: 'years',
                format: 'YYYY-MM-DD H:M:s',
                //defaultDate: moment(dateNow),
                minDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6]
            });
            $('#end_date_picker').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                viewMode: 'years',
                format: 'YYYY-MM-DD H:M:s',
                minDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6]
            });
            $("#start_date_picker").on("dp.change", function (e) {
                $('#end_date_picker').data("DateTimePicker").minDate(e.date);
            });
            $("#end_date_picker").on("dp.change", function (e) {
                $('#start_date_picker').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').dataTable();
        });
    </script>
    <script>
        $(document).on("click", ".open-AddBookDialog", function () {
            var medID = $(this).data('id');
            $(".modal-body #medID").val( medID );
            // As pointed out in comments,
            // it is superfluous to have to manually call the modal.
            // $('#addBookDialog').modal('show');
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#myModal').on('show.bs.modal', function (e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'fetch_record.php', //Here you will fetch records
                    data :  'rowid='+ rowid, //Pass $id
                    success : function(data){
                        $('.fetched-data').html(data);//Show fetched data from database
                    }
                });
            });
        });
    </script>




@endsection




