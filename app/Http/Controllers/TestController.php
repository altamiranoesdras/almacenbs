<?php

namespace App\Http\Controllers;

class TestController extends AppBaseController
{

    function __construct()
    {
        
    }

    public function test()
    {
        return view('test.index');
    }

}