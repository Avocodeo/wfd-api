@component('mail::message')
# What's for Dinner !?

Hey there {{ $user->name }}! Here are some new notifications:

	@foreach ($notifications as $notify)
        <li>
            {{ $notify->message }}
        </li>
	@endforeach

@component('mail::button', ['url' => url('/notifications')])
Look at Notifications
@endcomponent

Thanks,<br>
The WFD Team<br><br><br>
Powered by {{ config('app.name') }}
@endcomponent
