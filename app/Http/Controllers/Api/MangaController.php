<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMangaRequest;
use App\Http\Requests\UpdateMangaRequest;
use App\Http\Resources\MangaResource;
use App\Models\Manga;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    // GET /api/mangas
    public function index(Request $request)
    {
        $query = Manga::query();

        if ($request->filled('search')) {
            $query->where(
                'title',
                'like',
                '%' . $request->search . '%'
            );
        }

        return MangaResource::collection(
            $query->latest()->get()
        );
    }

    // GET /api/mangas/{manga}
    public function show(Manga $manga)
    {
        $manga->load('users');

        return new MangaResource($manga);
    }

    // POST /api/mangas
    public function store(StoreMangaRequest $request)
    {
        $manga = Manga::create($request->validated());

        return (new MangaResource($manga))
            ->response()
            ->setStatusCode(201);
    }

    // PUT/PATCH /api/mangas/{manga}
    public function update(
        UpdateMangaRequest $request,
        Manga $manga
    ) {
        $manga->update($request->validated());

        return new MangaResource($manga);
    }

    // DELETE /api/mangas/{manga}
    public function destroy(Manga $manga)
    {
        $manga->delete();

        return response()->json([
            'message' => 'Manga berhasil dihapus.'
        ]);
    }
}
