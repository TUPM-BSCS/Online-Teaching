@extends('app')

@section('content')
  <!--BEGIN #signup-form -->
    <div id="signup-form">
        
        <!--BEGIN #subscribe-inner -->
        <div id="signup-inner">
        
        	<div class="clearfix" id="header">
        
                <h1>Registration for Institutions</h1>

            
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
            
            <form id="send" method="POST" action="{{url('register/institution')}}" enctype="multipart/form-data">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="role_id" value="2">
                
                
                <p>
                <label for="name">Institution Name *</label>
                <input id="name" type="text" name="name" value="" />
                </p>
                
                <p>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
                </p>
                
                <p>
                <label for="contact">Contact No.</label>
                <input id="contact" type="text" name="contact" value="" />
                </p>
                
                <p>
                <label for="logo">Logo</label>
                <input id="logo" type="file" name="logo" value="" />
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