{{ html()->modelForm($company, 'PUT', route('admin.companies.company.update', $company))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div class="row mt-4 mb-4">
            <div class="col">

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.name'))->class('col-md-2 form-control-label required')->for('name') }}

                    <div class="col-md-10">
                        {{ html()->text('name')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.companies.company.name'))
                            ->attribute('maxlength', 191)
                            ->required()
                            ->autofocus() }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.phone'))->class('col-md-2 form-control-label required')->for('phone') }}

                    <div class="col-md-10">
                        {{ html()->text('phone')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.companies.company.phone'))
                            ->attribute('maxlength', 191)
                            ->required() }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.email'))->class('col-md-2 form-control-label')->for('email') }}

                    <div class="col-md-10">
                        {{ html()->text('email')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.companies.company.email'))
                            ->attribute('maxlength', 191) }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.address'))->class('col-md-2 form-control-label required')->for('address') }}

                    <div class="col-md-10">
                        {{ html()->text('address')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.companies.company.address'))
                            ->attribute('maxlength', 191)
                            ->required() }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.website'))->class('col-md-2 form-control-label')->for('website') }}

                    <div class="col-md-10">
                        {{ html()->text('website')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.companies.company.website'))
                            ->attribute('maxlength', 191) }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.street'))->class('col-md-2 form-control-label')->for('street') }}

                    <div class="col-md-10">
                        {{ html()->text('street')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.companies.company.street'))
                            ->attribute('maxlength', 191) }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.city'))->class('col-md-2 form-control-label required')->for('city') }}

                    <div class="col-md-10">
                        {{ html()->text('city')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.companies.company.city'))
                            ->attribute('maxlength', 191)
                            ->required() }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.state'))->class('col-md-2 form-control-label required')->for('state') }}

                    <div class="col-md-10">
                        {{ html()->text('state')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.companies.company.state'))
                            ->attribute('maxlength', 191)
                            ->required() }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.postal_code'))->class('col-md-2 form-control-label')->for('postal_code') }}

                    <div class="col-md-10">
                        {{ html()->text('postal_code')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.companies.company.postal_code'))
                            ->attribute('maxlength', 191) }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.size'))->class('col-md-2 form-control-label')->for('size') }}

                    <div class="col-md-10">
                        {{ html()->text('size')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.companies.company.size'))
                            ->attribute('maxlength', 191) }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.country'))->class('col-md-2 form-control-label required')->for('country_id') }}

                    <div class="col-md-10">
                        {{ html()->select('country_id', $countries)
                            ->class('form-control')
                            ->required() }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.direct_polling'))->class('col-md-2 form-control-label')->for('direct_polling') }}

                    <div class="col-md-10">
                        <label class="switch switch-label switch-pill switch-primary">
                            {{ html()->checkbox('direct_polling', null, 1)->class('switch-input') }}
                            <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                        </label>
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row ">
                    {{ html()->label(__('validation.attributes.backend.companies.company.type'))->class('col-md-2 form-control-label required')->for('type_id') }}

                    <div class="col-md-10">
                        @foreach($types as $type)
                            <div class="custom-control custom-radio custom-control-inline">

                                {{ html()->radio('type_id', $type->name == config('business.company.type.informal'), $type->uuid)
                                    ->class('custom-control-input')
                                    ->id($type->uuid)
                                    ->checked()
                                    ->required()
                                 }}
                                {{ html()->label(__($type->name))->for($type->uuid)->class('custom-control-label') }}
                            </div>
                        @endforeach
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.companies.company.logo'))->class('col-md-2 form-control-label')->for('logo') }}

                    <div class="col-md-10">
                        {{ html()->file('logo')->id('logo')->class('form-control-file') }}
                        <div>
                            {{ html()->img($company->full_logo, __('validation.attributes.backend.companies.company.logo'))->style('width:100px;height:100px;')->id('preview') }}
                        </div>
                    </div><!--col-->
                </div><!--form-group-->

            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col">
                {{ form_cancel(route('admin.companies.company.index'), __('buttons.general.cancel')) }}
            </div><!--col-->

            <div class="col text-right">
                {{ form_submit(__('buttons.general.crud.update')) }}
            </div><!--col-->
        </div><!--row-->

{{ html()->form()->close() }}
@push('after-scripts')

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#logo").change(function(){
        readURL(this);
    });
</script>
 @endpush
