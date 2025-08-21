<?php

namespace App\Http\Controllers;

use App\Models\UserConfiguration;

class LayoutController extends Controller
{
    public function changeLayout()
    {

        $theme = UserConfiguration::where('user_id', auth()->user()->id)->where('key', 'app.mode-layout')->get()->first();

       if(!$theme) {
           $theme = new UserConfiguration();
           $theme->user_id = auth()->user()->id;
           $theme->key = 'app.mode-layout';
           $theme->value = 'dark-layout'; // Default value
           $theme->descripcion = 'Cambio de modo de la aplicación dark o light';
           $theme->save();
       }else{

           if ($theme->value == 'dark-layout') {
                $theme->value = 'light-layout';
            } else {
                $theme->value = 'dark-layout';
            }
    
            $theme->save();
        }
        
        session(['mode-layout' => $theme->value]);

        return response()->json(['message' => 'Layout changed successfully']);
    }
}
