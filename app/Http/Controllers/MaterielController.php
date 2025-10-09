<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use App\Models\Personnel;
use App\Models\Site;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(["auth", "auth.admin"]);
    }
    public function index()
    {
        $materiels = Materiel::all();
        return view('Admin.materiels.index', compact('materiels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personnels = Personnel::all();
        $sites = Site::all();
        return view('Admin.materiels.create',compact('personnels','sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([ 'user_id'=> auth()->id()]);
        Materiel::create($request->all());

        return redirect()->route('Admin.materiels.index')->with('success', 'Materiel ajoute avec succes');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function show(Materiel $materiel)
    {
        return view('Admin.materiels.show', compact('materiel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materiel = Materiel::findOrFail($id);

        $personnels = Personnel::pluck('nom', 'id');
        $sites = Site::pluck('nom', 'id');



        return view('Admin.materiels.edit', compact('materiel', 'personnels', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $materiel = Materiel::findOrFail($id);
        $request->merge([ 'user_id'=> auth()->id()]);


        $materiel->update($request->all());

        return redirect()->route('Admin.materiels.index')->with('success', 'Materiel modifié avec succes');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materiel $materiel)
    {
        $materiel->delete();

        return back()->with('success', 'Materiel supprime avec succes');
    }
}
