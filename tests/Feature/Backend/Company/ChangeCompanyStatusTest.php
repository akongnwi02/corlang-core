<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 4:34 PM
 */

namespace Tests\Feature\Backend\Company;

use App\Events\Backend\Company\Company\CompanyDeactivated;
use App\Events\Backend\Company\Company\CompanyReactivated;
use App\Models\Company\Company;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangeCompanyStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_deactivate_a_company()
    {
        $company = factory(Company::class)->create();

        $this->loginAsAdmin();
        Event::fake();
        $this->get("/admin/companies/company/{$company->uuid}/mark/0");

        $this->assertEquals(0, $company->fresh()->is_active);
        Event::assertDispatched(CompanyDeactivated::class);
    }

    /** @test */
    public function admin_can_reactivate_a_company()
    {
        $company = factory(Company::class)->state('inactive')->create();

        $adminUser = $this->loginAsAdmin();
        $company->deactivated_by_id = $adminUser->uuid;
        $company->update();

        Event::fake();
        $this->get("/admin/companies/company/{$company->uuid}/mark/1");

        $this->assertEquals(1, $company->fresh()->is_active);
        Event::assertDispatched(CompanyReactivated::class);
    }

    /** @test */
    public function company_admin_can_deactivate_his_company()
    {
        $company = factory(Company::class)->state('active')->create();
        
        // use company to create company admin
        $this->loginAsCompanyAdmin(false, $company->uuid);
        
        Event::fake();
        $this->get("/admin/companies/company/{$company->uuid}/mark/0");
    
        $this->assertEquals(0, $company->fresh()->is_active);
        Event::assertDispatched(CompanyDeactivated::class);
    }
    
        /** @test */
    public function company_admin_can_reactivate_his_company()
    {
        $company = factory(Company::class)->state('inactive')->create();
        
        // use company to create company admin
        $companyAdmin = $this->loginAsCompanyAdmin(false, $company->uuid);
        $company->deactivated_by_id = $companyAdmin->uuid;
        $company->update();
        Event::fake();
        $this->get("/admin/companies/company/{$company->uuid}/mark/1");
    
        $this->assertEquals(1, $company->fresh()->is_active);
        Event::assertDispatched(CompanyReactivated::class);
    }
    
    /** @test */
    public function company_admin_cannot_deactivate_or_reactivate_other_companies()
    {
        $company = factory(Company::class)->state('active')->create();

        // don't use the company to create company admin
        $this->loginAsCompanyAdmin();

        Event::fake();
        $this->get("/admin/companies/company/{$company->uuid}/mark/0");

        $this->assertEquals(1, $company->fresh()->is_active);
        Event::assertNotDispatched(CompanyDeactivated::class);

        $company = factory(Company::class)->state('inactive')->create();

        $this->get("/admin/companies/company/{$company->uuid}/mark/1");
        
        $this->assertEquals(0, $company->fresh()->is_active);
        Event::assertNotDispatched(CompanyReactivated::class);
    }
    
    /** @test */
    public function company_admin_cannot_reactivate_his_company_if_deactivated_by_admin()
    {
        $company = factory(Company::class)->state('inactive')->create();
    
        $adminUser = $this->loginAsAdmin();
        $company->deactivated_by_id = $adminUser->uuid;
        $company->update();
    
        $companyAdmin = $this->loginAsCompanyAdmin(false, $company->uuid);
        
        Event::fake();
        $this->get("/admin/companies/company/{$company->uuid}/mark/1")
            ->assertSessionHas(['flash_danger' => __('exceptions.backend.companies.company.mark_rights_error')]);
    
        $this->assertEquals(0, $company->fresh()->is_active);
        Event::assertNotDispatched(CompanyReactivated::class);
    }
}
