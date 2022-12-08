<?php

namespace App\Mail;

use App\Models\Solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StockCriticoPorSolicitudMail extends Mailable
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
     * @var Solicitude
     */
    public $solicitud;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($items,Solicitude $solicitud)
    {

        $this->items = $items;
        $this->tienda = Tienda::find($solicitud->user->tienda->id);
        $this->solicitud = $solicitud;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $adrress = ['info@itsb.cl'];

        if(env('APP_DEBUG')){
            $adrress[] = config('app.mail_pruebas');
        }

        return $this->view('emails.stock_critico_mail')
            ->subject('Stock crítico')
            ->from(config('app.mail_negocio'),config('app.name'))
            ->to($adrress);
    }
}
