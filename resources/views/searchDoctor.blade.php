
@extends('home')

@section('subcontent')
   
   <br>



    <div class="container">
    <div class="col-md-9">
        <!-- Accordion -->
        <div class="panel panel-aqua invert" style="width:600px">
             <div class="panel-heading">
              <h3 class="panel-title">
                Search Your Doctor
              </h3>
            </div>
        <div class="panel-body" style="height:350px">
            <div class="control-label">Doctor's Last Name</div>
            <div class="form-group">
                <select class="form-control select2 select2-hidden-accessible" name="project_id"
                        style="width: 50%;"
                        tabindex="-1"
                        aria-hidden="true">

                </select>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <div class="control-label">Hospital</div>
                <select class="form-control select2 select2-hidden-accessible" name="project_id"
                        style="width: 50%;"
                        tabindex="-1"
                        aria-hidden="true">

                </select>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <div class="control-label">Speciality</div>
                <select class="form-control select2 select2-hidden-accessible" name="project_id"
                        style="width: 50%;"
                        tabindex="-1"
                        aria-hidden="true">

                </select>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <div class="control-label">Start Date</div>
                <div class='input-group date' id='start_date_picker' style='width:50%;'>
                    <input type='text' class="form-control" name="start_date" required/>
                    <div class="help-block with-errors"></div>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>

            <button type="button"  style="background-color: #1b1c19;color:#eaead6 ">Search</button>



     </div>
    </div>
    </div>


    </div>
    

@endsection



