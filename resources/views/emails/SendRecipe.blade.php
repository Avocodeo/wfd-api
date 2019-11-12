@component('mail::message')
# What's for Dinner!

Hey, you should check out this recipe! Click on the button below to view the recipe within the WFD app.

Recipe: {{ $recipe }}

@component('mail::button', ['url' => url('/recipes')])
View Recipe
@endcomponent

Thanks,<br>
The WFD Team<br><br><br>
Powered by {{ config('app.name') }}
@endcomponent
