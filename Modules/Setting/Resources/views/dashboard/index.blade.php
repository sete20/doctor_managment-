@extends('app::dashboard.layouts.app')
@section('title', __('setting::dashboard.settings.routes.index'))
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
					<a href="#">{{ __('setting::dashboard.settings.routes.index') }}</a>
				</li>
			</ul>
		</div>

		<h1 class="page-title"></h1>

		@include('app::dashboard.layouts._msg')

		<div class="row">
			<form role="form" class="form-horizontal form-row-seperated" method="post" action="{{route('dashboard.setting.update')}}" enctype="multipart/form-data">
				<div class="col-md-12">
					@csrf
					<div class="col-md-3">
						<div class="panel-group accordion scrollable" id="accordion2">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle"> {{__('setting::dashboard.settings.form.tabs.info')}}
										</a>
									</h4>
								</div>
								<div id="collapse_2_1" class="panel-collapse in">
									<div class="panel-body">
										<ul class="nav nav-pills nav-stacked">
											<li class="active">
												<a href="#global_setting" data-toggle="tab">
													{{ __('setting::dashboard.settings.form.tabs.general') }}
												</a>
											</li>
											<li>
												<a href="#points" data-toggle="tab">
													إعدادات النقاط
												</a>
											</li>
											<li>
												<a href="#app" data-toggle="tab">
													{{ __('setting::dashboard.settings.form.tabs.app') }}
												</a>
											</li>
											<li>
												<a href="#logo" data-toggle="tab">
													{{ __('setting::dashboard.settings.form.tabs.logo') }}
												</a>
											</li>
											
											<li>
												<a href="#social_media" data-toggle="tab">
													{{ __('setting::dashboard.settings.form.tabs.social_media') }}
												</a>
											</li>
											<li>
												<a href="#other" data-toggle="tab">
													{{ __('setting::dashboard.settings.form.tabs.other') }}
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
							@include('setting::dashboard.tabs.general')
							@include('setting::dashboard.tabs.app')
							@include('setting::dashboard.tabs.points')
							@include('setting::dashboard.tabs.logo')
							@include('setting::dashboard.tabs.social')
							@include('setting::dashboard.tabs.other')
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-9">
							<button type="submit" id="submit" class="btn btn-lg blue">
								{{__('app::dashboard.buttons.edit')}}
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
