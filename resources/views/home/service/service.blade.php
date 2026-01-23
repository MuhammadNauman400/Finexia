@extends('home.home_master')
@section('home')
    <div class="breadcrumb-wrapper light-bg">
        <div class="container">

            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">Services</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}" alt="right-arrow">
                                </li>
                                <li aria-current="page">Services</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="my-5">
        @include('home.homelayout.clarifies')
    </div>

    @include('home.homelayout.features')
    @include('home.homelayout.get_all')

    <div class="my-5">
        @include('home.homelayout.answers')
    </div>
    @include('home.homelayout.apps')
@endsection
