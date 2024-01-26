@component('mail::message')
    # Welcome!

    Login. {{$data['email']}}
    <br>
    Password. {{$data['password']}}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
