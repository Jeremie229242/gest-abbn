<?php
namespace App\Http\Controllers;

use App\Models\Maintenances;
use App\Models\Materiel;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index()
    {

        // $emtotalor = (int) Materiel::where('ordi', "Ordinateur")->count();
        // $emtotalim = (int) Materiel::where('ordi', "Imprimante")->count();
        // $emtotalsc = (int) Materiel::where('ordi', "Scanner")->count();
        // $emtotalorper = (int) Materiel::where('ordi', "Ordinateur")->where('personnel_id')->count();
        // $ematotalor = (int) Maintenances::whereStatus('En Reparation')->count();

        // $sites = Site::select('id', 'nom')
        // ->withCount([
        //     'materiels as total_ordinateurs' => function ($q) {
        //         $q->where('ordi', 'Ordinateur');
        //     },
        //     'materiels as total_scanners' => function ($q) {
        //         $q->where('ordi', 'Scanner');
        //     },
        //     'materiels as total_imprimantes' => function ($q) {
        //         $q->where('ordi', 'Imprimante');
        //     },
        // ])
        // ->orderBy('nom')
        // ->get();

        return view('dashboard');
    }

    public function show($id)
    {
        $site = Site::with(['materiels' => function($query) {
            $query->with('personnel'); // Charge le personnel lié
        }])->findOrFail($id);

        // Séparer les matériels par type
        $ordinateurs = $site->materiels->where('ordi', 'Ordinateur');
        $scanners = $site->materiels->where('ordi', 'Scanner');
        $imprimantes = $site->materiels->where('ordi', 'Imprimante');

        return view('Admin.sites.rapport', compact('site', 'ordinateurs', 'scanners', 'imprimantes'));
    }

}
