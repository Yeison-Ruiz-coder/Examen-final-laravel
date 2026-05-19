<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;

/**
 * Ejemplo de controlador API para Company
 */
class CompanyController
{
    public function index()
    {
        return Company::query()
            ->included()
            ->filter()
            ->sort()
            ->getOrPaginate();
    }

    public function show(Company $company)
    {
        if (request('included')) {
            $company->load(...explode(',', request('included')));
        }
        return response()->json($company);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'actividad' => 'required|string|max:255',
        ]);

        $company = Company::create($validated);
        return response()->json($company, 201);
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'actividad' => 'sometimes|string|max:255',
        ]);

        $company->update($validated);
        return response()->json($company);
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(null, 204);
    }
}
