<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $posts = Post::query()
            ->with('comments')->get();

        if ($posts->isEmpty()) {
            return response()->json([
                'message' => 'No data to show',
                'data' => null,
            ], SymfonyResponse::HTTP_OK);
        }
        return response()->json([
            'message' => 'Success fetching posts',
            'data' => $posts
        ], SymfonyResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return JsonResponse
     */
    public function store(StorePostRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();
            $path = 'posts';
            if (!Storage::disk('public')->path($path)) {
                Storage::disk('public')->makeDirectory($path);
            }

            $image = null;

            if ($request->hasFile('image')) {
                $image = Storage::disk('public')->putFile($path, $request->file('image'));
            }

            $user = Post::query()
                ->create(array_merge($validatedData, ['image' => $image]));


            DB::commit();

            return response()->json([
                'message' => 'Success creating post',
                'data' => $user,
            ], SymfonyResponse::HTTP_CREATED);
        } catch (\Exception $exception) {
            DB::rollBack();
            info($exception->getMessage());

            return response()->json([
                'message' => 'Error creating post',
                'data' => null,
            ], SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
