<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Creates a new post controller instance
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::filterBy(\request()->all())->paginate(15);
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        $user_id = $request->user()->id;
        $data = $request->validated();

        $post = Post::create(array_merge(
            $data,
            ['user_id' => $user_id]
        ));

        if($data['tags']){
            $post->tags()->attach($data['tags']);
        }

        return response()->json([
            'message' => 'Post successfully created',
            'post' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Post::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, $id)
    {
        $user_id = $request->user()->id;
        $post = Post::findOrFail($id);
        $data = $request->validated();

        if($post->user_id != $user_id){
            return response()->json(['message' => 'You are not allowed to edit this post'], 401);
        }

        $post->update($data);

        return response()->json([
            'message' => 'Post successfully updated',
            'post' => $post
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, int $id)
    {
        $user_id = $request->user()->id;
        $post = Post::findOrFail($id);

        if($post->user_id != $user_id){
            return response()->json(['message' => 'You are not allowed to delete this post'], 401);
        }

        $post->delete();

        return response()->json([], 204);
    }
}
