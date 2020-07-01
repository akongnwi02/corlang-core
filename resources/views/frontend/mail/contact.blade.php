<p>@lang('strings.emails.contact.email_body_title')</p>

<p><strong>@lang('validation.attributes.frontend.name'):</strong> {{ $request->name }}</p>
<p><strong>@lang('validation.attributes.frontend.email'):</strong> {{ $request->email ?: "N/A" }}</p>
<p><strong>@lang('validation.attributes.frontend.phone'):</strong> {{ $request->phone  }}</p>
<p><strong>@lang('validation.attributes.frontend.message'):</strong> {{ $request->message }}</p>
