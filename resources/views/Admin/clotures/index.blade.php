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
							<div class="dropdown">


							</div>
						</div>
					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($clots) > 0)
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Liste du Prestations</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">code</th>
                                    <th>Societé</th>
                                    <th>Debut</th>
                                    <th>Fin</th>
                                    <th>Type Prestation</th>
                                    <th>Durée</th>
                                    <th>Status</th>


									<th>Ajouter le</th>
                                    <th>Par</th>
                                    <th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                            @foreach($clots as $clot)
								<tr>
									<td class="table-plus">{{ $clot->code }}</td>
                                    <td class="table-plus">{{ $clot->client->rai_soci }}</td>
                                    <td class="table-plus">{{ $clot->pest_date->format('d/m/Y') }}</td>
                                    <td class="table-plus">{{ $clot->pestclot_date }}</td>
                                    <td>
                                    {{ $clot->type }}
                </td>
                <td class="duration-cell" data-start="{{ $clot->pest_date }}"
                data-end="{{ $clot->pestclot_date }}">
                -
</td>



<td>
    {{-- Bouton pour changer position --}}

    @if($clot->status == "Prestation clôturée")
            <button class="btn btn-sm btn-danger">
                🔄 Prestation Cloturer
            </button>

        @endif

</td>


									<td>{{ $clot->created_at }}</td>
                                    <td>{{ $clot->user->name }}</td>

                                    <td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('Admin.clotures.show', $clot->id) }}"><i class="dw dw-eye"></i> Voir</a>




                                                <a class="dropdown-item" ><i class="dw dw-delete-3"></i>
                                                <form action="{{ route('Admin.clotures.destroy', $clot->id) }}" method="POST" style="display: inline">
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











    <!-- Export Datatable End -->

			</div>

            <script>
        document.addEventListener("DOMContentLoaded", function() {
            const approveButton = document.getElementById('approve-button');
            const rejectButton = document.getElementById('reject-button');
            const approveForm = document.getElementById('approve-form');
            const rejectForm = document.getElementById('reject-form');

            if (approveButton && approveForm) {
                approveButton.addEventListener('click', function() {
                    if (confirm('Etes vous sur de la finition de cette réparation?')) {
                        approveForm.submit();
                    }
                });
            }

            if (rejectButton && rejectForm) {
                rejectButton.addEventListener('click', function() {
                    if (confirm('Are you sure you want to reject this repair?')) {
                        rejectForm.submit();
                    }
                });
            }
        });
    </script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.duration-cell').forEach(cell => {
        const start = new Date(cell.dataset.start);
        const end = new Date(cell.dataset.end);

        if (!isNaN(start) && !isNaN(end)) {
            const diffTime = end - start;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            cell.textContent = diffDays + " jour" + (diffDays > 1 ? "s" : "");
        } else {
            cell.textContent = "—";
        }
    });
});
</script>

@endsection
