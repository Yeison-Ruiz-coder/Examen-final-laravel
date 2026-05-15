<?php

namespace App\Http\Controllers;

use App\Models\Army_corp;
use Illuminate\Http\Request;

class ArmyCorpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Army_corp::filter($request->all());

        if ($request->has('with')) {
            $relations = explode(',', $request->with);
            $query = $query->with($relations);
        }

        return response()->json($query->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Army_corp::find($id);
        if (!$item) {
            return response()->json(['error' => 'army_corp no encontrado'], 404);
        }
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(army_corp $army_corp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, army_corp $army_corp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(army_corp $army_corp)
    {
        //
    }
}
