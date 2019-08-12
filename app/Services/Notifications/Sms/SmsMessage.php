<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 8/6/19
 * Time: 9:06 AM
 */

namespace App\Services\Notifications\Sms;

class SmsMessage
{
    /**
     * Receiver of the message
     *
     * @var $to
     */
    public $to;

    /**
     * Sender of the message
     *
     * @var $from
     */
    public $from;

    /**
     * The message content
     *
     * @var $content
     */
    public $content;

    /**
     * @param mixed $to
     * @return SmsMessage
     */
    public function to($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @param mixed $from
     * @return SmsMessage
     */
    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @param mixed $content
     * @return SmsMessage
     */
    public function content($content)
    {
        $this->content = $content;
        return $this;
    }
}