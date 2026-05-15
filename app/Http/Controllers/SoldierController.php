<?php

namespace App\Http\Controllers;

use App\Models\Soldier;
use Illuminate\Http\Request;

class SoldierController extends Controller
{

   // Obtener todos los soldados
     public function index()
    {

        $soldier=Soldier::included()->filter()->sort()->getOrPaginate();


        return response()->json($soldier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $soldier = Soldier::create($request->all());

        return response()->json($soldier);
    }


    public function show($id) //si se pasa $id se utiliza la comentada
    {
        $soldier = Soldier::findOrFail($id);

        return response()->json($soldier);
    }

    public function update(Request $request, Soldier $soldier)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:categories,slug,' . $soldier->id,

        ]);

        $soldier->update($request->all());

        return $soldier;
    }

    public function destroy(Soldier $soldier)
    {
        $soldier->delete();
        return $soldier;
    }
}
