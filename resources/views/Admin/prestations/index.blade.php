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
								<a class="btn btn-primary" href="{{ route('Admin.prestations.create') }}">
									Ajouter
								</a>

							</div>
						</div>
					</div>
				</div>

				<!-- Export Datatable start -->
                @if(count($prests) > 0)
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
                                    <th>Date Prestation</th>
                                    <th>Type Prestation</th>
                                    <th>Durée</th>
                                    <th>Status</th>


									<th>Ajouter le</th>
                                    <th>Par</th>
                                    <th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                            @foreach($prests as $prest)
								<tr>
									<td class="table-plus">{{ $prest->code }}</td>
                                    <td class="table-plus">{{ $prest->client->rai_soci }}</td>
                                    <td class="table-plus">{{ $prest->pest_date->format('d/m/Y') }}</td>

                                    <td>
                                    {{ $prest->type }}
                </td>
                <td>
                {{ $prest->duration_days }}
</td>



<td>
    {{-- Bouton pour changer position --}}

        @if($prest->status == "0")

        <button class="btn btn-sm btn-info" onclick="openClotureModal({{ $prest->id }})">
                ⏸️ Prestation en cour
                </button>
        @endif

</td>


									<td>{{ $prest->created_at }}</td>
                                    <td>{{ $prest->user->name }}</td>

                                    <td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{ route('Admin.prestations.show', $prest->id) }}"><i class="dw dw-eye"></i> Voir</a>


                                                <a class="dropdown-item">
                                                <i class="dw dw-delete-3"></i>

<button class="btn btn-info "
onclick="openResiliationModal({{ $prest->id }})">
Observation
</button>


</a>

                                                <a class="dropdown-item" ><i class="dw dw-delete-3"></i>
                                                <form action="{{ route('Admin.prestations.destroy', $prest->id) }}" method="POST" style="display: inline">
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


    <div class="modal fade" id="resiliationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Observation sur Prestation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="POST">
          @csrf
          <input type="hidden" id="resiliationPrestationId" name="prestation_id">

          <div class="mb-3">
            <label>Observation</label>
            <input type="text" name="observation" id="observation" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Date dedut de la prestation</label>
            <input type="date" name="obs_debut_date" id="obs_debut_date" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Heure debut prestation</label>
            <input type="time" name="obs_debut_time" id="obs_debut_time" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Date fin de la prestation</label>
            <input type="date" name="obs_fin_date" id="obs_fin_date" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Heure fin de la prestation</label>
            <input type="time" name="obs_fin_time" id="obs_fin_time" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-info w-100">Confirmer</button>

        </form>
      </div>
    </div>
  </div>
    </div>







  <div class="modal fade" id="clotureModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Cloture de la Prestation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="cloturePrestationId" name="prestation_id">

          <div class="mb-3">
            <label>Date facturation</label>
            <input type="date" name="fac_date" id="obs_debut_date" class="form-control" required>
          </div>



          <div class="mb-3">
            <label>Date cloture</label>
            <input type="date" name="pestclot_date" id="obs_fin_date" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>montant</label>
            <input type="number" name="montant" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Choisir un fichier</label>
            <div class="custom-file">
			<input type="file" name="file" class="custom-file-input">
			<label class="custom-file-label">Choisir un fichier</label>
		</div>          </div>
          <button type="submit" class="btn btn-danger w-100">Confirmer</button>
        </form>
      </div>
    </div>
  </div>



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
function openResiliationModal(prestationId) {
    // Injecte l'ID dans le formulaire
    document.getElementById('resiliationPrestationId').value = prestationId;

    // Met à jour dynamiquement l'action du formulaire
    const form = document.querySelector('#resiliationModal form');
    form.action = `/Admin/prestations/${prestationId}/observation`;

    // Ouvre le modal
    const modal = new bootstrap.Modal(document.getElementById('resiliationModal'));
    modal.show();
}
</script>

<script>
function openClotureModal(prestationId) {
    // Injecte l'ID dans le formulaire
    document.getElementById('cloturePrestationId').value = prestationId;

    // Met à jour dynamiquement l'action du formulaire
    const form = document.querySelector('#clotureModal form');
    form.action = `/Admin/prestations/${prestationId}/cloture`;

    // Ouvre le modal
    const modal = new bootstrap.Modal(document.getElementById('clotureModal'));
    modal.show();
}
</script>
@endsection
