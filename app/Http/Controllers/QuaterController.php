<?php

namespace App\Http\Controllers;

use App\Models\Quater;
use Illuminate\Http\Request;

class QuaterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Quater::filter($request->all());

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
        $item = Quater::find($id);
        if (!$item) {
            return response()->json(['error' => 'quater no encontrado'], 404);
        }
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(quater $quater)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, quater $quater)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(quater $quater)
    {
        //
    }
}
