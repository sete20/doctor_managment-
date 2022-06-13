@extends('app::dashboard.layouts.app')
@section('title', __('catalog::dashboard.nationalities.routes.update'))
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
                    <a href="{{ url(route('dashboard.nationalities.index')) }}">
                        {{__('catalog::dashboard.nationalities.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('catalog::dashboard.nationalities.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            {!! Form::model($model,[
                           'url'=> route('dashboard.nationalities.update',$model->id),
                           'id'=>'updateForm',
                           'role'=>'form',
                           'page'=>'form',
                           'class'=>'form-horizontal form-row-seperated',
                           'method'=>'PUT',
                           'files' => true
                           ])!!}
                <div class="col-md-12">

                    {{-- RIGHT SIDE --}}
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
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('catalog::dashboard.nationalities.form.tabs.general') }}
                                                </a>
                                            </li>
                                            {{-- <li>
                                                <a href="#seo" data-toggle="tab">
                                                    {{ __('catalog::dashboard.nationalities.form.tabs.seo') }}
                                            </a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PAGE CONTENT --}}
                    <div class="col-md-9">
                        <div class="tab-content">

                            {{-- UPDATE FORM --}}
                            <div class="tab-pane active fade in" id="global_setting">
                                <h3 class="page-title">{{__('catalog::dashboard.nationalities.form.tabs.general')}}</h3>
                                <div class="col-md-10">

                                    @include('catalog::dashboard.nationalities.form')

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
                                        <a href="{{url(route('dashboard.nationalities.index')) }}" class="btn btn-lg red">
                                            {{__('app::dashboard.buttons.back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>
@stop
