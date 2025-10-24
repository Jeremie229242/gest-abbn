<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Prestation;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $clients = Client::all();
        return view('Admin.prestations.create',compact('clients'));
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
            'pest_fin_date' => 'required|date',
            'type' => 'required|string',
           'prest_debut_time' => 'required|date_format:H:i',
    'prest_fin_time'   => 'required|date_format:H:i|after:prest_debut_time',
        'client_id' => 'required'

        ]);



        $validated['user_id'] = auth()->id();

       // Création de l’abonnement
    $prest = Prestation::create($validated);
    return redirect()->route('Admin.prestations.index')
    ->with('success', 'Prestation ajouté avec succès.');


    }

    public function observe(Request $request, Prestation $prestation)
    {
        $validated = $request->validate([
            'observation' => 'required|string|max:255',
            'obs_debut_date' => 'required|date',
            'obs_fin_date' => 'required|date',
            'obs_debut_time' => 'required|date_format:H:i',
            'obs_fin_time' => 'required|date_format:H:i|after:obs_debut_time',
        ]);

        $prestation->observations()->create($validated);

        return redirect()
            ->route('Admin.prestations.index')
            ->with('success', 'Observation enregistrée avec succès.');
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
    public function download(Prestation $prestation)
    {
        if ($prestation->file_path) {
            return Storage::disk('public')->download($prestation->file_path);
        }
        return back()->with('error', 'Aucun fichier disponible.');
    }

    public function togglePosition(Prestation $prestation)
{
    $prestation->status = !$prestation->status; // Inverse l’état
    $prestation->save();

    $message = $prestation->status
        ? 'Prestation Cloturer avec succes.'
        : 'Prestation encours avec succes.';

    return back()->with('success', $message);
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
        $prestation->delete();

        return back()->with('success', 'Prestation supprime avec succes');
    }
}
