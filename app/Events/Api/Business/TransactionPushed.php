<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/13/20
 * Time: 6:05 PM
 */

namespace App\Events\Api\Business;

use App\Services\Business\Transaction;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TransactionPushed implements ShouldBroadcast
{
    use Dispatchable,
        InteractsWithSockets,
        SerializesModels;
    
    /**
     * @var Transaction
     */
    public $transaction;
    
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        return [$this->transaction->userId];
    }
    
    public function broadcastAs()
    {
        \Log::debug('Processing new job transaction pushed job: ' . $this->transaction->getUserId());

        return 'transaction-complete';
    }
}
