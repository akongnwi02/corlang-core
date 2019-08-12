<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Event;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_login_route_exists()
    {
        $this->get('/login')->assertStatus(200);
    }

    /** @test */
    public function a_user_can_login_with_username_and_password()
    {
        $user = factory(User::class)->create([
            'username' => 'john@example.com',
            'password' => 'secret',
        ]);
        Event::fake();

        $this->post('/login', [
            'username' => 'john@example.com',
            'password' => 'secret',
        ]);

        Event::assertDispatched(UserLoggedIn::class);
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function inactive_users_cant_login()
    {
        factory(User::class)->states('inactive')->create([
            'username' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response = $this->post('/login', [
            'username' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response->assertSessionHas('flash_danger');
        $this->assertFalse($this->isAuthenticated());
    }

    /** @test */
    public function unconfirmed_user_cant_login()
    {
        factory(User::class)->states('unconfirmed')->create([
            'username' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response = $this->post('/login', [
            'username' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response->assertSessionHas('flash_danger');
        $this->assertFalse($this->isAuthenticated());
    }

    /** @test */
    public function username_is_required()
    {
        $response = $this->post('/login', [
            'username' => '',
            'password' => '12345',
        ]);

        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function password_is_required()
    {
        $response = $this->post('/login', [
            'username' => 'john@example.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function cant_login_with_invalid_credentials()
    {
        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);

        $this->post('/login',[
            'username' => 'not-existend@user.com',
            'password' => '9s8gy8s9diguh4iev',
        ]);
    }

    /** @test */
    public function a_user_can_log_out()
    {
        $user = factory(User::class)->create();
        Event::fake();

        $this->actingAs($user)
            ->get('/logout')
            ->assertRedirect('/');

        $this->assertFalse($this->isAuthenticated());
        Event::assertDispatched(UserLoggedOut::class);
    }
}
