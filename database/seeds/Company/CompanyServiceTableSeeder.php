<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 1:09 PM
 */

use App\Models\Company\Company;
use App\Models\Company\CompanyService;
use App\Models\Service\Service;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CompanyServiceTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
    
        $services = Service::all();
    
        foreach ($services as $service) {
            CompanyService::create([
                'company_id'   => Company::first()->uuid,
                'service_id'   => $service->uuid,
                'is_active'    => true,
            ]);
        }
    }
}
