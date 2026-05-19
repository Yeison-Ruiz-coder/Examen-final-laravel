<?php

namespace App\Http\Controllers\Api;

use App\Models\Quater;
use Illuminate\Http\Request;

/**
 * Ejemplo de controlador API para Quater
 */
class QuaterController
{
    public function index()
    {
        return Quater::query()
            ->included()
            ->filter()
            ->sort()
            ->getOrPaginate();
    }

    public function show(Quater $quater)
    {
        if (request('included')) {
            $quater->load(...explode(',', request('included')));
        }
        return response()->json($quater);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
        ]);

        $quater = Quater::create($validated);
        return response()->json($quater, 201);
    }

    public function update(Request $request, Quater $quater)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'ubicacion' => 'sometimes|string|max:255',
        ]);

        $quater->update($validated);
        return response()->json($quater);
    }

    public function destroy(Quater $quater)
    {
        $quater->delete();
        return response()->json(null, 204);
    }
}
