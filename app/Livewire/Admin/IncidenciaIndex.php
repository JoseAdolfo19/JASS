<?php

namespace App\Livewire\Admin;

use App\Models\Associate;
use Livewire\Component;

class IncidenciaIndex extends Component
{
    public function render()
    {
        $associates = Associate::all();
        
        return view('livewire.admin.incidencia-index', compact('associates'));
    }
}
