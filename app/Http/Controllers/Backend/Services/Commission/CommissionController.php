<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/24/20
 * Time: 6:42 PM
 */

namespace App\Http\Controllers\Backend\Services\Commission;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Services\Commission\CommissionRepository;

class CommissionController extends Controller
{
    
    public function index(CommissionRepository $commissionRepository)
    {
        return view('backend.services.commission.index')
            ->withCommissions($commissionRepository->getAllCommissions()
                ->paginate());
    }
    
}
