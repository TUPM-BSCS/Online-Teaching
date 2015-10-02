<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{url('main_admin')}}">PhilEd</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Institution Admin <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{url('institution/settings')}}"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{url('logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li id="dashboard">
                <a href="{{url('institution')}}"><i class="fa fa-fw fa-dashboard"></i> Institution Profile</a>
            </li>
            <li id="viewsite">
                <a href="{{url('#')}}"><i class="fa fa-fw fa-external-link"></i> View Site</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-users"></i> Professors <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo1" class="collapse">
                    <li>
                        <a href="{{url('institution/professors-verified')}}">Verified Professors ({{$num_verified}})</a>
                    </li>
                    <li>
                        <a href="{{url('institution/professors-pending')}}">Pending Professor Requests ({{$num_pending}})</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-list-ul"></i> Courses <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo2" class="collapse">
                    <li>
                        <a href="{{url('institution/courses')}}">View Courses</a>
                    </li>
                    <li>
                        <a href="{{url('institution/add_course')}}">Add a Course</a>
                    </li>
                    <li>
                        <a href="{{url('institution/category_requests')}}">Request for Course Category Approval</a>
                    </li>
                </ul>
            </li>                           
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>