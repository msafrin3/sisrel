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
use App\Models\Meta;
use App\Models\MetaData;

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
            dd($permission);
            $permission->delete();
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

    public function meta() {
        $metas = Meta::all();
        return view('admin.meta', ['metas' => $metas]);
    }

    public function metaAdd() {
        return view('admin.meta-add');
    }

    public function metaStore(Request $request) {
        try {
            $data = $request->except(['_token']);
            Meta::create($data);
            return redirect('admin/meta')->with('success', 'Meta Added');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function metaEdit(Meta $meta) {
        return view('admin.meta-edit', ['meta' => $meta]);
    }

    public function metaUpdate(Request $request, Meta $meta) {
        try {
            $data = $request->except(['_token']);
            $meta->update($data);
            return redirect('admin/meta')->with('success', 'Meta Updated.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function metaDelete(Request $request) {
        try {
            $meta = Meta::find($request->input('meta_id'));
            $meta->MetaData()->delete();
            $meta->delete();

            return response()->json(['status' => 'success', 'message' => 'Meta Deleted']);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function metaData() {
        $metadatas = MetaData::all();
        return view('admin.metadata', ['metadatas' => $metadatas]);
    }

    public function metaDataAdd() {
        $metas = Meta::all();
        return view('admin.metadata-add', ['metas' => $metas]);
    }

    public function metaDataStore(Request $request) {
        try {
            $data = $request->except(['_token']);
            MetaData::create($data);
            return redirect('admin/metadata')->with('success', 'Meta Data Created');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function metaDataEdit(MetaData $metadata) {
        $metas = Meta::all();
        return view('admin.metadata-edit', ['metadata' => $metadata, 'metas' => $metas]);
    }

    public function metaDataUpdate(Request $request, MetaData $metadata) {
        try {
            $data = $request->except(['_token']);
            $metadata->update($data);
            return redirect('admin/metadata')->with('success', 'Meta Data Updated.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function metaDataDelete(MetaData $metadata) {
        try {
            $metadata->delete();
            return response()->json(['status' => 'success', 'message' => 'Meta Data deleted']);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function users() {
        $users = User::withTrashed()->get();
        return view('admin.users', ['users' => $users]);
    }

    public function usersAdd() {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users-add', [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function usersStore(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
        try {
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            if($request->has('roles')) {
                $user->attachRoles($request->input('roles'));
            }
            if($request->has('permissions')) {
                $user->attachPermissions($request->input('permissions'));
            }
            return redirect('admin/users')->with('success', 'User Successfully Created.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function usersEdit(User $user) {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users-edit', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function usersUpdate(Request $request, User $user) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'confirmed'
        ]);
        try {
            if($data['password'] == null) {
                unset($data['password']);
            } else {
                $data['password'] = bcrypt($data['password']);
            }
            $user->update($data);
            // DETACH ALL ROLES OF THE USER BEFORE ASSIGN IN AGAIN.
            $user->detachRoles($user->roles);
            if($request->has('roles')) {
                $user->syncRoles($request->input('roles'));
            }
            // DETACH ALL PERMISSIONS OF THE USER BEFORE ASSIGN IN AGAIN.
            $user->detachPermissions($user->permissions);
            if($request->has('permissions')) {
                $user->syncPermissions($request->input('permissions'));
            }

            return redirect('admin/users')->with('success', 'User Successfully Updated.');
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function usersDisable(Request $request) {
        $user = User::withTrashed()->where('id', $request->input('user_id'))->first();
        try {
            if($request->input('is_permanent') == 1) {
                try { 
                    $user->detachRoles($user->roles);
                    $user->detachPermissions($user->permissions);
                    $user->forceDelete();
                } catch(\Exception $e) { 

                }
            } else {
                if($request->input('is_enable') == 1) {
                    $user->restore();
                } else {
                    // $user->detachRoles($user->roles);
                    // $user->detachPermissions($user->permissions);
                    $user->delete();
                }
            }
            return response()->json(['status' => 'success', 'message' => 'User Successfully Deleted.']);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}
