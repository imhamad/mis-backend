@component('mail::message')
<div style="text-align: center">
<img src="https://mis.developever.com/images/logo.png" alt="DE Logo" width="80" height="80">
<br>
<br>
</div>
<b>Greetings</b> 👋<b>,</b><br><br>
<p>We received a request to reset the password for your account on the Contributors Dashboard. To proceed, please enter the OTP (One-Time Password) below to create a new password:</p>
<h3>OTP Code: {{ $otp_code }}</h3>
<p>If you didn't initiate this request or believe it's in error, please disregard this email. Your current password remains secure.</p>
<p>For any concerns or assistance, don't hesitate to contact our support team at help.contributor@deknows.com. We're here to help!</p>
<b>Best Regards,</b><br><br>
<b>DE Powered by DeKnows Inc.</b>
@endcomponent