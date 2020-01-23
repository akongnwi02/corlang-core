<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 1:09 PM
 */

use App\Models\Business\Commission;
use App\Models\Company\Company;
use App\Models\Company\CompanyService;
use App\Models\Company\CompanyType;
use App\Models\Service\Service;
use App\Models\System\Country;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CompanyServiceTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        CompanyService::create([
            'company_id'            => Company::first()->uuid,
            'service_id'            => Service::first()->uuid,
            'is_active'             => true,
            'agentcommission_id'    => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
            'customercommission_id' => Commission::first()->uuid,
        ]);
    }
}
