<?php

namespace App\Mail;

use App\Models\Compra;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecepcionCompra extends Mailable
{
    use Queueable, SerializesModels;
    public $compra;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Compra $compra)
    {
        //
        $this->compra = $compra;
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

        $this->view('emails.recepcion_compra')
            ->subject('Recepción de Compra')
            ->from(config('app.mail_negocio'),config('app.name'))
            ->to($adrress);
    }
}
