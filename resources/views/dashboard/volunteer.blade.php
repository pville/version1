@extends('app')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>
@endsection
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
                            <!--<div class="orgProfileImg"><img src="{{ asset('images/orgthumb.jpg') }}" alt="" /></div>
                            <a class="addPhotobtn" >Add Photo</a>-->

                            <h2>{{$user->first_name}} {{$user->last_name}}</h2>

                            @if($user->IsMember())
                                <p>Member of {{$user->group->name}}</p>
                                <ul class="uniList">
                                    <li><img src="{{ asset('images/org_location_icon.jpg') }}" alt="" />{{ $user->group->address }} , {{ $user->group->city }} , {{$user->group->state}}</li>
                                    <li><img src="{{ asset('images/univer_phone_icon.jpg') }}" alt="" />{{ $user->group->phone }}</li>
                                    <li><img src="{{ asset('images/univer_chart_icon.jpg') }}" alt="" />{{ $user->group->email }}</li>
                                </ul>
                            @else
                                <ul class="uniList">
                                    <li><img src="{{ asset('images/univer_chart_icon.jpg') }}" alt="" />{{ $user->email }}</li>
                                    <li><img src="{{ asset('images/univer_phone_icon.jpg') }}" alt="" />{{ $user->volunteer->phone }}</li>

                                </ul>
                            @endif


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
                                                            <img src="{{ asset('images/events/' . $NextEvent->event_id. '.jpg') }}" alt="" />
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
                                    <div data-slick='{"arrows": true, "infinite": ture, "slidesToShow": 3, "slidesToScroll": 3, "rows": 1}'>
                                        @if( $CompletedEvents )
                                            @foreach($CompletedEvents as $CNextEvent)


                                                    <div class="col-md-6 col-sm-6">
                                                        <img src="{{ asset('images/events/' . $CNextEvent->event_id. '.jpg') }}" alt="" />
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

                                            @endforeach
                                        @endif
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
    <script src="{{ asset('slick/slick.min.js') }}"></script>

    <script type="text/javascript">

        $('.multiple-items').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });


        jQuery(".Notifi ul").mCustomScrollbar({
            setHeight:340,
            theme:"minimal-dark"
        });
    </script>
@endsection
