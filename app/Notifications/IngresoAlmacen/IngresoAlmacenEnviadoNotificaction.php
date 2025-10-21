<?php

namespace App\Notifications\IngresoAlmacen;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IngresoAlmacenEnviadoNotificaction extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($compra)
    {
        /**
         * @var \App\Models\Compra $compra
         */
        $this->compra = $compra;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
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
            ->subject("{$subjectPrefix}Nuevo ingreso en almacén #{$compra->id}")
            ->greeting('¡Hola!')
            ->line($usuario->name)
            ->line('')
            ->line('Tienes un nuevo ingreso almacén:')
            ->line("**Número de 1H:** {$compra->compra1h->id}")
            ->line("**Factura serie:** {$compra->serie}")
            ->line("**Factura número:** {$compra->numero_factura}")
            ->line("**Creado por:** {$compra->usuarioCrea->name}")
            ->line('')
            ->line("Este mismo recientemente ha cambiado al estado: **{$compra->estado->nombre}**, favor darle el respectivo seguimiento.")
            ->action('Ir a la bandeja', route('bandejas.compras1h.operador'))
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
            "titulo" => "Nuevo ingreso en almacén #{$compra->numero_h}",
            "texto" => "La compra con factura **{$compra->serie}-{$compra->numero_factura}**, creada por **{$compra->usuarioCrea->name}**, ha cambiado su estado a **{$compra->estado->nombre}**.",
            "imagen" => $compra->usuarioCrea->profile_photo_url ?? null,
            "url" => route('bandejas.compras1h.operador'),
        ];
    }

}
