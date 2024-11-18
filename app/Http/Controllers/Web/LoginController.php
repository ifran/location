<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function logar(Request $request)
    {
        $credentials = [
            "email" => $request->get("user"),
            "password" => md5($request->get("pass"))
        ];

        $userRepository = new UserRepository();
        if ($userRepository->canLogin($credentials)) {
            return redirect("home")->with('success', 'Logado com sucesso!');
        }

        return redirect("login")->with('fail', 'Erros nas credenciais!');
    }
}
