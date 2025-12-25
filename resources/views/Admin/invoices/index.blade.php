@extends("layouts.master")
@section('title','GEST-APP | Liste des souscriptions')
@section("contenu")

<!-- resources/views/roles/index.blade.php -->
@if(Session::has('message'))


                                <div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fas fa-check"></i>{{Session::get('message')}}</h5>

</div>
                                @endif
                                <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>subs</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Facturations</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary" href="{{ route('Admin.invoices.create') }}">
									Ajouter
								</a>

							</div>
						</div>
					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($invoices) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste du Abonnements</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">client</th>
                                    <th>Date Facturation</th>





                                    <th>Statut</th>
                                    <th>Action</th>
                                    <!-- <th>Mails</th> -->
									<th>Ajouter le</th>

                                    <th class="datatable-nosort">---</th>
								</tr>
							</thead>
							<tbody>
                            @foreach($invoices as $sub)
								<tr>
									<td class="table-plus">{{ $sub->client->rai_soci }}</td>
                                    <td class="table-plus">{{ $sub->invoice_date->format('d/m/Y') }}</td>



                 <td>
    {{-- Statut d’abonnement --}}
    @php
    $statusClasses = [
        'paid' => 'success',
        'partial' => 'info',
        'unpaid' => 'warning',
        'cancelled' => 'danger',
    ];
@endphp

<span class="badge bg-{{ $statusClasses[$sub->status] ?? 'secondary' }}">
    {{ ucfirst($sub->status) }}
</span>

</td>
@php
    $isLocked = in_array($sub->status, ['paid', 'cancelled']);
@endphp


<td class="space-x-1">

    {{-- PAYÉE --}}
    <form method="POST"
          action="{{ route('Admin.invoices.updateStatus', $sub->id) }}"
          class="inline">
        @csrf
        @method('PATCH')
        <input type="hidden" name="status" value="paid">
        <button
            @disabled($isLocked)
            class="px-2 py-1 text-xs rounded
                   {{ $isLocked ? 'bg-gray-300 cursor-not-allowed' : 'btn btn-success text-white' }}">
            Payée
        </button>
    </form>

    {{-- PARTIELLE --}}
    <form method="POST"
          action="{{ route('Admin.invoices.updateStatus', $sub->id) }}"
          class="inline">
        @csrf
        @method('PATCH')
        <input type="hidden" name="status" value="partial">
        <button
            @disabled($isLocked)
            class="px-2 py-1 text-xs rounded
                   {{ $isLocked ? 'bg-gray-300 cursor-not-allowed' : 'btn btn-info text-white' }}">
            Partielle
        </button>
    </form>

    {{-- IMPAYÉE --}}
    <form method="POST"
          action="{{ route('Admin.invoices.updateStatus', $sub->id) }}"
          class="inline">
        @csrf
        @method('PATCH')
        <input type="hidden" name="status" value="unpaid">
        <button
            @disabled($isLocked)
            class="px-2 py-1 text-xs rounded
                   {{ $isLocked ? 'bg-gray-300 cursor-not-allowed' : 'btn btn-warning text-white' }}">
            Impayée
        </button>
    </form>

    {{-- ANNULÉE --}}
    <form method="POST"
          action="{{ route('Admin.invoices.updateStatus', $sub->id) }}"
          class="inline">
        @csrf
        @method('PATCH')
        <input type="hidden" name="status" value="cancelled">
        <button
            @disabled($isLocked)
            class="px-2 py-1 text-xs rounded
                   {{ $isLocked ? 'bg-gray-300 cursor-not-allowed' : 'btn btn-danger text-white' }}">
            Annuler
        </button>
    </form>

</td>


									<td>{{ $sub->created_at }}</td>


                                    <td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<!-- <a class="dropdown-item" href="{{ route('Admin.subscriptions.show', $sub->id) }}"><i class="dw dw-eye"></i> Voir</a> -->
                                                @if($sub->file_path)
                        <a href="{{ route('Admin.invoices.download', $sub) }}" class="dropdown-item"><i class="dw dw-download"></i>Télécharger</a>
                    @else
                        Aucun fichier
                    @endif
												<!-- <a class="dropdown-item" href="{{ route('Admin.subscriptions.edit', $sub->id) }}"><i class="dw dw-edit2"></i> Modifier</a> -->

												<a class="dropdown-item">

                                                @if(!$sub->resilier)
        <button class="btn btn-danger "
                onclick="openResiliationModal({{ $sub->id }})">
            Résilier
        </button>
    @endif

                                            </a>


												<a class="dropdown-item" ><i class="dw dw-delete-3"></i>
                                                <form action="{{ route('Admin.subscriptions.destroy', $sub->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                                            </a>
											</div>
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
