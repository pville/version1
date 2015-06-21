@extends('app')
@section('title')
    Dashboard - Pleasantville.co
@endsection
@section('content')
    <section id="listofgroup">
        <div class="container">

            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="boxradwrap extra">
                        <div class="orgProfile">
                            <div class="orgProfileImg"><img src="{{ asset('images/orgthumb.jpg') }}" alt="" /></div>
                            <a class="addPhotobtn" >Add Photo</a>

                            <h2>{{$user->first_name}} {{$user->last_name}}</h2>

                            @if($user->IsMember())
                                <p>Member of {{$user->group->name}}</p>
                            @endif
                            <ul class="uniList">
                                <li><img src="{{ asset('images/org_location_icon.jpg') }}" alt="" />{{ $user->group->address }} , {{ $user->group->city }} , {{$user->group->state}}</li>
                                <li><img src="{{ asset('images/univer_phone_icon.jpg') }}" alt="" />{{ $user->group->phone }}</li>
                                <li><img src="{{ asset('images/univer_chart_icon.jpg') }}" alt="" />{{ $user->group->email }}</li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="boxradwrap">
                        <div class="orgProcess">
                            <h2><img src="{{ asset('images/org_process_icon.jpg') }} " alt="" /> My Progress</h2>
                            <ul>
                                <li><img src="{{ asset('images/big_process_icon.jpg') }} " alt="" />
                                    <div>
                                        Total Completed <span>{{ $user->TotalCompleted() }}%</span>
                                    </div>
                                </li>
                                <li><img src="{{ asset('images/target_icon.jpg') }} " alt="" />
                                    <div>
                                        Target Credits <span>{{ $user->Credits() }}</span>
                                    </div>
                                </li>
                                <li><img src="{{ asset('images/event_calc_icon.jpg') }} " alt="" />
                                    <div>
                                        Event Completed<span>{{ $user->TotalEvents() }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="boxradwrap">
                        <div class="orgProcess Notifi">
                            <h2><img src="{{ asset('images/org_notifaction_icon.jpg') }} " alt="" /> Notification</h2>
                            <ul>
                                @foreach($Notifications as $Notify)
                                    <li>
                                        <p>{{ $Notify->message }}<span>{{ $Notify->created_at->diffForHumans() }}</span></p>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-4">

                    <div class="boxradwrap">
                        <div class="groupsetting">
                            <h2><img src="{{ asset('images/setting_icon.jpg') }} " alt="" /> Settings</h2>
                            <ul>
                                <li><a href="#"><img src="{{ asset('images/key_icon.jpg') }} " alt="" /> Change Password</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-sm-8">
                    <div class="boxradwrap">
                        <div role="tabpanel" id="upcomingEvents">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#upcoming" aria-controls="home" role="tab" data-toggle="tab">Upcoming Events</a></li>
                                <li role="presentation"><a href="#compcoming" aria-controls="profile" role="tab" data-toggle="tab">Completed Events</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="upcomingEvents">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">

                                                <div class="col-md-6 col-sm-6">
                                                    <img src="{{ asset('images/event1.jpg') }} " alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }} " alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }} " /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }} " />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }} " />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <img src="{{ asset('images/event2.jpg') }} " alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }} " alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }} " /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }} " />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }} " />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="item">
                                                <div class="col-md-6 col-sm-6">
                                                    <img src="{{ asset('images/event1.jpg') }} " alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }} " alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }} " /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }} " />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }} " />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <img src="{{ asset('images/event2.jpg') }} " alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }} " alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }} " /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }} " />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }} " />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="compcoming">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">

                                                <div class="col-md-6 col-sm-6">
                                                    <img src="{{ asset('images/event1.jpg') }} " alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }} " alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }} " /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }} " />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }} " />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <img src="{{ asset('images/event2.jpg') }} " alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }} " alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }} " /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }} " />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }} " />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="item">
                                                <div class="col-md-6 col-sm-6">
                                                    <img src="{{ asset('images/event1.jpg') }} " alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }} " alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }} " /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }} " />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }} " />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <img src="{{ asset('images/event2.jpg') }} " alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }} " alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }} " /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }} " />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }} " />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

@section('script')

    <script type="text/javascript">
        jQuery(".Notifi ul").mCustomScrollbar({
            setHeight:340,
            theme:"minimal-dark"
        });
    </script>
@endsection