@component('mail::message')
# Introduction

<pre>
{{--Dear {{ $maildata['name'] }},--}}

Thank you for applying for your ChronoGrid account!

In order to properly process your application we will need you to email the following items for
    our approval to our application team by sending an email to members@chronogrid.com.
-	Personal Identification for Individual Registering
-	Business License from either/or Country and State
-	Proof of affiliation to the industry (i.e. IWJG #, JBT#, Polygon#, etc..)

Once this has been submitted our application team will review your application and somebody will
reach out to you within 1-2 business days to finalize your registration. In order to speed up
the approval process please make sure that all items requested above have been sent.


We look forward to having you as part of the grid!

Sincerely,
The ChronoGrid team
</pre>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
