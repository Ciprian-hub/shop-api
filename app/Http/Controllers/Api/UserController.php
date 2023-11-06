<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserListResource;
use App\Http\Resources\UserResource;
use App\Models\Api\Product;
use App\Models\Api\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search', false);
        $perPage = request('per_page', 10);
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = User::query();
        $query->orderBy($sortField, $sortDirection);
        if($search){
            $query->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
        }

        return UserResource::collection($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(StoreUserRequest $request)
    {

        $data = $request->validated();
        $data['is_admin'] = true;
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $user = User::create($data);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(StoreUserRequest $request, User $user): UserResource
    {
        // TODO update user

        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $user->update($data);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }

}
