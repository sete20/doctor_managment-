@extends('app::dashboard.layouts.doctor-app')
@section('title', __('courses::dashboard.contents.quiz.routes.update'))
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('doctor.home')) }}">{{ __('app::dashboard.index.title') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ url(route('doctor.contents.index')) }}">
                        {{__('courses::dashboard.contents.quiz.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('courses::dashboard.contents.quiz.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">

            {!! Form::model($model,[
                            'url'=> route('doctor.quiz.update',$model->id),
                            'id'=>'updateForm',
                            'role'=>'form',
                            'page'=>'form',
                            'class'=>'form-horizontal form-row-seperated',
                            'method'=>'PUT',
                            'files' => true
                            ])!!}
                <div class="col-md-12">

                    {{-- RIGHT SIDE --}}
                    @include('courses::doctor.contents.quiz.form.form-panel-body')

                    {{-- PAGE CONTENT --}}
                    <div class="col-md-9">
                        <div class="tab-content">

                            {{-- CREATE FORM --}}
                            @include('courses::doctor.contents.quiz.form.index')
                            {{-- END CREATE FORM --}}

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
                                <a href="{{url(route('doctor.contents.index')) }}" class="btn btn-lg red">
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
