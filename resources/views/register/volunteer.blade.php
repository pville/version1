@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Volunteer Register</div>
				<div class="panel-body">
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/register/volunteer') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">First Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Last Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone Number</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Bithdate</label>
							<div class="col-md-6">
								{!! Form::selectMonth('month', ['class' => 'form-control']) !!}
								{!! Form::selectRange('day', 1, 31, ['class' => 'form-control']) !!}
								{!! Form::selectYear('year', 2015, 1930, ['class' => 'form-control']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Gender</label>
							<div class="col-md-6">
								<div class="col-md-3">
								<input type="radio" name="gender" value="1">
								<label>Male</label>
							
							</div>
							<div class="col-md-3">
								
								<input type="radio" name="gender" value="2">
								<label>Female</label>
							</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Account Type</label>
							<div class="col-md-8">
								<select class="form-control" name="account_type">
								    @foreach($volunteerTypes as $volunteerType)
								      <option value="{{$volunteerType->id}}">{{$volunteerType->type}}</option>
								    @endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group" style="">
							<label class="col-md-4 control-label">Group</label>
							<div class="col-md-6">
								<select class="form-control" name="group_id">
								    @foreach($groups as $group)
								      <option value="{{$group->id}}">{{$group->name}}</option>
								    @endforeach
								</select>
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Target Credits</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="credits" value="{{ old('credits') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection