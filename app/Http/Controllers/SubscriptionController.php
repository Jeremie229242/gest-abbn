<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Subscription;
use Doctrine\Inflector\Rules\Substitution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subs = Subscription::all();
        return view('Admin.subscriptions.index', compact('subs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $emails = Email::all();
        return view('Admin.subscriptions.create',compact('emails'));

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
            'entity' => 'required|string',
            'subscription_date' => 'required|date',
            'expiration_date' => 'required|date|after:subscription_date',
            'remind_before_days' => 'required|integer|min:1',
            'type' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,jpg,png,doc,docx',
            'emails' => 'required|array',
        'emails.*' => 'email'

        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            $validated['file_path'] = $path;
        }

        $validated['user_id'] = auth()->id();

       // Création de l’abonnement
    $subscription = Subscription::create($validated);
        // Gestion des emails (création si nouveaux)
    $emailIds = [];
    foreach ($validated['emails'] as $mail) {
        $email = Email::firstOrCreate(['email' => $mail]);
        $emailIds[] = $email->id;
    }


    // Nouveaux emails ajoutés manuellement
if ($request->filled('new_emails')) {
    $newEmails = array_map('trim', explode(',', $request->new_emails));
    foreach ($newEmails as $mail) {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $email = Email::firstOrCreate(['email' => $mail], [ 'name' => strtok($mail, '@')]);
            $emailIds[] = $email->id;
        }
    }
}

    // Attache les emails à la subscription
    $subscription->emails()->sync($emailIds);

        return redirect()->route('Admin.subscriptions.index')
            ->with('success', 'Abonnement ajouté avec succès.');
    }


    // public function download(Subscription $subscription)
    // {
    //     if ($subscription->file_path) {
    //         return Storage::download($subscription->file_path);
    //     }
    //     return back()->with('error', 'Aucun fichier disponible.');
    // }

    public function download(Subscription $subscription)
{
    if ($subscription->file_path) {
        return Storage::disk('public')->download($subscription->file_path);
    }
    return back()->with('error', 'Aucun fichier disponible.');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $sub = Subscription::findOrFail($id);

        $emails = Email::all();
        


        return view('Admin.subscriptions.edit', compact('emails', 'sub'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $sub = Subscription::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string',
        'entity' => 'required|string',
        'subscription_date' => 'required|date',
        'expiration_date' => 'required|date|after:subscription_date',
        'remind_before_days' => 'required|integer|min:1',
        'type' => 'required|string',
        'file' => 'nullable|file|mimes:pdf,jpg,png,doc,docx',
        'emails' => 'required|array',
        'emails.*' => 'email'
    ]);

    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('uploads', 'public');
        $validated['file_path'] = $path;
    }

    $validated['user_id'] = auth()->id();

     // mise à jour des infos de l’abonnement
     $sub->update($validated);

     // Emails associés
     $emailIds = [];
     foreach ($validated['emails'] as $mail) {
         $email = Email::firstOrCreate(['email' => $mail]);
         $emailIds[] = $email->id;
     }

     // Nouveaux emails ajoutés manuellement
if ($request->filled('new_emails')) {
    $newEmails = array_map('trim', explode(',', $request->new_emails));
    foreach ($newEmails as $mail) {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $email = Email::firstOrCreate(['email' => $mail]);
            $emailIds[] = $email->id;
        }
    }
}

     // mise à jour de la relation (remplace les anciens par les nouveaux)
     $sub->emails()->sync($emailIds);

    return redirect()->route('Admin.subscriptions.index')
        ->with('success', 'Abonnement mis à jour avec succès.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
