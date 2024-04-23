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

    public function mount(){
        $this->componentName = "Denominaciones";
        $this->pageTitle = 'Listado';
        $this->selected_id = 0;
    }

    public function render()
    {
        return view('livewire.denominations.coinsComponent', [
            'coins' => Denomination::paginate(5)
        ])
                ->extends('layouts.theme.app')
                ->section('content');
    }

    public function resetUI() {

    }
}
