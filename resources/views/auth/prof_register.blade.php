@extends('app')

@section('content')
  <!--BEGIN #signup-form -->
    <div id="signup-form">
        
        <!--BEGIN #subscribe-inner -->
        <div id="signup-inner">
        
        	<div class="clearfix" id="header">
        
                <h1>Registration for Professors</h1>

            
            </div>
			<p>Please complete the fields below, ensuring you use a valid email address as you will be sent a validation code which you will need the first time you login to the site.</p>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form id="send" method="POST" action="{{url('register/professor')}}" enctype="multipart/form-data">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="role_id" value="3">
                
                
                <p>
                <label for="firstname">First Name </label>
                <input id="name" type="text" name="firstname" value="" />
                </p>
				
				<p>
                <label for="lastname">Last Name </label>
                <input id="name" type="text" name="lastname" value="" />
                </p>
                
                <p>
                <label for="about">About</label>
                <textarea name="about" id="about" cols="30" rows="10"></textarea>
                </p>
                
                <p>
                <label for="institution">Institution</label>
                <select class="btn btn-default dropdown-toggle" name="institution">
                     @foreach($institutions as $institution)
                        <option value="{{$institution->name}}">{{$institution->name}}</option>
                     @endforeach
                </select>
                </p>
                
                <p>
                <label for="image">Logo</label>
                <input id="image" type="file" name="image" value="" />
                </p>
                
                <p>
                <label for="email">Email*</label>
                <input id="email" type="text" name="email" value="" />
                </p> 
                
                <p>
                <label for="password">Password*</label>
                <input id="password" type="password" name="password" value="" />
                </p> 
                
                <p>
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" value="" />
                </p>               
                
                <p>

                <button id="submit" type="submit">Submit</button>
                </p>
                
            </form>
            
		<div id="required">
		<p>* Required Fields</p>
		</div>


            </div>
        
        <!--END #signup-inner -->
        </div>
        
    <!--END #signup-form -->   
    </div>
@stop