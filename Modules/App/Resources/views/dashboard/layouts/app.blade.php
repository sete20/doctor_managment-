<!DOCTYPE html>
<html lang="{{ locale() }}" dir="{{ is_rtl() }}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.7.0/switchery.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@if (is_rtl() == 'rtl')
    @include('app::dashboard.layouts._head_rtl')
@else
    @include('app::dashboard.layouts._head_ltr')
@endif

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
<div class="page-wrapper">

    @include('app::dashboard.layouts._header')

    <div class="clearfix"></div>

    <div class="page-container">
        @include('app::dashboard.layouts._aside')

        @yield('content')
    </div>

    @include('app::dashboard.layouts._footer')
</div>

@include('app::dashboard.layouts._jquery')
@include('app::dashboard.layouts._js')

@stack('scripts')
</body>
</html>
