{{ html()->form('POST', route('frontend.user.topup'))->class('form-horizontal')->open() }}
<div>
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.topup_account_change_notice')
    </div>
</div>
<div id="POItablediv">
    <table class="table table-responsive" id="POITable">
        <thead>
        <tr>
            <th></th>
            <th>@lang('validation.attributes.frontend.topup.service')</th>
            <th>@lang('validation.attributes.frontend.topup.account')</th>
            <th>@lang('validation.attributes.frontend.topup.confirmed')</th>
        </tr>
        </thead>
        <tbody>
            @foreach($topup_methods as $key => $method)
                <tr>
                    <td style="height: 50px; width: 50px;">{!! @$method->logo_label !!}</td>
                    <td>{{$method->name}}</td>
                    <td  class="row"><input style="width: 100%;" placeholder="{{$method->placeholder_text}}" id="account-{{$method->uuid}}" type="text" name="topup_config[{{ $key }}][account]" value="{{@$logged_in_user->getTopupAccount($method)->account}}" class="form-control" {{@$logged_in_user->getTopupAccount($method)->is_confirmed? 'disabled': ''}}/></td>
                    <td><input type="hidden" id="uuid" name="topup_config[{{$key}}][method_id]" value="{{$method->uuid}}"/></td>
                    @if(@$logged_in_user->getTopupAccount($method)->is_confirmed)
                        <td><i class='badge badge-success'>@lang('labels.general.yes')</i></td>
                    @else
                        <td><i class='badge badge-danger'>@lang('labels.general.no')</i></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    {{--<div>--}}
        {{--<small class="text-muted">@lang('business.landlord.percentage_for_the_landlord')</small>--}}
    {{--</div>--}}
</div>
<div class="row">
    <div class="col text-right">
        {{ form_submit(__('buttons.general.submit')) }}
    </div><!--row-->
</div><!--row-->
{{ html()->form()->close() }}
