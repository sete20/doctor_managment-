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
                <a href="{{ url(route('dashboard.home')) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ __('app::dashboard.index.title') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="heading">
                <h3 class="uppercase">{{ __('app::dashboard._layout.aside._tabs.roles_permissions') }}</h3>
            </li>

            <li class="nav-item {{ active_menu('roles') }}">
                <a href="{{ url(route('dashboard.roles.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.roles') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="heading">
                <h3 class="uppercase">{{ __('app::dashboard._layout.aside._tabs.users') }}</h3>
            </li>

            <li class="nav-item {{ active_menu('admins') }}">
                <a href="{{ url(route('dashboard.admins.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.admins') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item {{ active_menu('clients') }}">
                <a href="{{ url(route('dashboard.clients.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.users') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item {{ active_menu('dashboard.clientcourses.index') }}">
                <a href="{{ url(route('dashboard.clientcourses.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-share"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.clientcourses') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="heading">
                <h3 class="uppercase">{{ __('app::dashboard._layout.aside.store') }}</h3>
            </li>

            <li class="nav-item  {{ active_menu('categories') }}">
                <a href="{{ url(route('dashboard.categories.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.categories') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item  {{ active_menu('doctors') }}">
                <a href="{{ url(route('dashboard.doctors.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.doctors') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item  {{ active_menu('dashboard.courses.index') . active_menu('dashboard.courses.edit') }}">
                <a href="{{ url(route('dashboard.courses.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.courses') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item  {{ active_menu('chapters') }}">
                <a href="{{ url(route('dashboard.chapters.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.chapters') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item  {{ active_menu('contents') }}">
                <a href="{{ url(route('dashboard.contents.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.lessons') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

{{--            <li class="nav-item  {{ active_menu('clients') }}">--}}
{{--                <a href="{{ url('/') }}" class="nav-link nav-toggle">--}}
{{--                    <i class="icon-settings"></i>--}}
{{--                    <span class="title">{{ __('app::dashboard._layout.aside.orders') }}</span>--}}
{{--                    <span class="selected"></span>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="heading">
                <h3 class="uppercase">{{ __('app::dashboard._layout.aside.settings_tab') }}</h3>
            </li>

            <li class="nav-item {{ active_menu('setting') }}">
                <a href="{{ url(route('dashboard.setting.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('app::dashboard._layout.aside.setting') }}</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </div>

</div>
