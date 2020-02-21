@if(auth()->user())
    @if(auth()->user()->isTemporalLoggedToCompany() && auth()->user()->isAdmin())
        <div class="alert alert-info logged-in-as mb-0">
            You are temporarily logged in to this company, <strong>{{ auth()->user()->company->name }}</strong>. <a href="{{ route("admin.companies.company.login", $default_company) }}">Re-Login to the Central Company {{ session()->get("admin_user_name") }}</a>.
        </div><!--alert alert-warning logged-in-as-->
    @endif
@endif
