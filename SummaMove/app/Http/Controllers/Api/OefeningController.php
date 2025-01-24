<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Oefening;
use Illuminate\Http\Request;

class OefeningController extends Controller
{
    public function index()
    {
        $oefeningen = Oefening::all();
        return response()->json($oefeningen);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Afbeelding verwerken
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        $validated['image'] = 'images/' . $imageName;

        $oefening = Oefening::create($validated);

        return response()->json($oefening, 201);
    }

    public function show(Oefening $oefening)
    {
        return response()->json($oefening);
    }

    public function update(Request $request, Oefening $oefening)
    {
        // Validatie en update logica
    }

    public function destroy(Oefening $oefening)
    {
        // Verwijderen logica
    }
}