<?php

namespace App\Http\Controllers\admin\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAccountModel;
use App\Models\RoleAdmin;
use App\Http\Resources\admin\account\AdminAccountResource;
use App\Http\Resources\admin\account\AdminRoleResource;
use App\Http\Requests\Admin\account\AccountRequest;
use App\Http\Requests\Admin\account\AccountUpdateRequest;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function index()
    {
        try {
            $accoutns = AdminAccountModel::all();

            return response()->json([
                'status_code' => 200,
                'message' => 'Addmin Account List',
                'data' => AdminAccountResource::collection($accoutns),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'An error occurred while retrieving the user list'
            ], 500);
        }
    }

    public function show(string $id)
{
    try {
        $account = AdminAccountModel::findOrFail($id);

        return response()->json([
            'status_code' => 200,
            'message' => 'Admin Account Details',
            'data' => new AdminAccountResource($account),
        ], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'status_code' => 404,
            'message' => 'Admin Account not found'
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'status_code' => 500,
            'message' => 'An error occurred while retrieving the user details'
        ], 500);
    }
}


    public function store(AccountRequest $request)
    {
        try {
            $account = AdminAccountModel::create([
                'username' => $request->username,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'date_of_birth' => $request->date_of_birth,
                'role_id' => $request->role_id,
                'password' => bcrypt($request->password),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'status_code' => 200,
                'message' => 'Addmin Account created successfully',
                'data' => new AdminAccountResource($account),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'An error occurred while creating the account'
            ], 500);
        }
    }

    public function update(AccountUpdateRequest $request, string $id)
    {
        try {
            $account = AdminAccountModel::findOrFail($id);

            $account->update([
                'username' => $request->username,
                'date_of_birth' => $request->date_of_birth,
                'role_id' => $request->role_id,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'status_code' => 200,
                'message' => 'Admin Account updated successfully',
                'data' => new AdminAccountResource($account),
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Account not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'An error occurred while updating the account'
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $account = AdminAccountModel::findOrFail($id);

            $account->delete();

            return response()->json([
                'status_code' => 200,
                'message' => 'Admin Account deleted successfully',
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Account not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'An error occurred while deleting the account'
            ], 500);
        }
    }

    public function roleList()
    {
        $roles = RoleAdmin::all();
        return response()->json([
            'status_code' => 200,
            'message' => 'Get all roles successfully',
            'data' => AdminRoleResource::collection($roles)
        ], 200);
    }
}
