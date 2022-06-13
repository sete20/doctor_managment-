@extends('app::dashboard.layouts.app')
@section('title', __('users::dashboard.clients.routes.create'))
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
                        <a href="{{ url(route('dashboard.clients.index')) }}">
                            {{__('users::dashboard.clients.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('users::dashboard.clients.routes.create')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                {!! Form::model($model,[
                                'url'=> route('dashboard.clients.store'),
                                'id'=>'form',
                                'role'=>'form',
                                'method'=>'POST',
                                'class'=>'form-horizontal form-row-seperated',
                                'files' => true
                                ])!!}

                <div class="col-md-12">

                    @include('users::dashboard.clients.form.form-panel-body')

                    <div class="col-md-9">
                        <div class="tab-content">
                            @include('users::dashboard.clients.form.index')
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('app::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('app::dashboard.buttons.add')}}
                                </button>
                                <a href="{{url(route('dashboard.clients.index')) }}" class="btn btn-lg red">
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


@section('scripts')

@endsection