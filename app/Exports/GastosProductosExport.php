<?php

namespace App\Exports;

use App\Models\GastoProductos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GastosProductosExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GastoProductos::orderBy('created_at', 'desc')
            ->select('id','name', 'description_product', 'supplier', 'amount', 'total_cost', 'date_buy')
            ->get()
            ->map(function ($item) {
                return [
                    'ID' => $item->id,
                    'name' => $item->name,
                    'description_product' => $item->description_product,
                    'supplier' => $item->supplier,
                    'amount' => $item->amount,
                    'total_cost' => $item->total_cost,
                    'date_buy' => $item->date_buy,
                ];
            });
        }
    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Descripcion Producto',
            'Proveedor',
            'Cantidad',
            'Costo Total',
            'Fecha de Compra',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12, 'color' => ['argb' => 'FFFFFFFF']], 
                'fill' => ['fillType' => 'solid', 'color' => ['argb' => 'FF0000FF']]
            ],
            'A1:G' . ($sheet->getHighestRow()) => [
                'borders' => [
                    'allBorders' => ['borderStyle' => 'thin', 'color' => ['argb' => 'FF000000']]
                ]
            ],
            'A'=>['width' => 5],
            'B'=>['width' => 30],
            'C'=>['width' => 215],
            'D'=>['width' => 10],
            'E'=>['width' => 15],
            'F'=>['width' => 20],
            'G'=>['width' => 15],
        ];
    }
}

