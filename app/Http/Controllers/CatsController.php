<?php

namespace App\Http\Controllers;

use App\Models\BodyColor;
use App\Models\Cat;
use App\Models\ImagesCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class CatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cats = Cat::with(['bodycolor', 'images'])->get();

        return Inertia::render('admin/cats/Index')
            ->with([
                'cats' => $cats,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $body_colors = BodyColor::all();

        return Inertia::render('admin/cats/Create')->with([
            'body_colors' => $body_colors,
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
            'birthday' => 'date',
            'gender' => 'required|string|in:Mâle,Femelle,Indéfini',
            'body_color_id' => 'required|exists:body_colors,id',
            'photos.*' => 'nullable|image|max:10240', // max 10 MB par photo
        ]);
        $cat = Cat::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'birthday' => $validated['birthday'],
            'gender' => $validated['gender'],
            'body_color_id' => $validated['body_color_id'],
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

                    $encoder = new JpegEncoder(95);
                    $encoded = $image->encode($encoder);

                    Storage::disk('public')->put('cats/' . $filename, $encoded->__toString());
                } else {
                    // Pas besoin de compresser, on garde l’extension d’origine
                    $filename = uniqid() . '.' . $photo->getClientOriginalExtension();
                    $photo->storeAs('cats', $filename, 'public');
                }

                $cat->images()->create([
                    'image_path' =>   $filename
                ]);
            }
        }

        return redirect()->route('admin.cats.index')
            ->with('success', 'Le chat a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(cat $cats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {

        $cat = Cat::findOrFail($id);
        if (!$cat) {
            return redirect()->route('admin.cats.index')
                ->with('error', 'Le chat n\'existe pas.');
        }
        $body_colors = BodyColor::all();
        $images = $cat->images()->get();


        return Inertia::render('admin/cats/Edit')->with([
            'cat' => $cat,
            'body_colors' => $body_colors,
            'images' => $images,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cat $cats)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gender' => 'required|string|in:Mâle,Femelle,Indéfini',
            'body_color_id' => 'required|exists:body_colors,id',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'integer|exists:images_cats,id',
            'new_photos' => 'nullable|array',
            'new_photos.*' => 'image|max:10240',
        ]);


        // Suppression des images
        if (!empty($validated['deleted_images'])) {
            foreach ($validated['deleted_images'] as $imageId) {
                $image = ImagesCat::find($imageId);
                if ($image) {
                    Storage::disk('public')->delete('cats/' . $image->image_path);
                    $image->delete();
                }
            }
        }

        // Mise à jour du chaton
        $cats->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'gender' => $validated['gender'],
            'body_color_id' => $validated['body_color_id'],
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
                    Storage::disk('public')->put('cats/' . $filename, $encoded);
                } else {
                    $photo->storeAs('cats', $filename, 'public');
                }

                $cats->images()->create([
                    'image_path' => $filename
                ]);
            }
        }

        return redirect()->route('admin.cats.index')
            ->with('success', 'Le chat a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cat $cats)
    {
        //
    }
}
