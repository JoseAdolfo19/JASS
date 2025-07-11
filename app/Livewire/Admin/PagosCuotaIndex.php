<?php

namespace App\Livewire\Admin;

use App\Models\Associate;
use App\Models\QuotaPayments;
use Livewire\Component;

class PagosCuotaIndex extends Component
{
    public function render()
    {
        $associates = Associate::all();
        return view('livewire.admin.pagos-cuota-index', compact('associates'));
    }
}
