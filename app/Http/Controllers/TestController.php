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
            ->setCorreo(auth()->user()->email) // correo de la firma electrónica
            ->setClaveFirma($request->password) // contraseña de la firma
            ->setRubricaUsuario(auth()->user()->rubrica) // archivo de la rúbrica del usuario (ruta)
            ->setInicioX($request->firma_inicio_x)// Opcional: posición horizontal de la firma
            ->setInicioY($request->firma_inicio_y) // Opcional: posición vertical de la firma
            ->setAncho($request->firma_ancho) // Opcional: ancho de la firma
            ->setAlto($request->firma_alto) // Opcional: alto de la firma
            ->setLugar($request->lugar) // Opcional: lugar de la firma
            ->setTipoSolicitud($request->tipo_solicitud) // Opcional: tipo de solicitud (PDF, XML, etc.)
            ->setConcepto($request->concepto) // Opcional: concepto de la firma
            ->setDocumento($request->file('documento')) // documento a firmar (UploadedFile)
            ->firmarDocumento();

    }

}
