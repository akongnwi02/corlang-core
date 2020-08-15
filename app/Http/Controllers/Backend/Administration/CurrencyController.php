<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 8/15/20
 * Time: 10:35 AM
 */

namespace App\Http\Controllers\Backend\Administration;


use App\Http\Requests\Backend\Administration\Currency\ChangeCurrencyStatusRequest;
use App\Http\Requests\Backend\Administration\Currency\UpdateCurrencyRequest;
use App\Http\Requests\Backend\Administration\Currency\StoreCurrencyRequest;
use App\Models\System\Currency;
use App\Repositories\Backend\System\CurrencyRepository;

class CurrencyController
{
    /**
     * @param CurrencyRepository $currencyRepository
     * @return mixed
     */
    public function index(CurrencyRepository $currencyRepository)
    {
        return view('backend.administration.currency.index')
            ->withCurrencies($currencyRepository->get()->paginate());
    }
    
    public function create()
    {
        return view('backend.administration.currency.create');
    }
    
    /**
     * @param StoreCurrencyRequest $request
     * @param CurrencyRepository $currencyRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(StoreCurrencyRequest $request, CurrencyRepository $currencyRepository)
    {
        $currencyRepository->create($request->input());
    
        return redirect()->route('admin.administration.currency.index')
            ->withFlashSuccess(__('alerts.backend.administration.currency.created'));
    }
    
    /**
     * @param UpdateCurrencyRequest $request
     * @param Currency $currency
     * @param CurrencyRepository $currencyRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency, CurrencyRepository $currencyRepository)
    {
        $currencyRepository->update($currency, $request->input());
    
        return redirect()->route('admin.administration.currency.index')
            ->withFlashSuccess(__('alerts.backend.administration.currency.updated'));
    }
    
    /**
     * @param CurrencyRepository $currencyRepository
     * @param Currency $currency
     * @param $status
     * @param ChangeCurrencyStatusRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(CurrencyRepository $currencyRepository, Currency $currency, $status, ChangeCurrencyStatusRequest $request)
    {
        $currencyRepository->mark($currency, $status);
    
        return redirect()->route('admin.administration.currency.index')
            ->withFlashSuccess(__('alerts.backend.administration.currency.status_updated'));
    }
    
    /**
     * @param Currency $currency
     * @return mixed
     */
    public function edit(Currency $currency)
    {
        return view('backend.administration.currency.edit')
            ->withCurrency($currency);
    }
    
}
