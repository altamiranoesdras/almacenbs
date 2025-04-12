<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Markdown;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StockCriticoNotificacion extends Notification
{
    use Queueable;

    public $itemsStockCritico;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($itemsStockCritico)
    {
        $this->itemsStockCritico = $itemsStockCritico;
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

        $itemsStockCritico = $this->itemsStockCritico;

        $items = Markdown::parse(view('emails.parse_markdown.stock_critico_mail',compact('itemsStockCritico')));

        return (new MailMessage)
                    ->subject('Stock critico')
                    ->greeting("Hola ".($user->name ?? "name"))
                    ->from(env('MAIL_USERNAME'),config('app.name'))
                    ->line('Se ha alcanzado el stock crítico para los siguientes artículos')
                    ->line($items)
                    ->action('Reporte Stock Critico', route('reportes.stock'))
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
