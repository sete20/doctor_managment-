<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed"
            data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>

            <li class="nav-item {{ active_menu('home') }}">
                <a href="{{ url(route('doctor.home')) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ __('app::dashboard.index.title') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item {{ active_menu('clients') }}">
                <a href="{{ url(route('doctor.clients.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.users') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item  {{ active_menu('doctor.courses.index') . active_menu('doctor.courses.edit') }}">
                <a href="{{ url(route('doctor.courses.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.courses') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item  {{ active_menu('chapters') }}">
                <a href="{{ url(route('doctor.chapters.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.chapters') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item  {{ active_menu('contents') }}">
                <a href="{{ url(route('doctor.contents.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.lessons') }}</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </div>

</div>
