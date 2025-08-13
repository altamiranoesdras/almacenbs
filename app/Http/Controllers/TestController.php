<?php

namespace App\Http\Controllers;

use App\FirmaElectronica\FirmaElectronica;
use Illuminate\Http\Request;


class TestController extends AppBaseController
{

    function __construct()
    {

    }

    public function test()
    {
        return view('test.index');
    }

    public function firmarDocumento(Request $request){


        return (new FirmaElectronica())
            ->respuestaEnLinea() // o ->respuestaRuta() si solo quieres la ruta
            ->setDisco('public') // opcional: dónde guardar
            ->setDirectorio('firmas') // opcional: carpeta de guardado
            ->setCorreo('usuario@dominio.com') // correo de la firma electrónica
            ->setClaveFirma('mi_password_segura') // contraseña de la firma
            ->setRubricaUsuario(auth()->user()->rubrica) // firma
            ->setInicioX(250)// Opcional: posición horizontal de la firma
            ->setInicioY(15) // Opcional: posición vertical de la firma
            ->setAncho(250) // Opcional: ancho de la firma
            ->setAlto(65) // Opcional: alto de la firma
            ->setLugar("Guatemala, Guatemala") // Opcional: lugar de la firma
            ->setTipoSolicitud("PDF") // Opcional: tipo de documento (PDF, XML, TXT)
            ->setConcepto("test") // Opcional: concepto de la firma
            ->setDocumento($request->file('documento')) // documento a firmar (UploadedFile)
            ->firmarDocumento();


    }

}
