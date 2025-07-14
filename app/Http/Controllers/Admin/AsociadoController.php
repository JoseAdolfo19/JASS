<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Associate;
use Barryvdh\DomPDF\Facade\Pdf;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsociadoController extends Controller
{
    public function index()
    {
        return view('admin.asociados.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|unique:associates,dni|max:20',
            'address_house' => 'required|string|max:255',
            'housing_registration' => 'nullable|string|max:255',
        ]);

        try {
            $validator->validate();

            $associate = Associate::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'dni' => $request->dni,
                'address_house' => $request->address_house,
                'housing_registration' => $request->housing_registration,
                'status' => true,
            ]);

            return redirect()->route('admin.asociados.index')->with('success', 'Asociado creado exitosamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->$validator->errors())
                         ->withInput();
        }
    } 

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|unique:associates,dni,' . $id . '|max:20',
            'address_house' => 'required|string|max:255',
            'housing_registration' => 'nullable|string|max:255',
        ]);
        
        try {
            $validator->validate();

            $associate = Associate::findOrFail($id);
            $associate->update([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'dni' => $request->dni,
                'address_house' => $request->address_house,
                'housing_registration' => $request->housing_registration,
                'status' => true,
            ]);

            return redirect()->route('admin.asociados.index')->with('success', 'Asociado actualizado exitosamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->$validator->errors())
                         ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $associate = Associate::findOrFail($id);
        $associate->update(['status' => false]);
        
        return redirect()->route('admin.asociados.index')->with('success', 'Asociado eliminado exitosamente.');
    }

     public function exportPdf()
    {
        $associates = Associate::where('status', true)->get();
        $pdf = Pdf::loadView('Admin.asociados.pdf', compact('associates'));
        return $pdf->download('asociados.pdf');
    }
}
