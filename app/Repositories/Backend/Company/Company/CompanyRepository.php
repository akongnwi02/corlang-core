<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 9:46 PM
 */

namespace App\Repositories\Backend\Company\Company;


use App\Events\Backend\Company\Company\CompanyCreated;
use App\Exceptions\GeneralException;
use App\Models\Company\Company;

class CompanyRepository
{
    protected $model;
    
    public function __construct(Company $company)
    {
        $this->model = $company;
    }
    
    /**
     * @param array $data
     * @return mixed
     * @throws \Throwable
     */
    public function create(array $data)
    {
        return \DB::transaction(function () use ($data) {
            
            $company = $this->model->create([
                'name'          => $data['name'],
                'address'       => $data['address'],
                'country_id'    => $data['country_id'],
                'state'         => $data['state'],
                'city'          => $data['city'],
                'phone'         => $data['phone'],
                'user_owner_id' => $data['user_owner_id'],
                'type_id'       => $data['type_id'],
                'email'         => $data['email'],
                'street'        => $data['street'],
                'website'       => $data['website'],
                'postal_code'   => $data['postal_code'],
                'size'          => $data['size'],
            ]);
            
            if ($company) {

                event(new CompanyCreated($company));
        
                return $company;
            }
    
            throw new GeneralException(__('exceptions.backend.companies.create_error'));
        });
    }
}
