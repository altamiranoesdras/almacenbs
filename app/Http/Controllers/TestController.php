<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use Illuminate\Http\Request;
use App\FirmaElectronica\FirmaElectronica;
use Illuminate\Support\Facades\Storage;

class TestController extends AppBaseController
{

    function __construct()
    {

    }

    public function test()
    {
        return view('home');
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
