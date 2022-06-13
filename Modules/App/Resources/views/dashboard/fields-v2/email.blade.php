<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label class="col-md-2">
        {{ $label }}
    </label>
    <div class="col-md-9">
        {!! Form::email($name, $value, [
           "placeholder" => $label,
           "class" => "form-control",
           "data-name" => $name.'.'.$code,
           "id" => $name
           ]) !!}
        <div class="help-block"></div>
    </div>
</div>