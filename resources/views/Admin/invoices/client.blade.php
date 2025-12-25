


@extends("layouts.master")
@section('title','GEST-APP | Ajout Abonnement')
@section("contenu")
<div class="container">

<h4 class="mb-4">🔍 Recherche de factures par client</h4>

<form method="GET" action="{{ route('Admin.invoices.client') }}" class="row g-3 mb-4">

    <div class="col-md-4">
        <label>Client</label>
        <select name="client_id" class="form-control">
            <option value="">-- Tous les clients --</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}"
                    @selected(request('client_id') == $client->id)>
                    {{ $client->rai_soci }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label>Statut</label>
        <select name="status" class="form-control">
            <option value="">-- Tous --</option>
            <option value="unpaid" @selected(request('status')=='unpaid')>Non payée</option>
            <option value="partial" @selected(request('status')=='partial')>Partielle</option>
            <option value="paid" @selected(request('status')=='paid')>Payée</option>
            <option value="cancelled" @selected(request('status')=='cancelled')>Annulée</option>
        </select>
    </div>

    <div class="col-md-3 d-flex align-items-end">
        <button class="btn btn-primary w-100">
            🔍 Rechercher
        </button>
    </div>

</form>



@if(isset($invoices) && $invoices->count())
<div class="card">
    <div class="card-body p-0">

        <table class="table table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>Facture</th>
                    <th>Client</th>
                    <th>Date Facture</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->client->rai_soci }}</td>
                    <td>{{ $invoice->invoice_date->format('d/m/Y') }}</td>
                    <td>{{ number_format($invoice->amount, 0, ',', ' ') }} {{ $invoice->currency }}</td>
                    <td>
                        <span class="badge bg-{{
                            $invoice->status == 'paid' ? 'success' :
                            ($invoice->status == 'partial' ? 'warning' :
                            ($invoice->status == 'cancelled' ? 'secondary' : 'danger'))
                        }}">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </td>
                    <td>


                        @if($invoice->file_path)
                        <a href="{{ route('Admin.invoices.download', $invoice) }}" class="btn btn-sm btn-outline-primary"><i class="dw dw-download"></i>Télécharger</a>
                    @else
                        Aucun fichier
                    @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
@else
    <div class="alert alert-info">
        Aucun résultat trouvé.
    </div>
@endif

</div>
<br><br><br><br>
@endsection


