<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function form()
    {
        return view('user');
    }

    public function register(Request $request)
    {
        $userFill = [
            "user_name" => $request->get("name"),
            "user_email" => $request->get("email"),
            "user_password" => md5($request->get("pass")),
            "user_phone" => $request->get("phone"),
        ];

        $userRepository = new UserRepository();
        $userId = $userRepository->save($userFill);

        session()->put("userId", $userId);
        return redirect("home")->with('success', 'Redirecionado com sucesso!');
    }
}
