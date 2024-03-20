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
    private $pagination = 5;
    private $customFileName;

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

    public function Edit( $id ) {

        $record = Category::find( $id, ['id', 'name', 'image'] );

        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal', 'show modal!');

    }

    public function Store() {
        
        $rules = [
            'name' => 'required|unique:categories|min:3'
        ];

        $messages = [
            'name.required' => 'El nombre de la categoria es requerido',
            'name.unique' => 'Ya existe la categoria',
            'name.min' => 'Nombre no valido, minimo 3 caracteres',
        ];

        $this->validate( $rules, $messages );

        $category = Category::create([
            'name' => $this->name
        ]);

        if( $this->image ) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/categorias', $customFileName);
            $category->image = $customFileName;
            $category->save();
        }

        $this->resetUI();
        $this->emit('category-added','Categoria agregada');

    }

    public function Update() {
        $rules = [
            'name' => "required|min:3|unique:categories,name,{$this->selected_id}"
        ];
        $messages = [
            'name.required' => 'Nombre de categoria requerido',
            'name.min' => 'Nombre no valido, minimo 3 caracteres',
            'name.unique' => 'Nombre de categoria ya existe'
        ];

        $this->validate( $rules, $messages );

        $category = Category::find($this->selected_id);
        $category->update([
            'name' => $this->name
        ]);

        if( $this->image ) {
            $customFileName = uniqid() . '_.'. $this->image->extension();
            $this->image->storeAs('public/categorias', $customFileName);
            $imageName = $category->image;

            $category->image = $customFileName;
            $category->save();

            if( $imageName != null ) {
                if( file_exists('storage/categorias' . $imageName)){
                    unlink('storage/categorias'. $imageName);
                }
            }
        }

        $this->resetUI();
        $this->emit('category-updated','Categoria actualizada');

    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy( Category $category ) {

        $imageName = $category->image; // img temporal
        $category->delete();

        if( $imageName != null ) {
            unlink('storage/categorias/'. $imageName);
        }

        $this->resetUI();
        $this->emit('category-deleted','Categoria eliminada');
    }

    public function resetUI() {

        $this->name = '';
        $this->image = null;
        $this->search = '';
        $this->selected_id = 0;

    }

}
