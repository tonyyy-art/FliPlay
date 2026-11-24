<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimeController;
use App\Http\Controllers\Api\MangaController;
use App\Http\Controllers\Api\CollectionController;

// Anime API
Route::apiResource('animes', AnimeController::class);

// Manga API
Route::apiResource('mangas', MangaController::class);

Route::get(
    '/members/{user}/collections',
    [CollectionController::class, 'show']
);

// Anime Collection
Route::post(
    '/members/{user}/animes/{anime}',
    [CollectionController::class, 'addAnime']
);

Route::delete(
    '/members/{user}/animes/{anime}',
    [CollectionController::class, 'removeAnime']
);

// Manga Collection
Route::post(
    '/members/{user}/mangas/{manga}',
    [CollectionController::class, 'addManga']
);

Route::delete(
    '/members/{user}/mangas/{manga}',
    [CollectionController::class, 'removeManga']
);
