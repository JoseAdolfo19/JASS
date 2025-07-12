<?php

namespace App\Exports;

use App\Models\QuotaPayments;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PagoCuotasExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return QuotaPayments::where('status', 1)
            ->orWhere('status', 0)
            ->select('id', 'id_associate', 'amount', 'expiration_date', 'issue_date', 'status')
            ->get()
            ->map(function ($item) {
                return [
                    'ID' => $item->id,
                    'Associate ID' => $item->associate->name,
                    'Amount' => $item->amount,
                    'Expiration Date' => $item->expiration_date,
                    'Issue Date' => $item->issue_date,
                    'Status' => $item->status ? 'Pagado' : 'Pendiente',
                ];
            });
    }
    public function headings(): array
    {
        return [
            'ID',
            'Usuario',
            'Monto',
            'Fecha de Vencimiento',
            'Fecha de Emisión',
            'Estado de Pago',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12, 'color' => ['argb' => 'FF0000']],
                'fill' => ['fillType' => 'solid', 'color' => ['argb' => 'FF0000FF']]
            ],
            'A1:F' . ($sheet->getHighestRow()) => [
                'borders' => [
                    'allBorders' => ['borderStyle' => 'thin', 'color' => ['argb' => 'FF000000']]
                ]
            ],
            'A' => ['width' => 5],
            'B' => ['width' => 20],
            'C' => ['width' => 15],
            'D' => ['width' => 20],
            'E' => ['width' => 20],
            'F' => ['width' => 20],
        ];
    }
}
