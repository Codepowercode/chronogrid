@component('mail::message')
# Your {{$maildata['type']}} notification

<pre>
Dear {{ $maildata['company_name'] }}
Action: {{$maildata['action']}}

{!! $maildata['data'] !!}</pre>

@if($maildata['button'])
    @component('mail::button', ['url' => $maildata['url']])
        Button Text
    @endcomponent
@endif
Thanks,<br>
{{ config('app.name') }}
@endcomponent



{{--@component('mail::message')--}}

{{--    #1231321321--}}

{{--<pre>--}}
{{--asdasdasd asd asd asd asd asd--}}
{{--</pre>--}}
{{--    Thanks,<br>--}}
{{--    {{ config('app.name') }}--}}
{{--@endcomponent--}}
