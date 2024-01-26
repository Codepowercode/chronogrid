@component('mail::message')
# Introduction

<pre>
Dear {{ $maildata['name'] }},

Congratulations! Your ChronoGrid account has been successfully approved.

You now have full access to the following:

Login - {{ $maildata['email'] }}
Password - {{ $maildata['password'] }}
Role name - {{ $maildata['role'] }}
Permissions - @foreach($maildata['permissions'] as $key => $item) {{$item}}, @if($key==6 || $key==12 || $key== 18 || $key== 24) <br> @endif @endforeach

We are grateful to have you as part of our community and hope you enjoy our service for many years to come.

Sincerely,
The ChronoGrid team

</pre>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
