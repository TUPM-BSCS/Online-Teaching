<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-check"></i> Verified Institutions</h3>
				</div>			
				
				<div class="panel-body">
					@foreach($institutions_verified as $institution)
						<div class="col-lg-1"></div>
						<div class="thumbnail col-lg-10">
							<div class="col-lg-2">
								<img src="{{URL::asset('images/institution/'.$institution->logo)}}" width="100" height="100">
							</div>
							<div class="col-lg-10">
								<h4>{{$institution->name}}</h4>		
								<p> {{$institution->email}}</p>							
							</div>								
						</div>
						<div class="col-lg-1"></div>
					@endforeach
				</div>
				
			</div>
		</div>
	</div>
	<!-- /.row -->