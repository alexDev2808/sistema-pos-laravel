<?php

namespace App\Http\Livewire;

use App\Models\Denomination;
use App\Models\Product;
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

    public function ScanCode( $barcode, $quantity = 1 ) {
        $product = Product::where('barcode', $barcode)->first();

        if ( $product == null || empty($product) ) {
            $this->emit('scan-notfound', 'El producto no esta registrado');
        } else {

            if( $this->InCart( $product->id )) {
                $this->increaseQty( $product->id );
                return;
            }

            if ( $product->stock < 1 ) {
                $this->emit('no-stock', 'Stock insuficiente :(');
                return;
            }

            Cart::add( $product->id, $product->name, $product->price, $quantity, $product->image );
            $this->total = Cart::getTotal();

            $this->emit('scan-ok', 'Producto agregado');
        }

    }

    public function InCart( $product_id ) {

        $exists = Cart::get( $product_id );

        return $exists ? true : false;
    }

    public function increaseQty( $product_id, $quantity = 1) {

        $title = '';
        $product = Product::find( $product_id );
        $exists = Cart::get( $product_id );

        if ( $exists ) {
            $title = 'Cantidad actualizada';
        } else {
            $title = 'Producto agregado';
        }

        if ( $exists ) {
            
            if ( $product->stock < ($quantity + $exists->$quantity ) ) {
                $this->emit('no-stock', 'Stock insuficiente :(');
                return;
            }
        }

        // add verifica si existe y actualiza, sino agrega
        Cart::add( $product->id, $product->name, $product->price, $quantity, $product->image);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', $title);
    }
}
