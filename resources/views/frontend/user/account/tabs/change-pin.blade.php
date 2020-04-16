{{ html()->form('PATCH', route('frontend.auth.pin.update'))->class('form-horizontal')->open() }}
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.old_pin'))->for('old_pin') }}

                {{ html()->password('old_pin')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.old_pin'))
                    ->autofocus()
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.new_pin'))->for('pin') }}

                {{ html()->password('pin')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.new_pin'))
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.new_pin_confirmation'))->for('pin_confirmation') }}

                {{ html()->password('pin_confirmation')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.new_pin_confirmation'))
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group mb-0 clearfix">
                {{ form_submit(__('labels.general.buttons.update') . ' ' . __('validation.attributes.frontend.pin')) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{ html()->form()->close() }}
