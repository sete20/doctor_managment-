
<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label for="{{$name}}">{{$label}}</label>
    <div class="row">
        <div class="col-lg-12">
            @foreach($options as $value => $displayName)
                <label class="radio-inline" style="">
                    {!! Form::radio($name , $value , $checked == $value ? true : false ) !!}

                    <label for="{{$name}}">{{$displayName}}</label>
                </label>
            @endforeach
        </div>
    </div>

    <span class="help-block"><strong id="{{$name}}_error">{{$errors->first($name)}}</strong></span>
</div>