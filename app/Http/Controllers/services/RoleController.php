<?php

namespace App\Http\Controllers\services;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Payload;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function getAllRole()
    {
        $role = Role::all();
        if ($role->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(RoleResource::collection($role), 'Ok', 200);
    }

    public function getAllRoleByStatus($status)
    {
        $roles = Role::where('status', $status)
            ->get();
        if ($roles->isEmpty()) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(RoleResource::collection($roles), 'Ok', 200);
    }

    public function getRoleByIdAndStatus($id, $status)
    {
        $role = Role::where([['role_id', '=', $id], ['status', '=', $status]])
            ->first();
        if ($role == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new RoleResource($role), 'Ok', 200);
    }

    public function getRoleById($id)
    {
        $role = Role::where('role_id', $id)->first();
        if ($role == null) {
            return Payload::toJson(null, 'Data Not Found', 404);
        }
        return Payload::toJson(new RoleResource($role), 'Ok', 200);
    }

    public function saveRole(Request $req)
    {
        DB::beginTransaction();
        try {
            $role = new Role();
            $role->fill([
                'role_id' => $req->role_id,
                'role_name' => $req->role_name,
            ]);

            if ($role->save() == 1) {
                $role = Role::where('role_id', $role->role_id)->first();
                DB::commit();
                return Payload::toJson(new RoleResource($role), 'Completed', 201);
            }
            return Payload::toJson(null, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function updateRole(Request $req)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('role_id', $req->role_id)
                ->update(['role_name' => $req->role_name]);
            DB::commit();
            if ($role == 1) {
                return Payload::toJson($role, 'Completed', 200);
            }
            return Payload::toJson($role, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeRole(Request $req)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('role_id', $req->role_id)
                ->update(['status' => $req->status]);
            DB::commit();
            if ($role == 1) {
                return Payload::toJson($role, 'Completed', 200);
            }
            return Payload::toJson($role, 'Uncompleted', 500);
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}