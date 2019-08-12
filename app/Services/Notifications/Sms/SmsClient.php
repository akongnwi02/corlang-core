<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 8/6/19
 * Time: 9:06 AM
 */

namespace App\Services\Notifications\Sms;


use Codeception\Lib\Connector\Guzzle;
use GuzzleHttp\Client;

class SmsClient
{
    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getFrom()
    {
        return config('services.sms.from');
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getUrl()
    {
        return config('services.sms.api_url');
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getApiKey()
    {
        return config('services.sms.api_key');
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getApiSecret()
    {
        return config('services.sms.api_secret');
    }


    /**
     * @param $message
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * TODO implement the logic of connecting to the actual provider
     *
     */
    public function send($message)
    {
        dd($message);
        $apiClient = new Client();
        $apiClient->post($this->getUrl(), '');
        $response = $apiClient->request('POST', '/sendSms');
//        $request = new Request(
//            'POST',
//            $this->getUrl(),
//            [
//                'content-type' => 'application/json',
//            ],
//            [
//                'to' => $message->to,
//                'from' => $message->from ?: $this->getFrom(),
//                'content' => $message->content,
//            ]
//        );
//
//        $response = new Guzzle()

    }
}