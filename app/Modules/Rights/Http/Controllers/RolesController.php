<?php

namespace App\Modules\Rights\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;

class RolesController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Rights::roles.index");
    }

    public function getList()
    {
    	$list = Role::all();
		return Datatables::of($list)
        ->addColumn('action', function ($list) {

            return '<a href="' . url('rights/roles/add') . '" class="btn btn-xs btn-primary button-color" style="color: white"> <i class="fa fa-folder-open"></i> Add Role</a>';
        })
        ->rawColumns([])
        ->make(true);
    }

    public function add(Request $request)
    {
        return view("Rights::roles.create");
    }

    public function save(Request $request)
    {
        try {
            $roleName = $request->get('role_name');
            if($roleName != ''){
                $role = new Role;
                $role->name = $roleName;
                $role->save();
                Session::flash('success', 'Role Created Successfully!');
                return redirect('rights/roles/list');
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function assignRole($id)
    {
        try {
            $userInfo = User::findOrFail($id);
            $roles = Role::orderBy('name')->pluck('name', 'id');
            return view("Rights::roles.assignRoleForm", compact('userInfo', 'roles'));
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    public function saveRole($id, Request $request)
    {
        try {
            $userInfo = User::findOrFail($id);
            $role = $request->get('role');
            $assigned = $userInfo->assignRole($role);
            Session::flash('success', 'Role Assigned Successfully!');
            return redirect('rights/manage-users');
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
