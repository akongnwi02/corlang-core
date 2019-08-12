<?php

namespace Tests\Feature\Backend\User;

use Tests\TestCase;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use App\Events\Backend\Auth\User\UserCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_create_user_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/admin/auth/user/create');

        $response->assertStatus(200);
    }

    /** @test */
    public function create_user_has_required_fields()
    {
        $this->loginAsAdmin();

        $response = $this->post('/admin/auth/user', []);

        $response->assertSessionHasErrors(['first_name', 'last_name', 'email', 'password', 'roles']);
    }

    /** @test */
    public function user_email_needs_to_be_unique()
    {
        $this->loginAsAdmin();
        factory(User::class)->create(['email' => 'john@example.com']);

        $response = $this->post('/admin/auth/user', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '237653754334',
                'username' => 'john.doe',
                'email' => 'john@example.com',
                'notification_channel' => 'mail',
                'password' => 'password',
                'password_confirmation' => 'password',
                'active' => '1',
                'confirmed' => '0',
                'timezone' => 'UTC',
                'confirmation_message' => '1',
                'roles' => [1 => 'executive', 2 => 'user'],
            ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function user_username_needs_to_be_unique()
    {
        $this->loginAsAdmin();
        factory(User::class)->create(['username' => 'john.doe']);

        $response = $this->post('/admin/auth/user', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'username' => 'john.doe',
                'email' => 'john@example.com',
                'phone' => '237653754334',
                'notification_channel' => 'mail',
                'password' => 'password',
                'password_confirmation' => 'password',
                'active' => '1',
                'confirmed' => '0',
                'timezone' => 'UTC',
                'confirmation_message' => '1',
                'roles' => [1 => 'executive', 2 => 'user'],
            ]);

        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function user_phone_number_needs_to_be_unique()
    {
        $this->loginAsAdmin();
        factory(User::class)->create(['phone' => '237653754334']);

        $response = $this->post('/admin/auth/user', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'username' => 'john.doe',
                'email' => 'john@example.com',
                'phone' => '237653754334',
                'notification_channel' => 'mail',
                'password' => 'password',
                'password_confirmation' => 'password',
                'active' => '1',
                'confirmed' => '0',
                'timezone' => 'UTC',
                'confirmation_message' => '1',
                'roles' => [1 => 'executive', 2 => 'user'],
            ]);

        $response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function admin_can_create_new_user()
    {
        $this->loginAsAdmin();
        // Hacky workaround for this issue (https://github.com/laravel/framework/issues/18066)
        // Make sure our events are fired
        $initialDispatcher = Event::getFacadeRoot();
        Event::fake();
        Model::setEventDispatcher($initialDispatcher);

        $response = $this->post('/admin/auth/user', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'john.doe',
            'email' => 'john@example.com',
            'notification_channel' => 'mail',
            'phone' => '237653754334',
            'password' => 'password',
            'password_confirmation' => 'password',
            'active' => '1',
            'confirmed' => '1',
            'location' => 'Douala / Cameroon',
            'confirmation_message' => '1',
            'roles' => [1 => 'administrator'],
        ]);

        $this->assertDatabaseHas(
            config('access.table_names.users'),
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'username' => 'john.doe',
                'phone' => '237653754334',
                'email' => 'john@example.com',
                'active' => 1,
                'confirmed' => 1,
            ]
        );

        $response->assertSessionHas(['flash_success' => __('alerts.backend.users.created')]);
        Event::assertDispatched(UserCreated::class);
    }

    /** @test */
    public function when_an_unconfirmed_user_is_created_a_notification_will_be_sent()
    {
        $this->loginAsAdmin();
        Notification::fake();

        $response = $this->post('/admin/auth/user', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '237653754334',
            'username' => 'john.doe',
            'notification_channel' => 'mail',
            'password' => 'password',
            'password_confirmation' => 'password',
            'active' => '1',
            'confirmed' => '0',
            'timezone' => 'UTC',
            'confirmation_message' => '1',
            'roles' => [1 => 'administrator'],
        ]);
        $response->assertSessionHas(['flash_success' => __('alerts.backend.users.created')]);

        $user = User::where('email', 'john@example.com')->first();
        Notification::assertSentTo($user, UserNeedsConfirmation::class);
    }
}
