@component('mail::message')
# Account Deleted!

<pre>
Dear {{$data['email']}}

We regret to tell you that Your ChronoGrid account has been denied.


</pre>

Thanks,<br>
The {{ config('app.name') }} team
@endcomponent
