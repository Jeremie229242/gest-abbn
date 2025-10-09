@extends("layouts.master")
@section('title','GEST-APP | Rapport')
@section("contenu")


                                <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Le Rapport du site {{ $site->nom }}</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Rapport</li>
								</ol>
							</nav>
						</div>

					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($ordinateurs) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste des Ordinateurs</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
                                <th>Code</th>
                <th>Marque</th>
                <th>Capacité</th>
                <th>RAM</th>
                <th>État</th>
                <th>Personnel</th>
            </tr>
							</thead>
							<tbody>
                            @foreach ($ordinateurs as $m)
                <tr>
                    <td>{{ $m->code }}</td>
                    <td>{{ $m->marque }}</td>
                    <td>{{ $m->capacite }}</td>
                    <td>{{ $m->ram }}</td>
                    <td>{{ $m->etat }}</td>
                    <td>{{ $m->personnel ? $m->personnel->nom : '-' }}</td>
                </tr>
            @endforeach
							</tbody>
						</table>
					</div>
				</div>
                @else
        <p>Aucun Ordinateur trouvé.</p>
    @endif
				<!-- Export Datatable End -->





<!-- Export Datatable start -->
@if(count($scanners) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste des Scanners</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
                                <th>Code</th>
                <th>Marque</th>
                <th>Capacité</th>
                <th>RAM</th>
                <th>État</th>
                <th>Personnel</th>
            </tr>
							</thead>
							<tbody>
                            @foreach ($scanners as $m)
                <tr>
                    <td>{{ $m->code }}</td>
                    <td>{{ $m->marque }}</td>
                    <td>{{ $m->capacite }}</td>
                    <td>{{ $m->ram }}</td>
                    <td>{{ $m->etat }}</td>
                    <td>{{ $m->personnel ? $m->personnel->nom : '-' }}</td>
                </tr>
            @endforeach
							</tbody>
						</table>
					</div>
				</div>
                @else
        <p>Aucun Scanner trouvé.</p>
    @endif
				<!-- Export Da-->







<!-- Export Datatable start -->
@if(count($imprimantes) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste des Imprimantes</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
                                <th>Code</th>
                <th>Marque</th>
                <th>Capacité</th>
                <th>RAM</th>
                <th>État</th>
                <th>Personnel</th>
            </tr>
							</thead>
							<tbody>
                            @foreach ($imprimantes as $m)
                <tr>
                    <td>{{ $m->code }}</td>
                    <td>{{ $m->marque }}</td>
                    <td>{{ $m->capacite }}</td>
                    <td>{{ $m->ram }}</td>
                    <td>{{ $m->etat }}</td>
                    <td>{{ $m->personnel ? $m->personnel->nom : '-' }}</td>
                </tr>
            @endforeach
							</tbody>
						</table>
					</div>
				</div>
                @else
        <p>Aucun Imprimante trouvé.</p>
    @endif
				<!-- Export Da-->

			</div>


@endsection



