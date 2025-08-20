<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NoticiaPrueba extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // correo y base de datos
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('📢 Noticia de Prueba')
            ->from(config('mail.from.address'), config('app.name'))
            ->greeting('¡Hola!')
            ->line('Esta es una notificación de prueba generada en Laravel 10.')
            ->action('Visitar el sitio', url('/'))
            ->line('')
            ->line('¡Gracias por probar el sistema de notificaciones!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'titulo' => 'Noticia de Prueba',
            'mensaje' => 'Esta es una notificación de prueba guardada en la base de datos.',
            'url' => url('/'),
        ];
    }
}
