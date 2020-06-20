<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/20/20
 * Time: 1:16 PM
 */

namespace App\Exports\Sales;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;

class SalesExport implements FromView, Responsable
{
    use Exportable;
    
    protected $sales;
    
    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'sales.xls';
    
    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLS;
    
    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];
    
    public function __construct($sales)
    {
        $this->sales = $sales;
    }
    
    public function view(): View
    {
        return view('backend.sales.download.index',[
            'sales' => $this->sales,
            'total' => $this->sales->sum('amount')
        ]);
    }
}
