<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StockCriticoPorVentaMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    public $items;
    /**
     * @var
     */
    public $tienda;
    /**
     * @var Venta
     */
    public $venta;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($items,Venta $venta)
    {

        $this->items = $items;
        $this->venta = $venta;
        $this->tienda = Tienda::find($venta->local->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $adrress = mailsAdmins();

        if(env('APP_DEBUG')){
            $adrress[] = config('app.mail_pruebas');
        }

        return $this->view('emails.stock_critico_mail')
            ->subject('Stock crítico')
            ->from(config('app.mail_negocio'),config('app.name'))
            ->to($adrress);
    }
}
