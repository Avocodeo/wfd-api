@component('mail::message')
# What's for Dinner !!!

Hey! {{ $user->name }} wants to send you a recipe! Click on the button below to view the recipe within the WFD app.

Recipe: {{ $recipe->name }}

{{ $recipe->instructions }}

@component('mail::button', ['url' => url('\recipes\{{ $recipe->id }}')])
View Recipe
@endcomponent

Thanks,<br>
The WFD Team<br><br><br>
Powered by {{ config('app.name') }}
@endcomponent
