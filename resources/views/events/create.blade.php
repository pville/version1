@extends('app')

@section('title')
    Create Event - Pleasantville.co
@endsection

@section('content')
    <section class="bannertxt" id="CreventBanner">
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
                    <h3>Create Your Event!</h3>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div id="formwrap">
                        <form data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/events/create') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h2>Create Event</h2>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <label>Image</label>

                                <input type="file" placeholder="Image" class="file" data-show-upload="false" name="image" id="image" accept="image/*"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12"><input type="text" placeholder="Title" id="title" name="title" required/> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12"><textarea placeholder="Description" id="desc" name="desc" required></textarea> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12"><div class="select-style">
                                <select  data-toggle="select" id="event_type" name="event_type" required>
                                    <option value="">Select Event Type</option>
                                    @foreach($EventTypes as $event_type)
                                        <option value="{{$event_type->id}}">{{$event_type->type}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6"><input type="text" placeholder="Email" class="mb15" id="email" name="email" required/> </div>

                            <div class="col-md-6 col-sm-6"><input type="text" placeholder="Phone" id="phone" name="phone" required/> </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="select-style">
                                    <select data-toggle="select" name="state" id="state" value="{{ old('state') }}">
                                        <option value="Select State">Select State</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DC">District of Columbia</option>
                                        <option value="DE">Delaware</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="IA">Iowa</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MD">Maryland</option>
                                        <option value="ME">Maine</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MT">Montana</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NY">New York</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VA">Virginia</option>
                                        <option value="VT">Vermont</option>
                                        <option value="WA">Washington</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="mb15 col-md-6 col-sm-6"><input type="text" placeholder="City" name="city" id="city" value="{{ old('city') }}" required /> </div>

                            <div class="col-md-6 col-sm-6"><input type="text" placeholder="Zipcode" name="zipcode" id="zipcode" value="{{ old('zipcode') }}" required/> </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12"><input type="text" placeholder="Address" name="address" id="address" value="{{ old('address') }}" required/> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <div class='input-group date' id='startdate'>
                                            <input type='text' placeholder="Start Date" class="mb15 form-control" name="start" id="start" value="{{ old('start') }}" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        </div>
                                    </div>

                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class='input-group date' id='enddate'>
                                        <input type='text' placeholder="End Date" class="mb15 form-control" name="end" id="end" value="{{ old('end') }}" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div class="row extra-padd">
                            <div class="col-md-4 col-sm-4">
                               <!-- <label for="checkbox2" class="checkbox">
                                    <input type="checkbox" data-toggle="checkbox" id="checkbox2" value="0" checked="checked" class="custom-checkbox">
                                    <span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Recurring </label> -->
                                    </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="select-style">
                                    {!! Form::select('credits', ['Select Hours Amount', 1,2,3,4,5,6,7,8,9,10], ['class' => 'form-control select select-primary']) !!} </div></div>
                                </div>
                        <div class="row">
                            <input id="ageHidden"  type="hidden" value="0" name="age">
                            <input id="screeningHidden"  type="hidden" value="0" name="screening">
                            <div class="col-md-4 col-sm-4"><label for="screening" class="checkbox"><input type="checkbox" data-toggle="checkbox" id="screening" name="screening" value="0" onchange="update_value(this);" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>  Screen </label>		</div>
                            <div class="col-md-4 col-sm-4"><label for="age" class="checkbox"><input type="checkbox" data-toggle="checkbox" id="age" name="age" value="0" class="custom-checkbox" onchange="update_value(this);"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>  Age ( 18+ ) </label>		</div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12"><input type="submit" value="Create Event" /></div>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('script')
    <script type="text/javascript">
        $(function () {
            $('#startdate').datetimepicker();
            $('#enddate').datetimepicker();

            $("#image").fileinput({
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                allowedFileExtensions: ['jpg','png','jpeg']
            });

        });

        function update_value(chk_bx) {
            if (chk_bx.checked) {
                chk_bx.value = "1";
                document.getElementById(chk_bx.name + 'Hidden').disabled = true;
            }
            else {
                chk_bx.value = "0";
                document.getElementById(chk_bx.name + 'Hidden').disabled = false;
            }

        }
    </script>
@endsection