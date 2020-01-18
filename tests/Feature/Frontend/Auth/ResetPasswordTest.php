<?php

namespace Tests\Feature\Frontend\Auth;

use App\Events\Frontend\Auth\UserResetConfirmed;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\Frontend\Auth\UserNeedsPasswordReset;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_password_reset_route_exists()
    {
        $this->get('password/reset/init')->assertStatus(200);
    }

    /** @test */
    public function password_reset_code_is_sent_if_password_reset_is_requested()
    {
        $user = factory(User::class)->create(['username' => 'john@example.com']);
        Notification::fake();

        $this->followingRedirects()
            ->post('password/reset/init', ['username' => 'john@example.com']);

        Notification::assertSentTo($user, UserNeedsPasswordReset::class);
    }

    /** @test */
    public function a_user_can_confirm_their_password_reset_with_their_code()
    {
        Event::fake();

        $user = factory(User::class)->states('resetUnconfirmed')
            ->create(['confirmation_code' => '12345']);

        $response = $this->followingRedirects()
            ->post("password/code/confirm/$user->uuid", ['code' => '12345']);

        $this->assertContains(__('exceptions.frontend.auth.password.reset_code_confirmed'), $response->getContent());

        Event::assertDispatched(UserResetConfirmed::class);

    }


    /** @test */
    public function a_user_can_not_confirm_their_password_reset_with_expired_code_when_code_expiration_setting_is_on()
    {
        config(['access.users.confirmation_code.expiration_time' => 1]);

        $user = factory(User::class)->states('resetUnconfirmed')->create([
            'confirmation_code' => '12345',
            'code_sent_at' => Carbon::now()->subMinutes(config('access.users.confirmation_code.expiration_time'))->toDateTimeString(),
        ]);
        $response = $this->followingRedirects()
            ->post("password/code/confirm/$user->uuid", [
                'code' => '12345'
            ]);

        $this->assertContains(__('auth.code_expired'), $response->getContent());
    }

    /** @test */
    public function a_user_can_confirm_their_password_reset_with_expired_code_when_code_expiration_setting_is_off()
    {
        config(['access.users.confirmation_code.expiration_time' => false]);

        $user = factory(User::class)->states('resetUnconfirmed')->create([
            'confirmation_code' => '12345',
            'code_sent_at' => Carbon::now()->subMinutes(config('access.users.confirmation_code.expiration_time'))->toDateTimeString(),
        ]);
        $response = $this->followingRedirects()
            ->post("password/code/confirm/$user->uuid", [
                'code' => '12345'
            ]);

        $this->assertContains(__('exceptions.frontend.auth.password.reset_code_confirmed'), $response->getContent());
    }

    /** @test */
    public function the_reset_password_form_has_required_fields()
    {
        $response = $this->post('password/reset/123', [
            'password' => '',
            'password_confirmation' => '',
        ]);
        $response->assertSessionHasErrors([ 'password']);
    }

    /** @test */
    public function a_password_can_be_reset()
    {
        $user = factory(User::class)->states('resetConfirmed')->create([
            'username'=>'john.doe'
        ]);

        $this->post("password/reset/$user->uuid", [
            'password' => ']EqZL4}zBT',
            'password_confirmation' => ']EqZL4}zBT',
        ]);
        $this->assertTrue(Hash::check(']EqZL4}zBT', $user->fresh()->password));
    }

    /** @test */
    public function the_password_can_be_validated()
    {
        $user = factory(User::class)->states('resetConfirmed')->create();

        $response = $this->followingRedirects()
            ->post("password/reset/$user->uuid", [

            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $this->assertContains(__('auth.password_rules'), $response->content());
    }

    /** @test */
    public function a_user_can_use_the_same_password_when_history_is_off_on_password_reset()
    {
        config(['access.users.password_history' => false]);

        $user = factory(User::class)->states('resetConfirmed')->create([
            'username' => 'john@example.com',
            'password' => ']EqZL4}zBT'
        ]);

        $response = $this->post("password/reset/$user->uuid", [
            'password' => ']EqZL4}zBT',
            'password_confirmation' => ']EqZL4}zBT',
        ]);

        $response->assertSessionHas('flash_success');
        $this->assertTrue(Hash::check(']EqZL4}zBT', $user->fresh()->password));
    }

    /** @test */
    public function a_user_can_not_use_the_same_password_when_history_is_on_on_password_reset()
    {
        config(['access.users.password_history' => 3]);

        $user = factory(User::class)->create(['email' => 'john@example.com', 'password' => ']EqZL4}zBT']);

        // Change once
        $this->actingAs($user)
            ->patch('/password/update', [
                'old_password' => ']EqZL4}zBT',
                'password' => ':ZqD~57}1t',
                'password_confirmation' => ':ZqD~57}1t',
            ]);

        $this->assertTrue(Hash::check(':ZqD~57}1t', $user->fresh()->password));

        auth()->logout();

        $response = $this->post("password/reset/$user->uuid", [
            'password' => ']EqZL4}zBT',
            'password_confirmation' => ']EqZL4}zBT',
        ]);

        $response->assertSessionHasErrors();
        $errors = session('errors');
        $this->assertEquals($errors->get('password')[0], __('auth.password_used'));
        $this->assertTrue(Hash::check(':ZqD~57}1t', $user->fresh()->password));
    }

    /** @test */
    public function a_user_can_not_reset_their_password_if_their_reset_password_status_is_unconfirmed()
    {
        $user = factory(User::class)->create([
            'username'=>'john.doe'
        ]);

        $response = $this->followingRedirects()
        ->post("password/reset/$user->uuid", [
            'password' => ']EqZL4}zBT',
            'password_confirmation' => ']EqZL4}zBT',
        ]);

        $this->assertContains(__('exceptions.frontend.auth.password.reset_not_confirmed'), $response->content());
    }

}
