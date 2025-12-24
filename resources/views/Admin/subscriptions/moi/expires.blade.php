@extends("layouts.master")
@section('title','GEST-APP | Ajout de Prestation')
@section("contenu")



<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Souscriptions Expirer</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Souscriptions Expirer</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">

						</div>
					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($expires) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste du Souscriptions Expirer</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>

								<tr>
									<th class="table-plus datatable-nosort">Client</th>
                                    <th>Date Abbn</th>
                                    <th>Date exp</th>
                                    <th>Details</th>

								</tr>
							</thead>
							<tbody>
                            @foreach ($expires as $p)
								<tr>
									<td class="table-plus">{{ $p->client->rai_soci }}</td>
                                    <td class="table-plus">{{ $p->subscription_date->format('d/m/Y') }}</td>
                                    <td class="table-plus">{{ $p->expiration_date->format('d/m/Y') }}</td>
                                    <td>
                                    <a class="dropdown-item" href="{{ route('Admin.subscriptions.show', $sub->id) }}"><i class="dw dw-eye"></i> Voir</a>

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