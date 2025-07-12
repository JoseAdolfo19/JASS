<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PagoCuotasExport;
use App\Http\Controllers\Controller;
use App\Models\QuotaPayments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class PagoCuotasController extends Controller
{

    public function index()
    {
        return view('admin.pago_cuotas.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_associate' => 'required|exists:associates,id',
            'amount' => 'required|numeric|min:0',
            'expiration_date' => 'required|date',
            'issue_date' => 'required|date',
            'status' => 'required|in:pendiente,pagado',
        ]);

        try {
            $validator->validate();

            QuotaPayments::create([
                'id_associate' => $request->id_associate,
                'amount' => $request->amount,
                'expiration_date' => $request->expiration_date,
                'issue_date' => $request->issue_date,
                'status' => $request->status == "pendiente" ? 0 : 1,
            ]);

            return redirect()->route('admin.pago_cuotas.index')
                ->with('success', 'Pago de cuota registrado con éxito.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())
                ->withInput();
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_associate' => 'required|exists:associates,id',
            'amount' => 'required|numeric|min:0',
            'expiration_date' => 'required|date',
            'issue_date' => 'required|date',
            'status' => 'required|in:pendiente,pagado',
        ]);

        try {
            $validator->validate();

            $quotaPayment = QuotaPayments::findOrFail($id);
            $quotaPayment->update([
                'id_associate' => $request->id_associate,
                'amount' => $request->amount,
                'expiration_date' => $request->expiration_date,
                'issue_date' => $request->issue_date,
                'status' => $request->status == "pendiente" ? 0 : 1,
            ]);

            return redirect()->route('admin.pago_cuotas.index')
                ->with('success', 'Pago de cuota actualizado con éxito.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quotaPayment = QuotaPayments::findOrFail($id);
        $quotaPayment->delete();

        return redirect()->route('admin.pago_cuotas.index')
            ->with('success', 'Pago de cuota eliminado con éxito.');
    }
    public function exportExcel()
    {
        return Excel::download(new PagoCuotasExport, 'reporte_pagos_cuotas.xlsx');
    }
}
