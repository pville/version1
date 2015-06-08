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

                        @foreach($screening as $screen)
                            <a href="{{url('/screening/' . $screen->id )}}"> {{ $screen->user->first_name }} {{ $screen->user->last_name }} </a>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection