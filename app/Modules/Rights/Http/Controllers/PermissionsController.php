<?php

namespace App\Modules\Rights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;
use App\User;

class PermissionsController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Rights::permissions.index");
    }

    public function getList()
    {
        $list = Permission::getPermissions();
        return Datatables::of($list)
            ->addColumn('action', function ($list) {
                return '<a href="' . url('rights/permissions/add') . '" class="btn btn-xs btn-primary button-color" style="color: white"> <i class="fa fa-folder-open"></i> Add Permission</a>';
            })
            ->rawColumns([])
            ->make(true);
    }

    public function add(Request $request)
    {
        return view("Rights::permissions.create");
    }

    public function save(Request $request)
    {
        try {
            $permissionName = $request->get('permission_name');
            if($permissionName != ''){
                Permission::create(['name' => $permissionName]);
                Session::flash('success', 'Permission Created Successfully!');
                return redirect('rights/permissions/list');
            }else{
                Session::flash('error', 'Please Check Permission Name!');
                return redirect('rights/permissions/list');
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $permissionInfo = Permission::findOrFail($id);
        return view("Rights::permissions.edit", compact('permissionInfo'));
    }

    public function update($id, Request $request)
    {
        try {
            $permissionInfo = Permission::where('id', $id)->update([
                'name' => $request->permission_name
            ]);
            Session::flash('success', 'permission Update Successfully!');
            return redirect('rights/permissions/list');
        }catch (\Exception $e){
            Session::flash('error', 'Something Went Wrong!');
            return redirect('rights/permissions/list');
        }
    }

    public function delete($id)
    {
        try {
            Permission::where('id', $id)->delete();
            Session::flash('success', 'Permission Deleted!');
            return redirect('rights/permissions/list');
        }catch (\Exception $e){
            Session::flash('error', 'Something Went Wrong!');
            return redirect('rights/permissions/list');
        }
    }


    public function assignPermissionToUser($user_id){
        $user = User::find($user_id);
        $roles = $user->roles;
        return view("Rights::permissions.userPermissions", compact('roles', 'user_id'));
    }

    public function getUserPermissionsList($user_id){
        try {
            $user = User::find($user_id);
            $list = Permission::getPermissions();
            $dt = Datatables::of($list)
                ->editColumn('name', function ($list) use ($user) {
                    return $list->name;
                });

            $roles = $user->roles;
            if($roles){
                for($i = 0; $i < count($roles); $i++){
                    $dt->addColumn('role', function ($list) use ($user) {
                        return $user->hasPermissionTo($list->id) ? 'Revoke' : 'Assign';
                    });
                    $dt->addColumn('role', function ($list) use ($user) {
                        return $user->hasPermissionTo($list->id) ? 'Revoke' : 'Assign';
                    });
                    $dt->addColumn('role', function ($list) use ($user) {
                        return $user->hasPermissionTo($list->id) ? 'Revoke' : 'Assign';
                    });
                }
            }
            return $dt->rawColumns([])->make(true);

        }catch (\Exception $e){
//            dd($e->getMessage());
            Session::flash('error', 'Something Went Wrong!');
            return redirect('rights/manage-users');
        }
    }
}
