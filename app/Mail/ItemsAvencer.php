<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ItemsAvencer extends Mailable
{
    use Queueable, SerializesModels;

    public $stocks;
    public $tienda;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($stocks,$tienda)
    {

        $this->stocks = $stocks;
        $this->tienda = $tienda;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->view('emails.items_vencen')
            ->subject($this->tienda->nombre.': Items Vencidos o Próximos a Vencer')
            ->from(config('app.mail_negocio'),config('app.name'));
    }
}
