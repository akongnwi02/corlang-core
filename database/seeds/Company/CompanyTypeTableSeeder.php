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

class CompanyTypeTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        CompanyType::unguard();
    
        CompanyType::create([
            'name' => config('business.company.type.formal'),
            'code' => 'FORMALCOMPANY',
        ]);
    
        CompanyType::reguard();
    
    }
}
