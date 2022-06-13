
<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label for="{{$name}}" class="col-md-2">{{$label}}</label>
    <div class="col-md-9">
        <input type="checkbox" class="make-switch" id="{{$name}}" data-size="small" name="{{$name}}"
                {{fieldOptionExists($options , 'checked', 1) ? 'checked' : ''}}>
        <div class="help-block"></div>
    </div>
</div>