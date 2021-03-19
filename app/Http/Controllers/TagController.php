<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    /**
     * Creates a new category controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Tag::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return JsonResponse
     */
    public function store(TagRequest $request): JsonResponse
    {
        $data = $request->validated();

        $tag = Tag::create($data);

        return response()->json([
            'message' => 'Tag successfully created',
            'tag' => $tag
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(Tag::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TagRequest $request, int $id)
    {
        $tag = Tag::findOrFail($id);
        $data = $request->validated();

        $tag->update($data);

        return response()->json([
            'message' => 'Tag successfully updated',
            'tag' => $tag
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        return response()->json([], 204);
    }
}
