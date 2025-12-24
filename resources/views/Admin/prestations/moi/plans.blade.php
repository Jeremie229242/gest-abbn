@extends("layouts.master")
@section('title','GEST-APP | Ajout de Prestation')
@section("contenu")



<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Prastations En Attente</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Prestations En Attente</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">

						</div>
					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($plans) > 0)
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
								</tr>
							</thead>
							<tbody>
                            @foreach ($plans as $p)
								<tr>
									<td class="table-plus">{{ $p->client->rai_soci }}</td>
                                    <td class="table-plus">{{ $p->type }}</td>
                                    <td class="table-plus">{{ $p->pest_date }}</td>
                                    <td class="table-plus">{{ $p->pestclot_date }}</td>
                                    <td class="table-plus"><span class="badge badge-success badge-pill"> {{ number_format($p->montant, 0, ',', ' ') }}</span></td>


								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
                @else
        <p>Aucun Nom trouvé.</p>
    @endif




@endsection