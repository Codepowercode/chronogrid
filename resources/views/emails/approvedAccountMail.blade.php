@component('mail::message')
# Account Approved!

Dear {{$data['name']}}

<p>{{isset($data['message'])? $data['message'] : ''}}</p>
<br>
<p>Email {{$data['email']}}</p>
<p>{{isset($data['password']) ? 'Password: '.$data['password'] : ''}}</p>
<br>

Thanks,<br>
The {{ config('app.name') }} team
@endcomponent
