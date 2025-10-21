@extends("layouts.master")
@section('title','GEST-APP | Ajout de Prestation')
@section("contenu")

<!-- resources/views/roles/create.blade.php -->





    <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Créer une nouvelle Prestation</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.prestations.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Création</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" >
									Liste Prestations
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Création</h4>
						<p class="mb-30">Créer Prestation </p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.prestations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

							<section>
                            <input hidden class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}" type="text" name="user_id" id="user_id" value="{{ Auth()->id() }}">
                            <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="marque">Nom:</label>
            <input type="text" name="name" id="marque" class="form-control" required>
        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="numero">type de prestation:</label>
            <input type="text" name="type" id="numero" class="form-control" required>
        </div>
									</div>
								</div>


                                <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="marque">Date de Prestation:</label>
            <input type="date" name="pest_date" id="marque" class="form-control" required>
        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="numero">Durée de prestation:</label>
            <input type="number" name="duration_days" id="numero" class="form-control" required>
        </div>
									</div>
								</div>








                                <div class="row">
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Prestation Gratuit??</label>
            <select class="selectpicker form-control" id="question3" onchange="showHideFields3()" name="patr"  >
										<option value="oui">Oui</option>
										<option value="non">Non</option>

									</select>
        </div>
									</div>
                                </div>

                                <div class="row" id="hiddenFields3" style="display: none;" >
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Montant:</label>
            <input type="number" name="montant" id="montant" class="form-control" >

        </div>
									</div>
                                    <div class="col-md-12">
                                    <div class="form-group">
            <label for="name">document:</label>
            <input type="file" name="file" id="numero" class="form-control" >

        </div>
									</div>

                                </div>


                                <div class="row"  >
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Societe:</label>
            <select class="selectpicker form-control" name="site_id"  >
            @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->nom }}</option>
                                    @endforeach

									</select>
        </div>
									</div>


                                </div>

							</section>
							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.prestations.index') }}" class="btn btn-danger" >Annuller</a>
								<button type="submit" class="btn btn-primary" >Valider</button>

                            </div>

						</form>

					</div>
				</div>




			</div>



            <script>

function showHideFields2() {
  var selectBox = document.getElementById("question2");
  var hiddenFields2 = document.getElementById("hiddenFields2");

  if (selectBox.value === "oui") {
    hiddenFields2.style.display = "block";
  } else {
    hiddenFields2.style.display = "none";
  }
}
function showHideFields3() {
  var selectBox = document.getElementById("question3");
  var hiddenFields3 = document.getElementById("hiddenFields3");

  if (selectBox.value === "non") {
    hiddenFields3.style.display = "block";
  } else {
    hiddenFields3.style.display = "none";
  }
}
function showHideFields1() {
  var selectBox = document.getElementById("question1");
  var hiddenFields1 = document.getElementById("hiddenFields1");

  if (selectBox.value === "Ordinateur") {
    hiddenFields1.classList.remove("d-none"); // afficher
  } else {
    hiddenFields1.classList.add("d-none");    // cacher
  }
}



                                </script>






@endsection

