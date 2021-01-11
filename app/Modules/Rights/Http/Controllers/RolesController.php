<?php

namespace App\Modules\Rights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Modules\Rights\Models\Role;

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

    public function addRole()
    {
        
    }
}
