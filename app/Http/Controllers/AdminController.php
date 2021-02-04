<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\PermissionUser;
use App\Models\Role;
use App\Models\RoleUser;

class AdminController extends Controller
{
    
    public function index() {
        return view('admin.index');
    }

    public function roles() {
        $roles = Role::all();
        return view('admin.roles', ['roles' => $roles]);
    }

    public function permissions() {
        $permissions = Permission::all();
        return view('admin.permission', ['permissions' => $permissions]);
    }

    public function permissionsAdd() {
        return view('admin.permission-add');
    }

    public function permissionsStore(Request $request) {
        try {
            $data = $request->except(['_token']);
            Permission::create($data);
            return redirect('admin/permissions')->with('success', 'Permission created.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function permissionsEdit(Permission $permission) {
        return view('admin.permission-edit', ['permission' => $permission]);
    }

    public function permissionsUpdate(Request $request, Permission $permission) {
        try {
            $data = $request->except(['_token']);
            $permission->update($data);
            return redirect('admin/permissions')->with('success', 'Permission Updated');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function permissionsDelete(Request $request) {
        try {
            // RETRIEVE PERMISSION INFORMATION
            $permission = Permission::find($request->input('permission_id'));
            // DETACH PERMISSION FROM ROLE
            $permission->Roles()->delete();
            // DETACH PERMISSION FROM USER
            $permission->Users()->delete();
            // DELETE PERMISSION
            // $permission->delete();
            return response()->json(['status' => 'success', 'message' => 'Permission successfully deleted.']);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function rolesAdd() {
        $permissions = Permission::all();
        return view('admin.roles-add', ['permissions' => $permissions]);
    }

    public function rolesStore(Request $request) {
        try {
            $data = $request->except(['_token', 'permissions']);
            $role = Role::create($data);
            if($request->has('permissions')) {
                $role->attachPermissions($request->input('permissions'));
            }

            return redirect('admin/roles')->with('success', 'New Role created');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function rolesEdit(Role $role) {
        $permissions = Permission::all();
        return view('admin.role-edit', ['role' => $role, 'permissions' => $permissions]);
    }

    public function rolesUpdate(Request $request, Role $role) {
        try {
            $data = $request->except(['_token', 'permissions']);
            $role->update($data);
            $role->detachPermissions($role->permissions);
            if($request->has('permissions')) {
                $role->attachPermissions($request->input('permissions'));
            }

            return redirect('admin/roles')->with('success', 'Role updated.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

}
