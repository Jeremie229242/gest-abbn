<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;


class RoleController extends Controller
{

    public function __construct() {
        $this->middleware(["auth", "auth.admin"]);
    }
    public function index()
    {
        $roles = Role::all();
        return view('Admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('Admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:roles,slug',
        ]);

        Role::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect()->route('Admin.roles.index')->with('success', 'Role ajoute avec succes');
    }

    public function show(Role $role)
    {
        return view('Admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('Admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:roles,slug,' . $role->id,
        ]);

        $role->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect()->route('Admin.roles.index')->with('message','Role mis a jour avec succes');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('Admin.roles.index')->with( 'message','Role supprimmé avec succes');
    }
}
