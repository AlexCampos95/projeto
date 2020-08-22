<?php

namespace App\Http\Controllers;

use App\Models\UserTypes;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class UserTypesController extends Controller
{
    public function index(Request $request)
    {
        return UserTypes::paginate($request->per_page);
    }

    public function get($id)
    {
        $recurso = UserTypes::find($id);
        return response()->json(
            $recurso,
            !empty($recurso) ? 200 : 204
        );
    }
}