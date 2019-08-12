<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use App\Models\Auth\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;

class UpdateUserAccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_authenticated_users_can_access_their_account()
    {
        $this->get('/account')->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_update_his_profile_with_email()
    {
        $user = factory(User::class)->create([
            'notification_channel' => 'sms'
        ]);

        $this->actingAs($user)
            ->patch('/profile/update', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'avatar_type' => 'gravatar',
            ]);
        $user = $user->fresh();

        $this->assertEquals($user->first_name, 'John');
        $this->assertEquals($user->last_name, 'Doe');
        $this->assertEquals($user->email, 'john@example.com');
        $this->assertEquals($user->avatar_type, 'gravatar');
    }

    /** @test */
    public function a_user_can_update_his_profile_with_phone()
    {
        $user = factory(User::class)->create([
            'notification_channel' => 'mail',
        ]);

        $this->actingAs($user)
            ->patch('/profile/update',[
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '653754334',
                'avatar_type' => 'gravatar',
            ]);
        $user = $user->fresh();

        $this->assertEquals($user->first_name, 'John');
        $this->assertEquals($user->last_name, 'Doe');
        $this->assertEquals($user->phone, '237653754334');
        $this->assertEquals($user->avatar_type, 'gravatar');
    }

    /** @test */
    public function the_email_cannot_be_changed_if_notification_channel_is_mail()
    {
        $user = factory(User::class)->create([
            'notification_channel' => 'mail',
        ]);

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->patch('/profile/update', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'avatar_type' => 'gravatar',
            ]);

        $this->assertContains(__('exceptions.frontend.auth.cannot_change_email'), $response->getContent());
    }

    /** @test */
    public function the_phone_number_cannot_be_changed_if_notification_channel_is_sms()
    {
        $user = factory(User::class)->create([
            'notification_channel' => 'sms',
        ]);

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->patch('/profile/update', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '653754334',
                'avatar_type' => 'gravatar',
            ]);

        $this->assertContains(__('exceptions.frontend.auth.cannot_change_phone'), $response->getContent());

    }

    /** @test */
    public function the_first_name_is_required()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->patch('/profile/update', [
                'first_name' => '',
        ]);
        $response->assertSessionHasErrors(['first_name']);
    }

    /** @test */
    public function the_last_name_is_required()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->patch('/profile/update', [
                'last_name' => '',
            ]);

        $response->assertSessionHasErrors(['last_name']);
    }

    /** @test */
    public function the_avatar_type_is_required()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->patch('/profile/update', [
                'avatar_type' => ''
            ]);

        $response->assertSessionHasErrors(['avatar_type']);
    }

    /** @test */
    public function a_user_can_upload_his_own_avatar()
    {
        $user = factory(User::class)->create();
        Storage::fake('public');

        $this->actingAs($user)
            ->patch('/profile/update', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '653754334',
                'avatar_type' => 'storage',
                'avatar_location' => UploadedFile::fake()->image('avatar.jpg'),
            ]);

        Storage::disk('public')->assertExists("{$user->fresh()->avatar_location}");
    }

}
