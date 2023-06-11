<?php

namespace App\Http\Controllers;

use App\Facades\UserFacade;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = UserFacade::createUser($data);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], JsonResponse::HTTP_CREATED);
    }

    public function show($id)
    {
        $user = UserFacade::getUserById($id);

        return response()->json($user);
    }

    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();
        $user = UserFacade::updateUser($id, $data);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    public function destroy($id)
    {
        UserFacade::deleteUser($id);

        return response()->json([
            'message' => 'User deleted successfully',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
