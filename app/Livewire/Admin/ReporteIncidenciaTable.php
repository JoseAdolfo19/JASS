<?php

namespace App\Livewire\Admin;

use App\Models\Associate;
use App\Models\ReportedIncidence;
use Livewire\Component;

class ReporteIncidenciaTable extends Component
{
    public function render()
    {
        $incidences = ReportedIncidence::where('status', 1)->orWhere('status', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $associates = Associate::all();
    
        return view('livewire.admin.reporte-incidencia-table', compact('incidences', 'associates'));
    }
}