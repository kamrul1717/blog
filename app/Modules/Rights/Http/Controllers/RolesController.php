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

            return '
            <a href="' . url('rights/roles/edit/'.$list->id) . '" class="btn btn-link"> Edit </a> |
            <a onclick="return confirm(\'Are you sure you want to delete?\');" href="' . url('rights/roles/delete/'.$list->id) . '" class="btn btn-link"> Delete </a> |
            <a href="' . url('rights/roles/assign-role/'.$list->id) . '" class="btn btn-link"> Assign Role </a>
            ';
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
            Session::flash('error', 'Something Went Wrong!');
            return redirect('rights/roles/list');
        }
    }

    public function edit($id)
    {
        $roleInfo = Role::findOrFail($id);
        return view("Rights::roles.edit", compact('roleInfo'));
    }

    public function update($id, Request $request)
    {
        try {
            $roleInfo = Role::where('id', $id)->update([
                'name' => $request->role_name
            ]);
            Session::flash('success', 'Role Update Successfully!');
            return redirect('rights/roles/list');
        }catch (\Exception $e){
            Session::flash('error', 'Something Went Wrong!');
            return redirect('rights/roles/list');
        }
    }

    public function delete($id)
    {
        try {
            Role::where('id', $id)->delete();
            Session::flash('success', 'Role Deleted!');
            return redirect('rights/roles/list');
        }catch (\Exception $e){
            Session::flash('error', 'Something Went Wrong!');
            return redirect('rights/roles/list');
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
