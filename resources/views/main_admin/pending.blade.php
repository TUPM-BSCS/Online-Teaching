	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-warning"></i> Pending Institution Requests</h3>
				</div>
				<div class="panel-body">
					@foreach($institutions as $institution)
					<div class="row">
						<div class="col-lg-1"></div>
						<div class="thumbnail col-lg-10">							
							<div class="col-lg-10">
								<h4>{{$institution->name}}</h4>	
							</div>
								
							<form class="form-horizontal col-lg-1" role="form" method="POST" action="{{ url('/main_admin/accept') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">						
								<input type="hidden" name="inst_id" value="{{ $institution->id }}">
								<div class="form-group">
										<button type="submit" class="btn btn-primary">
											Accept
										</button>
								</div>								
							</form>	
							<form class="form-horizontal col-lg-1" role="form" method="POST" action="{{ url('/main_admin/decline') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">						
								<input type="hidden" name="inst_id" value="{{ $institution->id }}">
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