<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 8/6/19
 * Time: 8:52 AM
 */

namespace App\Channels;

use App\Services\Notifications\Sms\SmsClient;
use Illuminate\Notifications\Notification;

class SmsChannel
{

    private $smsClient;

    public function __construct(SmsClient $smsClient)
    {
        $this->smsClient = $smsClient;
    }

    public function send($notifiable, Notification $notification)
    {

        $message = $notification->toSms($notifiable);
        $this->smsClient->send([
            'to'      => $message->to,
            'from'    => $message->from,
            'content' => $message->content,
        ]);
    }
}