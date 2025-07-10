<?php

namespace App\Livewire\Admin;

use App\Models\Associate;
use Livewire\Component;

class AsociadoTable extends Component
{
    public function render()
    {
        $asociates = Associate::where('status', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.admin.asociado-table', compact('asociates'));
    }
}
