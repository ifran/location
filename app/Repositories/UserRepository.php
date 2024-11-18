<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserRepository
{
    public function save($userInfo)
    {
        $user = User::firstOrNew([
            "user_email" => $userInfo["user_email"]
        ]);
        $user->fill($userInfo);
        $user->save();

        return $user->user_id;
    }

    public function canLogin($userLogin)
    {
        $user = User::where("user_email", $userLogin["email"])
            ->where("user_password", $userLogin["password"])
            ->first();

        if ($user !== null) {
            Log::debug($user->user_id);
            session()->put("userId", $user->user_id);
            return true;
        }

        return false;
    }
}
