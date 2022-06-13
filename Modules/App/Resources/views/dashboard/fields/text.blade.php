@if(array_key_exists('multi_lang',$options) && $options['multi_lang'] == true)

    @foreach (config('translatable.locales') as $code)
        <div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
            <label class="col-md-2">
                {{ $label }} - {{ $code }}
            </label>
            <div class="col-md-9">
                @php $model = fieldOptionExists($options , 'model') ? $options['model'] : null;@endphp
                {!! Form::text($name.'['.$code.']', optional(optional($model)->translate($code))->$name, [
                   "placeholder" => $label,
                   "class" => "form-control",
                   "data-name" => $name.'.'.$code,
                   "id" => $name.'['.$code.']'
                   ]) !!}
                <div class="help-block"></div>
            </div>
        </div>
    @endforeach
@else
    <div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
        <label class="col-md-2">
            {{ $label }}
        </label>
        <div class="col-md-9">
            {!! Form::text($name, $value, [
               "placeholder" => $label,
               "class" => "form-control",
               "data-name" => $name.'.'.$code,
               "id" => $name
               ]) !!}
            <div class="help-block"></div>
        </div>
    </div>
@endif