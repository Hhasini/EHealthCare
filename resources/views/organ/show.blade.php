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

<!-- === BEGIN CONTENT === -->
<div id="content">
    <div class="container">
        <div class="row margin-vert-30">
            <div class="col-md-12">
                <h2>About Me</h2>
                <div class="row">
                    <div class="col-md-6 animate fadeIn">
                       
                      <img src="{{asset('assets/pic/' . $organ->image)}}" height="500" width="550" class="img-rounded">

                    </div>
                    <div class="col-md-6 margin-bottom-10 animate fadeInRight">
                        <h3 class="padding-top-10 pull-left">{{$organ->fname}}
                            <small>- Blood Donor</small>
                        </h3>
                        <div class="clearfix">
                            <form class="form-horizontal">
                                <div class="form-group">

                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title"  placeholder={{$organ->fname}} readonly style="width: 400px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-2 control-label">Age</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" placeholder={{$organ->age}} readonly style="width: 400px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-2 control-label">Bloodgroup</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" placeholder={{$organ->bloodgroup}} readonly style="width: 400px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-2 control-label">Body Parts</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" placeholder={{$organ->part}} readonly style="width: 400px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" placeholder={{$organ->gender}} readonly style="width: 400px;">
                                    </div>
                                </div>      
                                <div class="form-group">
                                    <label for="image" class="col-sm-2 control-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" placeholder={{$organ->phone}} readonly style="width: 400px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" placeholder={{$organ->email}} readonly style="width: 400px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" placeholder={{$organ->address}} readonly style="width: 400px;">
                                    </div>
                                </div>








                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <a href="{{ url('organs')}}" class="btn btn-primary btn-sm">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <hr>

              
               
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- === END CONTENT === -->
@endsection
