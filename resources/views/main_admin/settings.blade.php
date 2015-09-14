@extends('admin')

@section('navbar')
	@include('main_admin.navbar')
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Settings <small>change email or password</small>
		</h1>
	</div>
</div>
<!-- /.row -->

@if(session('status'))
	<div class="alert alert-success fade in">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> {{session('status')}}
	</div>
@endif

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Change Email</h3>
			</div>
			<div class="panel-body">
					@if(session('errortype')=='email')
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
					@endif
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/main_admin/change/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<div class="form-group">
							<label class="col-md-4 control-label">Current E-Mail Address: </label>
							<label class="col-md-1 control-label">{{$email}}</label>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">New E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Change Email Address
								</button>
							</div>
						</div>
						
					</form>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Change Password</h3>
			</div>
			<div class="panel-body">
				
				@if(session('errortype')=='password')
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
					@endif
				
				<form class="form-horizontal" role="form" method="POST" action="{{ url('main_admin/change/password') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Current Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="current_password">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">New Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="new_password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm New Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Change Password
								</button>
							</div>
						</div>
						
					</form>
			</div>
		</div>
	</div>
</div>
@stop