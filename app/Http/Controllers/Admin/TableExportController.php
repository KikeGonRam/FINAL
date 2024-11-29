<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Cita;
use App\Models\Barber;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Promotion;
use App\Models\Service;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TableExportController extends Controller
{
    private const ALLOWED_TABLES = [
        'users',
        'products',
        'appointments',
        'barbers',
        'contacts',
        'categories',
        'services',
        'promotions'
    ];

    private const ALLOWED_FORMATS = ['pdf', 'csv', 'word'];

    private const MODEL_MAPPING = [
        'users' => User::class,
        'products' => Product::class,
        'appointments' => Cita::class,
        'barbers' => Barber::class,
        'contacts' => Contact::class,
        'categories' => Category::class,
        'services' => Service::class,
        'promotions' => Promotion::class,
    ];

    public function index()
    {
        return view('admin.tables.index', [
            'allowedTables' => self::ALLOWED_TABLES,
            'allowedFormats' => self::ALLOWED_FORMATS
        ]);
    }

    public function export(Request $request, string $format, string $table)
    {
        if (!$this->isValidExportRequest($format, $table)) {
            return redirect()->back()
                ->with('error', 'Tabla o formato no soportado');
        }

        try {
            $data = $this->getTableData($table);

            if ($data->isEmpty()) {
                return redirect()->back()
                    ->with('error', 'No hay datos disponibles para exportar');
            }

            return $this->exportData($data, $format, $table);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al exportar datos: ' . $e->getMessage());
        }
    }

    protected function isValidExportRequest(string $format, string $table): bool
    {
        return in_array($table, self::ALLOWED_TABLES) &&
            in_array($format, self::ALLOWED_FORMATS);
    }

    protected function getTableData(string $table)
    {
        $model = self::MODEL_MAPPING[$table] ?? null;

        if (!$model) {
            return collect();
        }

        if ($table === 'appointments') {
            return $model::with(['cliente', 'barber'])->get();
        }

        return $model::all();
    }

    protected function exportData($data, string $format, string $table)
    {
        return match ($format) {
            'pdf' => $this->exportToPdf($data, $table),
            'csv' => $this->exportToCsv($data, $table),
            'word' => $this->exportToWord($data, $table),
            default => redirect()->back()
                ->with('error', 'Formato no soportado'),
        };
    }

    protected function exportToPdf($data, string $table)
    {
        $view = "admin.export.{$table}_pdf";

        if (!View::exists($view)) {
            return redirect()->back()
                ->with('error', 'Vista para PDF no disponible');
        }

        return Pdf::loadView($view, compact('data'))
            ->download("{$table}.pdf");
    }

    protected function exportToCsv($data, string $table): StreamedResponse
    {
        return response()->stream(
            function () use ($data) {
                $handle = fopen('php://output', 'w');

                // Escribir encabezados
                $firstRow = $data->first()->toArray();
                fputcsv($handle, array_keys($firstRow));

                // Escribir datos
                foreach ($data as $row) {
                    fputcsv($handle, $this->prepareCsvRow($row->toArray()));
                }

                fclose($handle);
            },
            200,
            $this->getCsvHeaders($table)
        );
    }

    protected function prepareCsvRow(array $row): array
    {
        return array_map(function ($value) {
            return is_array($value) ? json_encode($value) : $value;
        }, $row);
    }

    protected function getCsvHeaders(string $table): array
    {
        return [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => sprintf(
                'attachment; filename="%s_%s.csv"',
                $table,
                date('Ymd_His')
            ),
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ];
    }

    protected function exportToWord($data, string $table)
    {
        // Implementar lógica para exportación a Word
        return redirect()->back()
            ->with('error', 'Exportación a Word no implementada');
    }
}