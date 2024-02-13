<?php

namespace App\Exports;

use App\invoices;
use App\MoySituation;
use App\Situation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoicesExport implements FromView, ShouldAutoSize, WithColumnWidths, WithColumnFormatting, WithStyles, WithEvents
{
    use Exportable;
    private $situations;

    /**
    * @return \Illuminate\Support\Collection
    */
//    public function collection()
//    {
//        return Situation::all();
//        //return invoices::select('invoice_number', 'invoice_Date', 'Due_date','Section', 'product', 'Amount_collection','Amount_Commission', 'Rate_VAT', 'Value_VAT','Total', 'Status', 'Payment_Date','note')->get();
//
//    }
    public function __construct()
    {
        $this->situations = Situation::all();
    }

    public function view(): View
    {
        libxml_use_internal_errors(true);
        return view('situations.situationsex', [
            'situations' => $this->situations
        ]);
    }

    public function registerEvents(): array
    {
//        return [
//            AfterSheet::class    => function(AfterSheet $event) {
//                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
//                $event->sheet->getDelegate()->setRightToLeft(true);
//                $event->sheet->styleCells(
//                    'A8:L10',
//                    [
//                        'borders' => [
//                            'outline' => [
//                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
//                                'color' => ['argb' => 'FFFF0000'],
//                            ],
//                        ]
//                    ]
//                );
//            },
//        ];
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 7,
            'B' => 35,
            'C' => 9,
            'D' => 17,
            'E' => 17,
            'F' => 17,
            'G' => 17,
            'H' => 17,
            'I' => 17,
            'J' => 17,
            'K' => 17,
            'L' => 17,
        ];
    }
    public function styles(Worksheet $sheet)
    {

        return [
            'A8:L10' => [
                'font' => [
                    'bold' => false,
                    'italic' => false,
                    'underline' => Font::UNDERLINE_NONE,
                    'strikethrough' => false,
                ],
                'borders' => [
                    'bottom' => [
                        'borderStyle' => Border::BORDER_NONE,
                    ],
                    'top' => [
                        'borderStyle' => Border::BORDER_NONE,
                    ],
                    'left' => [
                        'borderStyle' => Border::BORDER_NONE,
                    ],
                    'right' => [
                        'borderStyle' => Border::BORDER_NONE,
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'quotePrefix'    => true
            ]
        ];
    }
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'H' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'I' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'J' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'K' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'L' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }
}
