@extends("layouts.master")
@section('title','GEST-APP | Ajout de Maintenances')
@section("contenu")

<!-- resources/views/roles/create.blade.php -->





    <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Créer un nouvel maaintenance</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.maintenances.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Création</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary " href="{{ route('Admin.maintenances.index') }}" >
									Liste Maitenances
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Création</h4>
						<p class="mb-30">Créer Maintenance </p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.maintenances.store') }}" method="POST">
                    @csrf

							<section>
                            <input hidden class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}" type="text" name="user_id" id="user_id" value="{{ Auth()->id() }}">

								<div class="row">

									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Date Panne:</label>
            <input type="date" name="date_panne" id="date_panne" class="form-control" required>

        </div>
									</div>
                                </div>
                                    <div class="row">
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="motif">Motif:</label>
            <input type="text" name="motif" id="motif" class="form-control" required>
        </div>
									</div>

								</div>






                                <div class="row">
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Materiels:</label>
            <select class="selectpicker form-control" name="materiel_id"  >
            @foreach ($materiels as $materiel)
                                        <option value="{{ $materiel->id }}">{{ $materiel->code }}</option>
                                    @endforeach

									</select>
        </div>
									</div>


                                </div>




                                <div class="row" id="fieldsContainer">

<div class="col-md-12">
<div class="form-group">
<label for="reparation_0">Détail reparation:(appuyer sur le + pour ajouter chaque ligne de detail)</label>
<input type="text" name="reparation[]" id="reparation_0" class="form-control" required>

</div>
</div>
</div>
<button type="button" class="btn btn-info" onclick="addMoreFields()">+</button>


							</section>
							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.maintenances.index') }}" class="btn btn-danger" >Annuller</a>
								<button type="submit" class="btn btn-primary" >Valider</button>

                            </div>

						</form>

					</div>
				</div>




			</div>



            <script>
  let fieldIndex = 1;

function addMoreFields() {
    let fieldsContainer = document.getElementById('fieldsContainer');
    let newFieldsDiv = document.createElement('div');
    newFieldsDiv.innerHTML = `


<div class="col-md-12">
<div class="form-group">
<label for="reparation_${fieldIndex}">detail reparation:(appuyer sur le + pour ajouter chaque ligne de detail)</label>
<input type="text" name="reparation[]" id="reparation_${fieldIndex}" class="form-control" required>

</div>
</div>
        `;

    fieldsContainer.appendChild(newFieldsDiv);
    fieldIndex++;
}



                                </script>






@endsection

