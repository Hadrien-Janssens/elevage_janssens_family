<?php

use App\Http\Controllers\KittenController;
use App\Http\Controllers\LitterController;
use App\Mail\ContactMail;
use App\Models\Kitten;
use App\Models\Litter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;


Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/chats', function () {
        return Inertia::render('admin/Cats');
    })->name('cats');

    Route::get('/chatons', [KittenController::class, 'index'])->name('kitten.index');
    Route::get('/chatons/creer', [KittenController::class, 'create'])->name('kitten.create');
    Route::post('/chatons', [KittenController::class, 'store'])->name('kitten.store');
    Route::get('/chaton/{id}/modifier', [KittenController::class, 'edit'])->name('kitten.edit');
    Route::post('/chatons/{kitten}', [KittenController::class, 'update'])->name('kitten.update');
    Route::delete('/chatons/{kitten}', [KittenController::class, 'destroy'])->name('kitten.destroy');
    Route::resource('/portees', LitterController::class)->names('litters');



    Route::get('/', function () {
        return Inertia::render('admin/Dashboard');
    })->name('dashboard');
});


Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/a-propos', function () {
    return Inertia::render('Elevage');
})->name('elevage');

Route::get('/chatons', function () {
    $kittens = Kitten::with(['litter', 'litter.mother', 'litter.father', 'bodycolor', 'images'])->get();
    return Inertia::render('Kittens')->with([
        'kittens' => $kittens,
        'litters' => Litter::with(['mother', 'father', 'images'])->get(),
    ]);
})->name('kittens');

Route::get('/chatons/{kitten}', function (Kitten $kitten) {
    return Inertia::render('Kitten')->with([
        'kitten' => $kitten->load(['litter', 'litter.mother', 'litter.father', 'bodycolor', 'images']),
    ]);
})->name('kitten.show');

Route::get('/portees/{litter}', function (Litter $litter) {
    return Inertia::render('Litter')->with([
        'litter' => $litter->load(['mother', 'father', 'images']),
    ]);
})->name('litter.show');

Route::get('/chats', function () {
    $cats = \App\Models\Cat::with(['images'])->get();
    return Inertia::render('Cats')->with([
        'cats' => $cats,
    ]);
})->name('cats');

Route::get('/conditions-adoption', function () {
    return Inertia::render('Booking');
})->name('booking');

Route::post('/send-mail', function (Request $request) {


    $request->validate([
        'email' => 'required|email',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'required|string|max:255',
        'message' => 'required|string|max:500',
    ]);
    $data = [
        'email' => $request->input('email'),
        'nom' => $request->input('nom'),
        'prenom' => $request->input('prenom'),
        'telephone' => $request->input('telephone'),
        'message' => $request->input('message'),
    ];


    Mail::to('hadrien.janssens7@gmail.com')->send(new ContactMail($data));

    return redirect()->back()->with('success', 'Email envoyé avec succès !');
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
