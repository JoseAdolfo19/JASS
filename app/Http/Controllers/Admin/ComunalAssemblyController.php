<?php

namespace App\Http\Controllers\Admin; // Solo esta línea debe estar aquí

use App\Http\Controllers\Controller;
use App\Models\ComunalAssembly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ComunalAssemblyController extends Controller
{
    public function index()
    {
        return view('admin.comunalassembly.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'assembly_date' => 'required|date',
            'reason_call' => 'required|string|max:255',
            'main_agreements' => 'required|string|max:255',
            'number_attendees' => 'required|string|max:100',
        ]);
        try {
            $validator->validate();

            ComunalAssembly::create([
                'user_id' => $request->user_id,
                'assembly_date' => $request->assembly_date,
                'reason_call' => $request->reason_call,
                'main_agreements' => $request->main_agreements,
                'number_attendees' => $request->number_attendees,
            ]);
            return redirect()->route('admin.comunalassembly.index')
                ->with('success', 'Registro de Asamblea generada con éxito.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())
                ->withInput();
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'assembly_date' => 'required|date',
            'reason_call' => 'required|string|max:255',
            'main_agreements' => 'required|string|max:255',
            'number_attendees' => 'required|string|max:100',
        ]);
        try {
            $validator->validate();

            $comunalassembly = ComunalAssembly::findOrFail($id);
            $comunalassembly->update([
                'user_id' => $request->user_id,
                'assembly_date' => $request->assembly_date,
                'reason_call' => $request->reason_call,
                'main_agreements' => $request->main_agreements,
                'number_attendees' => $request->number_attendees,
            ]);

            return redirect()->route('admin.comunalassembly.index')
                ->with('success', 'Registro de Asamblea actualizado con éxito.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())
                ->withInput();
        }
    }

    public function destroy(string $id)
    {
        ComunalAssembly::findOrFail($id)->delete();
        return redirect()->route('admin.comunalassembly.index')->with('success', 'El registro de Asamblea ha sido eliminado correctamente.');
    }
}