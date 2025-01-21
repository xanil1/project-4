<?php

namespace App\Http\Controllers;

use App\Models\Oefening;
use Illuminate\Http\Request;

class OefeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oefeningen = Oefening::all();
        return view('oefeningen.index', ['oefeningen' => $oefeningen]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('oefeningen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Krijg het bestand en bepaal het opslagpad
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Unieke naam voor bestand
        $destinationPath = public_path('images'); // Doelmap in de public map
        $image->move($destinationPath, $imageName); // Verplaats bestand naar de map

        // Sla de afbeeldingnaam op in de database
        $validated['image'] = 'images/' . $imageName;

        // Maak de oefening aan
        $oefening = Oefening::create($validated);

        return redirect()->route('oefeningen.index')->with('success', 'Oefening aangemaakt!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Oefening $oefening)
    {
        return response()->json($oefening);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oefening $oefening)
    {
        return view('oefeningen.edit', compact('oefening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Oefening $oefening)
    {
        // Valideer de ingevoerde gegevens
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Afbeelding is optioneel bij bewerken
        ]);

        // Controleer of er een nieuwe afbeelding is geüpload
        if ($request->hasFile('image')) {
            // Verwijder de oude afbeelding uit de public map
            if ($oefening->image) {
                $oldImagePath = public_path($oefening->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Verwijder de oude afbeelding
                }
            }

            // Verwerk de nieuwe afbeelding
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Unieke naam voor bestand
            $destinationPath = public_path('images'); // Doelmap in de public map
            $image->move($destinationPath, $imageName); // Verplaats bestand naar de map

            // Sla de nieuwe afbeeldingnaam op in de database
            $validated['image'] = 'images/' . $imageName;
        }

        // Werk de oefening bij met de nieuwe gegevens
        $oefening->update($validated);

        return redirect()->route('oefeningen.index')->with('success', 'Oefening succesvol bijgewerkt!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oefening $oefening)
    {
        // Verwijder de afbeelding uit de public/images map
        $imagePath = public_path($oefening->image);

        if (file_exists($imagePath)) {
            unlink($imagePath); // Verwijder het bestand
        }

        // Verwijder de oefening uit de database
        $oefening->delete();

        return redirect()->route('oefeningen.index')->with('success', 'Oefening succesvol verwijderd!');
    }


}

