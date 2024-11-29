<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function download()
    {
        // Datos que pasarás a la vista
        $data = ['title' => 'Bienvenido a Darketo'];

        // Generar el PDF
        $pdf = Pdf::loadView('pdf.myfile', $data);

        // Descargar el archivo PDF con el nombre 'mi_archivo.pdf'
        return $pdf->download('mi_archivo.pdf');
    }
}
