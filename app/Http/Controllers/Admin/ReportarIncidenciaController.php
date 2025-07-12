<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReportedIncidence;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ReportarIncidenciaController extends Controller
{
    public function index()
    {
        $incidences = ReportedIncidence::with('associate')->paginate(10);
        return view('admin.reported_incidence.index', compact('incidences'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_associates' => 'required|exists:associates,id',
            'description' => 'required|string|max:255',
            'type_incidence' => 'required|string|max:100',
            'date_reported' => 'required|date',
            'date_resolved' => 'nullable|date',
            'location' => 'required|string|max:255',
            'repair_cost' => 'required|numeric|min:0',
        ]);

        try {
            $validator->validate();

            ReportedIncidence::create([
                'id_associates' => $request->id_associates,
                'description' => $request->description,
                'type_incidence' => $request->type_incidence,
                'date_reported' => $request->date_reported,
                'date_resolved' => $request->date_resolved,
                'location' => $request->location,
                'repair_cost' => $request->repair_cost,
                'status' => $request->status == "pendiente" ? 0 : 1,
            ]);
            return redirect()->route('admin.reported_incidence.index')
                ->with('success', 'Incidencia creada con éxito.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())
                ->withInput();
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_associates' => 'required|exists:associates,id',
            'description' => 'required|string|max:255',
            'type_incidence' => 'required|string|max:100',
            'date_reported' => 'required|date',
            'date_resolved' => 'nullable|date',
            'location' => 'required|string|max:255',
            'repair_cost' => 'required|numeric|min:0',
            'status' => 'required|in:pendiente,resuelto',

        ]);

        try {
            $validator->validate();

            $ReportedIncidence = ReportedIncidence::findOrFail($id);
            $ReportedIncidence->update([
                'id_associates' => $request->id_associates,
                'description' => $request->description,
                'type_incidence' => $request->type_incidence,
                'date_reported' => $request->date_reported,
                'date_resolved' => $request->date_resolved,
                'location' => $request->location,
                'repair_cost' => $request->repair_cost,
                'status' => $request->status == "pendiente" ? 0 : 1,

            ]);

            return redirect()->route('admin.reported_incidence.index')
                ->with('success', 'Incidencia actualizada con éxito.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())
                ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $ReportedIncidence = ReportedIncidence::findOrFail($id);
        $ReportedIncidence->delete();

        return redirect()->route('admin.reported_incidence.index')
            ->with('success', 'Incidencia eliminada con éxito.');
    }

    public function exportPdf()
    {
        $incidences = ReportedIncidence::where('status', 1)->orWhere('status', 0)->get();
        $pdf = Pdf::loadView('Admin.reported_incidence.pdf', compact('incidences'));
        return $pdf->download('reporte_incidencias.pdf');
    }
}
