<?php

namespace App\Modules\Rights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RightsController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Rights::welcome");
    }
}
