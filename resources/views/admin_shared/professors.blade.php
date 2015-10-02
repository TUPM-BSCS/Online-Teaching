@extends('admin')

@section('navbar')
	@if($is_mainadmin)
		@include('main_admin.navbar')
	@else
		@include('inst_admin.navbar')
	@endif
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Professors 
			@if($is_mainadmin)
				<small>list of PhilEd's Professors</small>
			@else
				<small>list of Institutions's Professors</small>
			@endif
		</h1>
	</div>
</div>

@if($is_mainadmin)
	@include('inst_admin.professor_inst')
@endif
<!-- /.row -->
@stop