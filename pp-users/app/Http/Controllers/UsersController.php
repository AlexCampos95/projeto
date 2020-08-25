<?php

namespace App\Http\Controllers;

use App\Common\Cache\Configs;
use App\Domain\Users\MountUserByRequestData;
use App\Domain\Users\ValidateUserTypesIdExists;
use App\Domain\Users\ValidateUserUniqueFields;
use App\Models\Users;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        try {
            (new ValidateUserUniqueFields())->run($request);
            (new ValidateUserTypesIdExists())->run($request);

            $user = (new MountUserByRequestData())->run($request);
            return response()->json(Users::create($user), 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function get($id)
    {
        $cacheKey = Configs::USERS_PREFIX . $id;
        $recurso = Cache::get($cacheKey);
        if (empty($recurso)) {
            $recurso = Users::find($id);
            Cache::add($cacheKey, $recurso, Configs::DAY);
        }

        if (empty($recurso)) {
            return response()->json(['Error' => 'User not found'], 404);
        }

        return response()->json($recurso, 200);
    }

    public function update(int $id, Request $request)
    {
        $cacheKey = Configs::USERS_PREFIX . $id;
        Cache::forget($cacheKey);

        $users = Users::find($id);

        if (empty($users)) {
            return response()->json(['Error' => 'User not found'], 404);
        }

        $userData = (new MountUserByRequestData())->run($request);
        $users->fill($userData);
        $users->save();

        Cache::add($cacheKey, $users);
        return response()->json($users);
    }

    public function destroy($id)
    {
        $cacheKey = Configs::USERS_PREFIX . $id;
        Cache::forget($cacheKey);

        $qtdeSeriesRemovidas = Users::destroy($id);

        if ($qtdeSeriesRemovidas === 0) {
            return response()->json(['Error' => 'User not found'], 404);
        }

        return response()->json(['message' => "User removed"], 200);
    }
}