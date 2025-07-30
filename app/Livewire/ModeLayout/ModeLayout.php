<?php

namespace App\Livewire\ModeLayout;

use App\Models\UserConfiguration;
use Livewire\Component;

class ModeLayout extends Component
{

    public $theme;

    public function mount()
    {

//        $this->theme = UserConfiguration::where('user_id', auth()->user()->id)->where('key', 'app.mode-layout')->get()->first();
//
//        if(!$this->theme) {
////            $this->theme = new UserConfiguration();
////            $this->theme->user_id = auth()->user()->id;
////            $this->theme->key = 'app.mode-layout';
////            $this->theme->value = 'light-layout'; // Default value
////            $this->theme->descripcion = 'Cambio de modo de la aplicación dark o light';
////            $this->theme->save();
//        }
//
//        session(['mode-layout' => $this->theme->value]);
    }

    public function changeMode()
    {
        if ($this->theme->value == 'dark-layout') {
            $this->theme->value = 'light-layout';
        } else {
            $this->theme->value = 'dark-layout';
        }

        $this->theme->save();
        session(['mode-layout' => $this->theme->value]);
    }

    public function render()
    {
        return view('livewire.mode-layout.mode-layout');
    }
}
