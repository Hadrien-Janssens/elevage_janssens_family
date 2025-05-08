<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ContentController extends Controller
{
    public function index()
    {

        // Fetch all contents
        $contents = Content::all();

        return Inertia::render('admin/contents/Index')->with([
            'contents' => $contents,
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/contents/Create');
    }

    public function store(Request $request)
    {
        // Store the content
        return redirect()->route('admin.contents.index');
    }

    public function edit($id)
    {
        return Inertia::render('admin/contents/Edit', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Recherche du contenu à mettre à jour
        $content = Content::findOrFail($id);

        // Mise à jour du contenu
        $content->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // Redirection avec message de succès
        return redirect()->route('admin.contents.index')
            ->with('success', 'Contenu mis à jour avec succès');
    }

    public function destroy($id)
    {
        // Delete the content
        return redirect()->route('admin.contents.index');
    }
}
