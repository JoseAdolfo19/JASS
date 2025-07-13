<?php

namespace App\Livewire\Admin;

use App\Models\Associate;
use App\Models\User;
use Livewire\Component;

class TaskIndex extends Component
{
    public function render()
    {
        $users = User::all();
        return view('livewire.admin.task-index', compact('users'));
    }
}
    
