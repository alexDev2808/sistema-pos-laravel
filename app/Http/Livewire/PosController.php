<?php

namespace App\Http\Livewire;

use App\Models\Denomination;
use Livewire\Component;

class PosController extends Component
{

    public $cart = [], $total = 0, $itemsQuantity = 0, $denominations = [], $efectivo, $change;

    public function render()
    {
        $this->denominations = Denomination::all();

        return view('livewire.pos.posComponent')
                ->extends('layouts.theme.app')
                ->section('content');
    }
}
