@component('mail::message')
<div style="text-align: center">
<img src="https://mis.developever.com/images/logo.png" alt="DE Logo" width="80" height="80">
<br>
<br>
</div>
<b>Greetings</b> 👋<b>,</b><br><br>
<p>We're excited to inform you that your account on the Blog for DE, powered by DeKnows Inc., is now active and ready for action!</p>
<p>Our administrator has reviewed your account, and it has been approved. You now have full access to the Contributors Dashboard, where you can begin sharing your knowledge.</p>
<p>To get started, simply log in with the following credentials:</p>
<ul>
<li><b>Email:</b> {{ $user->email }}</li>
<li><b>Password:</b> {{ $password }}</li>
<li><b>Registration:</b> {{ date('M d, Y', strtotime($user->created_at)) }}</li>
</ul>
<p>For security reasons, we recommend changing your password after your first login. If you ever forget your password, you can easily reset it using the "Forgot Password" feature on our login page.</p>
<p>If you have any questions, need assistance, or have ideas to improve our platform, please feel free to reach out to our support team at help.contributor@deknows.com. We value your input and are here to assist you in making the most of your experience on Contributors Dashboard.</p>
<p>Thank you for joining us. We look forward to seeing your contributions and making our platform thrive together!</p>
<b>Best Regards,</b><br><br>
<b>DE Powered by DeKnows Inc.</b>
@endcomponent
