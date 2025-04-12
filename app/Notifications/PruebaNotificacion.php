<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PruebaNotificacion extends Notification
{
    use Queueable;


    public $titulo;
    public $texto;
    public $imagen;
    public $url;

    /**
     * PruebaNotificacion constructor.
     * @param $texto
     * @param $imagen
     * @param $url
     */
    public function __construct($titulo=null,$texto=null, $imagen=null, $url=null)
    {
        $this->titulo = $titulo ;
        $this->texto = $texto ;
        $this->imagen = $imagen ?? getLogo();
        $this->url = $url ?? route('home');
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->line($this->titulo ?? "Hola ".($notifiable->name ?? 'Usuario')." esta es una prueba de notificación")
                    ->action('Acción', $this->url)
                    ->line('Gracias por usar nuestra aplicación!');
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
            "titulo" => $this->titulo ?? "Hola ".$notifiable->name." esta es una prueba de notificación",
            "texto" => $this->texto ?? "Hola ".$notifiable->name." esta es una prueba de notificación",
            "imagen" => $this->imagen,
            "url" => $this->url
        ];
    }
}
