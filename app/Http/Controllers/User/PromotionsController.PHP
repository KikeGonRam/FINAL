<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Barryvdh\DomPDF\Facade\PDF;


class PromotionsController extends Controller
{
    public function index()
    {
        // Obtén todas las promociones activas (según la fecha de inicio y fin)
        $promotions = Promotion::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();

        return view('user.promotions.index', compact('promotions'));
    }
    public function download(Promotion $promotion)
    {
        try {
            if ($promotion->start_date > now() || $promotion->end_date < now()) {
                abort(403, 'Esta promoción no está activa.');
            }

            $pdf = PDF::loadView('user.promotions.pdf', compact('promotion'));

            return $pdf->download('promocion_' . $promotion->id . '.pdf');
        } catch (\Exception $e) {
            return redirect()->route('user.promotions.index')
                ->with('error', 'Hubo un problema al generar el PDF: ' . $e->getMessage());
        }
    }
}
