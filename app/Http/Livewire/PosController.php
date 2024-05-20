<?php

namespace App\Http\Livewire;

use App\Models\Denomination;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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

    // remplazar por completo
    public function updateQty( $product_id, $quantity = 1) {

        $title = '';
        $product = Product::find( $product_id );
        $exists = Cart::get( $product_id );

        if ( $exists ) {
            $title = 'Cantidad actualizada';
        } else {
            $title = 'Producto agregado';
        }


        if( $exists ) {

            if ( $product->stock < $quantity ) {
                $this->emit('no-stock', 'Stock insuficiente :(');
                return;
            }
        }

        $this->removeItem( $product_id );

        if ( $quantity > 0 ) {
            Cart::add( $product->id, $product->name, $product->price, $quantity, $product->image );

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok', $title);
        } 
        
    }

    public function removeItem( $product_id ) {

        Cart::remove( $product_id );

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Producto eliminado');
    }

    public function decreaseQty( $product_id ) {

        $item = Cart::get( $product_id );
        Cart::remove( $product_id );

        $newQty = ($item->quantity) - 1;

        if( $newQty > 0) {
            Cart::add($item->id, $item->name, $item->price, $newQty, $item->attributes[0] );
        }

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Cantidad actualizada');
    }

    public function clearCart() {
        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Carrito vacio');

    }

    public function saveSale() {
        if($this->total <= 0) {
            $this->emit('sale-error','Agrega productos a la venta');
            return;
        }

        if($this->efectivo <= 0) {
            $this->emit('sale-error','Ingresa el efectivo');
            return;
        }

        if($this->total > $this->efectivo){
            $this->emit('sale-error','El efectivo debe ser mayor o igual al total');
            return;
        }

        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'total'=> $this->total,
                'items'=> $this->itemsQuantity,
                'efectivo'=> $this->efectivo,
                'change'=> $this->change,
                'user_id'=> auth()->user()->id,
            ]);

            if($sale) {
                $items = Cart::getContent();

                // Detalle de venta
                foreach($items as $item) {
                    SaleDetail::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'product_id' => $item->id,
                        'sale' => $sale->id
                    ]);

                    // Actualizar stock
                    $product = Product::find($item->id);
                    $product->stock = $product->stock - $item->quantity;
                    $product->save();
                }
            }

            // Confirmar transaccion
            DB::commit();

            Cart::clear();
            $this->efectivo = 0;
            $this->change = 0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('sale-ok','Venta registrada correctamente');
            $this->emit('print-ticket', $sale->id);

        } catch(Exception $e) {
            DB::rollBack();
            $this->emit('sale-error', $e->getMessage());
        }
    }

    public function printTicket($sale) {
        return Redirect::to("print://$sale->id");
    }
}
