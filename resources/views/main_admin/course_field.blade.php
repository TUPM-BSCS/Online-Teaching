@extends('admin')

@section('navbar')
	@include('main_admin.navbar')
@stop

@section('content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Institutions
			@if($is_verified)
			<small>List of Verified Course Categories</small>
			@else
			<small>List of Pending Course Categories</small>
			@endif
		</h1>
	</div>
</div>
<!-- /.row -->

@if( $is_verified)
	//is
@else(! $is_verified)
	//not
@endif


@stop