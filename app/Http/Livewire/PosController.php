<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PosController extends Component
{

    public $cart = [], $total = 0;

    public function render()
    {
        return view('livewire.pos.posComponent')
                ->extends('layouts.theme.app')
                ->section('content');
    }
}
