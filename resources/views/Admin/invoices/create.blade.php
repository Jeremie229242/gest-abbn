@extends("layouts.master")
@section('title','GEST-APP | Ajout Abonnement')
@section("contenu")

<!-- resources/views/roles/create.blade.php -->





    <div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Créer un nouvel Abonnement</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="\">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.invoices.index') }}">Liste</a></li>
									<li class="breadcrumb-item active" aria-current="page">Création</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary " href="{{ route('Admin.invoices.index') }}" >
									Liste Facture
								</a>

							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Formulaire de Création</h4>
						<p class="mb-30">Créer Abonnement </p>
					</div>
					<div class="wizard-content">
                    <form action="{{ route('Admin.invoices.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

							<section>

								<div class="row">

									<div class="col-md-12">
                                    <div class="form-group">
            <label for="name">Nom Abonnement:</label>
            <select name="subscription_id"
            class="selectpicker form-control" required>
                <option value="">-- Sélectionner un abonnement --</option>
                @foreach($subscriptions as $sub)
                    <option value="{{ $sub->id }}">
                        {{ $sub->name }} | {{ $sub->client->rai_soci }}
                        ({{ $sub->expiration_date }})
                    </option>
                @endforeach
            </select>

        </div>
									</div>

                                </div>


                                <div class="row" >
									<div class="col-md-6">
                                    <div class="form-group">
            <label for="name">Montant</label>
            <input type="number" name="amount" id="amount" step="0.01" class="form-control" required>

        </div>
									</div>


                                    <div class="col-md-6">
<div class="form-group">
<label for="expiration_date">Monnaie:</label>
<select class="selectpicker form-control"  name="currency" >
										<option value="XAF">XAF</option>
										<option value="XOF">XOF</option>
                                        <option value="EURO">EURO</option>
										<option value="Dollars">Dollars</option>

									</select>
</div>
</div>

                                </div>



                                <div class="row">



                                </div>





                                <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
            <label for="subscription_date">Date facturation:</label>
            <input type="date" name="invoice_date" id="invoice_date" class="form-control" required>

        </div>
									</div>
<div class="col-md-6">
<div class="form-group">
<label for="expiration_date">Statut:</label>
<select class="selectpicker form-control"  name="status" >
										<option value="unpaid">Impayé</option>
										<option value="paid">Payer</option>
                                        <option value="partial">Partiel</option>
										<option value="cancelled">annuller</option>

									</select>
</div>
</div>
</div>



<div class="row">
									<div class="col-md-12">
                                    <div class="form-group">
		<label>Document</label>
		<div class="custom-file">
			<input type="file" name="file" class="custom-file-input">
			<label class="custom-file-label">Choisir un fichier</label>
		</div>
	</div>
									</div>

								</div>







							</section>
							<!-- Step 2 -->
                            <div class="modal-footer justify-content-center">
								<a type="button" href="{{ route('Admin.invoices.index') }}" class="btn btn-danger" >Annuller</a>
								<button type="submit" class="btn btn-primary" >Valider</button>

                            </div>

						</form>

					</div>
				</div>




			</div>










@endsection

