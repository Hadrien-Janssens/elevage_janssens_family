<?php

namespace App\Http\Controllers;

use App\Models\litter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class LitterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $litters = litter::with(['mother', 'father', 'kittens'])->get();


        return Inertia::render('admin/litters/Index')->with([
            'litters' => $litters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/litters/Create', [
            'cats' => \App\Models\Cats::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'mother_id' => 'nullable|exists:cats,id',
            'father_id' => 'nullable|exists:cats,id',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $litter = Litter::create($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('litters', 'public');
                $litter->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.litters.index')->with('success', 'Portée créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(litter $litter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $litter = Litter::with(['mother', 'father', 'kittens'])->findOrFail($id);

        return Inertia::render('admin/litters/Edit', [
            'litter' => $litter,
            'cats' => \App\Models\Cats::all(),
            'kittens' => $litter->kittens,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, litter $litter)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'mother_id' => 'nullable|exists:cats,id',
            'father_id' => 'nullable|exists:cats,id',
        ]);

        $litter->update($validated);

        return redirect()->route('admin.litters.index')->with('success', 'Portée mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(litter $litter)
    {
        //
    }
}
