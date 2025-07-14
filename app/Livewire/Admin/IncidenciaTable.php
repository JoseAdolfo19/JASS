<?php

namespace App\Livewire\Admin;

use App\Models\Associate;
use App\Models\Incidence;
use Livewire\Component;

class IncidenciaTable extends Component
{
    public function render()
    {
        $incidences = Incidence::where('status', 1)->orWhere('status', 0)
            ->orderBy('created_at', 'asc')
            ->paginate(10);
        $associates = Associate::with('associate');
        return view('livewire.admin.incidencia-table', compact('incidences', 'associates'));
    }
}

