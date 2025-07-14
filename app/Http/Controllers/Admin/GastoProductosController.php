<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GastoProductos;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class GastoProductosController extends Controller
{
    public function index()
    {
        return view('admin.gastoproductos.index');
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'description_product' => 'required|string|max:255',
        'supplier' => 'required|string|max:255',
        'amount' => 'required|string|max:255',
        'total_cost' => 'required|numeric|between:0,99999999.99',
        'date_buy' => 'required|string|max:255',
    ]);

    try {
        $validator->validate();

        $gastoproductos = GastoProductos::create([
            'description_product' => $request->description_product,
            'supplier' => $request->supplier,
            'amount' => $request->amount,
            'total_cost' => $request->total_cost,
            'date_buy' => $request->date_buy,
        ]);

        return redirect()->route('admin.gastoproductos.index')->with('success', 'Gasto de productos generado exitosamente.');
    } catch (ValidationException $e) {
        return back()->withErrors($e->validator)->withInput();
    }
}
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'description_product' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'total_cost' => 'required|numeric|between:0,99999999.99',
            'date_buy' => 'required|string|max:255',
        ]);
        
        try {
            $validator->validate();

            $gastoproductos = GastoProductos::findOrFail($id);
            $gastoproductos->update([
                'description_product' => $request->description_product,
                'supplier' => $request->supplier,
                'amount' => $request->amount,
                'total_cost' => $request->total_cost,
                'date_buy' => $request->date_buy,
            ]);

            return redirect()->route('admin.gastoproductos.index')->with('success', 'Gasto de productos editado correctamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->$validator->errors())
                         ->withInput();
        }
    }

    public function destroy(string $id)
    {
        GastoProductos::findOrFail($id)->delete();
        return redirect()->route('admin.gastoproductos.index')->with('success', 'El gasto de productos a sido eliminado correctamente.');
    }

    public function exportPdf()
    {
    $gastoproductos = GastoProductos::where('status', 1)->orWhere('status', 0)->get();
    $pdf = Pdf::loadView('Admin.gastoproductos.pdf', compact('gastoproductos'));
    return $pdf->download('gastoproductos.pdf');
    }
}
