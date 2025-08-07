<?php

namespace App\Http\Controllers;

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

        // dd($request); // Debugging: dump all request data

        $firmaElectronica = new \App\FirmaElectronica\FirmaElectronica();

        // $data = $request->all(); // Get all data from the request

        $response = $firmaElectronica->firmarDocumento($request);

        dd($response);
    }

}