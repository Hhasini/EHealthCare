@extends('app')

@section('content')
    <?php
    use Illuminate\Support\Facades\DB as DB;

    $results = DB::table('recommend_checkups')->where('status','=','Pending')->groupby('visit_id')->get();

    foreach($results as $key => $result)
    {
        $id = $result->visit_id;
        $checkuplist = DB::table('recommend_checkups')->where('visit_id','=',$id)->get();
    }





    ?>

    <div class="container">
        <div class="row margin-vert-30">
            <!-- Side Column -->
            <div class="col-md-3">

                <!-- End About -->
                <div class=" person-details margin-bottom-30">
                    <figure>
                        <img src="{{ asset('/assets/img/theteam/image6.png') }}" alt="image2">
                        <figcaption>

                            <span></span>
                        </figcaption>
                        <ul class="list-inline person-details-icons">
                            <li>

                                <a href="{{ url('checkup_shedules/viewLabDetails') }}" style="color: white">
                                    VIEW DAILY LAB DETAILS
                                </a>
                            </li>

                        </ul>
                    </figure>
                </div>


            </div>

            <br>

            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane active in fade" id="faq">
                        <div class="panel-group" id="accordion">
                            @foreach($results as $key => $result)
                                <div class="panel panel-default panel-faq">
                                    <div class="panel-heading" style="background-color: #37abb3">
                                        <a data-toggle="collapse" data-parent="#accordion"
                                           href="#{{ $result->visit_id }}">
                                            <h4 class="panel-title" style="font-weight: 900 ;color: #eff7ff">
                                                Visit Number : {{ $result->visit_id }}
                                                <span class="pull-right">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </span>
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="{{ $result->visit_id }}" class="panel-collapse collapse">
                                        <div class="panel-body" style="background-color: #faffe7">

                                            <?php

                                            $id = $result->visit_id;
                                            $checkups = DB::table('recommend_checkups')->where('visit_id','=',$id)->where('status','=','Pending')->get();

                                            ?>
                                            @foreach($checkups as $checkup)

                                                <?php
                                                    $cpLists = DB::table('medical_checkups')->where('checkup_id', '=',$checkup->checkup_id)->get();
                                                    foreach ($cpLists as $cpList) {
                                                        $cName= $cpList->checkup_name;
                                                    }

                                                    $dcVisitLists = DB::table('doctor_visits')->where('id', '=',$id)->get();
                                                    foreach ($dcVisitLists as $dcVisitList) {
                                                        $pid= $dcVisitList->patient_id;
                                                    }
                                                    $patientLists = DB::table('patients')->where('id', '=',$pid)->get();
                                                    foreach ($patientLists as $patientList) {
                                                        $pName= $patientList->name;
                                                    }

                                                    ?>
                                                <table class="table table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td width="10%"><a href="#" class="pull-left">
                                                                <img src="{{ asset('/assets/img/theteam/image10.png') }}" width="35px">
                                                            </a></td>

                                                        <td width="10%">
                                                            <a href="{{ URL::to('/patient_shedules/create?bookId='.$result->id)  }}"
                                                               style="z-index: 2500;">{{ $checkup->id }}</a></td>
                                                        <td width="20%"> {{ $pName }}</td>
                                                        <td width="20%"> {{ $cName }}</td>


                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>



@endsection

