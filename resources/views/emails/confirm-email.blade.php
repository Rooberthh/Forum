@component('mail::message')
# One Last Step

You need to confirm your Email address to prove that you're human.

@component('mail::button', ['url' => 'Localhost:8000/register/confirm?token=' . $user->confirmation_token])
    Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
