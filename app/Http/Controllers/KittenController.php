<?php

namespace App\Http\Controllers;

use App\Models\Body_color;
use App\Models\kitten;
use App\Models\Litter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;

class KittenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kittens = Kitten::with(['litter', 'litter.mother', 'litter.father', 'bodycolor', 'images'])->get();

        return Inertia::render('admin/kitten/Index')
            ->with([
                'kittens' => $kittens,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $body_colors = Body_color::all();
        $litters = Litter::with(['mother', 'father'])->get();

        return Inertia::render('admin/kitten/Create')->with([
            'body_colors' => $body_colors,
            'litters' => $litters,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gender' => 'required|string|in:Mâle,Femelle,Indéfini',
            'body_color_id' => 'required|exists:body_colors,id',
            'litter_id' => 'required|exists:litters,id',
            'price' => 'required|numeric|min:0',
            'is_booked' => 'boolean',
            'is_adopted' => 'boolean',
            'photos.*' => 'nullable|image|max:10240', // max 10 MB par photo
        ]);
        $kitten = Kitten::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'gender' => $validated['gender'],
            'body_color_id' => $validated['body_color_id'],
            'litter_id' => $validated['litter_id'],
            'price' => $validated['price'],
            'is_booked' => $validated['is_booked'] ?? false,
            'is_adopted' => $validated['is_adopted'] ?? false,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $maxSizeKb = 1000; // seuil ~1 MB
                $filename = uniqid() . '.jpg'; // on force en jpg après compression

                if ($photo->getSize() / 1024 > $maxSizeKb) {
                    // Compressons l'image
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($photo);
                    $image->scale(height: 300);

                    $encoder = new JpegEncoder(75);
                    $encoded = $image->encode($encoder);

                    Storage::disk('public')->put('kittens/' . $filename, $encoded->__toString());
                } else {
                    // Pas besoin de compresser, on garde l’extension d’origine
                    $filename = uniqid() . '.' . $photo->getClientOriginalExtension();
                    $photo->storeAs('kittens', $filename, 'public');
                }

                $kitten->images()->create([
                    'image_path' => 'kittens/' . $filename
                ]);
            }
        }

        return redirect()->route('admin.kitten.index')
            ->with('success', 'Le chaton a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(kitten $kitten) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kitten $kitten)
    {
        $body_colors = Body_color::all();
        $litters = Litter::with(['mother', 'father'])->get();
        $images = $kitten->images()->get();



        return Inertia::render('admin/kitten/Edit')->with([
            'kitten' => $kitten,
            'body_colors' => $body_colors,
            'litters' => $litters,
            'images' => $images,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kitten $kitten)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gender' => 'required|string|in:Mâle,Femelle,Indéfini',
            'body_color_id' => 'required|exists:body_colors,id',
            'litter_id' => 'required|exists:litters,id',
            'price' => 'required|numeric|min:0',
            'is_booked' => 'boolean',
            'is_adopted' => 'boolean',
            'photos.*' => 'nullable|image|max:10240', // max 10 MB par photo
        ]);
        // On met à jour le chaton
        $kitten->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'gender' => $validated['gender'],
            'body_color_id' => $validated['body_color_id'],
            'litter_id' => $validated['litter_id'],
            'price' => $validated['price'],
            'is_booked' => $validated['is_booked'] ?? false,
            'is_adopted' => $validated['is_adopted'] ?? false,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $maxSizeKb = 1000; // seuil ~1 MB
                $filename = uniqid() . '.jpg';

                if ($photo->getSize() / 1024 > $maxSizeKb) {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($photo);
                    $image->scale(height: 300);

                    $encoder = new JpegEncoder(75);
                    $encoded = $image->encode($encoder);

                    Storage::disk('public')->put('kittens/' . $filename, $encoded->__toString());
                } else {
                    $filename = uniqid() . '.' . $photo->getClientOriginalExtension();
                    $photo->storeAs('kittens', $filename, 'public');
                }

                $kitten->images()->create([
                    'image_path' => 'kittens/' . $filename
                ]);
            }
        }

        return redirect()->route('admin.kitten.index')
            ->with('success', 'Le chaton a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kitten $kitten)
    {
        // Supprimer les images associées
        foreach ($kitten->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        // Supprimer le chaton
        $kitten->delete();

        return redirect()->route('admin.kitten.index')
            ->with('success', 'Le chaton a été supprimé avec succès.');
    }
}
