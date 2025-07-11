<?php

namespace App\Livewire\Admin;

use App\Models\GastoProductos;
use Livewire\Component;

class GastoProductosTable extends Component
{
     public function render()
    {
        $gastoproductos = GastoProductos::orderBy('created_at', 'desc')
        ->paginate(10);
        return view('livewire.admin.gasto-productos-table', compact('gastoproductos'));
    }
}
