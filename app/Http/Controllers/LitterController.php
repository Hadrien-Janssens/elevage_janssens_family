<?php

namespace App\Http\Controllers;

use App\Models\ImagesLitters;
use App\Models\Litter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class LitterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $litters = Litter::with(['mother', 'father', 'kittens'])->get();


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
            'cats' => \App\Models\Cat::all(),
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
                $maxSizeKb = 1000; // seuil ~1 MB
                $filename = uniqid() . '.jpg'; // on force en jpg après compression

                if ($photo->getSize() / 1024 > $maxSizeKb) {
                    // Compressons l'image
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($photo);
                    $image->scale(height: 300);

                    $encoder = new JpegEncoder(95);
                    $encoded = $image->encode($encoder);

                    Storage::disk('public')->put('litters/' . $filename, $encoded->__toString());
                } else {
                    // Pas besoin de compresser, on garde l’extension d’origine
                    $filename = uniqid() . '.' . $photo->getClientOriginalExtension();
                    $photo->storeAs('litters', $filename, 'public');
                }

                $litter->images()->create([
                    'image_path' => $filename
                ]);
            }
        }

        return redirect()->route('admin.litters.index')->with('success', 'Portée créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Litter $litter)
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
            'cats' => \App\Models\Cat::all(),
            'kittens' => $litter->kittens,
            'images' => $litter->images,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Litter $litter)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'mother_id' => 'nullable|exists:cats,id',
            'father_id' => 'nullable|exists:cats,id',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'integer|exists:images_litters,id',
            'new_photos' => 'nullable|array',
            'new_photos.*' => 'image|max:10240',
        ]);

        // Suppression des images
        if (!empty($validated['deleted_images'])) {
            foreach ($validated['deleted_images'] as $imageId) {
                $image = $litter->images()->find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // Mise à jour de la portée
        $litter->update([
            'name' => $validated['name'],
            'birth_date' => $validated['birth_date'],
            'mother_id' => $validated['mother_id'],
            'father_id' => $validated['father_id'],
        ]);

        // Ajout des nouvelles images
        if ($request->hasFile('new_photos')) {
            foreach ($request->file('new_photos') as $photo) {
                $filename = uniqid() . '.jpg';

                if ($photo->getSize() / 1024 > 1000) {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($photo);
                    $image->scale(height: 300);
                    $encoded = $image->encode(new JpegEncoder(95));
                    Storage::disk('public')->put('litters/' . $filename, $encoded);
                } else {
                    $photo->storeAs('litters', $filename, 'public');
                }
                $litter->images()->create([
                    'image_path' => $filename
                ]);
            }
        }

        return redirect()->route('admin.litters.index')
            ->with('success', 'La portée a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $litter = Litter::findOrFail($id);
        // Supprimer les images associées
        foreach ($litter->images as $image) {
            Storage::disk('public')->delete('litters/' . $image->image_path);
            $image->delete();
        }
        //supprimer les images des chatons
        foreach ($litter->kittens as $kitten) {
            foreach ($kitten->images as $image) {
                Storage::disk('public')->delete('kittens/' . $image->image_path);
                $image->delete();
            }
        }

        // Supprimer la portée
        $litter->delete();

        return redirect()->route('admin.litters.index')
            ->with('success', 'Le chaton a été supprimé avec succès.');
    }
}
