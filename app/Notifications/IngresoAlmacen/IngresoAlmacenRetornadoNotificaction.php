<?php

namespace App\Notifications\IngresoAlmacen;

use App\Models\Compra;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IngresoAlmacenRetornadoNotificaction extends Notification
{
//    use Queueable;


    public Compra $compra;

    /**
     * Create a new notification instance.
     */
    public function __construct(Compra $compra, $url)
    {
        $this->compra = $compra;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        /**
         * @var \App\Models\Compra $compra
         */
        $compra  = $this->compra;
        /**
         * @var \App\Models\User $usuario
         */
        $usuario = $notifiable;

        $estaEnLocal = app()->environment('local');

        $subjectPrefix = $estaEnLocal ? '(Correo de prueba) ' : '';

        return (new MailMessage)
            ->subject("{$subjectPrefix}Ingreso en almacén #{$compra->id}")
            ->greeting('¡Hola!')
            ->line($usuario->name)
            ->line('')
            ->line('Te informamos que se retornó el ingreso almacén:')
            ->line("**Número de 1H:** {$compra->compra1h->folio}")
            ->line("**Factura serie:** {$compra->serie}")
            ->line("**Factura número:** {$compra->numero}")
            ->line("**Creado por:** {$compra->usuarioCrea->name}")
            ->line('')
            ->line("Este mismo recientemente ha cambiado al estado: **{$compra->estado->nombre}**, favor darle el respectivo seguimiento.")
            ->action('Ir a la bandeja', $this->url)
            ->line('Gracias por tu atención.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $compra = $this->compra;

        return [
            "titulo" => "Ingreso en almacén #{$compra->compra1h->folio} retornado",
            "texto" => "La compra con factura **{$compra->serie}-{$compra->numero}**, creada por **{$compra->usuarioCrea->name}**, ha cambiado su estado a **{$compra->estado->nombre}**.",
            "imagen" => $compra->usuarioCrea->img ?? null,
            "url" => $this->url
        ];
    }
}
