<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/1/20
 * Time: 11:17 AM
 */

namespace App\Http\Controllers\Api\Business;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class ServiceController extends Controller
{
    public function index(ServiceRepository $serviceRepository)
    {
        return response()->json($serviceRepository->getAllServices()->get());
    }
    
    public function show()
    {
    
    }
}
