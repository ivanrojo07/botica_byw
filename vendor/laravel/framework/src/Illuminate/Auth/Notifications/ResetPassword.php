<?php

namespace Illuminate\Auth\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //     ->line('You are receiving this email because we received a password reset request for your account.')
        //     ->action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)))
        //     ->line('If you did not request a password reset, no further action is required.');

        return (new MailMessage)
            ->line('Usted acaba de recibir este correo porque usted (o alguien más) solicito el restablecimiento de su contraseña para TuFarmaciaLatina.com.')
            ->action('Restablecer contraseña', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('Si usted no hizo esta acción, por favor hacer caso omiso a este correo.');
    }
}
