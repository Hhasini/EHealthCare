@extends('app')

<?php

use Illuminate\Support\Facades\DB;
$doctors = DB::table('doctors')->get();

?>
@section('content')


    <div class="container">


        <div class="row margin-vert-30">
            <!-- Side Column -->
            <div class="col-md-3">
                <div class=" person-details margin-bottom-30">
                    <figure>
                        <img src="{{ asset('/assets/img/theteam/image4.jpg') }}" alt="image2">
                        <figcaption>

                        </figcaption>
                        <ul class="list-inline person-details-icons">
                            <li>

                                <a href="{{ url('/EC_DOC_RATES/create') }}" style="color: white">
                                    ADD DOCTOR CHARGES
                                </a>
                            </li>

                        </ul>
                    </figure>
                </div>
                <!-- End About -->
                <div class=" person-details margin-bottom-30">
                    <figure>
                        <img src="{{ asset('/assets/img/theteam/image6.png') }}" alt="image2">
                        <figcaption>

                            <span></span>
                        </figcaption>
                        <ul class="list-inline person-details-icons">
                            <li>

                                <a href="{{ url('/EC_Schedule') }}" style="color: white">
                                    VIEW DAILY CALENDER
                                </a>
                            </li>

                        </ul>
                    </figure>
                </div>


            </div>


            <br>

            <div class="col-md-9">
        <div class="row">
            <br>

            <div class="col-md-10">
                <h1>LIST E-CHANNELLING PAYMENT DETAILS</h1>
                <br>


                            <table class="table table-striped " id="myTable" >
                                <thead style="background-color: #738668">
                                <tr style="font-weight: 900 ;color: #eff7ff">

                                    <td>Doctor</td>

                                    <td>Payment Per Booking(Rs)</td>
                                    <td> Edit Payment</td>
                                    <td>Delete Payment </td>
                                    <td> </td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>


                                    @foreach( $rate as $key =>  $rates)

                                        <?php
                                        $name = DB::table('doctors')->where('doctor_id',$rates->doc_id)->get();


                                        foreach($name as $d){


                                            echo "<td>";
                                            echo $d->name;
                                            echo "</td>";

                                        }
                                        ?>
                                        <td>{{  $rates->rate }}</td>

                                        <td>

                                            <a class="btn btn-small btn-info"
                                               href="{{ URL::to('EC_DOC_RATES/' . $rates->rid . '/edit') }}">
                                                <i class='glyphicon glyphicon-edit'> </i>  </a>
                                        </td>
                                        <td>
                                            {!! Form::model( $rates, [ 'method' => 'DELETE', 'route' =>
                                             ['EC_DOC_RATES.destroy',$rates->rid], 'id' => 'EC_Rate-del-frm' ]) !!}



                                            <a title="" data-original-title="" class="btn btn-large btn-danger"
                                               data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i> </a>

                                            {!! Form::close() !!}

                                        </td>


                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>






                </div>

            </div>


        <br><br><br>


    </div>


@endsection

@section('page_script2')

    <script src="{{ URL::asset('bootstrap/js/bootstrap-confirmation.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap-tooltip.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {


            $('[data-toggle="confirmation"]').confirmation({
                btnOkLabel: "Yes", btnCancelLabel: "No",
                onConfirm: function (event) {
                    $('#EC_Rate-del-frm').submit();
                }
            });
        });
    </script>
@endsection