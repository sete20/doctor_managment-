@component('mail::message')

  your pin code is : <span style="color: blue;">{{$code}}</span><br>


  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
