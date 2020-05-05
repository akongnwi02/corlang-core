<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/2/20
 * Time: 9:35 PM
 */

namespace App\Jobs\Business\Purchase;

use App\Exceptions\Api\ServerErrorException;
use App\Http\Resources\Api\TransactionResource;
use App\Jobs\Job;
use App\Models\Transaction\Transaction;
use App\Repositories\Backend\Movement\MovementRepository;
use App\Services\Constants\BusinessErrorCodes;
use Pusher\Pusher;

class CompletePurchaseJob extends Job
{
    /**
     * @var Transaction
     */
    public $transaction;
    
    /**
     * Avoid processing deleted jobs
     */
    public $deleteWhenMissingModels = true;
    
    /**
     * Number of retries
     * @var int
     */
    public $tries = 5;
    
    /**
     * Timeout
     * @var int
     */
    public $timeout = 120;
    
    /**
     * Create a new job instance.
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
    
    /**
     * @param MovementRepository $movementRepository
     * @throws ServerErrorException
     * @throws \Pusher\PusherException
     */
    public function handle(MovementRepository $movementRepository)
    {
        if ($this->transaction->status != config('business.transaction.status.success')) {
            \Log::warning("{$this->getJobName()}: Transaction is not successful. Reversing movements...", [
                'transaction.status' => $this->transaction->status,
                'transaction.code'   => $this->transaction->code,
                'movement.code'      => $this->transaction->movement_code
            ]);
            
            $movementRepository->reverseMovements($this->transaction->movement_code);
        }
        
        \Log::info("{$this->getJobName()}: Transaction is terminated. Sending event to pusher...", [
            'transaction.status'       => $this->transaction->status,
            'transaction.asset'        => $this->transaction->asset,
            'transaction.code'         => $this->transaction->code,
            'transaction.uuid'         => $this->transaction->uuid,
            'transaction.destination'  => $this->transaction->destination,
            'transaction.amount'       => $this->transaction->amount,
            'transaction.message'      => $this->transaction->message,
            'transaction.error'        => $this->transaction->error,
            'transaction.error_code'   => $this->transaction->error_code,
            'transaction.service_code' => $this->transaction->service_code,
        ]);
        
        $this->transaction->completed_at = now();
        $this->transaction->save();
        
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            config('broadcasting.connections.pusher.options')
        );
        
        $triggered = $pusher->trigger(
            $this->transaction->uuid,
            config('broadcasting.connections.pusher.events.transaction_complete'),
            new TransactionResource($this->transaction)
        );
        
        if (!$triggered) {
            \Log::error("{$this->getJobName()}: Error encountered while sending event to pusher");
            throw new ServerErrorException(BusinessErrorCodes::GENERAL_CODE, 'Error connection to the pusher server');
        }
        
        \Log::info("{$this->getJobName()}: Event sent to pusher successfully");
    }
    
    public function getJobName()
    {
        return class_basename($this);
    }
}
