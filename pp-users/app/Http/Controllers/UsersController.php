<?php

namespace App\Http\Controllers;

use App\Domain\Users\MountUserByRequestData;
use App\Domain\Users\ValidateUserTypesIdExists;
use App\Domain\Users\ValidateUserUniqueFields;
use App\Models\Users;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'cpf_cnpj' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'user_types_id' => 'required'
        ]);

        (new ValidateUserUniqueFields())->run($request);
        (new ValidateUserTypesIdExists())->run($request);

        $user = (new MountUserByRequestData())->run($request);
        return response()->json(Users::create($user), 201);
    }

    public function get($id)
    {
        $recurso = Users::find($id);
        return response()->json(
            $recurso,
            !empty($recurso) ? 200 : 204
        );
    }

    public function update(int $id, Request $request)
    {
        $users = Users::find($id);

        if (empty($users)) {
            return response()->json(['Error' => 'User not found'], 404);
        }

        $userData = (new MountUserByRequestData())->run($request);
        $users->fill($userData);
        $users->save();

        return response()->json($users);
    }

    public function destroy($id)
    {
        $qtdeSeriesRemovidas = Users::destroy($id);

        if ($qtdeSeriesRemovidas === 0) {
            return response()->json(['Error' => 'User not found'], 404);
        }

        return response()->json('', 204);
    }
}