<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        {
            try {
                DB::beginTransaction();

                $validatedData = array_merge($request->validated(), ['password' => Hash::make($request->password)]);

                $user = User::query()
                    ->create($validatedData);

                DB::commit();

                return response()->json([
                    'message' => 'Success creating user',
                    'data' => $user,
                ], SymfonyResponse::HTTP_CREATED);
            } catch (\Exception $exception) {
                DB::rollBack();
                info($exception->getMessage());

                return response()->json([
                    'message' => 'Error creating user',
                    'data' => null,
                ], SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
