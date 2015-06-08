@extends('app')

@section('content')
    @section('style')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">
    @endsection
<section class="title-bg">
    <div class="container">
        <div class="row">
            <h4>EVENT / SINGLE POST</h4>
            <h1>CARING BETWEEN FAMILIES</h1>

        </div>
    </div>
</section>
<section id="event-page">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9 large-box">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 event-sidebar">
                        <div class="date">
                            <h3>{{ $event->getMonth($event->start_time) }}</h3>
                            <h2>{{ $event->start_time->day }}</h2>
                            <h5>{{ $event->start_time->year }}</h5>
                        </div>
                        <div class="join-event">
                            @if(Auth::check())
                                @if($user->CheckedIn($event->id) == true)
                                    @if($user->role == "volunteer")
                                        @if($event->screening_required == true && $user->IsVerified() == false)

                                            <a href="{{ url('/events/screen/' . $event->organization_id ) }}">Apply</a>
                                        @else
                                            @if($user->volunteer->ageCheck($event->age_requirement) == true)
                                            <form data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/' .$event->organization->slug . '/events/'. $event->slug . '/join') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12"><input type="submit" value="Join Event" /></div>
                                                </div>
                                             </form>

                                            @else
                                                {{ "Age requirement of" }} {{ $event-> age_requirement }}
                                            @endif
                                        @endif
                                    @endif
                                @endif
                             @endif
                        </div>
                        <span class="divder"></span>
                        <div class="clear"></div>
                        <h4>Details</h4>
                        <ul>
                            <li><span>Start</span>{{ $event->FriendlyDate($event->start_time) }}</li>
                            <li><span>End</span>{{$event->FriendlyDate($event->end_time) }}</li>
                            <li><span>Timing</span>{{ $event->start_time->hour }}:{{ $event->start_time->minute }} - {{ $event->end_time->hour }}:{{ $event->end_time->minute }}</li>
                            <li><span>Event Category</span>Family Love</li>
                            <li><span>Event Tags</span>Family</li>
                            <li><span>Website</span><a href="{{ $event->organization->url }}" target="_blank">{{ $event->organization->url }}</a></li>
                        </ul>
                        <a class="edit-event" href="" data-toggle="modal" data-target="#myModal">Edit Event</a>
                        <div class="modal fade listingpopup extra" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('images/event-calander.png') }} " alt="event-calander">Event Roster</h4>

                                    </div>
                                    <p>Name / Age <img src="{{ asset('images/name-arrow.png') }} "> <span class="grade">Grade</span></p>
                                    <div class="modal-body event-area">


                                        <ul>
                                            <li><div class="img-box"><img src="{{ asset('images/user1.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><p>50%</p></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user2.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><p>50%</p></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user3.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><p>50%</p></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user4.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><p>50%</p></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user5.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><p>50%</p></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user1.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><p>50%</p></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user2.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><p>50%</p></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user3.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><p>50%</p></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user4.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><p>50%</p></div></li>



                                        </ul>

                                    </div>
                                    <div class="modal-footer">
                                        <a href="">Save</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <a class="view-roster" href="" data-toggle="modal" data-target="#myModal3">View roster</a>
                        <div class="modal fade listingpopup extra" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('images/event-calander.png') }} " alt="event-calander">Event Roster</h4>

                                    </div>
                                    <p>Name / Age <img src="{{ asset('images/name-arrow.png') }} "></p>
                                    <div class="modal-body event-area">


                                        <ul>
                                            <li><div class="img-box"><img src="{{ asset('images/user1.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><input id="Option1" type="checkbox"><label class="checkbox" for="Option1">&nbsp;</label></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user2.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><input id="option2" type="checkbox" ><label class="checkbox" for="option2">&nbsp;</label></div></li>


                                            <li><div class="img-box"><img src="{{ asset('images/user3.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><input id="option3" type="checkbox" ><label class="checkbox" for="option3">&nbsp;</label></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user4.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><input id="option4" type="checkbox" ><label class="checkbox" for="option4">&nbsp;</label></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user5.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><input id="option5" type="checkbox" ><label class="checkbox" for="option5">&nbsp;</label></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user1.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><input id="option6" type="checkbox" ><label class="checkbox" for="option6">&nbsp;</label></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user2.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><input id="option7" type="checkbox" ><label class="checkbox" for="option7">&nbsp;</label></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user3.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><input id="option8" type="checkbox" ><label class="checkbox" for="option8">&nbsp;</label></div></li>

                                            <li><div class="img-box"><img src="{{ asset('images/user4.png') }} "></div><div class="user-dscp"><p>Sarah Ray</p><span>23 years old</span></div>
                                                <div class="chq-box"><input id="option9" type="checkbox" ><label class="checkbox" for="option9">&nbsp;</label></div></li>



                                        </ul>

                                    </div>
                                    <div class="modal-footer">
                                        <a href="">Save</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <span class="divder"></span>
                        <div class="clear"></div>
                        <h4>View</h4>
                        <span class="map-pin">{{ $event->city }}</span>
                        <span class="medical">{{ $event->address }}, {{$event->state }} {{$event->zipcode }} </span>
                        <span class="gp">+Google Map</span>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6307.674476944136!2d-122.41907853603836!3d37.77041442111432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan+Francisco%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1430304737780" width="300" height="250" frameborder="0" style="border:0"></iframe>
                    </div>
                    <div class="col-xs-12 col-sm-8 family">
                        <img src="{{ asset('images/events/'. $event->id . '.jpg') }}" height="219" width="326" alt="logo">
                        <ul>
                            <li><img src="{{ asset('images/org-1.jpg') }} " alt="orgnaization"></li>
                            <li><img src="{{ asset('images/org-2.jpg') }} " alt="orgnaization"></li>
                            <li><img src="{{ asset('images/org-3.jpg') }} " alt="orgnaization"></li>
                        </ul>
                        <p>{{ $event->description }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 my-profile">
                <div class="profile">
                    <h3> My Profile</h3>
                    <img src="{{ asset('images/man-profile.png') }} " alt="">
                    <p>{{ $event->organization->description }}</p>
                    <a href="{{ url($event->organization->slug) }}">Learn more</a>
                </div>
                <div class="clear"></div>
                <div class="bar-area">
                    <p>Hour Earned / Completion</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="up-events">
                    <h2>Upcoming Events</h2>
                    <div id="carousel-example-generic" class="carousel slide single-slider" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">

                                <ul class="event-list">
                                    <li><span><img src="{{ asset('images/up-events-1.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-2.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-3.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-1.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-2.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    </li>
                                </ul>
                            </div>
                            <div class="item">
                                <ul class="event-list">
                                    <li><span><img src="{{ asset('images/up-events-1.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-2.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-3.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-1.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-2.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    </li>
                                </ul>
                            </div>
                            <div class="item">
                                <ul class="event-list">
                                    <li><span><img src="{{ asset('images/up-events-1.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-2.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-3.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-1.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    <li><span><img src="{{ asset('images/up-events-2.png') }} "></span><p>A New Yorker doesn't necessarily  ...<span>3 minutes ago</span></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

    @section('script')
        <script type="text/javascript">
            jQuery("#myModal .modal-body").mCustomScrollbar({
                setHeight:340,
                theme:"minimal-dark"
            });

            jQuery("#myModal3 .modal-body").mCustomScrollbar({
                setHeight:340,
                theme:"minimal-dark"
            });

            jQuery("#myModal5 .chkboxlist").mCustomScrollbar({
                setHeight:340,
                theme:"minimal-dark"
            });
        </script>
    @endsection
@endsection