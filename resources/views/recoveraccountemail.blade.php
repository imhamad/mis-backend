<x-mail::message>
    # Introduction

    Please use the One Time Password (OTP) below to reset your password.

    # OTP: {{ $otp_code }}

    Thanks
    {{ config('app.name') }}
</x-mail::message>
