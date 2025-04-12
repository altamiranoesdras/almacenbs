<?php

namespace App\Mail;

use App\Models\Solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitudStock extends Mailable
{
    use Queueable, SerializesModels;
    public $solicitud;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Solicitude $solicitud)
    {
        //
        $this->solicitud = $solicitud;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $adrress = [];

        if(env('APP_DEBUG')){
            $adrress[] = config('app.mail_pruebas');
        }

        $adrress = array_merge($adrress,mailsAdmins());

        $this->view('emails.solicitud_stock')
            ->subject('Solicitud de Stock')
            ->from(config('app.mail_negocio'),config('app.name'))
            ->to($adrress);
    }
}
