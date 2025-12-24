@extends("layouts.master")
@section('title','GEST-APP | Ajout de Prestation')
@section("contenu")



<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Prastations</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Prestations</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">

						</div>
					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($clients) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste du Prestations</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Client</th>
                                    <th>Nbre de prestations</th>
                                    <th>Montant total</th>

                                    <th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                            @foreach ($clients as $client)
								<tr>
									<td class="table-plus">{{ $client->rai_soci }}</td>
                                    <td class="table-plus"><span class="badge badge-success badge-pill"> {{ $client->total_cloturees }}</span></td>
                                    <td class="table-plus">{{ number_format($client->montant_cloture ?? 0, 0, ',', ' ') }} FCFA</td>

                                    <td>
										<div class="dropdown">

												<a class="dropdown-item" href="{{ route('Admin.prestations.details', $client->id) }}"><i class="dw dw-eye"></i> Voir</a>


										</div>
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




@endsection