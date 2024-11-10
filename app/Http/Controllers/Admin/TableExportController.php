<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Cita;
use App\Models\Barber;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableExportController extends Controller
{
    // Método index para cargar la vista principal o realizar acciones
    public function index()
    {
        return view('admin.tables.index');
    }

    // Exportar en varios formatos
    public function export(Request $request, $format, $table)
    {
        // Recoger los datos según la tabla seleccionada
        switch ($table) {
            case 'users':
                $data = User::all();
                break;
            case 'products':
                $data = Product::all();
                break;
            case 'appointments':
                $data = Cita::with('cliente', 'barber')->get();
                break;
            case 'barbers':
                $data = Barber::all();
                break;
            default:
                return redirect()->back()->with('error', 'Tabla no soportada');
        }

        // Llamar al método para exportar los datos según el formato
        return $this->exportData($data, $format, $table);
    }

    // Método para exportar según el formato
    protected function exportData($data, $format, $table)
    {
        // Verificar el formato de exportación (PDF)
        if ($format == 'pdf') {
            // Construir el nombre de la vista según el tipo de tabla
            $view = 'admin.export.' . $table . '_pdf';
            $pdf = Pdf::loadView($view, compact('data')); // Pasar los datos a la vista
            return $pdf->download($table . '.pdf');
        }

        // Otros formatos como CSV o Word pueden ser gestionados aquí
        switch ($format) {
            case 'csv':
                return $this->exportCsv($data, $table);
            case 'word':
                return $this->exportWord($data, $table);
            default:
                return redirect()->back()->with('error', 'Formato no soportado');
        }
    }

    // Método para exportar en formato CSV
    protected function exportCsv($data, $table)
    {
        // Lógica para exportar a CSV
        return response()->stream(function () use ($data) {
            $handle = fopen('php://output', 'w');
            // Escribir encabezado de las columnas
            fputcsv($handle, array_keys($data->first()->toArray()));

            // Escribir los datos
            foreach ($data as $row) {
                fputcsv($handle, $row->toArray());
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $table . '.csv"',
        ]);
    }

    // Método para exportar en formato Word
    protected function exportWord($data, $table)
    {
        // Crear el objeto PhpWord
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();

        // Títulos de las columnas
        $section->addText(ucwords($table));

        // Crear la tabla en Word
        $tableWord = $section->addTable();
        $tableWord->addRow();
        
        // Escribir los encabezados
        foreach ($data->first()->toArray() as $key => $value) {
            $tableWord->addCell(2000)->addText(ucwords($key));
        }

        // Escribir los datos
        foreach ($data as $row) {
            $tableWord->addRow();
            foreach ($row->toArray() as $value) {
                $tableWord->addCell(2000)->addText($value);
            }
        }

        // Guardar el archivo Word y devolverlo al usuario
        $fileName = $table . '.docx';
        $filePath = storage_path('app/public/' . $fileName);
        $phpWord->save($filePath, 'Word2007');
        
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
