<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:38 PM
 */

namespace App\Notifications\Backend\Company\Company;

use App\Channels\SmsChannel;
use App\Services\Notifications\Sms\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class CompanyCreated
 * @package App\Notifications\Backend\Company\Company
 */

class CompanyCreated extends Notification
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
            ->subject(app_name().': '.__('strings.emails.company.company.mail.company_created'))
            ->greeting(__('strings.emails.auth.user_greeting', ['first_name' => $notifiable->owner->first_name]))
            ->line(__('strings.emails.company.company.mail.company_account_created', [
                'account' => $notifiable->name,
                'app_name' => app_name(),
            ]))
            ->action(__('labels.frontend.auth.login_button'), route('frontend.auth.login'))
            ->line(__('strings.emails.auth.thank_you_for_using_app'));
    }
    
    public function toSms($notifiable)
    {
        return (new SmsMessage())
            ->content(__('strings.emails.company.company.sms.company_created', [
                'first_name' => $notifiable->owner->first_name,
                'account' => $notifiable->name,
                'app_name' => app_name(),
            ]))
            ->content(__('strings.emails.company.company.sms.login'));
    }
}
