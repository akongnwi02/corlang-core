{{ html()->modelForm($method, 'PUT', route('admin.services.method.update', $method))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div class="row mt-4 mb-4">
    <div class="col">
        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.name'))->class('col-md-2 form-control-label required')->for('name') }}

            <div class="col-md-10">
                {{ html()->text('name')
                    ->class('form-control')
                    ->required()
                    ->attribute('maxlength', 191)
                    ->placeholder(__('validation.attributes.backend.services.method.name'))}}
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.code'))->class('col-md-2 form-control-label required')->for('code') }}

            <div class="col-md-10">
                {{ html()->text('code')
                    ->class('form-control')
                    ->disabled()
                    ->attribute('maxlength', 191)
                    ->placeholder(__('validation.attributes.backend.services.method.code'))}}
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.placeholder_text'))->class('col-md-2 form-control-label')->for('placeholder_text') }}

            <div class="col-md-10">
                {{ html()->text('placeholder_text')
                    ->class('form-control')
                    ->attribute('maxlength', 191)
                    ->placeholder(__('validation.attributes.backend.services.method.placeholder_text'))}}
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.accountregex'))->class('col-md-2 form-control-label')->for('accountregex') }}

            <div class="col-md-10">
                {{ html()->text('accountregex')
                    ->class('form-control')
                    ->attribute('maxlength', 191)
                    ->placeholder(__('validation.attributes.backend.services.method.accountregex'))}}
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.customercommission'))->class('col-md-2 form-control-label')->for('customercommission_id') }}

            <div class="col-md-10">
                {{ html()->select('customercommission_id', [null => null] + $commissions)
                    ->class('form-control')
                    }}
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.providercommission'))->class('col-md-2 form-control-label')->for('providercommission_id') }}

            <div class="col-md-10">
                {{ html()->select('providercommission_id', [null => null] + $commissions)
                    ->class('form-control')
                    }}
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.description_en'))->class('col-md-2 form-control-label required')->for('description_en') }}

            <div class="col-md-10">
                {{ html()->text('description_en')
                    ->class('form-control')
                    ->required()
                    ->attribute('maxlength', 191)
                    ->placeholder(__('validation.attributes.backend.services.method.description_en'))}}
            </div><!--col-->
        </div><!--form-group-->


        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.description_fr'))->class('col-md-2 form-control-label required')->for('description_fr') }}

            <div class="col-md-10">
                {{ html()->text('description_fr')
                    ->class('form-control')
                    ->required()
                    ->attribute('maxlength', 191)
                    ->placeholder(__('validation.attributes.backend.services.method.description_fr'))}}
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.realtime'))->class('col-md-2 form-control-label')->for('is_realtime') }}

            <div class="col-md-10">
                <label class="switch switch-label switch-pill switch-primary">
                    {{ html()->checkbox('is_realtime', null, 1)->class('switch-input') }}
                    <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                </label>
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.service'))->class('col-md-2 form-control-label')->for('service_id') }}

            <div class="col-md-10">
                {{ html()->select('service_id', [null => null] + $services)
                    ->class('form-control')}}
            </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.services.method.logo'))->class('col-md-2 form-control-label')->for('logo') }}

            <div class="col-md-10">
                {{ html()->file('logo')->id('logo')->class('form-control-file') }}
                <div class="preview">
                    {{ html()->img($method->logo_url, __('validation.attributes.backend.services.service.logo'))->style('width:100px;height:100px;')->id('preview') }}
                </div>
            </div><!--col-->
        </div><!--form-group-->

    </div><!--col-->
</div><!--row-->

<div class="row">
    <div class="col">
        {{ form_cancel(route('admin.services.method.index'), __('buttons.general.cancel')) }}
    </div><!--col-->

    <div class="col text-right">
        {{ form_submit(__('buttons.general.continue')) }}
    </div>
</div><!--row-->


{{ html()->closeModelForm() }}
@push('after-scripts')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview').hide();
        }
    }
    $("#logo").change(function(){
        readURL(this);
    });
</script>
@endpush
