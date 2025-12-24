<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\Site\StoreSiteRequest;
use App\Http\Requests\Site\UpdateSiteRequest;
use App\Models\Email;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.clients.index', ['clients' => Client::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['user_id' => auth()->id()]);
        $data = $request->all();

        // 1️⃣ Création du client
        $client = Client::create($data);

        // 2️⃣ Récupération des emails (séparés par des virgules)
        if (!empty($request->email)) {
            $emails = array_filter(array_map('trim', explode(',', $request->email)));


            foreach ($emails as $mail) {
                // Vérifie si l'email existe déjà
                $email = Email::firstOrCreate(
                    ['email' => $mail],
                    [
                        'code' => uniqid('em_'),
                        'name' => $mail,
                        'user_id' => auth()->id(),
                        'client_id' => $client->id,
                    ]
                );

                // Associe l’email au client via la table pivot
                $client->emails()->syncWithoutDetaching([$email->id]);
            }
        }

        return redirect()
            ->route('Admin.clients.index')
            ->with('success', 'Client ajouté avec succès avec ses emails.');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('Admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('Admin.clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiteRequest  $request
     * @param  \App\Models\Client  $site
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiteRequest $request, Client $client)
    {
        // 1️⃣ Ajoute l'ID de l'utilisateur connecté
        $request->merge(['user_id' => auth()->id()]);

        // 2️⃣ Récupère uniquement les données validées
        $validated = $request->validated();

        // 3️⃣ Mise à jour du client
        $client->update($validated);

        // 4️⃣ Gestion des emails multiples
        if (!empty($request->email)) {
            $emails = array_filter(array_map('trim', explode(',', $request->email)));
            $emailIds = [];
            foreach ($emails as $mail) {
                $email = Email::firstOrCreate(
                    ['email' => $mail],
                    [
                        'code' => uniqid('em_'),
                        'name' => $mail,
                        'user_id' => auth()->id(),
                        'client_id' => $client->id,
                    ]
                );
                $emailIds[] = $email->id;


            }
            //$client->emails()->syncWithoutDetaching([$email->id]);
            $client->emails()->sync($emailIds);
        }

        // 5️⃣ Retour
        return redirect()
            ->route('Admin.clients.index')
            ->with('success', 'Client modifié avec succès ✅');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return back()->with('success', 'Client supprime avec succes');
    }
}
