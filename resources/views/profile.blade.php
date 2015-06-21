@extends('app')

@section('content')
    <section id="listofgroup">
        <div class="container">

            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="boxradwrap bg-none">
                        <div class="orgProfile arts">
                            <div class="orgProfileImg"><img src="{{ asset('images/organization/' . $org->id . '.jpg') }}" alt="" /></div>
                            <a href="#" class="addPhotobtn"  data-toggle="modal" data-target="#myModal">Add Photo</a>

                            <!-- Modal -->
                            <div class="modal fade imgupload" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm extra">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Upload Picture</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Drag a picture here</p>
                                            <p><img src="{{ asset('images/dragdrop.jpg') }}" alt="" /></p>
                                            <p class="options">or</p>
                                            <button>Upload picture from your computer</button>
                                            <button class="greenbtn">Upload picture from your dropbox</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <h2>{{ $org->name }}</h2>
                        </div>
                        <div class="boxradwrap orgProfile  extra-box">
                            <ul class="uniList">
                                <li><img src="{{ asset('images/org_location_icon.jpg') }}" alt="" />{{ $org->address }} , {{ $org->city }} , {{ $org->address }}</li>
                                <li><img src="{{ asset('images/univer_phone_icon.jpg') }}" alt="" />{{ $org->phone }}</li>
                                <li><img src="{{ asset('images/univer_chart_icon.jpg') }}" alt="" />{{ $org->email  }}</li>
                            </ul>
                            <ul class="uniSmedia">
                                <li><a href="#"><img src="{{ asset('images/gplus_icon.jpg') }}" alt="" /></a></li>
                                <li><a href="#"><img src="{{ asset('images/uni_facebook_icon.jpg') }}" alt="" /></a></li>
                                <li><a href="#"><img src="{{ asset('images/uni_twitter_icon.jpg') }}" alt="" /></a></li>
                                <li><a href="#"><img src="{{ asset('images/uni_instragrame_icon.jpg') }}" alt="" /></a></li>
                                <li><a href="#"><img src="{{ asset('images/uni_blog_icon.jpg') }}" alt="" /></a></li>
                            </ul>
                        </div>
                        <span class="edit">Donate</span>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8">
                    <div class="boxradwrap mission-box">
                        <h1>Our Mission</h1>
                        <p> {{ $org->description }}</p>
                     </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="boxradwrap extra">
                        <div role="tabpanel" id="upcomingEvents">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs extra" role="tablist">
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

                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event1.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event2.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event2.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>




                                            </div>

                                            <div class="item">
                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event1.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event2.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event2.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
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
                                    <div id="carousel-example-genericc" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">

                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event1.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event2.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event2.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="item">
                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event1.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event2.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
                                                            <li><a href="#">Read More</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mb15 col-md-4 col-sm-4">
                                                    <img src="{{ asset('images/event2.jpg') }}" alt="" />
                                                    <div class="portfoliotxt">
                                                        <h3>Lorem ipsum dolor sit amet</h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            Morbi orci mauris, volutpat porttitor. </p>
                                                        <ul>
                                                            <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                                            <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                                            <li><img src="{{ asset('images/location_icon.jpg') }}" />100 Medical Center Way, San Francisco, CA</li>
                                                            <li><img src="{{ asset('images/calc_cion.jpg') }}" />Apr 5, 2015  9:30PM</li>
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
