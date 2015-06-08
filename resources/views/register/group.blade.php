@extends('app')



@section('content')
    <section class="bannertxt" id="GroupAcc">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">

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

                    <h1>Volunteer & Serve Your Community.</h1>
                    <h3>Create Your Account</h3>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div id="formwrap">
                        <form data-toggle="validator" role="form" method="POST" action="{{ url('/register/group') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h2>Account</h2>
                            <div class="row">
                                <div class="col-md-6 col-sm-6"><input class="mb15" type="text" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required/> </div>
                                <div class="col-md-6 col-sm-6"><input type="text" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="text" placeholder="Email Address" name="email" value="{{ old('email') }}" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="text" placeholder="Phone" name="phone_number" value="{{ old('phone_number') }}" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="password" placeholder="Password" name="password" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="password" placeholder="Confirm Password" name="password_confirmation" required/> </div>
                            </div>

                    <h2>Group</h2>

                    <div class="row">
                        <div class="mb15 col-md-6 col-sm-6"><input type="text" placeholder="Name / Title"  name="group_name" value="{{ old('group_name') }}" required/> </div>
                        <div class="col-md-6 col-sm-6">
                            <select class="form-control" name="group_type" required>
                                @foreach($group_types as $group)
                                    <option value="{{$group->id}}">{{$group->type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb15 col-md-6 col-sm-6"><input type="text" placeholder="Email" name="group_email" value="{{ old('group_email') }}" required/> </div>
                        <div class="col-md-6 col-sm-6"><input type="text" placeholder="Phone" required /> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><input type="text" placeholder="Target Credits" name="group_credits" value="{{ old('group_credits') }}" required/> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><input type="submit" value="Create Account" /></div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection