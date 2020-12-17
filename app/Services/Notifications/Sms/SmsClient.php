<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 8/6/19
 * Time: 9:06 AM
 */

namespace App\Services\Notifications\Sms;


use App\Exceptions\GeneralException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Webpatser\Uuid\Uuid;

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
        return config('services.sms.key');
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getApiSecret()
    {
        return config('services.sms.secret');
    }
    
    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getApiVersion()
    {
        return config('services.sms.api_version');
    }
    
    /**
     * @param $message
     * @throws \Exception
     */
    public function send($message)
    {
        $smsClient = new Client([
            'timeout'         => 120,
            'connect_timeout' => 120,
            'allow_redirects' => true,
            'headers' => ['content-type' => 'application/json']
        ]);
        $query = [
            'version' => $this->getApiVersion(),
            'phone' => $this->getApiKey(),
            'from' => $this->getFrom(),
            'to' => substr($message['to'], -9),
            'text' => $message['content'],
            'id' => Uuid::generate(4)->string
        ];
        
        $url = $this->getUrl() . '/sendsms';
        
        \Log::debug("{$this->getClientName()}: Sending new SMS", [
            'url' => $url,
            'query' => $query
        ]);
        
        $query['password'] = $this->getApiSecret();
        
        try {
            $response = $smsClient->request('GET', $url, [
                'query' => $query
            ]);
            $content = $response->getBody()->getContents();
            if ($content == '200') {
                \Log::info("{$this->getClientName()}: SMS sent successfully", [
                    'server message' => $content,
                    'status code' => $response->getStatusCode(),
                ]);
            } else {
                \Log::error("{$this->getClientName()}: There was an error sending the SMS from the SMS Service provider", [
                    'server message' => $content,
                    'status code' => $response->getStatusCode(),
                ]);
                throw new GeneralException(__('exceptions.frontend.auth.sms.send_error'));
            }
            
        } catch (BadResponseException $exception) {
            \Log::error("{$this->getClientName()}: There was an error sending the SMS from the SMS Service provider", [
                'server message' => $exception->getResponse()->getBody()->getContents(),
                'status code' => $exception->getResponse()->getStatusCode(),
            ]);
            throw new GeneralException(__('exceptions.frontend.auth.sms.send_error'));
        } catch (\Exception $exception) {
            \Log::error("{$this->getClientName()}: There was a connection problem sending request to SMS provider", [
                'message' => $exception->getMessage()
            ]);
            throw new GeneralException(__('exceptions.frontend.auth.sms.send_error'));
        }
    }
    
    public function getClientName()
    {
        return class_basename($this);
    }
}
