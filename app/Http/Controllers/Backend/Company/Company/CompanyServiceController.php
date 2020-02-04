<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/3/20
 * Time: 11:55 PM
 */

namespace App\Http\Controllers\Backend\Company\Company;


use App\Http\Controllers\Controller;
use App\Models\Company\Company;

class CompanyServiceController extends Controller
{
    public function create(Company $company)
    {
        return view('backend.companies.company.edit.tabs.setting.services')
            ->withCompany($company)
            ->services();
    }
}
