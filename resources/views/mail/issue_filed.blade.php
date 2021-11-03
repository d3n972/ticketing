@component('mail::message')
    <h3>Dear {{$issue->author()->first()->name}}!</h3>
    {{__('Your ticket has been opened with the id')}} <code>{{$issue->ticket_id}}</code>.
    <br>
    @if($issue->severity<4)
        <strong> {{__('We will start processing of your request within 2 working days')}}.</strong>
    @else
        {{__('We will start processing of your request within 7 working days')}}.
    @endif
    @component('mail::button', ['url' => route('issue.details',['id'=>$issue->ticket_id])])
       {{__('You can track your ticket here.')}}
    @endcomponent

    Best regards,
    {{env('APP_NAME')}}
@endcomponent
