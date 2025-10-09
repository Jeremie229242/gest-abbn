<?php

namespace App\Http\Controllers;


use App\Models\Personnel;
use App\Http\Requests\Personnel\StorePersonnelRequest;
use App\Http\Requests\Personnel\UpdatePersonnelRequest;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.personnels.index', ['personnels' => Personnel::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.personnels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePersonnelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonnelRequest $request)
    {
        $request->merge([ 'user_id'=> auth()->id()]);
        $request->validated($request->validated());

        Personnel::create($request->all());

        return redirect()->route('Admin.personnels.index')->with('success', 'Personnel ajoute avec succes');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Personnel $personnel)
    {
        return view('Admin.personnels.show', compact('personnel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Personnel $personnel)
    {
        return view('Admin.personnels.edit', ['personnel' => $personnel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersonnelRequest  $request
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonnelRequest $request, Personnel $personnel)
    {
        $request->merge([ 'user_id'=> auth()->id()]);
        $request->validated($request->all());

        $personnel->update($request->all());

        return redirect()->route('Admin.personnels.index')->with('success', 'Personnel modifié avec succes');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personnel $personnel)
    {
        $personnel->delete();

        return back()->with('success', 'Personnel supprime avec succes');
    }
}
