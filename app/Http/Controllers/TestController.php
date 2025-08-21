<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use Illuminate\Http\Request;
use App\FirmaElectronica\FirmaElectronica;
use Storage;

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
    

        $url_rubrica =  env('app_url'). Storage::url($request->file('rubrica')->store('rubrica', 'public')); // Guardar la rúbrica en el disco público


        return (new FirmaElectronica())
            ->respuestaEnLinea() // o ->respuestaRuta() si solo quieres la ruta
            ->setDisco('public') // opcional: dónde guardar
            ->setDirectorio('firmas') // opcional: carpeta de guardado
            ->setCorreo(env('EMAIL_FIRMA_ELECTRONICA')) // correo de la firma electrónica
            ->setClaveFirma(env('PASSWORD_FIRMA_ELECTRONICA')) // contraseña de la firma
            ->setRubrica($url_rubrica) // archivo de la rúbrica del usuario (ruta)
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

    public function reverb(){
        return view('reverb.index');
    }

    public function testEvent()
    {
        event(new TestEvent('Hello, this is a test message!'));
        return 'Event has been dispatched!';
    }

}
