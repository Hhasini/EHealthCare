@extends('app')



@section('content')



<div class="container">



    <div class="box box-default">

        <div class="box-header with-border">


            <div class="box box-default" style="padding: 20px 50px 0px 20px ;">

                <div class="col-md-12" style="background-color:  #eaffdf">

                    <h1 style="color: #14c421">C.T. Scanning</h1><br><br>

                    <div class="box box-default">
                        <div class="box-header with-border">




                            <div class="col-md-12" >

                                <div  class="page-inner-content row">
                                    <div class="inner-wrapper">
                                        <p>

                                            CT scanning is a radiographic procedure used for diagnosis.
                                            X-rays are taken from a series of different angles and assembled to
                                            show a cross- sectional view of internal organs. In this procedure the patient
                                            is exposed to a very small amount of radiation..</p>
                                        <p>

                                            CT scanning is used when more detailed information are needed by the
                                            doctors than regular x-rays provide, particularly to
                                            look for head injuries, brain disease, and tumors.</p>


                                            <br>
                                            <br>

                                    </div>

                                </div>


                                <div>
                                    <div class="images">
                                        <span><span><img src="{{ URL::asset('images/ctscan1.jpg') }}" alt="CT Scan Lab 1" class="zoom" /></span></span>
                                        <span><span><img src="{{ URL::asset('images/ctscan2.jpg') }} " alt="CT Scan Lab 2" class="zoom" /></span></span>

                                    </div>
                                    <div class="images">

                                        <table class="location">
                                            <tbody>
                                            <tr>
                                                <td>Location</td>
                                                <td>: 2nd Floor, Cath Lab</td>
                                            </tr>
                                            <tr>
                                                <td>Contact Person</td>
                                                <td>: OPD Office (Counter 15)</td>
                                            </tr>
                                            <tr>
                                                <td>Contact No</td>
                                                <td>: +94 11 2304444</td>
                                            </tr>
                                            <tr>
                                                <td>Extension</td>
                                                <td>: 1227 / 1366</td>
                                            </tr>
                                            <tr>
                                                <td>E-mail</td>
                                                <td>: <a href="mailto:nawaloka@slt.lk?subject=Angiography">Angiography</a></td>
                                            </tr>
                                            <tr class="align-right">
                                                <td colspan="2">[ <a href="#">Map</a> ]</td>
                                            </tr>
                                            </tbody>
                                        </table>


                                        <br>
                                        <br>
                                    </div>
                                </div>
                            </div>





                            <br>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<br>
<br>
@endsection