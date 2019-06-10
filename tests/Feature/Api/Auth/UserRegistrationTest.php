<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/8/19
 * Time: 2:54 PM
 */

namespace Test\Feature\Api\Auth;


use App\Events\Api\Auth\UserRegistered;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Notifications\Api\Auth\UserNeedsConfirmation;
use App\Repositories\Api\Auth\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper function for registering a user.
     * @param array $userData
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function registerUser($userData = [])
    {
        factory(Role::class)->create(['name' => 'user']);
        return $this->withHeader('Accept','application/json')
            ->post('/api/auth/register', array_merge([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
        ], $userData));
    }

    /** @test */
    public function the_api_register_route_exists()
    {
        $this->registerUser()->assertStatus(201);
    }

    /** @test */
    public function api_user_registration_can_be_disabled()
    {
        factory(Role::class)->create(['name' => 'user']);
        config(['access.api_registration' => false]);
        $this->withHeader('Accept', 'application/json')
            ->post('/api/auth/register', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'don@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ])
            ->assertStatus(404);
    }

    /** @test */
    public function api_user_can_register_account()
    {
        $this->registerUser([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'newuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $newUser = (new UserRepository())->where('email', 'newuser@example.com')->first();
        $this->assertEquals($newUser->first_name, 'John');
        $this->assertEquals($newUser->last_name, 'Doe');
        $this->assertEquals($newUser->confirmed,0);
        $this->assertTrue(Hash::check('password', $newUser->password));
    }

    /** @test */
    public function if_email_confirmation_is_enabled_then_user_gets_notified()
    {
        config(['access.users.confirm_email' => true]);
        Notification::fake();

        $this->registerUser(['email' => 'don@example.com']);
        $user = (new UserRepository())->where('email', 'don@example.com')->first();

        Notification::assertSentTo($user, UserNeedsConfirmation::class);
    }

    /** @test */
    public function a_user_can_confirm_his_email()
    {
        $user = factory(User::class)->states('unconfirmed')->create();
        Event::fake();

        $response = $this->withHeader('Accept', 'application/json')
            ->get('/api/auth/register/confirm/'.$user->confirmation_code);
        $response->assertStatus(200)->assertJson(['message' => 'Your account has been successfully confirmed!']);
    }

    /** @test */
    public function confirmation_can_be_resent() {
        Notification::fake();

        $user = factory(User::class)->state('unconfirmed')->create();

        $response = $this->withHeader('Accept', 'application/json')
            ->get('/api/auth/register/confirm/resend/'.$user->uuid)
            ->assertStatus(200)
            ->assertSee(__('exceptions.frontend.auth.confirmation.resent'));
    }

    /** @test */
    public function if_requires_approval_is_active_the_user_cant_login()
    {

        config(['access.users.requires_approval' => true]);

        $this->registerUser();

        $response = $this->withHeader('Accept', 'application/json')
            ->post('api/auth/login', ['email' => 'john@example.com', 'password' => 'password'])
            ->assertStatus(401)
            ->assertSee('You can\'t log in at the moment. Your account may require approval or needs confirmation');
    }

    /** @test */
    public function an_event_get_fired_on_registration()
    {
        $initialDispatcher = Event::getFacadeRoot();
        Event::fake();
        Model::setEventDispatcher($initialDispatcher);

        $this->registerUser();

        Event::assertDispatched(UserRegistered::class);
    }

    /** @test */
    public function first_name_is_required()
    {
        $response = $this->withHeader('Accept','application/json')
            ->post('/api/auth/register', [
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422)->assertJson([
            'errors' => [
                'first_name' => [
                    'The first name field is required.',
                ]
            ]
        ]);
    }

    /** @test */
    public function last_name_is_required()
    {
        $response = $this->withHeader('Accept','application/json')
            ->post('/api/auth/register', [
                'first_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422)->assertJson([
            'errors' => [
                'last_name' => [
                    'The last name field is required.',
                ]
            ]
        ]);
    }

    /** @test */
    public function email_is_required()
    {
        $response = $this->withHeader('Accept','application/json')
            ->post('/api/auth/register', [
                'first_name' => 'Doe',
                'last_name' => 'Doe',
                'password' => 'password',
                'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422)->assertJson([
            'errors' => [
                'email' => [
                    'The email field is required.',
                ]
            ]
        ]);
    }

    /** @test */
    public function email_must_be_unique()
    {
        $user = factory(User::class)->create(['email' => 'don@don.com']);
        $response = $this->withHeader('Accept','application/json')
            ->post('/api/auth/register', [
                'first_name' => 'Doe',
                'last_name' => 'Doe',
                'email' => 'don@don.com',
                'password' => 'password',
                'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422)->assertJson([
            'errors' => [
                'email' => [
                    'The email has already been taken.',
                ]
            ]
        ]);
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $response = $this->withHeader('Accept','application/json')
            ->post('/api/auth/register', [
                'first_name' => 'Doe',
                'last_name' => 'Doe',
                'email' => 'don@don.com',
                'password' => 'password',
        ]);

        $response->assertStatus(422)->assertJson([
            'errors' => [
                'password' => [
                    'The password confirmation does not match.',
                ]
            ]
        ]);
    }

    /** @test */
    public function password_must_be_same()
    {
        $response = $this->withHeader('Accept','application/json')
            ->post('/api/auth/register', [
                'first_name' => 'Doe',
                'last_name' => 'Doe',
                'email' => 'don@don.com',
                'password' => 'password',
                'password_confirmation' => 'different',
        ]);

        $response->assertStatus(422)->assertJson([
            'errors' => [
                'password' => [
                    'The password confirmation does not match.',
                ]
            ]
        ]);
    }

}