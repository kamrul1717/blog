<?php

namespace App\Modules\Rights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;

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
        $list = Permission::all();
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
                $permission = new Permission();
                $permission->name = $permissionName;
                $permission->save();
                Session::flash('success', 'Permission Created Successfully!');
                return redirect('rights/permissions/list');
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
