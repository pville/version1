@extends('app')
@section('title')
    Dashboard - Pleasantville.co
@endsection
@section('content')
    <section id="listofgroup">
        <div class="container">

            <div class="row">
                <div class="col-md-4 col-sm-4">
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
                    <div class="boxradwrap">
                        <div class="orgProfile">
                            <div class="orgProfileImg"><img src="{{ asset('images/organization/' . $user->organization->id . '.jpg') }}" alt="" /></div>
                            <a href="{{ url('/dashboard/screening') }}" class="addPhotobtn">Volunteer Screening</a>

                            <h2>{{ $user->organization->name }}</h2>

                            <ul class="uniList">
                                <li><img src="{{ asset('images/org_location_icon.jpg') }}" alt="" />{{ $user->organization->address }} , {{ $user->organization->city }} , {{$user->organization->state}}</li>
                                <li><img src="{{ asset('images/univer_phone_icon.jpg') }}" alt="" />{{ $user->organization->phone }}</li>
                                <li><img src="{{ asset('images/univer_chart_icon.jpg') }}" alt="" />{{ $user->organization->email }}</li>
                            </ul>
                            <a class="uniEdit" href="{{ url('/dashboard/edit') }}" >Edit</a>
                        </div>

                    </div>

                    <div class="boxradwrap">
                        <div class="createSubuser">
                            <h2>Create Sub Users</h2>
                            <ul>
                                <form id="adduser" data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/dashboard/adduser') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <li><input type="text" placeholder="First Name" name="first_name"/></li>
                                <li><input type="text" placeholder="Last Name" name="last_name"/></li>
                                <li><input type="text" placeholder="Email Address" name="email"/></li>

                            </ul>
                            <a class="uniEdit" href="javascript:document.forms['adduser'].submit();">Add User</a>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="boxradwrap">
                        <a href="{{ url('/events/create') }}"> <img src="{{ asset('images/create-event.png') }}" alt="create-event"></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="boxradwrap extra2">
                        <div class="orgProcess Notifi">
                            <h2><img src="{{ asset('images/org_notifaction_icon.jpg') }}" alt="" /> Notification</h2>
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
                <div class="col-md-12 col-sm-12">
                    <div class="boxradwrap extra">
                        <div role="tabpanel" id="upcomingEvents">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs extra" role="tablist">
                                <li role="presentation" class="active"><a href="#upcoming" aria-controls="upcoming" role="tab" data-toggle="tab">Upcoming Events</a></li>
                                <li role="presentation"><a href="#completed" aria-controls="completed" role="tab" data-toggle="tab">Completed Events</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="upcoming">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            @if($UpcomingEvents)
                                                @foreach($UpcomingEvents as $NextEvent)

                                                    <div class="item active">
                                                        <div class="col-md-6 col-sm-6">
                                                            <img src="{{ asset('images/events/' . $NextEvent->id. '.jpg') }}" alt="" />
                                                            <div class="portfoliotxt">
                                                                <h3>{{ $NextEvent->name }}</h3>
                                                                <p>{{ $NextEvent->description }} </p>
                                                                <ul>
                                                                    <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />{{ $NextEvent->getEventType() }}</li>
                                                                    <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> {{ $NextEvent->getAttending() }} persons going</li>
                                                                    <li><img src="{{ asset('images/location_icon.jpg') }}" />{{ $NextEvent->address  }}, {{ $NextEvent->city }}, {{ $NextEvent->state }}</li>
                                                                    <li><img src="{{ asset('images/calc_cion.jpg') }}" />{{ $NextEvent->FriendlyDate($NextEvent->start_time) }}</li>
                                                                    <li><a href="{{ url( $NextEvent->organization->slug . '/events/' . $NextEvent->slug) }}">Read More</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

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
                                <div role="tabpanel" class="tab-pane" id="completed">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            @if( $CompletedEvents )
                                                @foreach($CompletedEvents as $CNextEvent)

                                                    <div class="item active">
                                                        <div class="col-md-6 col-sm-6">
                                                            <img src="{{ asset('images/events/' . $CNextEvent->id. '.jpg') }}" alt="" />
                                                            <div class="portfoliotxt">
                                                                <h3>{{ $CNextEvent->name }}</h3>
                                                                <p>{{ $CNextEvent->description }} </p>
                                                                <ul>
                                                                    <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />{{ $CNextEvent->getEventType() }}</li>
                                                                    <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> {{ $CNextEvent->getAttending() }} persons going</li>
                                                                    <li><img src="{{ asset('images/location_icon.jpg') }}" />{{ $CNextEvent->address  }}, {{ $CNextEvent->city }}, {{ $CNextEvent->state }}</li>
                                                                    <li><img src="{{ asset('images/calc_cion.jpg') }}" />{{ $CNextEvent->FriendlyDate($CNextEvent->start_time) }}</li>
                                                                    <li><a href="{{ url( $CNextEvent->organization->slug . '/events/' . $CNextEvent->slug) }}">Read More</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
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
