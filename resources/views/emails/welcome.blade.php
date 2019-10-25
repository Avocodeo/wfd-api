@component('mail::message')
# Welcome to What's for Dinner!

Thanks for registering. We will be sure to send any awesome notifications and updates your way!

Show us what you've got available to you and we'll do our best to help make the best food possible!

@component('mail::button', ['url' => 'http://127.0.0.1:8000/ingredients'])
Why not start by adding some ingredients?
@endcomponent

Thanks,<br>
The WFD Team<br><br><br>
Powered by {{ config('app.name') }}
@endcomponent
