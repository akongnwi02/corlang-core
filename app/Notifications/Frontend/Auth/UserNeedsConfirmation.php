<?php

namespace App\Notifications\Frontend\Auth;

use App\Channels\SmsChannel;
use App\Services\Notifications\Sms\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserNeedsConfirmation.
 */
class UserNeedsConfirmation extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        if ($notifiable->notification_channel == 'sms') {
            return [SmsChannel::class];
        }
        return [$notifiable->notification_channel];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(app_name().': '.__('exceptions.frontend.auth.confirmation.confirm'))
            ->greeting(__('strings.emails.auth.user_greeting', ['first_name' => $notifiable->first_name]))
            ->line(__('strings.emails.auth.use_code_to_confirm'))
            ->line($notifiable->confirmation_code)
            ->line(__('strings.emails.auth.thank_you_for_using_app'));
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

    public function toSms($notifiable)
    {
        return (new SmsMessage())
            ->content(__('strings.emails.auth.use_code_to_confirm_sms', [
                'first_name' => $notifiable->first_name,
                'code' => $notifiable->confirmation_code,
                'app_name' => app_name(),
            ]))
            ->to($notifiable->phone_number);
    }
}
