<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{

    public function index()
    {
        return view('admin.task.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string|max:255',
            'date_task' => 'required|date',
            'type_task' => 'required|string|max:255',
            'number_participants' => 'required|string|max:100',
        ]);
        try {
            $validator->validate();

            Task::create([
                'user_id' => $request->user_id,
                'description' => $request->description,
                'date_task' => $request->date_task,
                'type_task' => $request->type_task,
                'number_participants' => $request->number_participants,
            ]);
            return redirect()->route('admin.task.index')
                ->with('success', 'Registro de Faena generada con exito.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())
                ->withInput();
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string|max:255',
            'date_task' => 'required|date',
            'type_task' => 'required|string|max:255',
            'number_participants' => 'required|string|max:100',
        ]);
        try {
            $validator->validate();

            $task = Task::findOrFail($id);
            $task->update([
                'user_id' => $request->user_id,
                'description' => $request->description,
                'date_task' => $request->date_task,
                'type_task' => $request->type_task,
                'number_participants' => $request->date_resolved,

            ]);

            return redirect()->route('admin.task.index')
                ->with('success', 'Registro de Faena actualizado con éxito.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())
                ->withInput();
        }
    }

    public function destroy(string $id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->route('admin.task.index')->with('success', 'El regsitro de Faena a sido eliminado correctamente.');
    }
}
