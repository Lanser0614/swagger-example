<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserCollectionResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use AutoSwagger\Attributes\ApiSwagger;
use AutoSwagger\Attributes\ApiSwaggerQuery;
use AutoSwagger\Attributes\ApiSwaggerRequest;
use AutoSwagger\Attributes\ApiSwaggerResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;

class ApiNewUserController extends Controller
{
    #[ApiSwagger(summary: "Store new user", description: "Store new user", tag: 'user')]
    #[ApiSwaggerRequest(request: StoreUserRequest::class, description: 'Store new user data', required: true)]
    #[ApiSwaggerResponse(status: 200, resource: [
        "token" => "string",
        "user" => [
            "id" => "integer",
            "email" => "string",
            "password" => "string",
        ]
    ])]
    public function register(StoreUserRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    #[ApiSwagger(summary: "Login user", description: "Login user", tag: 'user')]
    #[ApiSwaggerRequest(request: LoginUserRequest::class, description: 'login user data', required: true)]
    #[ApiSwaggerResponse(status: 200, resource: [
        "token" => "string",
        "user" => [
            "id" => "integer",
            "email" => "string",
            "password" => "string",
        ]
    ])]
    public function login(LoginUserRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            /** @var User $user */
            $user = auth()->user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    /**
     * @param Request $request
     * @return UserCollectionResource
     */
    #[ApiSwagger(summary: "Store new user", description: "Store new user", tag: 'user')]
    #[ApiSwaggerResponse(status: 200, resource: UserResource::class, isPagination: true)]
    #[ApiSwaggerQuery(name: "email", description: "Search by email", required: false)]
    #[ApiSwaggerQuery(name: "name", description: "Search by name", required: false)]
    public function index(Request $request): UserCollectionResource
    {
        $user = User::query()->paginate();

        return new UserCollectionResource($user);
    }
}
