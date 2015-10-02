@extends('admin')

@section('navbar')
	@include('main_admin.navbar')
@stop

@section('content')

<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Dashboard <small>Statistics Overview</small>
		</h1>
	</div>
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-6 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-university fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{$num_verifiedtoday}}</div>
						<div>New Institutions!</div>
					</div>
				</div>
			</div>
			<a href="{{url('main_admin/institutions_verified')}}">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-6 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-warning fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{$num_pendingtoday}}</div>
						<div>Pending Institution Requests</div>
					</div>
				</div>
			</div>
			<a href="{{url('main_admin/institutions_pending')}}">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-6 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-shopping-cart fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">124</div>
						<div>New Orders!</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-6 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-support fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">13</div>
						<div>Support Tickets!</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>
@stop