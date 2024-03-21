<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductsController extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $name, $barcode, $cost, $price, $stock, $alerts, $category_id, $image;
    public $componentName, $pageTitle, $search, $selected_id; 
    public $pagination = 5;

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function mount() {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->category_id = 'Elegir';
    }

    public function render()
    {
        if( strlen($this->search) > 0 ) {
            $products = Product::join('categories as c', 'c.id', 'products.category_id')
                        ->select('products.*', 'c.name as category')
                        ->where('products.name', 'like', '%' . $this->search .'%')
                        ->orWhere('products.barcode', 'like', '%' . $this->search .'%')
                        ->orWhere('c.name', 'like', '%' . $this->search .'%')
                        ->orderBy('products.name', 'asc')
                        ->paginate($this->pagination);
        } else {
            $products = Product::join('categories as c', 'c.id', 'products.category_id')
                        ->select('products.*', 'c.name as category')
                        ->orderBy('products.name', 'asc')
                        ->paginate($this->pagination);
        }


        return view('livewire.products.productsComponent', [
            'products' => $products,
            'categories' => Category::orderBy('name', 'asc')->get(),
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function resetUI(){
        
    }

    public function Store() {
        $rules = [
            'name' => 'required|unique:products|min:3',
            'cost' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'alerts' => 'required',
            'category_id' => 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required'=> 'El nombre es requerido',
            'name.unique' => 'Ya existe ese nombre',
            'name.min' => 'El nombre debe tener minimo 3 caracteres',
            'cost.required' => 'El costo es requerido',
            'price.required' => 'El precio es requerido',
            'stock.required' => 'El stock es requerido',
            'alerts.required' => 'El valor minimo de existencias es requerido',
            'category_id.not_in' => 'Elige un nombre diferente a Elegir',
        ];

        $this->validate($rules, $messages);

        $product = Product::create([
            'name' => $this->name,
            'cost' => $this->cost,
            'price'=> $this->price,
            'barcode' => $this->barcode,
            'stock' => $this->stock,
            'alerts' => $this->alerts,
            'category_id' => $this->category_id,
        ]);

        if( $this->image ) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/productos', $customFileName);
            $product->image = $customFileName;

            $product->save();
        }

        $this->resetUI();
        $this->emit('product-added', 'Producto agregado');

    }
}
