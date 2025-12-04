<?php

namespace App\Notifications;

use App\Models\Compra;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Markdown;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Throwable;

class NuevoIngresoParaUnidadNotification extends Notification
{
    use Queueable;

    public $compra;

    /**
     * Create a new notification instance.
     */
    public function __construct(Compra $compra)
    {
        $this->compra = $compra;
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
     * @throws Throwable
     */
    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
//            ->from('sistemasbs@sbs.gob.gt', 'Secretaría de Bienestar Social')
            ->subject('Nuevo ingreso para la unidad')
            ->view('compras.correos.nuevo_ingreso', [
                'compra' => $this->compra,
            ]);
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
