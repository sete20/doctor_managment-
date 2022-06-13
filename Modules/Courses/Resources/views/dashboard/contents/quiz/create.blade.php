@extends('app::dashboard.layouts.app')
@section('title', __('courses::dashboard.contents.quiz.routes.create'))
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
                        <a href="{{ url(route('dashboard.contents.index')) }}">
                            {{__('courses::dashboard.contents.quiz.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('courses::dashboard.contents.quiz.routes.create')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                {!! Form::model($model,[
                                'url'=> route('dashboard.quiz.store'),
                                'id'=>'form',
                                'role'=>'form',
                                'method'=>'POST',
                                'class'=>'form-horizontal form-row-seperated',
                                'files' => true
                                ])!!}

                <div class="col-md-12">

                    {{-- RIGHT SIDE --}}
                    @include('courses::dashboard.contents.quiz.form.form-panel-body')

                    {{-- PAGE CONTENT --}}
                    <div class="col-md-9">
                        <div class="tab-content">

                            {{-- CREATE FORM --}}
                            @include('courses::dashboard.contents.quiz.form.index')
                            {{-- END CREATE FORM --}}

                        </div>
                    </div>

                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('app::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('app::dashboard.buttons.add')}}
                                </button>
                                <a href="{{url(route('dashboard.contents.index')) }}" class="btn btn-lg red">
                                    {{__('app::dashboard.buttons.back')}}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
@stop
