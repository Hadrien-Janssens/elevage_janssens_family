<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();

        return Inertia::render('admin/faq/Index')->with([
            'faqs' => $faqs->sortBy('order'),
        ]);
    }

    /**e
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/faq/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'question' => 'required|string|max:255',
        //     'answer' => 'required|string',
        //     'order' => 'required|integer',
        // ]);

        Faq::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'order' => $request->input('order') ?? 0,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $faq->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'order' => $request->input('order') ?? 0,
        ]);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        //
    }
}
