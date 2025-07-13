<?php

namespace App\Livewire\Admin;

use App\Models\Associate;
use App\Models\Task;
use App\Models\User;
use Livewire\Component;

class TaskTable extends Component
{
    public function render()
    {
        $tasks = Task::orderBy('created_at', 'desc')
            ->paginate(10);
        $users = User::all();
        return view('livewire.admin.task-table', compact('tasks','users'));
    }
}
