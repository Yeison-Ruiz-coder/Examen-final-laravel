<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;

/**
 * Ejemplo de controlador API para Service
 */
class ServiceController
{
    public function index()
    {
        return Service::query()
            ->included()
            ->filter()
            ->sort()
            ->getOrPaginate();
    }

    public function show(Service $service)
    {
        if (request('included')) {
            $service->load(...explode(',', request('included')));
        }
        return response()->json($service);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'actividad_servicio' => 'required|string|max:255',
        ]);

        $service = Service::create($validated);
        return response()->json($service, 201);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'actividad_servicio' => 'sometimes|string|max:255',
        ]);

        $service->update($validated);
        return response()->json($service);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(null, 204);
    }
}
