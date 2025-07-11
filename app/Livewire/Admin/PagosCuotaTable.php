<?php

namespace App\Livewire\Admin;

use App\Models\Associate;
use App\Models\QuotaPayments;
use Livewire\Component;

class PagosCuotaTable extends Component
{
   public function render()
    {
        $pagos = QuotaPayments::where('status', 1)
            ->orWhere('status', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $associates = Associate::all();
        return view('livewire.admin.pagos-cuota-table', compact('pagos', 'associates'));
    }
}
