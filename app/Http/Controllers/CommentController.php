<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCommentRequest  $request
     * @return JsonResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::query()
            ->create($request->validated());

        return response()->json([
            'message' => 'Success creating comment',
            'data' => $comment
        ], SymfonyResponse::HTTP_CREATED);
    }

}
