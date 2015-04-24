@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Organization Register</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/register/organization') }}">
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
							<label class="col-md-4 control-label">Organization Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="org_name" value="{{ old('org_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Organization Email</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="org_email" value="{{ old('org_email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Organization Phone Number</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="org_phone_number" value="{{ old('org_phone_number') }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Organization Address</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="org_address" value="{{ old('org_address') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Organization Description</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="org_desc" value="{{ old('org_desc') }}">
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