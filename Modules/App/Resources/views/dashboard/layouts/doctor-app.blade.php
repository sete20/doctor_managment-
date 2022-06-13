<!DOCTYPE html>
<html lang="{{ locale() }}" dir="{{ is_rtl() }}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.7.0/switchery.min.css" rel="stylesheet"/>
@if (is_rtl() == 'rtl')
    @include('app::dashboard.layouts._head_rtl')
@else
    @include('app::dashboard.layouts._head_ltr')
@endif

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
<div class="page-wrapper">

    @include('app::dashboard.layouts._doctor_header')

    <div class="clearfix"></div>

    <div class="page-container">
        @include('app::dashboard.layouts._doctor_aside')

        @yield('content')
    </div>

    @include('app::dashboard.layouts._footer')
</div>

@include('app::dashboard.layouts._jquery')
@include('app::dashboard.layouts._js')
</body>
</html>
