@extends("layouts.master")
@section('title','GEST-APP | Ajout de Prestation')
@section("contenu")
<h4>Abonnements</h4>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Client</th>
            <th>Abonnement</th>
            <th>Expiration</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subscriptions as $sub)
        <tr>
            <td>{{ $sub->client->rai_soci ?? '-' }}</td>
            <td>{{ $sub->name }}</td>
            <td>{{ $sub->expiration_date }}</td>
            <td>
                <span class="badge bg-{{ $sub->status ? 'success' : 'danger' }}">
                    {{ $sub->status ? 'Actif' : 'Inactif' }}
                </span>
            </td>
            <td>
                <a href="{{ route('subscriptions.show', $sub->id) }}" class="btn btn-sm btn-primary">
                    Voir
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
