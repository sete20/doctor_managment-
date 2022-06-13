<div class="tab-pane active fade in" id="global_setting">
    <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.general') }}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
              {{ __('setting::dashboard.settings.form.locales') }}
            </label>
            <div class="col-md-9">
                <select name="locales[]" id="single" class="form-control select2" multiple="">
                    @foreach (config('core.available-locales') as $key => $language)
                    <option value="{{ $key }}"
                    @if (in_array($key,array_keys(config('laravellocalization.supportedLocales'))))
                    selected
                    @endif>
                        {{ $language['native'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.rtl_locales') }}
            </label>
            <div class="col-md-9">
                <select name="rtl_locales[]" id="single" class="form-control select2" multiple="">
                    @foreach (config('core.available-locales') as $key => $language)
                    <option value="{{ $key }}"
                    @if (in_array($key,config('rtl_locales')))
                    selected
                    @endif>
                        {{ $language['native'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.default_language') }}
            </label>
            <div class="col-md-9">
                <select name="default_locale" id="single" class="form-control select2">
                    @foreach (config('core.available-locales') as $key => $language)
                    <option value="{{ $key }}"
                    @if (config('default_locale') == $key)
                    selected
                    @endif>
                        {{ $language['native'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>



    </div>
</div>
