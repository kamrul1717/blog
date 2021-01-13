<?php

namespace App\Modules\Rights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RightsController extends Controller
{
    public function manageUsers(){
        return view("Rights::index");
    }

    public function getUsersList(){
        $users = User::all();
        return Datatables::of($users)
            ->addColumn('action', function ($list) {

                return '
                <a href="' . url('rights/roles/assign-role/'.$list->id) . '" class="btn btn-sm btn-primary" style="color: white">Assign Role</a>
                <a href="' . url('rights/roles/assign-permission/'.$list->id) . '" class="btn btn-sm btn-info" style="color: white">Assign Permission</a>
                ';
            })
            ->editColumn('role', function ($list) {
                $user = User::findOrFail($list->id);
                $roles = $user->roles()->pluck('name');
                return count($roles) > 0 ? explode(',',$roles[0]) : '';
            })
            ->rawColumns([])
            ->make(true);
    }
}
