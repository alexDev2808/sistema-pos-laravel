<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductsController extends Component
{

    public $componentName, $pageTitle; 

    public function render()
    {
        return view('livewire.products.productsComponent');
    }
}
