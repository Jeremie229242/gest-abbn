<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Maintenances;
use App\Models\Materiel;
use App\Models\Prestation;
use App\Models\Site;
use App\Models\Subscription;
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

        $client = Client::count();

        $prestatt = Prestation::where('status', 'Prestation planifier')->count();

        $prestenco = Prestation::where('status', '0')->count();

        $subsactif = Subscription::where('status', '1')->count();

        $subsexp = Subscription::where('status', '0')->where('qnadb', '0')->count();

        $prestclo = Prestation::where('status', 'Prestation clôturée')->count();

        $prest = Prestation::count();

        return view('dashboard', compact('client','prestatt', 'prestenco', 'prestclo', 'prest', 'subsactif', 'subsexp'));
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
