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

        if (request()->wantsJson()) {
            return response()->json($oefeningen);
        }
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
            'description_en' => 'required|string', // Engelse beschrijving vereist
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Verwerk de afbeelding
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('images');
        $image->move($destinationPath, $imageName);
        $validated['image'] = 'images/' . $imageName;

        // Maak de oefening aan
        Oefening::create($validated);

        if ($request->wantsJson()) {
            return response()->json($oefening, 201);
        }

        return redirect()->route('oefeningen.index')->with('success', 'Oefening aangemaakt!');
        return response()->json($oefening, 201);
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'description_en' => 'required|string', // Engelse beschrijving vereist
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Verwerk nieuwe afbeelding indien geüpload
        if ($request->hasFile('image')) {
            if ($oefening->image) {
                $oldImagePath = public_path($oefening->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        // Update de oefening
        $oefening->update($validated);

        return redirect()->route('oefeningen.index')->with('success', 'Oefening succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oefening $oefening)
    {
        if ($oefening->image) {
            $imagePath = public_path($oefening->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $oefening->delete();

        return redirect()->route('oefeningen.index')->with('success', 'Oefening succesvol verwijderd!');
    }
}
