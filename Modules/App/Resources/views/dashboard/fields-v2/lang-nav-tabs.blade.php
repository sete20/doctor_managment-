<ul class="nav nav-tabs">
    @foreach (config('translatable.locales') as $code)
        <li class="@if($loop->first) active @endif"><a data-toggle="tab" href="#first_{{$code}}">{{ $code }}</a></li>
    @endforeach
</ul>