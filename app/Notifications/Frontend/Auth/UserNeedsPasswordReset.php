<?php

namespace App\Notifications\Frontend\Auth;

use App\Channels\SmsChannel;
use App\Services\Notifications\Sms\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserNeedsPasswordReset.
 */
class UserNeedsPasswordReset extends Notification
{
    use Queueable;

    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     *
     * @return array|string
     */
    public function via($notifiable)
    {
        if ($notifiable->notification_channel == 'sms') {
            return [SmsChannel::class];
        }
        return [$notifiable->notification_channel];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(app_name().': '.__('strings.emails.auth.password_reset_subject'))
            ->greeting(__('strings.emails.auth.user_greeting', ['first_name' => $notifiable->first_name]))
            ->line(__('strings.emails.auth.password_cause_of_email'))
            ->line(__('strings.emails.auth.use_code_to_reset_email'))
            ->line($notifiable->confirmation_code)
            ->line(__('strings.emails.auth.password_if_not_requested'));
    }

    /**
     * @param  mixed $notifiable
     *
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage())
            ->content(__('strings.emails.auth.use_code_to_confirm_sms', [
                'first_name' => $notifiable->first_name,
                'code' => $notifiable->confirmation_code,
                'app_name' => app_name(),
            ]))
            ->unicode();
    }

    /**
     * @param $notifiable
     *
     * @return SmsMessage
     */
    public function toSms($notifiable)
    {
        return (new SmsMessage())
            ->content(__('use_code_to_reset_sms', [
                'first_name' => $notifiable->first_name,
                'code' => $notifiable->confirmation_code,
                'app_name' => app_name(),
            ]))
            ->to($notifiable->phone_number);
    }
}
