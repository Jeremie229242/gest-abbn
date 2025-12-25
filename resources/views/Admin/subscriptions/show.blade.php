@extends("layouts.master")
@section('title','GEST-APP | Details subscriptions')
@section("contenu")

<!-- resources/views/roles/show.blade.php -->


    <div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Detail</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.subscriptions.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Detail</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
                <div class="container px-0">
<div class="card card-primary card-outline">
<div class="card-body box-profile">

<h3 class="profile-username text-center">{{ $subscription->code }}</h3>
<p class="text-muted text-center">...............</p>
<ul class="list-group list-group-unbordered mb-3">
<li class="list-group-item">
<b>Nom subscription</b> <a class="float-right">{{ $subscription->name }}</a>
</li>
<li class="list-group-item">
<b>Client</b> <a class="float-right">{{ $subscription->client->rai_soci }}</a>
</li>
<li class="list-group-item">
<b>Date Debut subscription</b> <a class="float-right">{{ $subscription->subscription_date }}</a>
</li>
<li class="list-group-item">
<b>Date Fin subscription</b> <a class="float-right">{{ $subscription->expiration_date }}</a>
</li>
<li class="list-group-item">
<b>Type subscription</b> <a class="float-right">{{ $subscription->type }}</a>
</li>
<li class="list-group-item">




<button class="btn btn-success btn-sm float-right"
        data-bs-toggle="modal"
        data-bs-target="#renewModal{{ $subscription->id }}">
    🔁 Renouveler
</button>



</a>
</li>
<li class="list-group-item">
<b>position</b> <a class="float-right"> <span class="badge bg-{{ $subscription->status ? 'success' : 'danger' }}">
                    {{ $subscription->status ? 'Actif' : 'Inactif' }}
                </span></a>
</li>










<li class="list-group-item">
<b>Ajoutée le</b> <a class="float-right">{{ $subscription->created_at }}</a>
</li>
<li class="list-group-item">
<b>Par</b> <a class="float-right">{{ $subscription->user->name }}</a>
</li>
</ul>
<a href="{{ route('Admin.subscriptions.index') }}" class="btn btn-dark btn-block"><b>Retour</b></a>
</div>

</div>
                </div>
                <br><br><br>


                @if($history->count() > 1)
<div class="card mt-4">
    <div class="card-header bg-light">
        <h6 class="mb-0">🔄 Historique des renouvellements</h6>
    </div>

    <div class="card-body p-0">
        <table class="table table-sm mb-0">
            <thead>
                <tr>
                    <th>Période</th>
                    <th>Statut</th>
                    <th>Type</th>

                </tr>
            </thead>
            <tbody>
                @foreach($history as $sub)
                <tr class="{{ $sub->id === $subscription->id ? 'table-success' : '' }}">
                    <td>
                        {{ $sub->subscription_date->format('d/m/Y') }}
                        →
                        {{ $sub->expiration_date->format('d/m/Y') }}
                    </td>

                    <td>
                        @if($sub->status)
                            <span class="badge bg-success">Actif</span>
                        @elseif($sub->qnadb)
                            <span class="badge bg-secondary">Renouvelé</span>
                        @else
                            <span class="badge bg-danger">Expiré</span>
                        @endif
                    </td>

                    <td>{{ ucfirst($sub->type) }}</td>



                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
<br><br>

                <div class="modal fade" id="renewModal{{ $subscription->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    🔁 Renouvellement de l’abonnement
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST"
                  action="{{ route('Admin.subscriptions.renew.store', $subscription->id) }}">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nom de l’abonnement</label>
                        <input type="text" name="name"
                               class="form-control"
                               value="{{ old('name', $subscription->name) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Date début</label>
                            <input type="date" name="subscription_date"
                                   class="form-control"
                                   value="{{ old('subscription_date', $subscription->expiration_date->addDay()->format('Y-m-d')) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Date fin</label>
                            <input type="date" name="expiration_date"
                                   class="form-control"
                                   value="{{ old('expiration_date') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Jours de rappel</label>
                            <input type="number" name="remind_before_days"
                                   class="form-control"
                                   value="{{ old('remind_before_days', $subscription->remind_before_days) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Type</label>
                            <select name="type" class="form-control">
                                <option value="internet" @selected($subscription->type === 'internet')>
                                    Internet
                                </option>

                                <option value="licence" @selected($subscription->type === 'licence')>
                                    Licence
                                </option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Annuler
                    </button>

                    <button type="submit" class="btn btn-success">
                        💾 Valider le renouvellement
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


@endsection