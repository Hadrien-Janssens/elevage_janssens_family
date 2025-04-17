<?php

use App\Models\Kitten;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
})->name('kittens.show');

Route::get('/chats', function () {
    return Inertia::render('Cats');
})->name('cats');

Route::get('/conditions-adoption', function () {
    return Inertia::render('Booking');
})->name('booking');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
