@lang('strings.emails.contact.email_body_title')

@lang('validation.attributes.frontend.name'): {{ $request->name }}
@lang('validation.attributes.frontend.subject'): {{ $request->subject }}
@lang('validation.attributes.frontend.email'): {{ $request->email ?: "N/A" }}
@lang('validation.attributes.frontend.phone'): {{ $request->phone }}
@lang('validation.attributes.frontend.message'): {{ $request->message }}
