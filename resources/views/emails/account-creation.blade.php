<x-mail::message>
    # Dear {{ $user->first_name . ' ' . $user->last_name }},

    Your request has been submitted successfully. You will be notified through email once your account is approved.

    Thanks
    {{ config('app.name') }}
</x-mail::message>
