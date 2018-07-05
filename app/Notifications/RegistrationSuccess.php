<?php

namespace App\Notifications;

use App\Fictionary\Auth\Activation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegistrationSuccess extends Notification
{
    use Queueable;

    /**
     * The activation token of the new user
     *
     * @var Activation
     */
    private $activation;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Activation $activation)
    {
        $this->activation = $activation;
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
                    ->line('Welcome to Fictionary! Click the button to activate your account.')
                    ->action('Activate', route('account.activation', [
                        'activation' => $this->activation->token,
                        'email' => $notifiable->email,
                    ]))
                    ->line('Thank you for signing up!');
    }
}
