<?php

use App\Http\Controllers\KittenController;
use App\Models\Kitten;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/chats', function () {
        return Inertia::render('admin/Cats');
    })->name('cats');

    Route::get('/chatons', [KittenController::class, 'index'])->name('kitten.index');
    Route::get('/chatons/creer', [KittenController::class, 'create'])->name('kitten.create');
    Route::get('/chatons/{kitten}', [KittenController::class, 'show'])->name('kitten.show');



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
    ]);
})->name('kittens');

Route::get('/chatons/{kitten}', function (Kitten $kitten) {
    return Inertia::render('Kitten')->with([
        'kitten' => $kitten->load(['litter', 'litter.mother', 'litter.father', 'bodycolor', 'images']),
    ]);
})->name('kitten.show');

Route::get('/chats', function () {
    return Inertia::render('Cats');
})->name('cats');

Route::get('/conditions-adoption', function () {
    return Inertia::render('Booking');
})->name('booking');


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
