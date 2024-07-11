@component('mail::message')
<div style="text-align: center">
<img src="https://mis.developever.com/images/logo.png" alt="DE Logo" width="80" height="80">
<br><br>
</div>

<b>Greetings</b> 👋,<br><br>

<p>You have received a new contact enquiry from {{$contactData->de_contact_fullname}} {{$contactData->de_contact_business_email}}, Please review the enquiry and respond promptly. If necessary, mark this enquiry as a ticket to ensure it is tracked and addressed promptly.</p>
<ul>
<li><b>Name:</b> {{ $contactData->de_contact_fullname }}</li>
<li><b>Email:</b> {{ $contactData->de_contact_business_email }}</li>
<li><b>Organization:</b> {{ $contactData->de_contacting_organization }}</li>
<li><b>Phone / Mobile:</b> {{ $contactData->de_contacting_phone }}</li>
<li><b>Country:</b> {{ $contactData->de_contacting_country }}</li>
</ul>

<p><b>Relationship to DeKnows:</b> {{ $contactData->relationship_to_deknows->key }}</p>

@if (isset($contactData->relationship_to_deknows->value) && !empty($contactData->relationship_to_deknows->value))
<p><b>Specific Interests or Requests:</b></p>
<ul>
@foreach ($contactData->relationship_to_deknows->value as $interest)
<li>{{ $interest }}</li>
@endforeach
</ul>
@endif

<p><b>Message:</b> {{ $contactData->how_can_we_help_you }}</p>

<p>Your timely response is crucial to maintaining our service standards and client satisfaction.</p>

<b>Best Regards,</b><br><br>
<b>DE Powered by DeKnows Inc.</b>
@endcomponent