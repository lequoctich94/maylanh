<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\services\RoleController as ServicesRoleController;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function roleManagement()
    {
        $roleController = new ServicesRoleController();
        $data_role = $roleController->getAllRole();
        $roles = $data_role['data']->collection;
        return view('role_management/role', ['roles' => $roles]);
    }

    public function addRole(Request $req)
    {
        try {
            $roleController = new ServicesRoleController();
            $result = $roleController->saveRole($req);

            if ($result == null) {
                return back()->withErrors(['error' => 'Tạo thất bại']);
            }
        } catch (Exception $e) {
            return back()->withErrors(['errorRoleId' => 'Thêm thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
        return redirect(route('role-management'));
    }

    public function updateRole(Request $req)
    {
        try {
            $roleController = new ServicesRoleController();
            $result = $roleController->updateRole($req);
            if ($result == null) {
                return back()->withErrors(['error' => 'Sửa thất bại']);
            }
            return redirect(route('role-management'));
        } catch (Exception $e) {
            return back()->withErrors(['errorRoleName' => 'Cập nhật thất bại - vui lòng kiểm tra lại (Thông tin bị trùng lặp)']);
        }
        return redirect(route('role-management'));
    }
}
