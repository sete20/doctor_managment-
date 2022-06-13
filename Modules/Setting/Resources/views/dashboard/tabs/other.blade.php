<div class="tab-pane fade" id="other">
    <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.other') }}</h3>
    <div class="col-md-10">

        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.force_update') }}
            </label>
            <div class="col-md-9">
                <div class="mt-radio-inline">
                    <label class="mt-radio mt-radio-outline"> Yes
                        <input type="radio" name="other[force_update]" value="1"
                        @if (setting('other','force_update') == 1)
                          checked
                        @endif>
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">
                        No
                        <input type="radio" name="other[force_update]" value="0"
                        @if (setting('other','force_update') == 0)
                          checked
                        @endif>
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
