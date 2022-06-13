@if(array_key_exists('multi_lang',$options) && $options['multi_lang'] == true)
    @php $code = $options['code'];@endphp
    <div class="form-group {{$errors->has($name.'['.$code.']') ? 'has-error':'' }}" id="{{$name.'['.$code.']'}}_wrap">
        <label class="col-md-2">
            {{ $label }} - {{ $code }}
        </label>
        <div class="col-md-9">
            @php $model = fieldOptionExists($options , 'model') ? $options['model'] : null;@endphp
            {!! Form::textarea($name.'['.$code.']',$value, [
               "placeholder" => $label,
               "class" => 'form-control '.is_rtl($code).'Editor',
               "rows" => "8",
               "cols" => "8",
               "data-name" => $name.'.'.$code,
               "id" => $name.'['.$code.']'
               ]) !!}
            <div class="help-block"></div>
        </div>
    </div>

@else
    <div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
        <label class="col-md-2">
            {{ $label }}
        </label>
        <div class="col-md-9">
            {!! Form::textarea($name, $value, [
               "placeholder" => $label,
                "class" => 'form-control Editor',
               "rows" => "80",
               "cols" => "8",
               "data-name" => $name,
               "id" => $name
               ]) !!}
            <div class="help-block"></div>
        </div>
    </div>
@endif