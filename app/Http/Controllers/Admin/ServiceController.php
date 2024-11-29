<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'special_dates' => 'boolean',
            'specific_barbers' => 'nullable|array',
            'special_packages' => 'nullable|string',
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Servicio creado exitosamente');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'special_dates' => 'boolean',
            'specific_barbers' => 'nullable|array',
            'special_packages' => 'nullable|string',
        ]);

        $service->update($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Servicio actualizado exitosamente');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Servicio eliminado exitosamente');
    }
}
