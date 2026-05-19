<?php

namespace App\Http\Controllers\Api;

use App\Models\Army_corp;
use Illuminate\Http\Request;

/**
 * Ejemplo de controlador API para Army_corp
 */
class ArmyCorpController
{
    public function index()
    {
        return Army_corp::query()
            ->included()
            ->filter()
            ->sort()
            ->getOrPaginate();
    }

    public function show(Army_corp $armyCorp)
    {
        if (request('included')) {
            $armyCorp->load(...explode(',', request('included')));
        }
        return response()->json($armyCorp);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'denominacion' => 'required|string|max:255|unique:army_corps',
        ]);

        $armyCorp = Army_corp::create($validated);
        return response()->json($armyCorp, 201);
    }

    public function update(Request $request, Army_corp $armyCorp)
    {
        $validated = $request->validate([
            'denominacion' => 'sometimes|string|max:255|unique:army_corps,denominacion,' . $armyCorp->id,
        ]);

        $armyCorp->update($validated);
        return response()->json($armyCorp);
    }

    public function destroy(Army_corp $armyCorp)
    {
        $armyCorp->delete();
        return response()->json(null, 204);
    }
}
