<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads; // trait -> img a back
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $search, $image, $selected_id, $pageTitle, $componentName;
    private $pagination = 2;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorias';
    }

    public function paginationView() {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if( strlen($this->search) > 0 ){
            $data = Category::where('name', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        } else {
            $data = Category::orderBy('id', 'desc')->paginate($this->pagination);
        }

        return view('livewire.category.categories', [ 'categories' => $data ])
                ->extends('layouts.theme.app')
                ->section('content');
    }
}
