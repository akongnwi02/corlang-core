<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 4:34 PM
 */

namespace Tests\Feature\Backend\Company;


use App\Events\Backend\Company\Company\CompanyCreated;
use App\Models\Company\Company;
use App\Models\Company\CompanyType;
use App\Models\System\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCompanyTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function admin_can_access_the_create_company_page()
    {
        $this->loginAsAdmin();
        $response = $this->get('/admin/companies/company/create');
        $response->assertStatus(200);
    }
    
    /** @test */
    public function create_company_has_required_fields()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/companies/company');
        $response->assertSessionHasErrors(['name']);
    }
    
    /** @test */
    public function create_company_has_non_required_fields()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/companies/company');
        $response->assertSessionDoesntHaveErrors(['email', 'website', 'stree', 'postal_code']);
    }
    
    /** @test */
    public function company_name_needs_to_be_unique()
    {
        $this->loginAsAdmin();
        factory(Company::class)->create(['name' => 'Corlang']);
    
        $response = $this->post('/admin/companies/company', [
            'name'          => 'Corlang',
            'email'         => 'gentledivert@gmail.com',
            'phone'         => '65357885',
            'address'       => '128 street 212',
            'website'       => 'www.website.com',
            'street'        => 'mambanda',
            'city'          => 'Douala',
            'state'         => 'Littoral',
            'postal_code'   => '00237',
            'country_id'    => Country::first()->uuid,
            'size'          => 4,
            'type_id'       => CompanyType::first()->uuid,
        ]);
    
        $response->assertSessionHasErrors('name');
    }
    
    /** @test */
    public function admin_can_create_a_new_company()
    {
        $this->loginAsAdmin();
        $initialDispatcher = Event::getFacadeRoot();
        Event::fake();
        Model::setEventDispatcher($initialDispatcher);
        
        $response = $this->post('/admin/companies/company', [
            'name'          => 'Corlang',
            'email'         => 'gentledivert@gmail.com',
            'phone'         => '65357885',
            'address'       => '128 street 212',
            'website'       => 'www.website.com',
            'street'        => 'mambanda',
            'city'          => 'Douala',
            'state'         => 'Littoral',
            'postal_code'   => '00237',
            'country_id'    => Country::first()->uuid,
            'size'          => 4,
            'type_id'       => CompanyType::first()->uuid,
        ]);
        
        $response->assertSessionHas(['flash_success' => __('alerts.backend.companies.company.created')]);
        Event::assertDispatched(CompanyCreated::class);
    
        $this->assertDatabaseHas('companies', [
            'name'          => 'Corlang',
            'email'         => 'gentledivert@gmail.com',
            'phone'         => '65357885',
            'address'       => '128 street 212',
            'website'       => 'www.website.com',
            'street'        => 'mambanda',
            'city'          => 'Douala',
            'state'         => 'Littoral',
            'postal_code'   => '00237',
            'country_id'    => Country::first()->uuid,
            'size'          => 4,
            'type_id'       => CompanyType::first()->uuid,
        ]);
    }
}
