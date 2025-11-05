<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnviarEnlaceNotificacion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        /**
         * @var User $user
         */
        $user = $notifiable;

        return (new MailMessage)
                    ->subject("Enlace y credenciales acceso sistema almacén")
                    ->greeting("Buen día ".($user->name ?? "name"))
                    ->from(env('MAIL_USERNAME'),config('app.name'))
                    ->line('A continuación se te proporcionan tus credenciales para usar el sistema de almacén')
                    ->line('Usuario: '.($user->username ?? "username"))
                    ->line('Contraseña: 123')
                    ->action('Ingresar al sistema', route('login'))
                    ->salutation('Gracias por usar nuestra aplicación!');
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
