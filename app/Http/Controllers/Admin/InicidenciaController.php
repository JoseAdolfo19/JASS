<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InicidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.incidencia.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'associate_id' => 'required|exists:associates,id',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date_reported' => 'required|date',
            'date_resolved' => 'nullable|date',
            'type_incidence' => 'required|string|max:50',
            'repair_cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:pendiente,resuelto',
        ]);

        try {
            $validator->validate();

            $incidence = Incidence::create([
                'associate_id' => $request->associate_id,
                'description' => $request->description,
                'location' => $request->location,
                'date_reported' => $request->date_reported,
                'date_resolved' => $request->date_resolved,
                'type_incidence' => $request->type_incidence,
                'repair_cost' => $request->repair_cost,
                'status' => $request->status=="pendiente" ? 0 : 1, 
            ]);

            return redirect()->route('admin.incidencia.index')
                ->with('success', 'Incidencia creada exitosamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())
                         ->withInput();
        }
    }   
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'associate_id' => 'required|exists:associates,id',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date_reported' => 'required|date',
            'date_resolved' => 'nullable|date',
            'type_incidence' => 'required|string|max:50',
            'repair_cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:pendiente,resuelto',
        ]);

        try {
            $validator->validate();

            $incidence = Incidence::findOrFail($id);
            $incidence->update([
                'associate_id' => $request->associate_id,
                'description' => $request->description,
                'location' => $request->location,
                'date_reported' => $request->date_reported,
                'date_resolved' => $request->date_resolved,
                'type_incidence' => $request->type_incidence,
                'repair_cost' => $request->repair_cost,
                'status' => $request->status=="pendiente" ? 0 : 1, 
            ]);

            return redirect()->route('admin.incidencia.index')
                ->with('success', 'Incidencia actualizada exitosamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())
                         ->withInput();
        }
    }
    public function destroy(string $id)
    {
        $incidence = Incidence::findOrFail($id);
        $incidence->delete();

        return redirect()->route('admin.incidencia.index')
            ->with('success', 'Incidencia eliminada exitosamente.');
    }
}
