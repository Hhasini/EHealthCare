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
<div class="container-fluid">
	<br><br><br>	<br>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" style="background: #d6e9c6 ">
				<div class="panel-heading" style="background: #4A9166;color: #FFFFff">Login</div>
				<div class="panel-body">
					<br>
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label" >E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" >Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="background:#4A9166;color:#ffffff ">Login</button>

								{{--<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>--}}
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br><br><br>
</div>
@endsection
