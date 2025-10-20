<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use App\Models\Site;
use Illuminate\Http\Request;

class PrestationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prests = Prestation::all();
        return view('Admin.prestations.index', compact('prests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sites = Site::all();
        return view('Admin.prestations.create',compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|string',

            'pest_date' => 'required|date',
            'duration_days' => 'required|integer|min:1',
            'montant' => 'nullable|integer|min:1',
            'type' => 'required|string',
            'patr' => 'required',

            'file' => 'nullable|file|mimes:pdf,jpg,png,doc,docx',
        'site_id' => 'required'

        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            $validated['file_path'] = $path;
        }

        $validated['user_id'] = auth()->id();

       // Création de l’abonnement
    $prest = Prestation::create($validated);
    return redirect()->route('Admin.prestations.index')
    ->with('success', 'Prestation ajouté avec succès.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestation  $prestation
     * @return \Illuminate\Http\Response
     */
    public function show(Prestation $prestation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestation  $prestation
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestation $prestation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestation  $prestation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestation $prestation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestation  $prestation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestation $prestation)
    {
        //
    }
}
