<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();

        $user = User::findOrFail($request->id);
        $user->description = $request->description;
        $user->phone_number = $request->phone_number;
        $user->save();

        session()->flash('updateUser', 'Les informations du profile a ete mis a jour avec succees');
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user_name = userName();
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        session()->flash('deleteUser', 'Le compte '.$user_name.'a été supprimé avec succès.');
        return Redirect::to('/');
    }

    public function addAvatar(Request $request)
    {

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid())  {

            $myfile = $request->file('avatar');
            $namefile = $myfile->hashName();
            $extension = $myfile->extension();

            $avater = Avatar::create([
                'name'  => $namefile ,
                'extension' =>  $extension,
            ]);

            $avatarId = DB::table('avatars')->latest()->first()->id;

            DB::table('users')->where('id','=',userID())->update(['avatar_id' => $avatarId]);

            $request->file('avatar')->storeAs('/'.auth()->user()->name,$namefile,'usersDisk');
            session()->flash('AddPhoto', 'La photo de profil a été mise à jour avec succès');
        }
        else
            session()->flash('EcheckPhoto', 'La photo de profil est echoue');

        return redirect()->back();
    }
}
