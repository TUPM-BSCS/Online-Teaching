@extends('admin')

@section('navbar')
	@include('inst_admin.navbar')
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Professors
			@if($is_verified)
			<small>List of Verified Professors</small>
			@else
			<small>List of Pending Professors</small>
			@endif
		</h1>
	</div>
</div>
<!-- /.row -->

@if( $is_verified)
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-check"></i> Verified Professors</h3>
				</div>			
				
				<div class="panel-body">
					@foreach($professors_verified as $professor)
						<div class="col-lg-1"></div>
						<div class="thumbnail col-lg-10">
							<div class="col-lg-2">
								<img src="{{URL::asset('images/professor/'.$professor->image)}}" width="100" height="100">
							</div>
							<div class="col-lg-10">
								<h4>{{$professor->name}}</h4>		
								<p> {{$professor->email}}</p>							
							</div>								
						</div>
						<div class="col-lg-1"></div>
					@endforeach
				</div>
				
			</div>
		</div>
	</div>
	<!-- /.row -->
@else(! $is_verified)
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-warning"></i> Pending Professor Requests</h3>
				</div>
				<div class="panel-body">
					@foreach($professors_pending as $professor)
					<div class="row">
						<div class="col-lg-1"></div>
						<div class="thumbnail col-lg-10">	
							<div class="col-lg-2">
								<img src="{{URL::asset('images/professor/'.$professor->image)}}" width="100" height="100">	
							</div>						
							<div class="col-lg-8">
								<h4>{{$professor->firstname}} {{$professor->lastname}}</h4>	
							</div>
								
							<form class="form-horizontal col-lg-1" role="form" method="POST" action="{{ url('/institution/accept') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">						
								<input type="hidden" name="prof_id" value="{{ $professor->user_id }}">
								<div class="form-group">
										<button type="submit" class="btn btn-primary">
											Accept
										</button>
								</div>								
							</form>	
							<form class="form-horizontal col-lg-1" role="form" method="POST" action="{{ url('/institution/decline') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">						
								<input type="hidden" name="prof_id" value="{{ $professor->user_id }}">
								<div class="form-group">
										<button type="submit" class="btn btn-default">
											Decline
										</button>
								</div>								
							</form>							
						</div>		
						<div class="col-lg-1"></div>
					</div>											
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endif


@stop
