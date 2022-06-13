@extends('app::dashboard.layouts.doctor-app')
@section('title', __('app::dashboard.index.title'))
@section('content')

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('doctor.home')) }}">
                        {{ __('app::dashboard.index.title') }}
                    </a>
                </li>
            </ul>
        </div>
        <h1 class="page-title"> {{ __('app::dashboard.index.welcome') }} ,
            <small><b style="color:red">{{auth('doctor')->user()->name}} </b></small>
        </h1>

    </div>
</div>

@stop
