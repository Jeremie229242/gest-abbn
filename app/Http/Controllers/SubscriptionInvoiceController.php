<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Subscription;
use App\Models\SubscriptionInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubscriptionInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = SubscriptionInvoice::with('subscription.client')
            ->latest()
            ->get();

        return view('Admin.invoices.index', compact('invoices'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscriptions = Subscription::where('status', true)
        ->with('client')
        ->get();

    return view('Admin.invoices.create', compact('subscriptions'));
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'amount' => 'required|numeric|min:0',
            'invoice_date' => 'required|date',
            'currency' => 'required|string|max:10',
            'status' => 'required',
            'file' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        // 📁 Upload fichier facture
        if ($request->hasFile('file')) {
            $data['file_path'] = $request
                ->file('file')
                ->store('invoices', 'public');
        }

        // 🔗 Récupérer l’abonnement
        $subscription = Subscription::findOrFail($data['subscription_id']);

        // 🧾 Création facture
        SubscriptionInvoice::create([
            'invoice_number' => 'FAC-' . now()->format('Ymd') . '-' . rand(1000, 9999),
            'invoice_date' => $data['invoice_date'],
            'amount' => $data['amount'],
            'currency' => $data['currency'],
            'status' => $data['status'],
            'file_path' => $data['file_path'] ?? null,
            'subscription_id' => $subscription->id,
            'client_id' => $subscription->client_id,
        ]);

        return redirect()
            ->route('Admin.invoices.index')
            ->with('message', 'Facture créée avec succès');
    }

    public function updateStatus(Request $request, SubscriptionInvoice $invoice)
    {
        $request->validate([
            'status' => 'required|in:paid,partial,unpaid,cancelled',
        ]);

        $invoice->update([
            'status' => $request->status,
            'paid_at' => $request->status === 'paid' ? now() : null,
        ]);

        return back()->with('message', 'Statut de la facture mis à jour');
    }


    public function client(Request $request)
    {
        $clients = Client::orderBy('rai_soci')->get();

        $invoices = SubscriptionInvoice::with(['client', 'subscription'])
            ->when($request->client_id, function ($query) use ($request) {
                $query->where('client_id', $request->client_id);
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderByDesc('invoice_date')
            ->get();

        return view('Admin.invoices.client', compact('clients', 'invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionInvoice  $subscriptionInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionInvoice $subscriptionInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionInvoice  $subscriptionInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionInvoice $subscriptionInvoice)
    {
        //
    }

    public function download(SubscriptionInvoice $subscriptionInvoice)
    {
        if ($subscriptionInvoice->file_path) {
            return Storage::disk('public')->download($subscriptionInvoice->file_path);
        }
        return back()->with('error', 'Aucun fichier disponible.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscriptionInvoice  $subscriptionInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriptionInvoice $subscriptionInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionInvoice  $subscriptionInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionInvoice $subscriptionInvoice)
    {
        //
    }
}
