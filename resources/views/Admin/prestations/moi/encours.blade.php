@extends("layouts.master")
@section('title','GEST-APP | Ajout de Prestation')
@section("contenu")



<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Prastations Encours</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Prestations Encours</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">

						</div>
					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($encours) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste du Prestations</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Client</th>
                                    <th>Type de prestation</th>
                                    <th>Debut</th>
                                    <th>fin</th>
                                    <th>Montant</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
                            @foreach ($encours as $p)
								<tr>
									<td class="table-plus">{{ $p->client->rai_soci }}</td>
                                    <td class="table-plus">{{ $p->type }}</td>
                                    <td class="table-plus">{{ $p->pest_date }}</td>
                                    <td class="table-plus">{{ $p->pestclot_date }}</td>
                                    <td class="table-plus"><span class="badge badge-success badge-pill"> {{ number_format($p->montant, 0, ',', ' ') }}</span></td>

                                    <td>


    @if($p->observations->isNotEmpty())
    <button
        class="btn btn-info btn-sm"
        data-toggle="modal"
        data-target="#obsModal{{ $p->id }}">
        Observations
    </button>
@else
    <span class="badge bg-secondary">Aucune observation</span>
@endif


</td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
                @else
        <p>Aucun Nom trouvé.</p>
    @endif

    <div class="modal fade" id="obsModal{{ $p->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    Observations – {{ $p->client->rai_soci }}
                </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                @if($p->observations->count())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Observation</th>
                                <th>Début</th>
                                <th>Fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($p->observations as $obs)
                            <tr>
                                <td>{{ $obs->observation }}</td>
                                <td>
                                    {{ $obs->obs_debut_date }}
                                    {{ $obs->obs_debut_time }}
                                </td>
                                <td>
                                    {{ $obs->obs_fin_date }}
                                    {{ $obs->obs_fin_time }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-muted">
                        Aucune observation pour cette prestation.
                    </p>
                @endif
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>



@endsection