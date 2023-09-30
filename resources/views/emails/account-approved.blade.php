<x-mail::message>
    # Dear {{ $user->first_name . ' ' . $user->last_name }},

    Your account has been approved. Kindly login to your account using the mentioned password.

    # Password: {{ $password }}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
