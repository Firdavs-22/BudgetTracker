<?php

namespace App\Notifications;

use Carbon\CarbonInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class ResetPasswordCode extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($code, $expiresAt)
    {
        $this->code = $code;
        $this->expiresAt = $expiresAt;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
//            ->action('Reset Your Password', url("/password/reset?email={$notifiable->email}&code={$this->code}"))
        return (new MailMessage)
            ->subject('🔐 Password Reset Code')
            ->greeting("Hello {$notifiable->name},")
            ->line("We received a request to reset your password.")
            ->line("🔢 **Your password reset code is:** `{$this->code}`")
            ->line("⏰ **This code will expire after:** " . Carbon::now()->diffForHumans($this->expiresAt, [
                    'syntax' => CarbonInterface::NO_ZERO_DIFF,
                    'parts' => 2,
                ]))
            ->line("If you did not request a password reset, please ignore this email or contact support if you have concerns.")
            ->salutation('Regards,')
            ->salutation(config('app.name') . ' Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
