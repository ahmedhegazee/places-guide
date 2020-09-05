@component('mail::message')

Blood Bank Reset Password


<p>Your reset code is {{ $code }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
