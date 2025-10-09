<?php

namespace App\Http\Controllers;


// app/Http/Controllers/UserController.php

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware(["auth", "auth.admin"]);
    }

    public function index()
    {
        $users = User::all();
        return view('Admin.utilisateurs.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('Admin.utilisateurs.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'roles' => 'array',
            'permissions' => 'array',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->roles()->attach($request->input('roles'));
        $user->permissions()->attach($request->input('permissions'));

        return redirect()->route('Admin.utilisateurs.index')->with( session()
        ->flash('message','Utilisateurs enregistré avec succes'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.utilisateurs.show', compact('user'));
    }
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        $permissions = Permission::all();
        return view('Admin.utilisateurs.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required',
            'email' => 'required',
            'password' => 'nullable|string|min:6',
            'roles' => 'array',
            'permissions' => 'array',
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),

        ]);

        $user->roles()->sync($request->input('roles', []));
        $user->permissions()->sync($request->input('permissions', []));
//dd($user);
        return redirect()->route('Admin.utilisateurs.index')->with( session()
        ->flash('message','Utilisateurs mis a jour avec succes'));
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();

        return back()->with( session()
        ->flash('message','Utilisateurs supprimmé avec succes'));
    }
}
