<?php


namespace App\Traits;


use Carbon\Carbon;

trait TieneCodigo
{



    public function establecerCodigo()
    {

        if ($this->codigo) return;

        $prefijoCodigo= $this->prefijoCodigo ?? '';

        $correlativo = self::whereRaw('year(created_at) ='.Carbon::now()->year)
            ->max('correlativo');

        $correlativo = $correlativo ? $correlativo+1 : 1;

        $this->correlativo = $correlativo;
        $this->codigo = $prefijoCodigo.prefijoCeros($correlativo,4)."-".Carbon::now()->year;

    }


}
