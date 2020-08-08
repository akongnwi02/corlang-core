<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 7:19 PM
 */

use App\Models\Business\Commission;
use App\Models\Service\Category;
use App\Models\Service\Service;
use App\Models\System\Country;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        Service::create([
            'name' => 'IAT Prepaid',
            'description' => 'Some quick example text to serve as the service description and make up the bulk of the service\'s content.',
            'code' => 'CORIAT',
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::where('code', config('business.service.category.prepaidbills.code'))->first()->uuid,
            'is_prepaid' => false,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
        
        Service::create([
            'name' => 'Sample service 2',
            'description' => 'Some quick example text to serve as the service description and make up the bulk of the service\'s content.',
            'code' => 'CORMTNIN',
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::where('code', config('business.service.category.sendmoney.code'))->first()->uuid,
            'is_prepaid' => true,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
        
        Service::create([
            'name' => 'Orange Web Payment',
            'description' => 'Some quick example text to serve as the service description and make up the bulk of the service\'s content.',
            'code' => 'CORORANGEWEBPAY',
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::where('code', config('business.service.category.receivemoney.code'))->first()->uuid,
            'is_prepaid' => true,
            'requires_auth'  => false,
            'is_money_withdrawal' => true,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
        
        Service::create([
            'name' => 'Sample service 4',
            'description' => 'Some quick example text to serve as the service description and make up the bulk of the service\'s content.',
            'code' => 'CORMTNOUT',
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::where('code', config('business.service.category.receivemoney.code'))->first()->uuid,
            'is_prepaid' => true,
            'requires_auth'  => false,
            'is_money_withdrawal' => true,
            'auth_type'      => null,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
        
        Service::create([
            'name' => 'ENEO',
            'description' => 'Some quick example text to serve as the service description and make up the bulk of the service\'s content.',
            'code' => 'CORENEOPP',
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::where('code', config('business.service.category.postpaidbills.code'))->first()->uuid,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
        
        Service::create([
            'name' => 'MTN Airtime',
            'description' => 'Some quick example text to serve as the service description and make up the bulk of the service\'s content.',
            'code' => 'CORAPMTN',
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::where('code', config('business.service.category.airtime.code'))->first()->uuid,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
        
        Service::create([
            'name' => 'MTN Data',
            'description' => 'Some quick example text to serve as the service description and make up the bulk of the service\'s content.',
            'code' => 'CORAPMTNDATA',
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::where('code', config('business.service.category.data.code'))->first()->uuid,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
    }
}
