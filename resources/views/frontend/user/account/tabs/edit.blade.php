{{ html()->modelForm($logged_in_user, 'PATCH', route('frontend.user.profile.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.avatar'))->for('avatar') }}

                <div>
                    <input type="radio" name="avatar_type" value="gravatar" {{ $logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} /> Gravatar
                    <input type="radio" name="avatar_type" value="storage" {{ $logged_in_user->avatar_type == 'storage' ? 'checked' : '' }} /> Upload

                    @foreach($logged_in_user->providers as $provider)
                        @if(strlen($provider->avatar))
                            <input type="radio" name="avatar_type" value="{{ $provider->provider }}" {{ $logged_in_user->avatar_type == $provider->provider ? 'checked' : '' }} /> {{ ucfirst($provider->provider) }}
                        @endif
                    @endforeach
                </div>

            </div><!--form-group-->

            <div class="form-group hidden" id="avatar_location">
                {{ html()->file('avatar_location')->class('form-control-file')->id('avatar') }}
            </div><!--form-group-->
        </div><!--col-->
        <div class="col-sm-6">
            {{ html()->img($logged_in_user->picture, __('labels.frontend.user.profile.avatar'))->style('width:100px;height:100px;')->id('preview')->class('user-profile-image') }}
        </div>
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.username'))->for('username') }}

                {{ html()->text('username')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.username'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->disabled()}}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

                {{ html()->text('first_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.first_name'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

                {{ html()->text('last_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.last_name'))
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            @if($logged_in_user->notification_channel=='mail')
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.cannot_change_email_notice')
                </div>
            @endif
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                {{ html()->email('email')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.email'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->disabled($logged_in_user->notification_channel=='mail')}}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            @if($logged_in_user->notification_channel=='sms')
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.cannot_change_phone_notice')
                </div>
            @endif
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone') }}

                {{ html()->text('phone')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.phone'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->disabled($logged_in_user->notification_channel=='sms')}}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group mb-0 clearfix">
                {{ form_submit(__('labels.general.buttons.update')) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{ html()->closeModelForm() }}

@push('after-scripts')
    <script>
        $(function() {
            var avatar_location = $("#avatar_location");

            if ($('input[name=avatar_type]:checked').val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function() {
                if ($(this).val() === 'storage') {
                    avatar_location.show();
                } else {
                    avatar_location.hide();
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#avatar").change(function(){
            readURL(this);
        });
    </script>
@endpush
