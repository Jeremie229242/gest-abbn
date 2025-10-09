<?php

namespace App\Http\Controllers;

use App\Models\Maintenances;
use App\Models\Materiel;
use Illuminate\Http\Request;

class MaintenancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        $maintenances = Maintenances::all();
        return view('Admin.maintenances.index', compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $materiels = Materiel::all();
        return view('Admin.maintenances.create',compact('materiels'));


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
        $maintenanceData = $request->except('_token');

        $maintenanceData['reparation'] = serialize($request->input('reparation'));
        Maintenances::create($maintenanceData);

        return redirect()->route('Admin.maintenances.index')
        ->with('success','La maintenance créer avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maintenances  $maintenances
     * @return \Illuminate\Http\Response
     */
    public function show(Maintenances $maintenance)
    {

        $maintenance->reparation = unserialize($maintenance->reparation);

        return view('Admin.maintenances.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maintenances  $maintenances
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maintenance = Maintenances::findOrFail($id);

        $materiels = Materiel::pluck('code', 'id');
        $maintenance->reparation = unserialize($maintenance->reparation);

        return view('Admin.maintenances.edit', compact('materiels', 'maintenance'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maintenances  $maintenances
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $maintenance = Maintenances::findOrFail($id);
        $request->merge([ 'user_id'=> auth()->id()]);
        $maintenanceData = $request->except('_token', '_method');

            // Serialize the array data before updating it
            $maintenanceData['reparation'] = serialize($request->input('reparation'));


            $maintenance->update($maintenanceData);




            return redirect()->route('Admin.maintenances.index')
            ->with('success','Le Maintenance a été modifier avec succes');
    }


    public function approve($id)
    {
        $maintenances = Maintenances::findOrFail($id);
        $maintenances->update(['status' => 'Deja Réparer']);

        return redirect()->back()->with('success','Maintenance terminée avec succes');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintenances  $maintenances
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenances $maintenance)
    {
        $maintenance->delete();

        return back()->with('success', 'Maintenance supprime avec succes');
    }
}
