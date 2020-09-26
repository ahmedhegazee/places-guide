<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as NotificationResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends NotificationResetPassword
{
    use Queueable;
    public $token;
    public $route;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token,$route)
    {
        $this->token = $token;
        $this->route = $route;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('messages.Reset Password Notification'))
            ->line(__('messages.You are receiving this email because we received a password reset request for your account.'))
            ->action(__('messages.Reset Password'), url(config('app.url') . route($this->route, ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(__('messages.This password reset link will expire in 60 minutes.'))
            ->line(__('messages.If you did not request a password reset, no further action is required.'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}