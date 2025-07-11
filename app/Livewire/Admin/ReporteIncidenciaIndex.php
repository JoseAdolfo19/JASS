<?php

namespace App\Livewire\Admin;

use App\Models\Associate;
use Livewire\Component;

class ReporteIncidenciaIndex extends Component
{
    public function render()
    {
        $associates = Associate::all();
        return view('livewire.admin.reporte-incidencia-index', compact('associates'));
    }
}
