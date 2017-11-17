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


            <h1 style="color: #0a470d">Pharmacy</h1>
            <br> <br>

               <div class="box box-default" style="width: 1000px;padding-left: 50px;">
                   <div class="box-header with-border">
                       <table><tr><td style="width: 800px">
                                   <h3>Add medicines to the cart </h3>
                                   <br>
                                   <div>
                                       {!! Form::open(['route' => 'medicinecarts.store']) !!}


                                       <div class="form-group">
                                           {!! Form::label('medicine_id', 'Medicine:', ['class' => 'control-label']) !!}
                                           <?php $results = DB::table('medicines')->get(); ?>
                                           <select class="form-control " name="medicine_id" style="width: 50%">
                                               <?php

                                               foreach ($results as $result) {
                                                   $id = $result->medicine_id;
                                                   $name=$result->medicine_name;
                                                   $pric = $result->price;


                                                   echo "<option value = '$id' >$name</option >";



                                               }
                                               ?>
                                           </select>
                                       </div>



                                       <div class="form-group">
                                           {!! Form::label('amount', 'Amount:', ['class' => 'control-label']) !!}
                                           {!! Form::text('amount', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                                       </div>


                                       {!! Form::submit('Add to cart', ['class' => 'btn btn-primary']) !!}

                                       {!! Form::close() !!}
                                   </div>
                               </td>
                           <td valign="bottom">
                               <?php
                               $id=null;
                               $status=false;
                               $carts=DB::table('medicine_carts')->get();
                               foreach($carts as $car){
                                   $id=$car->id;
                               }
                               if($id!=null)
                               {
                                   $status=true;
                               }
                               ?>
                                   @if($status===true)
                               <div>
                                   <a class="btn btn-small btn-info pull-right" href="{{ URL::to('medicinecarts/create') }}"> Confirm Order</a>
                               </div>
                                       @endif
                           </td></tr></table>


                   </div>
               </div>







<br><br>

            @if($status===true)
                <div style="padding-left: 50px;padding-right: 50px">
                    <table class="table table-striped table-bordered">
                        <thead style="background-color: #2e6da4;color: #FFFFff">
                        <tr>
                            <td>ID</td>
                            <td>Medicine</td>
                            <td>Amount</td>
                            <td>Price</td>
                            <td>Remove</td>

                        </tr>
                        </thead>
                        <tbody>




                        @foreach($carts as $cart)
                            <tr>
                                <td>{{$cart->medicine_id}}</td>
                                <?php

                                $name=null;
                                $meds=DB::table('medicines')->where('medicine_id',$cart->medicine_id)->get();
                                foreach($meds as $med)
                                {
                                    $name=$med->medicine_name;
                                }
                                ?>
                                <td>{{$name}}</td>
                                <td>{{$cart->amount}}</td>
                                <td>{{$cart->price}}.00</td>
                                <td style="width: 100px">


                                    <script>

                                        function ConfirmDelete()
                                        {
                                            var x = confirm("Are you sure you want to delete?");
                                            if (x)
                                                return true;
                                            else
                                                return false;
                                        }

                                    </script>
                                    <table><tr>
                                            <td><a class="btn btn-small btn-info" data-toggle="modal" data-target="#myModal-{{$cart->id}}"  >Change Amount</a></td>

                                            <td style="padding-left: 5px">
                                                {!! Form::model( $cart, [ 'method' => 'DELETE', 'route' => ['medicinecarts.destroy',$cart->id],'onsubmit' => 'return ConfirmDelete()' ,'class'=>'delete']) !!}

                                                <button class='btn btn-danger' type='submit' id="btnDelete" >Delete
                                                </button>

                                                {!! Form::close() !!}
                                            </td>
                                        </tr></table>







                                </td>
                            </tr>

                            <div class="modal fade" id="myModal-{{$cart->id}}" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Change Amount</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="box-header with-border">
                                                {!! Form::model($cart, [
                                                              'method' => 'PATCH',
                                                              'route' => ['medicinecarts.update', $cart->id]
                                                          ]) !!}
                                                <input type="hidden" id="hdn_story_id" name="story_id" value="">

                                                <div class="form-group">
                                                    {!! Form::label('amount', 'Amount:', ['class' => 'control-label']) !!}
                                                    {!! Form::text('amount', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                                                </div>




                                                {!! Form::submit('Change Amount', ['class' => 'btn btn-primary']) !!}

                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endforeach




                        </tbody>
                    </table>
                </div>


                <!-- Modal -->



            @endif











<br><br><br>


            </div></div>
    <br>
@endsection





@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>



    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
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




