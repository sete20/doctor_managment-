@extends('app::dashboard.layouts.app')
@section('title', __('category::dashboard.categories.routes.update'))
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
                    <a href="{{ url(route('dashboard.categories.index')) }}">
                        {{__('category::dashboard.categories.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('category::dashboard.categories.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            {!! Form::model($model,[
                            'url'=> route('dashboard.categories.update',$model->id),
                            'id'=>'updateForm',
                            'role'=>'form',
                            'page'=>'form',
                            'class'=>'form-horizontal form-row-seperated',
                            'method'=>'PUT',
                            'files' => true
                            ])!!}
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
                                                <a href="#category_level" data-toggle="tab">
                                                    {{ __('category::dashboard.categories.form.tabs.category_level') }}
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('category::dashboard.categories.form.tabs.general') }}
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
                            <div class="tab-pane active fade in" id="category_level">
                                <h3 class="page-title">{{ __('category::dashboard.categories.form.tabs.category_level') }}</h3>
                                <div id="jstree">
                                    <ul>
                                        <li id="null"
                                          @if ($model->category_id == null)
                                            data-jstree='{"selected":true}'
                                          @endif>
                                          {{ __('category::dashboard.categories.form.main_category') }}
                                        </li>
                                    </ul>
                                    @include('category::dashboard.tree.categories.edit',['mainCategories' => $mainCategories])
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="global_setting">
                                <h3 class="page-title">{{__('category::dashboard.categories.form.tabs.general')}}</h3>
                                <div class="col-md-10">
                                    @include('category::dashboard.categories.form')
                                </div>
                            </div>
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
                                <a href="{{url(route('dashboard.categories.index')) }}" class="btn btn-lg red">
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

<script type="text/javascript">
    $(function() {

        $('#jstree').jstree({
            core: {
                multiple: false
            }
        });

        $('#jstree').on("changed.jstree", function(e, data) {
            $('#root_category').val(data.selected);
        });

    });
</script>

@endsection
