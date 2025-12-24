@extends("layouts.master")
@section('title','GEST-APP | Modification  Societé')
@section("contenu")

<!-- resources/views/roles/edit.blade.php -->






    <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Modifier la société : {{ $client->rai_soci }}</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Acceuil</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.clients.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Modification</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary" href="{{ route('Admin.clients.index') }}" >
									Liste des societé
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Modification</h4>
						<p class="mb-30">Modifier Societe</p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')


                            <section>

<div class="row">
        <div class="col-md-12">
        <div class="form-group">
<label for="name">Raison Social:</label>
<input type="text" name="rai_soci" id="rai_soci" value="{{ $client->rai_soci }}" class="form-control" required>
</div>
        </div>
</div>
    <div class="row">

        <div class="col-md-6">
        <div class="form-group">
<label for="description">Intitulé:</label>
<input type="text" name="intitule" id="intitule" value="{{ $client->intitule }}" class="form-control" required>
</div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
<label for="name">Adresse:</label>
<input type="text" name="adresse" id="adresse" value="{{ $client->adresse }}" class="form-control" required>
</div>
        </div>
    </div>


    <div class="row">

        <div class="col-md-6">
        <div class="form-group">
<label for="description">numero:</label>
<input type="number" name="numero" id="numero" value="{{ $client->numero }}" class="form-control" required>
</div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
<label for="name">Intermediaire principale:</label>
<input type="text" name="inter_prin" id="inter_prin" value="{{ $client->inter_prin }}" class="form-control" required>
</div>
        </div>
    </div>








    <div class="row">

<div class="col-md-6">
<div class="form-group">
<label for="description">Pays:</label>
<input type="text" name="pays" id="pays" value="{{ $client->pays }}" class="form-control" required>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="name">Ville:</label>
<input type="text" name="ville" id="ville" value="{{ $client->ville }}" class="form-control" required>
</div>
</div>
</div>

<div class="form-group mt-3">
    <label for="email">Email(s) du client :</label>
    <input type="text"
           name="email"
           id="email"
           class="form-control"
           value="{{ old('email', $client->emails->pluck('email')->implode(', ')) }}"
           placeholder="ex: exemple1@mail.com, exemple2@mail.com">
    <small class="text-muted">
        Tu peux entrer plusieurs emails séparés par une virgule.
    </small>
</div>




</section>







							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.clients.index') }}" class="btn btn-danger" >Annuller</a>
								<button type="submit" class="btn btn-info" >Valider</button>

                            </div>

						</form>

					</div>
				</div>




			</div>







@endsection
