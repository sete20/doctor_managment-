<!DOCTYPE html>
<html dir="rtl">
@section('title',__('auth::dashboard.login.routes.index'))
<link rel="stylesheet" href="{{ url('admin/assets/pages/css/login.min.css') }}">
@include('app::dashboard.layouts._head_rtl')
<body class="login">
<div class="content">
    <form class="login-form" action="{{ route('doctor.login') }}" method="POST">
        {{ csrf_field() }}

        <h3 class="form-title font-green">{{ __('auth::dashboard.login.routes.index') }}</h3>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label">
                {{ __('auth::dashboard.login.form.email') }}
            </label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" value="{{ old('email') }}" name="email"/>
            @if ($errors->has('email'))
                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
        </div>
        <div class="form-group{{$errors->has('password') ? ' has-error' : ''}}">
            <label class="control-label">
                {{ __('auth::dashboard.login.form.password') }}
            </label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" name="password"/>
            @if ($errors->has('password'))
                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
        </div>
        <div class="form-actions">
            <button type="submit" class="btn green uppercase">
                {{ __('auth::dashboard.login.form.btn.login') }}
            </button>
        </div>
    </form>
</div>
@include('app::dashboard.layouts._footer')
@include('app::dashboard.layouts._jquery')
</body>
</html>
