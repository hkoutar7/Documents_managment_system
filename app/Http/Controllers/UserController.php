<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('permission:user_list', ['only' => ['index']]);
        $this->middleware('permission:user_create', ['only' => ['create','store']]);
        $this->middleware('permission:user_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user_delete', ['only' => ['destroy']]);
        $this->middleware('permission:user_changeStatus', ['only' => ['changeStatus']]);
        // $this->middleware('permission:user_show', ['only' => ['show']]);
    }

    public function index() : View
    {
        $users = User::where('id','!=',userID())->get();
        $num_users = User::get()->count();

        return view('users.index',compact('users', 'num_users'));
    }

    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'role_names' => $input['roles'],
        ]);

        $user->assignRole($request->input('roles'));

        Alert::success('Utilisateur ajouté avec succès', 'L\'utilisateur "'.$request['name'].'" a été ajouté');
        return redirect()->route('users.index');
    }

    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ],[
            'name.required' => 'Le champ du nom est requis.',
            'email.required' => 'Le champ de l\'adresse e-mail est requis.',
            'email.email' => 'L\'adresse e-mail doit être une adresse valide.',
            'email.unique' => 'L\'adresse e-mail est déjà utilisée.',
            'password.required' => 'Le champ du mot de passe est requis.',
            'password.same' => 'Le mot de passe doit correspondre au champ de confirmation du mot de passe.',
            'roles.required' => 'Le champ des rôles est requis.',
        ]);


        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
            $user = User::find($id);
            $user->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
                'role_names' => $input['roles'],
            ]);
        }
        else{
            $input = Arr::except($input,array('password'));
            $user = User::find($id);
            $user->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'role_names' => $input['roles'],
            ]);
        }


        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        Alert::success('Utilisateur modifié avec succès', 'L\'utilisateur "'.$request['name'].'" a été modifié');
        return redirect()->route('users.index');
    }

    public function destroy(Request $request)
    {
        User::find($request->id)->delete();

        Alert::success('Utilisateur supprimé avec succès', 'L\'utilisateur "'.$request['name'].'" a été supprimé');
        return redirect()->route('users.index');
    }

    public function changeStatus(Request $request)
    {
        if ($request->status == 1)
        {
            Alert::success('Compte desactivé avec succès', 'Le compte de l\'utilisateur "'.$request['name'].'" a été desactivé');
            DB::table('users')->where("id", $request->id)->update(['isActive' =>  0]);
        }
        else
        {
            Alert::success('Compte activé avec succès', 'Le compte de l\'utilisateur "'.$request['name'].'" a été activé');
            DB::table('users')->where("id", $request->id)->update(['isActive' =>  1]);
        }
        return redirect()->back();
    }
}
