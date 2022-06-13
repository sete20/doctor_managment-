@extends('app::dashboard.layouts.app')
@section('title', __('authorization::dashboard.permissions.routes.update'))
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
                    <a href="{{ url(route('dashboard.permissions.index')) }}">
                        {{__('authorization::dashboard.permissions.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('authorization::dashboard.permissions.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" role="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.permissions.update',$permission->id)}}">
                @csrf
                @method('PUT')
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
                                                    {{ __('authorization::dashboard.permissions.form.tabs.general') }}
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
                            {{-- UPDATE FORM --}}
                            <div class="tab-pane active fade in" id="general">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('authorization::dashboard.permissions.form.name')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" placeholder="add_user" class="form-control" data-name="name" value="{{ $permission->name }}">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('authorization::dashboard.permissions.form.key')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="display_name" placeholder="users" class="form-control" data-name="display_name" value="{{ $permission->display_name }}">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    @foreach (config('translatable.locales') as $code)
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('authorization::dashboard.permissions.form.description')}} - {{ $code }}
                                        </label>
                                        <div class="col-md-9">
                                            <textarea name="description[{{$code}}]" rows="8" cols="80" class="form-control" data-name="description.{{$code}}">{{ $permission->translate($code)? $permission->translate($code)->description : ''}}</textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- END UPDATE FORM --}}
                        </div>
                    </div>

                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('app::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg green">
                                    {{__('app::dashboard.buttons.edit')}}
                                </button>
                                <a href="{{url(route('dashboard.permissions.index')) }}" class="btn btn-lg red">
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
