<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PhilEd Admin Site</title>

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


    <!-- Custom CSS -->
	<link href="{!! asset('css/admin.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/sb-admin.css') !!}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{!! asset('css/plugins/morris.css') !!}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        @yield('navbar')
        
        <div id="page-wrapper">
            <div class="container-fluid page">
                @yield('content')   
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    @yield('footer')
    
    <!-- jQuery -->
    <script src="{!! asset('js/jquery.js') !!}"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
	
    <script src="{!! asset('js/plugins/morris/raphael.min.js') !!}"></script>
    <script src="{!! asset('js/plugins/morris/morris.min.js') !!}"></script>
    <script src="{!! asset('js/plugins/morris/morris-data.js') !!}"></script>
   
</body>

</html>
