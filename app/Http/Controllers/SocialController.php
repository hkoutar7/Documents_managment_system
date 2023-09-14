<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function Callback($provider)
    {

        $userSocial = Socialite::driver($provider)->stateless()->user();

        $user = User::where([
            'provider' => $provider ,
            'provider_id' => $userSocial->id,
        ])->first();

        if ($user)
        {
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        else {
            $newUser = User::create([
                'name' => $userSocial->name,
                'email' => $userSocial->email,
                'password' => Hash::make('123456789'),
                'provider' => $provider,
                'provider_id' => $userSocial->id,
                'provider_token' => $userSocial->token,
                'email_verified_at' => now(),
                'role_names' => ["User"],
            ]);

            $newUser->assignRole(3);

            Auth::login($newUser);
            return redirect()->route('dashboard');
        }

    }


}
