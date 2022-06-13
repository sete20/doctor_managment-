@extends('app::dashboard.layouts.app')
@section('title', __('authorization::dashboard.roles.routes.create'))
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">{{ __('app::dashboard.index.title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('dashboard.roles.index')) }}">
                            {{__('authorization::dashboard.roles.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('authorization::dashboard.roles.routes.create')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                <form id="form" role="form" class="form-horizontal form-row-seperated" method="post"
                      enctype="multipart/form-data" action="{{route('dashboard.roles.store')}}">
                    @csrf
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="panel-group accordion scrollable" id="accordion2">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a class="accordion-toggle"></a></h4>
                                    </div>
                                    <div id="collapse_2_1" class="panel-collapse in">
                                        <div class="panel-body">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li class="active">
                                                    <a href="#general" data-toggle="tab">
                                                        {{ __('authorization::dashboard.roles.form.tabs.general') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content">
                                {{-- CREATE FORM --}}
                                <div class="tab-pane active fade in" id="general">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{__('authorization::dashboard.roles.form.name')}}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" name="name" placeholder="add_user"
                                                       class="form-control" data-name="name">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('authorization::dashboard.roles.form.permissions') }}
                                            </label>
                                            <div class="col-md-9">
                                                <div class="mt-checkbox-list">
                                                    <ul>

                                                        @foreach ($permissions->groupBy('category') as $key => $perm)
                                                            <li style="list-style-type:none">
                                                                <label class="mt-checkbox">
                                                                    <input type="checkbox" class="permission-group">
                                                                    <strong>{{$key}}</strong>
                                                                    <span></span>
                                                                </label>
                                                                <ul class="row" style="list-style-type:none">
                                                                    @foreach($perm as $permission)
                                                                        <li style="list-style-type:none">
                                                                            <label class="mt-checkbox col-md-4">
                                                                                <input class="child" type="checkbox"
                                                                                       name="permission[]"
                                                                                       value="{{$permission->id}}">
                                                                                {{ $permission->display_name }}
                                                                                <span></span>
                                                                            </label>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                            <hr>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        @foreach (config('translatable.locales') as $code)
                                            <div class="form-group">
                                                <label class="col-md-2">
                                                    {{__('authorization::dashboard.roles.form.key')}} - {{ $code }}
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" name="display_name[{{$code}}]"
                                                           placeholder="users" class="form-control"
                                                           data-name="display_name.{{$code}}">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- END CREATE FORM --}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-actions">
                                @include('app::dashboard.layouts._ajax-msg')
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-lg blue">
                                        {{__('app::dashboard.buttons.add')}}
                                    </button>
                                    <a href="{{url(route('dashboard.roles.index')) }}" class="btn btn-lg red">
                                        {{__('app::dashboard.buttons.back')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(
            function () {
                $(".permission-group").click(function () {
                    $(this).parents('li').find('.child').prop('checked', this.checked);
                });
            }
        );
    </script>
@stop
