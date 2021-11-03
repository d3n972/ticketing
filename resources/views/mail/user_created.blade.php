@component('mail::message')
<h3>Dear {{$user->name}}!</h3>
{{__('An account has been created for you regarding your recent ticket.')}}
<br>
{{__('You can log in with the following password')}}
<pre>{{$pass}}</pre>
{{__('Please, change your generated password after the first login.')}}
<br>
@component('mail::button', ['url' => '/login'])
{{__('LOGIN')}}
@endcomponent
Best regards,
{{env('APP_NAME')}}
@endcomponent
