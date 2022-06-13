
<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label class="col-md-2">
        {{ $label }}
    </label>
    <div class="col-md-4">
        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
            {!! Form::text($name, $value, [
          "placeholder" => $label,
          "class" => "form-control",
          "data-name" => $name,
          "readonly" => 'readonly',
          "aria-required" => 'true',
          "aria-invalid" => 'false',
          "aria-describedby" => 'datepicker-error',
          "id" => $name
          ]) !!}

            <span class="input-group-btn">
                <button class="btn default" type="button">
                    <i class="fa fa-calendar"></i>
                </button>
            </span>
        </div>

        <div class="help-block" style="color: #e73d4a;"></div>
    </div>
</div>
