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
    
}
