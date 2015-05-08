@extends('app')

@section('content')

<section class="bannertxt" id="VolunteerAcc">
	<div class="container">
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
    	<div class="row">
        	<div class="col-md-12 col-sm-12"> 
        	<h1>Volunteer & Serve Your Community.</h1>
            <h3>Create Your Account</h3>
            </div>
        </div>
    </div>
    
    <div class="container">
    	<div class="row">
        	<div class="col-md-12 col-sm-12"> 
        		<form class="form-horizontal" role="form" method="POST" action="{{ url('/register/volunteer') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
            	<div id="formwrap">
                	<h2>Volunteer Account</h2>
                		<div class="row">
        					<div class="col-md-6 col-sm-6"><input class="mb15" type="text" placeholder="First Name" name="first_name" value="{{ old('first_name') }}"/> </div>
                            <div class="col-md-6 col-sm-6"><input type="text" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}"/> </div>
                        </div>
                        <div class="row">
        					<div class="col-md-12 col-sm-12"><input type="text" placeholder="Email Address" name="email" value="{{ old('email') }}"/> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12"><input type="text" placeholder="Phone" name="phone_number" value="{{ old('phone_number') }}"/> </div>
                        </div>
                        <div class="row">
        					<div class="col-md-12 col-sm-12"><input type="text" placeholder="Password" name="password"/> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12"><input type="text" placeholder="Confirm Password" name="password_confirmation"/> </div>
                        </div>
                        <div class="row">
        					<div class="col-md-4 col-sm-4">
        						<div class="mb15 select-style wid100">
        							{!! Form::selectMonth('month', ['class' => 'form-control select select-primary']) !!}
        						</div>
        					</div>
                            <div class="col-md-4 col-sm-4">
                            	<div class="mb15 select-style wid100">
                            		{!! Form::selectRange('day', 1, 31, ['class' => 'form-control select select-primary']) !!}
                            	</div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                            	<div class="mb15 select-style wid100">
                            		{!! Form::selectYear('year', 2015, 1930, ['class' => 'form-control select select-primary']) !!}
                            	</div>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-md-12 col-sm-12"><h4>Gender</h4></div>
                            <div class="col-md-12 col-sm-12"><div class="select-style wid100"><select class="form-control select select-primary" data-toggle="select">
            <option value="0">Female </option>
            <option value="1">Male</option>
                    </select></div></div>
                        </div>
                        <div class="row">
                        	<div class="col-md-12 col-sm-12"><h4 class="text-center">Account Type</h4></div>
                            
             <div class="col-md-12 col-sm-12">   
        	 
           <div class="col-md-12 col-sm-12 green-btn-outer"> 
           <div class="col-md-4 col-sm-4"> 
		   <a href="#" class="green-btns">Student</a>
		   </div>
		   
		   <div class="col-md-4 col-sm-4"> 
		   <a href="#" class="green-btns">Default</a>
		   </div>
		   
		   <div class="col-md-4 col-sm-4"> 
		   <a href="#" class="green-btns selected">Volunteer</a>
		   </div>
		   
		   
		   </div>
		   </div>
		   </div>
                            
                            
                             
                           
                     
                       
                        <div class="row">
                        	<div class="col-md-12 col-sm-12"><h4>Target Credits</h4></div>
                            <div class="col-md-12 col-sm-12"><input type="text" placeholder="Confirm Password" /></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12"><input type="submit" value="Create Account" /></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection