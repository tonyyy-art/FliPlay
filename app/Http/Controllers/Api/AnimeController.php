<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnimeRequest;
use App\Http\Requests\UpdateAnimeRequest;
use App\Http\Resources\AnimeResource;
use App\Models\Anime;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    // GET /api/animes
    public function index(Request $request)
    {
        $query = Anime::query();

        if ($request->filled('search')) {
            $query->where(
                'title',
                'like',
                '%' . $request->search . '%'
            );
        }

        return AnimeResource::collection(
            $query->latest()->get()
        );
    }

    // GET /api/animes/{anime}
    public function show(Anime $anime)
    {
        $anime->load('users');

        return new AnimeResource($anime);
    }

    // POST /api/animes
    public function store(StoreAnimeRequest $request)
    {
        $anime = Anime::create($request->validated());

        return (new AnimeResource($anime))
            ->response()
            ->setStatusCode(201);
    }

    // PUT/PATCH /api/animes/{anime}
    public function update(
        UpdateAnimeRequest $request,
        Anime $anime
    ) {
        $anime->update($request->validated());

        return new AnimeResource($anime);
    }

    // DELETE /api/animes/{anime}
    public function destroy(Anime $anime)
    {
        $anime->delete();

        return response()->json([
            'message' => 'Anime berhasil dihapus.'
        ]);
    }
}
