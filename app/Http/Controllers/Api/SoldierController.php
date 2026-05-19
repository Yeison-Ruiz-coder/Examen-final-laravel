<?php

namespace App\Http\Controllers\Api;

use App\Models\Soldier;
use Illuminate\Http\Request;

/**
 * Ejemplo de controlador API usando los scopes
 *
 * Uso:
 * GET /api/soldiers
 * GET /api/soldiers?included=army_corp,services
 * GET /api/soldiers?filter[nombre]=Juan&sort=nombre&perPage=10
 */
class SoldierController
{
    /**
     * Obtener listado de Soldiers
     *
     * Query Parameters:
     * - included: Relaciones a incluir (army_corp, quarter, company, services)
     * - filter[campo]: Filtrar por campo
     * - sort: Campos para ordenar (- para descendente)
     * - perPage: Registros por página
     */
    public function index()
    {
        return Soldier::query()
            ->included()
            ->filter()
            ->sort()
            ->getOrPaginate();
    }

    /**
     * Obtener un Soldier específico
     */
    public function show(Soldier $soldier)
    {
        // Verifica si hay parámetro 'included' para cargar relaciones
        if (request('included')) {
            $soldier->load(
                ...explode(',', request('included'))
            );
        }

        return response()->json($soldier);
    }

    /**
     * Crear un nuevo Soldier
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'grado' => 'required|integer|between:1,6',
            'army_corp_id' => 'nullable|exists:army_corps,id',
            'quarter_id' => 'nullable|exists:quaters,id',
            'company_id' => 'nullable|exists:companies,id',
        ]);

        $soldier = Soldier::create($validated);

        return response()->json($soldier, 201);
    }

    /**
     * Actualizar un Soldier
     */
    public function update(Request $request, Soldier $soldier)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'grado' => 'sometimes|integer|between:1,6',
            'army_corp_id' => 'nullable|exists:army_corps,id',
            'quarter_id' => 'nullable|exists:quaters,id',
            'company_id' => 'nullable|exists:companies,id',
        ]);

        $soldier->update($validated);

        return response()->json($soldier);
    }

    /**
     * Eliminar un Soldier
     */
    public function destroy(Soldier $soldier)
    {
        $soldier->delete();

        return response()->json(null, 204);
    }
}
