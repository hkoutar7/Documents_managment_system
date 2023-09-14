<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],[
            "name.required" => 'Le champ nom est obligatoire.' ,
            "name.string" => 'Le champ nom doit être une chaîne de caractères.' ,
            "name.max" => 'Le champ nom ne peut pas dépasser 255 caractères.' ,
            "email.required" => 'Le champ email est obligatoire' ,
            "email.string" => 'Le champ email doit être une chaîne de caractères' ,
            "email.email" => 'L\'adresse email n\'est pas valide' ,
            "email.unique" => 'Cette adresse email est déjà utilisée' ,
            "password.required" => 'Le champ mot de passe est obligatoire' ,
            "password.confirmed" => 'La confirmation du mot de passe ne correspond pas' ,
            "password." . Rules\Password::class => 'Le mot de passe doit contenir au moins 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial. ' ,
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_names' => ['User'],
        ]);
        $user->assignRole(3);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
