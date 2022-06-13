<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label class="col-md-2" for="{{$name}}">{{$label}}</label>
    <div class="col-md-9">
        <div class="input-group">
            <span class="input-group-btn">
                <a data-input="image" data-preview="holder"
                   class="btn btn-primary lfm">
                    <i class="fa fa-picture-o"></i>
                    {{__('app::dashboard.buttons.upload')}}
                </a>
            </span>
            {!! Form::text($name, null, [
               "class" => "form-control image",
               "id" => $name,
               "readonly" => "readonly"
            ]) !!}
            <span class="input-group-btn">
                <a data-input="{{$name}}" data-preview="holder"
                   class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-remove"></i>
                </a>
            </span>
        </div>
        <span class="holder" style="margin-top:15px;max-height:100px;">
            @if(fieldOptionExists($options,'url',))
                <img src="{{url($options['url'])}}" style="height: 15rem;">
            @endif
        </span>
        <input type="hidden" data-name="{{$name}}">
        <div class="help-block"></div>
    </div>
</div>
