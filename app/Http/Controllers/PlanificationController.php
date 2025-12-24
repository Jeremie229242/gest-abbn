<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Planification;
use App\Models\Prestation;
use Illuminate\Http\Request;

class PlanificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Prestation::where('status', 'Prestation planifier')->get();
        return view('Admin.planifications.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('Admin.planifications.create',compact('clients'));
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
    $plan = Prestation::create($validated);
    return redirect()->route('Admin.planifications.index')
    ->with('success', 'Prestation ajouté avec succès.');
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
     * Display the specified resource.
     *
     * @param  \App\Models\Planification  $planification
     * @return \Illuminate\Http\Response
     */
    public function show(Prestation $planification)
    {
        return view('Admin.planifications.show', compact('planification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Planification  $planification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Prestation::findOrFail($id);


        $clients = Client::all();


        return view('Admin.planifications.edit', compact( 'plan' ,'clients'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planification  $planification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plan = Prestation::findOrFail($id);

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

         // mise à jour des infos de l’abonnement
         $plan->update($validated);





        return redirect()->route('Admin.planifications.index')
            ->with('success', 'Prestation mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planification  $planification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestation $plan)
    {
        $plan->delete();

        return back()->with('success', 'Prestation supprime avec succes');
    }

    public function plan()
{
    $plans = Prestation::where('status', 'Prestation planifier')
        ->get();

    return view('Admin.prestations.moi.plans', compact('plans'));
}
}
