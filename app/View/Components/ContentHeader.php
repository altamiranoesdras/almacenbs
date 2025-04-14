<?php
// app/View/Components/ContentHeader.php

namespace App\View\Components;

use Illuminate\View\Component;

class ContentHeader extends Component
{
    public $titulo;

    public function __construct($titulo)
    {
        $this->titulo = $titulo;
    }

    public function render()
    {
        return view('components.content-header');
    }
}
