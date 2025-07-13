<?php

namespace App\Livewire\Admin;

use App\Models\Associate;
use App\Models\ComunalAssembly;
use App\Models\User;
use Livewire\Component;

class ComunalAssemblyTable extends Component
{
    public function render()
    {
        $comunalassemblys = ComunalAssembly::orderBy('created_at', 'desc')
            ->paginate(10);
        $users = User::all();
        return view('livewire.admin.comunal-assembly-table', compact('users','comunalassemblys'));
    }
}
