@extends('app')

@section('content')
    <div id="slider_container">

        <!-- REVOLUTION SLIDER 3.0.2 fullwidth mode -->
        <div id="rev_slider_2_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" style="margin:0px auto;background-color:#f2f2f2;padding:0px;margin-top:0px;margin-bottom:0px;max-height:550px;">
            <div id="rev_slider_2_1" class="rev_slider fullwidthabanner" style="display:none;max-height:550px;height:450;">
                <ul>


                    <!-- BEGIN: SLIDE #02 -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="300" >

                        <!-- BACKGROUND IMAGE -->
                        <img src="{{ asset('images/slider/cloud.png') }}"  alt=""  data-fullwidthcentering="on">

                        <!-- CAPTION #01 -->
                        <div id="myCarousel" class="tp-caption sfb"
                             data-x="center" data-hoffset="0"
                             data-y="190"
                             data-speed="1800"
                             data-start="500"
                             data-easing="easeOutExpo"> <h1><span>Volunteer.</span> Serve Your Community.</h1>
                        </div>

                        <!-- CAPTION #02 -->
                        <div id="myCarousel" class="tp-caption lfb"
                             data-x="center" data-hoffset="2"
                             data-y="260" data-voffset="12"
                             data-speed="1400"
                             data-start="1200"
                             data-easing="easeOutExpo">
                            <p>Join Today And Earn Your Community Service Hours.</p>
                        </div>

                        <!-- CAPTION #03 -->
                        <div class="tp-caption sft"
                             data-x="500"
                             data-y="300"
                             data-speed="1300"
                             data-start="2000"
                             data-easing="easeInOutBack">
                            <button class="btn01">SIGN UP NOW</button>			 								</div>

                        <!-- CAPTION #04 -->
                        <div class="tp-caption sfb"
                             data-x="300"
                             data-y="300"
                             data-speed="1300"
                             data-start="2000"
                             data-easing="easeInOutBack">
                            <button class="btn02">Browse Events</button>			 					 			</div>


                    </li>


                    <li data-transition="fade" data-slotamount="7" data-masterspeed="300" >

                        <!-- BACKGROUND IMAGE -->
                        <img src="{{ asset('images/slider/cloud.png') }}"  alt=""  data-fullwidthcentering="on">

                        <!-- CAPTION #01 -->
                        <div id="myCarousel" class="tp-caption sfb"
                             data-x="center" data-hoffset="0"
                             data-y="190"
                             data-speed="1800"
                             data-start="500"
                             data-easing="easeOutExpo"> <h1><span>Volunteer.</span> Serve Your Community.</h1>
                        </div>

                        <!-- CAPTION #02 -->
                        <div id="myCarousel" class="tp-caption lfb"
                             data-x="center" data-hoffset="2"
                             data-y="260" data-voffset="12"
                             data-speed="1400"
                             data-start="1200"
                             data-easing="easeOutExpo">
                            <p>Join Today And Earn Your Community Service Hours.</p>
                        </div>

                        <!-- CAPTION #03 -->
                        <div class="tp-caption sft"
                             data-x="500"
                             data-y="300"
                             data-speed="1300"
                             data-start="2000"
                             data-easing="easeInOutBack">
                            <button class="btn01">SIGN UP NOW</button>			 								</div>

                        <!-- CAPTION #04 -->
                        <div class="tp-caption sfb"
                             data-x="300"
                             data-y="300"
                             data-speed="1300"
                             data-start="2000"
                             data-easing="easeInOutBack">
                            <button class="btn02">Browse Events</button>			 					 			</div>


                    </li>


                    <li data-transition="fade" data-slotamount="7" data-masterspeed="300" >

                        <!-- BACKGROUND IMAGE -->
                        <img src="{{ asset('images/slider/cloud.png') }}"  alt=""  data-fullwidthcentering="on">

                        <!-- CAPTION #01 -->
                        <div id="myCarousel" class="tp-caption sfb"
                             data-x="center" data-hoffset="0"
                             data-y="190"
                             data-speed="1800"
                             data-start="500"
                             data-easing="easeOutExpo"> <h1><span>Volunteer.</span> Serve Your Community.</h1>
                        </div>

                        <!-- CAPTION #02 -->
                        <div id="myCarousel" class="tp-caption lfb"
                             data-x="center" data-hoffset="2"
                             data-y="260" data-voffset="12"
                             data-speed="1400"
                             data-start="1200"
                             data-easing="easeOutExpo">
                            <p>Join Today And Earn Your Community Service Hours.</p>
                        </div>

                        <!-- CAPTION #03 -->
                        <div class="tp-caption sft"
                             data-x="500"
                             data-y="300"
                             data-speed="1300"
                             data-start="2000"
                             data-easing="easeInOutBack">
                            <button class="btn01">SIGN UP NOW</button>			 								</div>

                        <!-- CAPTION #04 -->
                        <div class="tp-caption sfb"
                             data-x="300"
                             data-y="300"
                             data-speed="1300"
                             data-start="2000"
                             data-easing="easeInOutBack">
                            <button class="btn02">Browse Events</button>			 					 			</div>


                    </li>


                </ul>
                <!-- END: SLIDE #04 -->
                <div class="tp-bannertimer tp-bottom"></div>
            </div>
        </div>




    </div>

    <section id="aboutus">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1>What We Do?</h1>
                    <p>Welcome to the worlds first community service platform. Here at PleasantVille we have made creating and finding community service events as easy as possible.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4" data-appear-top-offset="-100" data-animated="fadeIn">
                    <img src="{{ asset('images/volunteer.jpg') }}" alt="" />
                    <h2>Volunteer</h2>
                    <p>Search through all of the community service opportunities in area and sign up with the click of a button.</p>
                </div>
                <div class="col-md-4 col-sm-4" data-appear-top-offset="-200" data-animated="fadeIn">
                    <img src="{{ asset('images/event3.jpg') }}" alt="" />
                    <h2>Care</h2>
                    <p>Grow your volunteer base by creating and promoting community service events.</p>
                </div>
                <div class="col-md-4 col-sm-4" data-appear-top-offset="-300" data-animated="fadeIn">
                    <img src="{{ asset('images/earn.jpg') }}" alt="" />
                    <h2>Earn</h2>
                    <p>Track the progress and completion of community service hours.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="clbox">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2>If everyone demanded peace instead of another<br>
                        television set, then there’d be peace.</h2>
                    <p><span><img src="{{ asset('images/quotes.png') }}"></span>JOHN LENNON</p>
                    <ul>
                        <li><img src="{{ asset('images/half_s_icon.png') }}" alt="" /></li>
                        <li><img src="{{ asset('images/jupiter_icon.png') }}" alt="" /></li>
                        <li><img src="{{ asset('images/rocket_cion.png') }}" alt="" /></li>
                        <li><img src="{{ asset('images/moonpic_icon.png') }}" alt="" /></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="events">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12" data-appear-top-offset="-100" data-animated="fadeInUp">
                    <h1>Upcoming Events</h1>
                    <h2 class="portfolio-heading2"><span class="left_contr">Events Nearby You</span><span class="right_contr">
<img align="left" alt="arrow" src="{{ asset('images/arrow.jpg') }}">{{ $location["city"] }}</span></h2>
                </div>
            </div>
            <div class="row first">

                @foreach($Events as $event)
                    <div class="mask-area col-md-4 col-sm-4" data-appear-top-offset="-100" data-animated="fadeInLeft">
                        <a href=""><div class="mask"></div></a>
                        <img src="{{ asset('images/events/' . $event->id. '.jpg') }}" height="147" width="220" alt="" />
                        <div class="portfoliotxt">
                            <h3>{{ $event->name }}</h3>
                            <p>{{ $event->description }} </p>
                            <ul>
                                <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />Playing children</li>
                                <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> 126 persons going</li>
                                <li><img src="{{ asset('images/location_icon.jpg') }}" />{{ $event->address  }}, {{ $event->city }}, {{ $event->state }}</li>
                                <li><img src="{{ asset('images/calc_cion.jpg') }}" />{{ $event->FriendlyDate($event->start_time) }}</li>
                                <li><a href="{{ url( $event->organization->slug . '/events/' . $event->slug) }}">Read More</a></li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </section>
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1>Find Ways to Help Your Community</h1>
                    <p>Here are a few categories to choose from</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="serv_links">
                        <a class="serv rokl" href="#"><div><img src="{{ asset('images/rot1.png') }}"><br><span>Animals</span></div></a>
                        <a class="serv rokl" href="#"><div><img src="{{ asset('images/rot2.png') }}"><br><span>Soup Kitchen</span></div></a>
                        <a class="serv rokl" href="#"><div><img src="{{ asset('images/rot7.png') }}"><br><span>Enviroment</span></div></a>
                        <a class="serv rokl" href="#"><div><img src="{{ asset('images/rot4.png') }}"><br><span>Event Setup</span></div></a>
                        <a class="serv rokl" href="#"><div><img src="{{ asset('images/rot1.png') }}"><br><span>Animals</span></div></a>
                        <a class="serv rmn rokl" href="#"><div><img src="{{ asset('images/rot6.png') }}"><br><span>Outreach</span></div></a>
                        <a class="serv rmn rokl" href="#"><div><img src="{{ asset('images/rot7.png') }}"><br><span>Parks & Rec</span></div></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contactus">
        <div class="container"  data-appear-top-offset="-100" data-animated="fadeInUp">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1>JOIN US TODAY !</h1>
                    <p>We see your time as the most precious commodity. Whether you are working at a local soup kitchen or cleaning up a public park, the time that you take out of your life to improve the world around you is truly a wonderful gift. <br />
                        We’re excited to have you join us. Our goal is to make giving back to your community as easy as possible; exactly how it should be.</p>
                    <p>Thank you for your time,<br />
                        The PleasantVille Team</p>
                </div>
            </div>
            <div class="row">
                <div class="w-form w-col col-md-6 col-sm-6">
                    <form action="contact.php" method="post">
                        <input class="w-input" type="text" placeholder="Enter your name" name="cf_name">
                        <input class="w-input" placeholder="Enter your email address" type="text" name="cf_email" required>
                        <input class="w-input" placeholder="Your number" type="text" name="cf_email" required>
                    </form>
                </div>
                <div class="w-form w-col col-md-6 col-sm-6">
                    <textarea class="w-input message" placeholder="Enter your Message Here" name="cf_message"></textarea></div>
                <div class="w-form tl_cen"> <input class="w-button" type="submit" value="SEND MESSAGE"></div>
            </div>
        </div>
        </div>
    </section>
@endsection