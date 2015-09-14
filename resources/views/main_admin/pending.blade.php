	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-check"></i> Pending Institution Requests</h3>
				</div>
				<div class="panel-body">
					@foreach($institutions as $institution)
						<div class="thumbnail">
							<h4>{{$institution->name}}</h4>		
						</div>													
					@endforeach
				</div>
			</div>
		</div>
	</div>