<div class="tab-pane fade" id="logo">
    <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.logo') }}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.logo') }}
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                        <a data-input="logo" data-preview="holder" class="btn btn-primary ">
                            <i class="fa fa-picture-o"></i>
                            {{__('app::dashboard.buttons.upload')}}
                        </a>
                    </span>
                    <input name="images[logo]" class="form-control logo" type="file"  value="{{ setting('logo') ? url(setting('logo')) : '' }}">
                </div>
                <span class="holder" style="margin-top:15px;max-height:100px;">
                    <img src="{{ setting('logo') ? url(setting('logo')) : '' }}" style="height: 15rem;">
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.favicon') }}
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                        <a data-input="favicon" data-preview="holder" class="btn btn-primary ">
                            <i class="fa fa-picture-o"></i>
                            {{__('app::dashboard.buttons.upload')}}
                        </a>
                    </span>
                    <input name="images[favicon]" class="form-control favicon" type="file"  value="{{ setting('favicon') ? url(setting('favicon')) : '' }}">
                </div>
                <span class="holder" style="margin-top:15px;max-height:100px;">
                    <img src="{{ setting('favicon') ? url(setting('favicon')) : '' }}" style="height: 15rem;">
                </span>
            </div>
        </div>
    </div>
</div>
