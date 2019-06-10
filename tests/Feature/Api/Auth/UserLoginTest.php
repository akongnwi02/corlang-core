<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/9/19
 * Time: 12:55 PM
 */

namespace Test\Feature\Api\Auth;


use App\Events\Api\Auth\UserLoggedIn;
use App\Exceptions\Api\UnauthorizedException;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_login_with_email_and_password()
    {
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        Event::fake();

        $this->withHeader('Accept', 'application/json')
        ->post('/api/auth/login', [
                'email' => 'john@example.com',
                'password' => 'password'
            ])
        ->assertStatus(200);

        Event::assertDispatched(UserLoggedIn::class);
        $this->assertAuthenticatedAs($user, 'api');
    }

    /** @test */
    public function inactive_users_cant_login()
    {
        factory(User::class)->states('inactive')->create([
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $this->withHeader('Accept', 'application/json')
            ->post('/api/auth/login', [
                'email' => 'john@example.com',
                'password' => 'secret',
            ])
            ->assertStatus(401)
            ->assertSee('You can\'t log in at the moment. Your account may require approval or needs confirmation');

        $this->assertFalse($this->isAuthenticated('api'));
    }

    /** @test */
    public function unconfirmed_user_cant_login()
    {
        factory(User::class)->states('unconfirmed')->create([
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $this->withHeader('Accept', 'application/json')
            ->post('/api/auth/login', [
                'email' => 'john@example.com',
                'password' => 'secret',
            ])
            ->assertStatus(401)
            ->assertSee('You can\'t log in at the moment. Your account may require approval or needs confirmation');

        $this->assertFalse($this->isAuthenticated());
    }

    /** @test */
    public function email_is_required()
    {
        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);

        $this->withHeader('Accept', 'application/json')
            ->post('/api/auth/login', [
                'email' => '',
                'password' => 'secret',
            ])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'email' => ['The email field is required.']
                    ]
                ]);

        $this->assertFalse($this->isAuthenticated());
    }


    /** @test */
    public function password_is_required()
    {
        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);

        $this->withHeader('Accept', 'application/json')
            ->post('/api/auth/login', [
                'email' => 'don@email.com',
                'password' => '',
            ])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'password' => ['The password field is required.']
                    ]
                ]);

        $this->assertFalse($this->isAuthenticated());
    }

    /** @test */
    public function cant_login_with_invalid_credentials()
    {
        $this->withoutExceptionHandling();

        $this->expectException(UnauthorizedException::class);

        $this->withHeader('Accept', 'application/json')
            ->post('/api/auth/login', [
                'email' => 'not-existend@user.com',
                'password' => '9s8gy8s9diguh4iev',
            ])->assertStatus(401)
            ->assertSee('exceptions.api.auth.login.unauthorized');

    }

    /** @test */
    public function a_user_can_logout()
    {
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response = $this->withHeader('Accept', 'application/json')
            ->post('/api/auth/login', [
                'email' => 'john@example.com',
                'password' => 'password'
            ]);

        $token = json_decode($response->getContent())->access_token;

        $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $token"
        ])
            ->get('/api/auth/logout')
            ->assertStatus(200)
            ->assertSee('User logged out successfully.');
    }

    /** @test */
    public function a_user_cannot_use_a_blacklisted_token_on_a_protected_route()
    {
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response = $this->withHeader('Accept', 'application/json')
            ->post('/api/auth/login', [
                'email' => 'john@example.com',
                'password' => 'password'
            ]);

        $token = json_decode($response->getContent())->access_token;

        $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $token"
        ])
            ->get('/api/auth/logout')
            ->assertStatus(200)
            ->assertSee('User logged out successfully.');

        $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $token"
        ])
            ->get('/api/auth/logout')
            ->assertStatus(401)
            ->assertSee('Your token is invalid');
    }


    /** @test */
    public function a_user_can_refresh_his_token()
    {
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $this->withHeader('Accept', 'application/json')
            ->post('/api/auth/login', [
                'email' => 'john@example.com',
                'password' => 'password'
            ]);

        $this->withHeaders([
            'Accept' => 'application/json',
        ])
            ->get('/api/auth/refresh')
            ->assertStatus(200);
    }

}
