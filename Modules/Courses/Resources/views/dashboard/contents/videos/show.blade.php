@extends('app::dashboard.layouts.app')
@section('title', 'عرض')
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
                            {{__('courses::dashboard.contents.videos.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">عرض</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="form-actions">

                            <div class="row">
                                <div class="col-md-12">
                                    @if(count($views))
                                        <div class="card" style="padding: 20px;">
                                            <div class="card-body p-0">
                                                <div class="table-responsive table-invoice">

                                                    <table class="table table-striped">
                                                        <tbody>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center">الإسم</th>
                                                        </tr>

                                                        @foreach($views as $view)
                                                            <tr class="text-center">
                                                                <td>{{ $view->id }}</td>
                                                                <td>{{ $view->name }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="table-responsive table-invoice">
                                                    <div class="text-center p-3 text-muted">
                                                        <h5>لا يوجد مشاهدات</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(count($views)>0)
                                        <div class="text-center">
                                            {{ $views->appends(Request::except('page'))->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@stop
