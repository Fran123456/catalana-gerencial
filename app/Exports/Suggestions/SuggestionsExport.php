<?php

namespace App\Exports\Suggestions;

use App\Models\Suggestion;
use Illuminate\Contracts\View\View;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


//class SuggestionsExport implements FromCollection
class SuggestionsExport implements FromView, WithColumnWidths, WithDrawings//,WithStyles
{
    protected $query;
    
    public function __construct($query,$text,$fi,$ff,$tipo)
    {
        $this->query = $query;
        $this->text = $text;
        $this->fi = $fi;
        $this->ff = $ff;
        $this->tipo = $tipo;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('images\logos\catalana.jpg'));
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function view(): View
    {
        return view('pdf-reports.sugerencias.tactico-excel', [
            'query' => $this->query,
            'text' => $this->text,
            'fi' => $this->fi,
            'ff' => $this->ff,
            'tipo' => $this->tipo
        ]);   
    }    

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 60,
            'C' => 40,
            'D' => 15,
            'E' => 15,
            'F' => 20
        ];
    }

    /*public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('2')->getFont()->setBold(true);
        $sheet->getStyle('6')->getFont()->setBold(true);
        $sheet->getStyle('7')->getFont()->setBold(true);
        $sheet->getStyle('10')->getFont()->setBold(true);        
    }*/
}
