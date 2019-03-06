<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($service) {
        return Socialite::driver ( $service )->redirect ();
    }

    public function callback($service) {
        $user = Socialite::with ( $service )->user ();
        $id = null;
        $oldUser = User::where('email', $user->email)->get();
        if (count($oldUser) > 0) {
            $id = $oldUser->first()->id;
        } else {
            $id = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'image_path' => $user->avatar,
                'role_id' => 3,
                'verified' => 1,
                'password' => Hash::make($user->token),
            ])->id;
        }


        auth()->loginUsingId($id);

        return redirect('/home');
    }
}
