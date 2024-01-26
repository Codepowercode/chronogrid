@component('mail::message')
# Access Code!

Code. {{$code}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
