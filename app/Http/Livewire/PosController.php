<?php

namespace App\Http\Livewire;

use App\Models\Denomination;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;

class PosController extends Component
{

    public $total, $itemsQuantity, $efectivo, $change;

    public function mount() {
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    public function render()
    {
        $denominations = Denomination::orderBy('value', 'desc')->get();
        $cart = Cart::getContent()->sortBy('name');

        return view('livewire.pos.posComponent', [
            'denominations' => $denominations,
            'cart' => $cart
        ])
                ->extends('layouts.theme.app')
                ->section('content');
    }

    public function ACash( $value ) {
        $this->efectivo += ( $value == 0 ? $this->total : $value );
        $this->change = ($this->efectivo - $this->total);
    }

    protected $listeners = [
        'scan-code'=> 'ScanCode',
        'remove-item'=> 'removeItem',
        'clear-cart' => 'clearCart',
        'save-sale'=> 'saveSale'
    ];
}
