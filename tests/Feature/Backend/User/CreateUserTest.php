<?php

namespace Tests\Feature\Backend\User;

use App\Models\Company\Company;
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

        $response->assertSessionHasErrors(['first_name', 'last_name', 'email', 'password', 'roles', 'company_id']);
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
        $admin = $this->loginAsAdmin();
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
            'roles' => [2 => 'company administrator'],
            'company_id' => $admin->company->uuid
        ]);

        $this->assertDatabaseHas(config('access.table_names.users'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'john.doe',
            'phone' => '237653754334',
            'email' => 'john@example.com',
            'active' => 1,
            'confirmed' => 1,
            'company_id' => $admin->company->uuid
        ]);

        $response->assertSessionHas(['flash_success' => __('alerts.backend.users.created')]);
        Event::assertDispatched(UserCreated::class);
    }

    /** @test */
    public function when_an_unconfirmed_user_is_created_a_notification_will_be_sent()
    {
        $admin = $this->loginAsAdmin();
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
            'roles' => [2 => 'company administrator'],
            'company_id' => $admin->company->uuid
        ]);
        $response->assertSessionHas(['flash_success' => __('alerts.backend.users.created')]);

        $user = User::where('email', 'john@example.com')->first();
        Notification::assertSentTo($user, UserNeedsConfirmation::class);
    }

    /** @test */
    public function admin_cannot_create_another_admin_user()
    {
        $admin = $this->loginAsAdmin();
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
            'company_id' => $admin->company->uuid
        ]);
        $response->assertSessionHasErrors(['roles']);
    }

    /** @test */
    public function company_admin_cannot_create_another_company_admin_user()
    {
        $companyAdmin = $this->loginAsCompanyAdmin();
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
            'roles' => [2 => 'company administrator'],
            'company_id' => $companyAdmin->company->uuid
        ]);
        $response->assertSessionHasErrors(['roles']);
    }

    /** @test */
    public function company_admin_can_create_agent_user()
    {
        $companyAdmin = $this->loginAsCompanyAdmin();
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
            'roles' => [3 => 'agent'],
            'company_id' => $companyAdmin->company->uuid
        ]);
        $response->assertSessionHas(['flash_success' => __('alerts.backend.users.created')]);

        $user = User::where('email', 'john@example.com')->first();
        Notification::assertSentTo($user, UserNeedsConfirmation::class);
    }

    /** @test */
    public function company_admin_cannot_create_agent_in_another_company()
    {
        $company = factory(Company::class)->create();

        // create company admin with different company
        $companyAdmin = $this->loginAsCompanyAdmin();
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
            'roles' => [3 => 'agent'],
            'company_id' => $company->uuid
        ]);

        $response->assertSessionHasErrors(['company_id']);
    }

    /** @test */
    public function admin_in_default_company_can_create_agent_in_diffent_company()
    {
        $company = factory(Company::class)->create();

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
            'roles' => [3 => 'agent'],
            'company_id' => $company->uuid
        ]);
        $response->assertSessionHas(['flash_success' => __('alerts.backend.users.created')]);

        $user = User::where('email', 'john@example.com')->first();
        Notification::assertSentTo($user, UserNeedsConfirmation::class);
    }

    /** @test */
    public function company_owner_is_set_to_first_company_admin_created()
    {
        $company = factory(Company::class)->create();
    
        $this->loginAsAdmin();
    
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
            'roles' => [2 => 'company administrator'],
            'company_id' => $company->uuid
        ]);

        $response->assertSessionHas(['flash_success' => __('alerts.backend.users.created')]);
    
        $user_id = User::where('username', 'john.doe')->first()->uuid;
        $this->assertDatabaseHas('companies', [
            'uuid' => $company->uuid,
            'owner_id' => $user_id,
        ]);
    }
    
    /** @test */
    public function company_owner_is_not_set_when_onwer_already_exists()
    {
        $admin = $this->loginAsAdmin();
        $admin->company->owner_id = $admin->uuid;
        $admin->company->save();
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
            'roles' => [2 => 'company administrator'],
            'company_id' => $admin->company->uuid
        ]);
    
        $response->assertSessionHas(['flash_success' => __('alerts.backend.users.created')]);
    
        $user_id = User::where('username', 'john.doe')->first()->uuid;
        
        $this->assertDatabaseMissing('companies', [
            'uuid' => $admin->company->uuid,
            'owner_id' => $user_id,
        ]);
        
        $this->assertDatabaseHas('companies', [
            'uuid' => $admin->company->uuid,
            'owner_id' => $admin->uuid,
        ]);
    }
}
