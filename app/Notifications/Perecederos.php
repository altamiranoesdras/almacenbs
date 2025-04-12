<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Perecederos extends Notification
{
    use Queueable;

    protected  $stocks;
    protected  $tienda;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($stocks,$tienda)
    {
        //
        $this->stocks = $stocks;
        $this->tienda = $tienda;
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
            ->markdown('emails.items_vencen',['stocks' => $this->stocks,'user' => $notifiable])
            ->subject('Bodega/Sucursal '.$this->tienda->nombre.': Items Vencidos o Próximos a Vencer');

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
