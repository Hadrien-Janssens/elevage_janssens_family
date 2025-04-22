<?php

namespace App\Http\Controllers;

use App\Models\kitten;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        return Inertia::render('admin/kitten/Create');
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
    public function show(kitten $kitten)
    {
        return Inertia::render('admin/kitten/Show')->with([
            'kitten' => $kitten->load(['litter', 'litter.mother', 'litter.father', 'bodycolor', 'images']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kitten $kitten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kitten $kitten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kitten $kitten)
    {
        //
    }
}
