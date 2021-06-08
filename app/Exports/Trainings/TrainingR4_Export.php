<?php

namespace App\Exports\Trainings;

use App\Models\TrainingEmployee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class TrainingR4_Export implements FromView, WithColumnWidths, WithDrawings//,WithStyles
{
    protected $query;
    
    public function __construct($query,$text,$tipo,$aprobados,$reprobados)
    {
        $this->query = $query;
        $this->text = $text;        
        $this->tipo = $tipo;
        $this->aprobados = $aprobados;
        $this->reprobados = $reprobados;
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
        return view('pdf-reports.capacitaciones.r4-tactico-excel', [
            'query' => $this->query,
            'text' => $this->text,            
            'tipo' => $this->tipo,
            'aprobados' => $this->aprobados,
            'reprobados' => $this->reprobados,
        ]);   
    }    

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 30,
            'C' => 50,
            'D' => 20,            
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
