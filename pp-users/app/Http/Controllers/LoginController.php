<?php

namespace App\Http\Controllers;

use App\Domain\Login\GenerateToken;
use App\Domain\Login\GetUserByEmail;
use App\Domain\Login\ValidadeUserPassword;
use Exception;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class LoginController extends Controller
{
    public function execute(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $user = (new GetUserByEmail())->run($request->email);

            (new ValidadeUserPassword())->run($request->password,$user->password);

            $token = (new GenerateToken())->run($user);

            return response()->json([$user, 'access_token' => $token]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getStatusCode());
        }
    }

}