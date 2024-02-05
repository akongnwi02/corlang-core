<?php


namespace App\Http\Composers\Backend\User;


use App\Models\Company\Company;
use App\Repositories\Backend\Company\Company\CompanyRepository;
use Illuminate\View\View;

class FilterUserComposer
{
    public $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function compose(View $view)
    {
        $view->with('companies', Company::all()->pluck('name', 'uuid')->toArray());
    }
}
