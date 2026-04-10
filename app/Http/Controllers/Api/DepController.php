<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;


class DepController extends Controller
{
    public function view(Department $dep){

      

        return response()->json(["departments"=>$dep]);
    }

    public function edit(Department $dep){
        

    return response()->json(["departments_edit"=>$dep]);
    }

}
