<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Anime;
use App\Models\Manga;

class CollectionController extends Controller
{
    // GET: Menampilkan koleksi member
    public function show(User $user)
    {
        $user->load(['animes', 'mangas']);

        return new UserResource($user);
    }

    // POST: Menambahkan anime ke koleksi
    public function addAnime(User $user, Anime $anime)
    {
        if ($user->animes()->whereKey($anime->id)->exists()) {
            return response()->json([
                'message' => 'Anime sudah ada di koleksi member.'
            ], 409);
        }

        $user->animes()->attach($anime->id);

        return response()->json([
            'message' => 'Anime berhasil ditambahkan ke koleksi.',
            'member_id' => $user->id,
            'anime_id' => $anime->id
        ], 201);
    }

    // DELETE: Menghapus anime dari koleksi
    public function removeAnime(User $user, Anime $anime)
    {
        $deleted = $user->animes()->detach($anime->id);

        if ($deleted === 0) {
            return response()->json([
                'message' => 'Anime tidak ditemukan dalam koleksi member.'
            ], 404);
        }

        return response()->json([
            'message' => 'Anime berhasil dihapus dari koleksi.'
        ]);
    }

    // POST: Menambahkan manga ke koleksi
    public function addManga(User $user, Manga $manga)
    {
        if ($user->mangas()->whereKey($manga->id)->exists()) {
            return response()->json([
                'message' => 'Manga sudah ada di koleksi member.'
            ], 409);
        }

        $user->mangas()->attach($manga->id);

        return response()->json([
            'message' => 'Manga berhasil ditambahkan ke koleksi.',
            'member_id' => $user->id,
            'manga_id' => $manga->id
        ], 201);
    }

    // DELETE: Menghapus manga dari koleksi
    public function removeManga(User $user, Manga $manga)
    {
        $deleted = $user->mangas()->detach($manga->id);

        if ($deleted === 0) {
            return response()->json([
                'message' => 'Manga tidak ditemukan dalam koleksi member.'
            ], 404);
        }

        return response()->json([
            'message' => 'Manga berhasil dihapus dari koleksi.'
        ]);
    }
}
