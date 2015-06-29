@extends('app')
@section('title')
    Dashboard - Pleasantville.co
@endsection
@section('content')
    <section id="listofgroup">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 pull-right">
                    <div class="boxradwrap">
                        <div class="orghead">
                            <img src="{{ asset('images/bag_icon.png') }}" alt="" /> List of Volunteer in the Group
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="groupsearch">
                                    <input type="text"><input type="submit" value="Filter" />
                                    <a class="uniEdit" href="{{ url('/dashboard/filter') }}">Blacklist</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Age/Grade</th>
                                        <th>Hours Earned</th>
                                        <th>Target</th>
                                        <th>Completion %</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Members as $member)

                                        <tr>
                                            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                            <td>{{ $member->volunteer->getAge() }}</td>
                                            <td>{{ $member->volunteer->current_credits }}</td>
                                            <td>{{ $member->Credits()  }}</td>
                                            <td>{{ $member->TotalCompleted()  }}%</td>
                                        </tr>
                                    @endforeach


                                    </tbody>

                                </table>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="pagination">
                                    {!! $Members->render() !!}
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <ul class="pagenationList">
                                    <li> View <select><option>09</option></select></li>
                                    <li>FOUND TOTAL 20 RECORDS</li>
                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="boxradwrap">
                        <div class="univerBox">
                            <h2>{{ $user->group->name  }}</h2>
                            <ul class="uniList">
                                <li><img src="images/univer_bag_icon.jpg" alt="" />{{ $user->group->address }} , {{ $user->group->city }} , {{$user->group->state}}</li>
                                <li><img src="images/univer_phone_icon.jpg" alt="" />{{ $user->group->phone }}</li>
                                <li><img src="images/univer_chart_icon.jpg" alt="" />{{ $user->group->email }}</li>
                                <li><img src="images/univer_lock_icon.jpg" alt="" />U.S Permitted University</li>
                            </ul>
                           <a class="uniEdit" href="{{ url("/dashboard/edit") }}">EDIT</a>
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


                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade listingpopup" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><img alt="" src="{{ asset('images/org_notifaction_icon.jpg') }} ">Notification</h4>
                                </div>
                                <div class="modal-body">
                                    <div role="tabpanel" id="poptabs">

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#upcoming" aria-controls="home" role="tab" data-toggle="tab">Organization types</a></li>
                                            <li role="presentation"><a href="#compcoming" aria-controls="profile" role="tab" data-toggle="tab">Event types</a></li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="upcomingEvents">
                                                <ul class="chkboxlist">
                                                    <li><img src="{{ asset('images/animal01.jpg') }} " alt="" /><span>Animals</span><div class="chq-box"><input id="Option1" type="checkbox"><label class="checkbox" for="Option1">&nbsp;</label></div></li>
                                                    <li><img src="{{ asset('images/heat02.jpg') }} " alt="" /><span>Arts,Culture,Humanities</span><div class="chq-box"><input id="option2" type="checkbox" ><label class="checkbox" for="option2">&nbsp;</label></div></li>
                                                    <li><img src="{{ asset('images/heat03.jpg') }} " alt="" /><span>Community Development</span><div class="chq-box"><input id="option3" type="checkbox" ><label class="checkbox" for="option3">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat04.jpg') }} " alt="" /><span>Education</span><div class="chq-box"><input id="option4" type="checkbox" ><label class="checkbox" for="option4">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat05.jpg') }} " alt="" /><span>Environment</span><div class="chq-box"><input id="option5" type="checkbox" ><label class="checkbox" for="option5">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat06.jpg') }} " alt="" /><span>Health</span><div class="chq-box"><input id="option6" type="checkbox" ><label class="checkbox" for="option6">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat07.jpg') }} " alt="" /><span>Human+Civil Rights</span><div class="chq-box"><input id="option7" type="checkbox" ><label class="checkbox" for="option7">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat08.jpg') }} " alt="" /><span>Humans Services</span><div class="chq-box"><input id="option8" type="checkbox" ><label class="checkbox" for="option8">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/animal01.jpg') }} " alt="" /><span>Animals</span><div class="chq-box"><input id="option9" type="checkbox" ><label class="checkbox" for="option9">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat02.jpg') }} " alt="" /><span>Arts,Culture,Humanities</span><div class="chq-box"><input id="option10" type="checkbox" ><label class="checkbox" for="option10">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat03.jpg') }} " alt="" /><span>Community Development</span><div class="chq-box"><input id="option11" type="checkbox" ><label class="checkbox" for="option11">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat04.jpg') }} " alt="" /><span>Education</span><div class="chq-box"><input id="option12" type="checkbox" ><label class="checkbox" for="option12">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat05.jpg') }} " alt="" /><span>Environment</span><div class="chq-box"><input id="option13" type="checkbox" ><label class="checkbox" for="option13">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat06.jpg') }} " alt="" /><span>Health</span><div class="chq-box"><input id="option14" type="checkbox" ><label class="checkbox" for="option14">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat07.jpg') }} " alt="" /><span>Human+Civil Rights</span><div class="chq-box"><input id="option15" type="checkbox" ><label class="checkbox" for="option15">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat08.jpg') }} " alt="" /><span>Humans Services</span><div class="chq-box"><input id="option16" type="checkbox" ><label class="checkbox" for="option16">&nbsp;</label></li>

                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="compcoming">
                                                <ul class="chkboxlist">
                                                    <li><img src="{{ asset('images/icon09.jpg') }} " alt="" /><span>Food drive</span><input id="option17" type="checkbox" ><label class="checkbox" for="option17">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon10.jpg') }} " alt="" /><span>Clothing</span><input id="option18" type="checkbox" ><label class="checkbox" for="option18">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon11.jpg') }} " alt="" /><span>walk/run</span><input id="option19" type="checkbox" ><label class="checkbox" for="option19">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon12.jpg') }} " alt="" /><span>Set up for an event</span><input id="option20" type="checkbox" ><label class="checkbox" for="option20">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon13.jpg') }} " alt="" /><span>Supply drive</span><input id="option21" type="checkbox" ><label class="checkbox" for="option21">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon14.jpg') }} " alt="" /><span>Blood drive</span><input id="option22" type="checkbox" ><label class="checkbox" for="option22">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon15.jpg') }} " alt="" /><span>Hospital</span><input id="option23" type="checkbox" ><label class="checkbox" for="option23">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon16.jpg') }} " alt="" /><span>Soup Kitcken</span><input id="option24" type="checkbox" ><label class="checkbox" for="option24">&nbsp;</label></li>

                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection