<?php

namespace App\Http\Livewire;

use App\Models\Denomination;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class CoinsController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $componentName, $pageTitle, $selected_id, $image, $search, $type, $value;
    public $pagination = 5;

    public function mount(){
        $this->componentName = "Denominaciones";
        $this->pageTitle = 'Listado';
        $this->selected_id = 0;
        $this->type = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {

        if ( strlen($this->search) > 0) { 
            $data = Denomination::where('type','like','%'. $this->search .'%')->paginate($this->pagination);
        } else {
            $data = Denomination::orderBy('id','desc')->paginate($this->pagination);
        }

        return view('livewire.denominations.coinsComponent', [
            'coins' => $data
        ])
                ->extends('layouts.theme.app')
                ->section('content');
    }

    public function Edit($id) {
        $record = Denomination::find($id, ['id', 'type', 'value', 'image']);
        $this->type = $record->type;
        $this->value = $record->value;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal', 'show modal');
    }

    public function Store() {
        $rules = [
            'type'=> 'required|not_in:Elegir',
            'value'=> 'required|unique:denominations',
        ];

        $messages = [
            'type.required'=> 'El tipo es requerido',
            'type.not_in'=> 'Elige un valor diferente de Elegir',
            'value.required'=> 'El valor es requerido',
            'value.unique'=> 'Ya existe el valor',
        ];

        $this->validate($rules, $messages);

        $denomination = Denomination::create([
            'type'=> $this->type,
            'value'=> $this->value
        ]);

        if ( $this->image ) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominaciones', $customFileName);
            $denomination->image = $customFileName;
            $denomination->save();
        }

        $this->resetUI();
        $this->emit('item-added', 'Denominacion registrada');
        
    }

    public function Update() {
        $rules = [
            'type'=> 'required|not_in:Elegir',
            'value'=> "required|unique:denominations,value,{$this->selected_id}",
        ];

        $messages = [
            'type.required'=> 'El tipo es requerido',
            'type.not_in'=> 'Elige un valor diferente de Elegir',
            'value.required'=> 'El valor es requerido',
            'value.unique'=> 'Ya existe el valor',
        ];

        $this->validate($rules, $messages);

        $denomination = Denomination::find($this->selected_id);
        $denomination->update([
            'type' => $this->type,
            'value'=> $this->value
        ]);

        if ( $this->image ) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominaciones', $customFileName);
            $imageTemp = $denomination->image;
            $denomination->image = $customFileName;
            $denomination->save();

            if($imageTemp != null) {
                if( file_exists('storage/denominaciones' . $imageTemp )){
                    unlink('storage/denominations'. $imageTemp);
                }
            }
        }

        $this->resetUI();
        $this->emit('item-added', 'Denominacion registrada');

    }

    public function resetUI() {
        $this->type = '';
        $this->value = '';
        $this->image = null;
        $this->search = '';
        $this->selected_id = 0;
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy( Denomination $denomination ) {
        
        $imageTemp = $denomination->image;
        $denomination->delete();

        if( $imageTemp != null ) {
            unlink('storage/denominaciones/'. $imageTemp);
        }

        $this->resetUI();
        $this->emit('item-deleted', 'Denominacion eliminada');
    }
}
