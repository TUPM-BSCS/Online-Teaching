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
			<small>List of Verified Institutions</small>
			@else
			<small>List of Pending Institutions</small>
			@endif
		</h1>
	</div>
</div>
<!-- /.row -->

@if( $is_verified)
	@include('main_admin.verified')
@else(! $is_verified)
	@include('main_admin.pending')
@endif


@stop