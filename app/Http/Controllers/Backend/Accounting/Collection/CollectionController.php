<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/1/20
 * Time: 12:11 AM
 */

namespace App\Http\Controllers\Backend\Accounting\Collection;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class CollectionController extends Controller
{
    public function index(ServiceRepository $serviceRepository)
    {
        return view('backend.accounts.deposit.index')
            ->withServices($serviceRepository->getAllServices()->paginate());
    }
    
    public function show()
    {
    
    }
    
    public function pay()
    {
    
    }
}
