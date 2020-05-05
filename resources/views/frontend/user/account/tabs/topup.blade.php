{{ html()->form('POST', route('frontend.user.topup'))->class('form-horizontal')->open() }}
<div id="POItablediv">
    <table class="table table-responsive table-borderless" id="POITable">
        <thead>
        <tr>
            <th></th>
            <th>@lang('validation.attributes.frontend.topup.service')</th>
            <th>@lang('validation.attributes.frontend.topup.account')</th>
        </tr>
        </thead>
        <tbody>
            @foreach($topup_methods as $key => $method)
                <tr>
                    <td>{!! @$method->logo_label !!}</td>
                    <td style="min-width: 100px; text-align: center" class="alert alert-light">{{$method->name}}</td>
                    <td><input id="account-{{$method->uuid}}" style="min-width:100px" type="text" name="topup_config[{{ $key }}][account]" value="{{$logged_in_user->getAccount($method, $logged_in_user)}}" class="form-control"/></td>
                    <td><input type="hidden" id="uuid" name="topup_config[{{$key}}][method_id]" value="{{$method->uuid}}"/></td>
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
        {{ form_submit(__('buttons.general.continue')) }}
    </div><!--row-->
</div><!--row-->
{{ html()->form()->close() }}
