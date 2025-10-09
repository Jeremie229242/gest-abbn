@extends("layouts.master")
@section('title','GEST-APP | Ajout de Materiels')
@section("contenu")

<!-- resources/views/roles/create.blade.php -->





    <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Créer un nouvel materiel</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.materiels.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Création</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" >
									Liste Materiels
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Création</h4>
						<p class="mb-30">Créer Materiel </p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.materiels.store') }}" method="POST">
                    @csrf

							<section>
                            <input hidden class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}" type="text" name="user_id" id="user_id" value="{{ Auth()->id() }}">

								<div class="row">

									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Type de mateliel:</label>
            <select id="question1" onchange="showHideFields1()" class="selectpicker form-control" name="ordi"  >
										<option value="Ordinateur">Ordinateur</option>
										<option value="Imprimante">Imprimante</option>
                                        <option value="Scanner">Scanner</option>

									</select>
        </div>
									</div>
                                </div>
                                    <div class="row">
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="marque">Marque:</label>
            <input type="text" name="marque" id="marque" class="form-control" required>
        </div>
									</div>
                                    <div class="col-md-6">
                                    <div class="form-group">
            <label for="numero">Addresse IP ou Nom du Poste:</label>
            <input type="text" name="numero" id="numero" class="form-control" required>
        </div>
									</div>
								</div>


                                <div class="row d-none" id="hiddenFields1">
									<div class="col-md-4 col-sm-12 ">
                                    <div class="form-group">
            <label for="capacite">Capacite:</label>
            <input type="text" name="capacite" id="capacite" class="form-control">
        </div>
									</div>

                                    <div class="col-md-4 col-sm-12 ">
                                    <div class="form-group">
            <label for="telephone">Type:</label>
            <select class="selectpicker form-control" name="type"  >
										<option value="Portatif">Portatif</option>
										<option value="Bureautique">Bureautique</option>

									</select>
                </div>
									</div>

                                    <div class="col-md-4 col-sm-12 ">
                                    <div class="form-group">
            <label for="ram">Ram:</label>
            <input type="text" name="ram" id="ram" class="form-control" >
        </div>
									</div>
								</div>

                                <div class="row">
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Appartient-il a un personnel??</label>
            <select class="selectpicker form-control" id="question2" onchange="showHideFields2()" name="apartpers"  >
										<option value="oui">Oui</option>
										<option value="non">Non</option>

									</select>
        </div>
									</div>
                                </div>

                                <div class="row" id="hiddenFields2" style="display: none;" >
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Personnel:</label>
            <select class="selectpicker form-control" name="personnel_id"  >
            @foreach ($personnels as $personnel)
                                        <option value="{{ $personnel->id }}">{{ $personnel->nom }}</option>
                                    @endforeach

									</select>
        </div>
									</div>


                                </div>

                                <div class="row">
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Appartient-il a un site??</label>
            <select class="selectpicker form-control" id="question3" onchange="showHideFields3()" name="apartsite"  >
										<option value="oui">Oui</option>
										<option value="non">Non</option>

									</select>
        </div>
									</div>
                                </div>

                                <div class="row" id="hiddenFields3" style="display: none;" >
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Site:</label>
            <select class="selectpicker form-control" name="site_id"  >
            @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->nom }}</option>
                                    @endforeach

									</select>
        </div>
									</div>


                                </div>

                                <div class="row">
									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Etat??</label>
            <select class="selectpicker form-control"  name="etat" >
										<option value="neuf">Neuf</option>
										<option value="peu user">Peu user</option>

									</select>
        </div>
									</div>
                                </div>
							</section>
							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.materiels.index') }}" class="btn btn-danger" >Annuller</a>
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

  if (selectBox.value === "oui") {
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

